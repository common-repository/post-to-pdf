<?php

class GMPTP_Cron {
	
	public function __construct () {

		add_action( 'init', array( $this, 'GMPTP_default' ) );
		
	}

	public function GMPTP_default(){
		$defalarr = array(
			'gmpcp_header_text' => 'Post to Pdf',
			'gmpcp_footer_text' => 'Developer By <a href="https://wordpress.org/plugins/post-to-pdf/" >Post to Pdf</a>',
			'gmptp_shop_button_text' => 'Download PDF',
			'gmptp_single_button_text' => 'Download PDF',
			'gmptp_single_display_location' => 'before',
			'gmptp_shop_display_location' => 'before',
			'gmpcp_background_color' => '#fff',
			'gmpcp_item_background_color' => '#000',
			'gmpcp_hf_background_color' => '#0084B4',
			'gmpcp_hf_item_background_color' => '#000',
			'gmpcp_show_hide' => array('title','images','long_desc','read_more','categories','tags'),
			
		);
		foreach ($defalarr as $keya => $valuea) {
			if (get_option( $keya )=='') {
				if(in_array($keya, array('gmpcp_show_hide'))){
			        update_option( $keya, $valuea );
			    }else{
			        update_option( $keya, sanitize_text_field($valuea) );
			    }
			}
			
		}
		
	}
}

?>