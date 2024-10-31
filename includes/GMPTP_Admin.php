<?php
/**
* This class is loaded on the back-end since its main job is
* to display the Admin to box.
*/
class GMPTP_Admin {
	
	public function __construct () {
		add_action( 'admin_init', array( $this, 'GMPTP_register_settings' ) );
		add_action( 'admin_menu', array( $this, 'GMPTP_admin_menu' ) );
		add_action('admin_enqueue_scripts', array( $this, 'GMPTP_admin_script' ));
		if ( is_admin() ) {
			return;
		}
		
	}
	public function GMPTP_admin_script () {
		wp_enqueue_script( 'wp-color-picker' ); 
		wp_enqueue_style('gmptp_admin_css', GMPTP_PLUGINURL.'css/admin-style.css');
		wp_enqueue_script('gmptp_admin_js', GMPTP_PLUGINURL.'js/admin-script.js');
	}
	
	public function GMPTP_admin_menu () {
		add_menu_page('Post to PDF', 'Post to PDF', 'manage_options', 'gmptp-catalog', array( $this, 'GMPTP_page' ));
		
	}
	public function GMPTP_page() {
		
	?>
	<div class="wrap">
		<div class="headingmc">
			<h1 class="wp-heading-inline"><?php _e('Post to PDF', 'gmptp'); ?></h1>
		</div>
		<hr class="wp-header-end">
		
			<div class="postbox">
					
					<div class="inside">
						<?php
						$navarr = array(
							'page=gmptp-catalog'=>'Single Post Page Setting',
							'page=gmptp-catalog&view=layout'=>'Layout',
							
						);
						?>
						<h2 class="nav-tab-wrapper">
							<?php
							foreach ($navarr as $keya => $valuea) {
								$pagexl = explode("=",$keya);
								if(!isset($pagexl[2])){
									$pagexl[2] = '';
								}
								if(!isset($_REQUEST['view'])){
									$_REQUEST['view'] = '';
								}
								?>
								<a href="<?php echo admin_url( 'admin.php?'.$keya);?>" class="nav-tab <?php if($pagexl[2]==$_REQUEST['view']){echo 'nav-tab-active';} ?>"><?php echo $valuea;?></a>
								<?php
							}
							?>
						</h2>
						
					   <?php

						
						if($_REQUEST['view']=='single' || $_REQUEST['view']==''){
							include(GMPTP_PLUGINDIR.'includes/GMPTP_Single_Admin.php');
						}
						if($_REQUEST['view']=='layout'){
							include(GMPTP_PLUGINDIR.'includes/GMPTP_layout.php');
						}
						?>
					</div>
			</div>
			
	</div>

	<?php
	}

	public function GMPTP_register_settings() {



		register_setting( 'gmptp_options_group', 'gmptp_enable_single_product' , array( $this, 'gmwqp_callback' ) );
		register_setting( 'gmptp_options_group', 'gmptp_shop_post' , array( $this, 'gmwqp_callback' ) );
		register_setting( 'gmptp_options_group', 'gmptp_single_display_location' , array( $this, 'gmwqp_callback' ) );
		register_setting( 'gmptp_options_group', 'gmptp_single_button_text' , array( $this, 'gmwqp_callback' ) );

		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'wp_gmpcp_layout'){

			if(!isset( $_POST['gmpcp_nonce_field_layout'] ) || !wp_verify_nonce( $_POST['gmpcp_nonce_field_layout'], 'gmpcp_nonce_action_layout' ) ){
                print 'Sorry, your nonce did not verify.';
                exit;
            }else{
            	update_option( 'gmpcp_show_hide', $_REQUEST['gmpcp_show_hide'] );
            	update_option( 'gmpcp_pagebreak', $_REQUEST['gmpcp_pagebreak'] );
            	foreach ($_REQUEST['gmpcplayotarr'] as $keya => $valuea) {
            		update_option( $keya, sanitize_text_field($valuea) );
            	}
				wp_redirect( admin_url( 'admin.php?page=gmptp-catalog&view=layout&msg=layout') );
			}
			exit;
		}
	}
	
	public function gmwqp_accesstoken_callback($option) {
		return $option;
	}
	

}


?>