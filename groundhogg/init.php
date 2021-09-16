<?php // initialization
if ( ! class_exists( 'WLM3_Groundhogg_Hooks' ) ) {
	class WLM3_Groundhogg_Hooks {
		var $wlm;
		function __construct() {
			global $WishListMemberInstance;
			$this->wlm = $WishListMemberInstance;
			add_action( 'wp_ajax_wlm3_groundhogg_check_plugin', array( $this, 'check_plugin' ) );
		}
		function check_plugin() {
			// extract($_POST['data']);
			$data = array(
				'status'  => false,
				'message' => '',
				'lists'   => array(),
				'tags'    => array(),
			);
			// connect and get info
			try {
				$active_plugins = wlm_get_active_plugins();
				if ( in_array( 'Groundhogg', $active_plugins ) || isset( $active_plugins['groundhogg/groundhogg.php'] ) || is_plugin_active( 'groundhogg/groundhogg.php' ) ) {
					$data['status']  = true;
					$data['message'] = 'Groundhogg plugin is installed and activated';


					$allTags = \Groundhogg\get_db('tags')->query();
					$tags    = array();
					foreach ( $allTags as $key => $value ) {
						$tags[ $value->tag_id ] = $value->tag_name;
					}
					$data['tags'] = $tags;
				} else {
					$data['message'] = 'Please install and activate Groundhogg plugin';
				}
			} catch ( Exception $e ) {
				$data['message'] = $e->getMessage();
			}
			wp_die( json_encode( $data ) );
		}
	}
	new WLM3_Groundhogg_Hooks();
}
