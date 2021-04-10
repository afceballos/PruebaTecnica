<?php
/**
 * CPTs edit page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Engine_CPT_Tax_Page_Edit' ) ) {

	/**
	 * Define Jet_Engine_CPT_Tax_Page_Edit class
	 */
	class Jet_Engine_CPT_Tax_Page_Edit extends Jet_Engine_CPT_Page_Base {

		/**
		 * Page slug
		 *
		 * @return string
		 */
		public function get_slug() {
			if ( $this->item_id() ) {
				return 'edit';
			} else {
				return 'add';
			}
		}

		/**
		 * Page name
		 *
		 * @return string
		 */
		public function get_name() {
			if ( $this->item_id() ) {
				return esc_html__( 'Edit Taxonomy', 'jet-engine' );
			} else {
				return esc_html__( 'Add New Taxonomy', 'jet-engine' );
			}
		}

		/**
		 * Returns currently requested items ID.
		 * If this funciton returns an empty result - this is add new item page
		 *
		 * @return [type] [description]
		 */
		public function item_id() {
			return isset( $_GET['id'] ) ? absint( $_GET['id'] ) : false;
		}

		/**
		 * Register add controls
		 * @return [type] [description]
		 */
		public function page_specific_assets() {

			$module_data = jet_engine()->framework->get_included_module_data( 'cherry-x-vue-ui.php' );

			$ui = new CX_Vue_UI( $module_data );

			$ui->enqueue_assets();

			do_action( 'jet-engine/taxonomies/edit/before-enqueue-assets' );

			wp_register_script(
				'jet-engine-cpt-delete-dialog',
				jet_engine()->plugin_url( 'assets/js/admin/taxonomies/delete-dialog.js' ),
				array( 'cx-vue-ui', 'wp-api-fetch', ),
				jet_engine()->get_version(),
				true
			);

			wp_localize_script(
				'jet-engine-cpt-delete-dialog',
				'JetEngineCPTDeleteDialog',
				array(
					'taxonomies' => Jet_Engine_Tools::get_taxonomies_for_js(),
					'api_path'   => jet_engine()->api->get_route( 'delete-taxonomy' ),
					'redirect'   => $this->manager->get_page_link( 'list' ),
				)
			);

			wp_enqueue_script(
				'jet-engine-cpt-edit',
				jet_engine()->plugin_url( 'assets/js/admin/taxonomies/edit.js' ),
				array( 'cx-vue-ui', 'wp-api-fetch', 'jet-engine-cpt-delete-dialog' ),
				jet_engine()->get_version(),
				true
			);

			$id = $this->item_id();

			if ( $id ) {
				$button_label = __( 'Update Taxonomy', 'jet-engine' );
				$redirect     = false;
			} else {
				$button_label = __( 'Add Taxonomy', 'jet-engine' );
				$redirect     = $this->manager->get_edit_item_link( '%id%' );
			}

			wp_localize_script(
				'jet-engine-cpt-edit',
				'JetEngineCPTConfig',
				$this->manager->get_admin_page_config( array(
					'api_path_edit'     => jet_engine()->api->get_route( $this->get_slug() . '-taxonomy' ),
					'item_id'           => $id,
					'edit_button_label' => $button_label,
					'redirect'          => $redirect,
					'help_links'        => array(
						array(
							'url'   => 'https://crocoblock.com/knowledge-base/articles/creating-custom-taxonomy-with-jetengine/?utm_source=jetengine&utm_medium=taxonomies-page&utm_campaign=need-help',
							'label' => __( 'Creating custom taxonomy with JetEngine', 'jet-engine' ),
						),
						array(
							'url'   => 'https://crocoblock.com/knowledge-base/articles/how-to-add-a-thumbnail-for-the-specific-taxonomy-in-jetengine/?utm_source=jetengine&utm_medium=taxonomies-page&utm_campaign=need-help',
							'label' => __( 'How to add a thumbnail for the specific taxonomy', 'jet-engine' ),
						),
						array(
							'url'   => 'https://crocoblock.com/knowledge-base/articles/how-to-create-an-additional-taxonomy-type-with-jetengine-to-use-it-for-the-post/?utm_source=jetengine&utm_medium=taxonomies-page&utm_campaign=need-help',
							'label' => __( 'How to create an additional taxonomy type to use it for the post', 'jet-engine' ),
						),
					),
				) )
			);

			add_action( 'admin_footer', array( $this, 'add_page_template' ) );

		}

		/**
		 * Print add/edit page template
		 */
		public function add_page_template() {

			ob_start();
			include jet_engine()->get_template( 'admin/pages/taxonomies/edit.php' );
			$content = ob_get_clean();
			printf( '<script type="text/x-template" id="jet-cpt-form">%s</script>', $content );

			ob_start();
			include jet_engine()->get_template( 'admin/pages/taxonomies/delete-dialog.php' );
			$content = ob_get_clean();
			printf( '<script type="text/x-template" id="jet-cpt-delete-dialog">%s</script>', $content );

		}

		/**
		 * Renderer callback
		 *
		 * @return void
		 */
		public function render_page() {
			?>
			<br>
			<div id="jet_cpt_form"></div>
			<?php
		}

	}

}