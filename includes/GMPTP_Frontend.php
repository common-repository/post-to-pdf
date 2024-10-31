<?php
/**
 * This class is loaded on the back-end since its main job is 
 * to display the Admin to box.
 */

class GMPTP_Frontend {
	
	public function __construct () {

		
	
		
		
		


		$gmptp_enable_single_product = get_option( 'gmptp_enable_single_product' );
		
		if($gmptp_enable_single_product == 'yes'){
			add_action( 'the_content', array( $this, 'woo_comman_single_button' ) ); 
		}
		

		add_shortcode('gmptp_single_post', array( $this, 'gmptp_single_post' ));
	}
	function gmptp_single_post($atts){
		ob_start();
		//print_r($atts);
		if(isset($atts['id'])){
			$post_id = $atts['id'];
		}else{
			$post_id = $atts['id'];
		}
		echo  $this->woo_comman_single_make($post_id);
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	function woo_comman_single_button($content){
		global $post;
		$gmptp_single_display_location = get_option( 'gmptp_single_display_location' );
		$gmptp_shop_post = get_option( 'gmptp_shop_post' );
		
		if(is_singular( array_keys($gmptp_shop_post) ) ){

			
			
			
			$gmptp_button = $this->woo_comman_single_make($post->ID);
			if($gmptp_single_display_location == 'before_content'){
				 $content = $gmptp_button.$content;
			}
			if($gmptp_single_display_location == 'after_content'){
				 $content = $content.$gmptp_button;
			}
	       
        }
        return $content;
		
	}
	function woo_comman_single_make($post_id){
		$gmptp_single_button_text = get_option( 'gmptp_single_button_text' );
		$url_custom = get_home_url().'?action=catelog_singlepost&id='.$post_id;
		ob_start();
		?>
		<div class="gmptp_button">
			<a href="<?php echo $url_custom;?>" class="button"><?php echo $gmptp_single_button_text; ?></a>
		</div>
		<?php
		return $gmptp_button = ob_get_clean();
	}
	
	
	
	
}

