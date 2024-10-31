<?php
/**
 * This class is loaded on the back-end since its main job is 
 * to display the Admin to box.
 */
use Dompdf\Dompdf as Dompdf;

class GMPTP_PDF {
	
	public function __construct () {
		add_action( 'init', array( $this, 'woo_comman_single_button' )); 
	}

	function woo_comman_single_button(){
		if (isset($_REQUEST['action']) && $_REQUEST['action']=='catelog_singlepost') {

			include_once(GMPTP_PLUGINDIR.'dompdf-master/autoload.inc.php');

			$dompdf = new Dompdf(array('enable_remote' => true));
			$dompdf->getOptions()->setChroot(ABSPATH);
			ob_start(); 
			$style_path = GMPTP_PLUGINDIR.'css/print-style.css';
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<style type="text/css">
					<?php
					ob_start();
					if (file_exists($style_path)) {
						include($style_path);
					}
					echo $style_path = ob_get_clean();
					?>
				</style>
				<?php
				echo $this->gmptp_css();
				?>
			</head>
			<body >
				<?php
				$gmpcp_header_text = get_option( 'gmpcp_header_text' );
				$gmpcp_footer_text = get_option( 'gmpcp_footer_text' );
				?>
				<header>
			      	<p><?php echo $gmpcp_header_text;?></p>
			    </header>
			    <footer>
			      	<p><?php echo  htmlspecialchars_decode($gmpcp_footer_text);;?></p>
			    </footer>
			    <main>
			    	<?php $this->gmptp_signle_pdf($_REQUEST['id']); ?>
			    </main> 
				
			</body>
			</html>
			<?php
			$output = ob_get_clean();
			$dompdf->loadHtml($output);
			$dompdf->render();

			// Output the generated PDF to Browser
			$dompdf->stream("relatorio.pdf", array("Attachment" => false));
			exit;
		}
		if (isset($_REQUEST['action']) && $_REQUEST['action']=='gmptp_catelog_shop') {
			include_once(GMPTP_PLUGINDIR.'dompdf-master/autoload.inc.php');
			$dompdf = new Dompdf(array('enable_remote' => true));
			$dompdf->getOptions()->setChroot(ABSPATH);
			ob_start(); 
			$style_path = GMPTP_PLUGINDIR.'css/print-style.css';
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<style type="text/css">
					<?php
					ob_start();
					if (file_exists($style_path)) {
						include($style_path);
					}
					echo $style_path = ob_get_clean();
					?>
				</style>
				<?php
				echo $this->gmptp_css();
				?>
			</head>
			<body >
				<header>
			      	<p><?php echo $gmpcp_header_text;?></p>
			    </header>
			    <footer>
			      	<p><?php echo  htmlspecialchars_decode($gmpcp_footer_text);;?></p>
			    </footer>
			    <main>
				<?php 
				
				$args = array(
					/*'post_type' => 'product',*/
					'posts_per_page' => -1,
					'tax_query' => array(
									        array(
									            'taxonomy' => sanitize_text_field($_REQUEST['taxonomytpe']),
									            'field'    => 'term_id',
									            'terms'    => array( sanitize_text_field($_REQUEST['id']) ),
									            'operator' => 'IN',
									        ),
									    ),
				);
				

				$query1 = new WP_Query( $args );
				while ( $query1->have_posts() ) {
				   $query1->the_post();
				   global $post;
				   $this->gmptp_signle_pdf($post->ID);
				}
				 ?>
				</main>
			</body>
			</html>
			<?php
			$output = ob_get_clean();

			
			$dompdf->set_option('defaultFont', 'Helvetica');
			$dompdf->loadHtml($output);
			$dompdf->render();

			// Output the generated PDF to Browser
			$dompdf->stream("relatorio.pdf", array("Attachment" => false));
			exit;
		}
	}

	function gmptp_signle_pdf($product_id){
		$gmpcp_show_hide = get_option( 'gmpcp_show_hide' );

		$product = get_post( $product_id );
		$attachment_id = get_post_thumbnail_id($product_id);
		$url = wp_get_attachment_image_url( $attachment_id,'mediaum' );
		$uploads   = wp_upload_dir();
		$url = str_replace( $uploads['baseurl'], $uploads['basedir'], $url );
		if($url!=''){
			$fullsize_path = $url;
		}else{
			$fullsize_path = GMPTP_PLUGINURL.'img/woocommerce-placeholder-600x600.jpg';
		}
		
		?>
		<div class="main_table">
			<div class="spacear"></div>
			<table style="width:100%;">
				<tr>
					<td style="width: 50%;">
						<img src="<?php echo $fullsize_path;?>" style="width: 100%;">
					</td>
					<td style="width: 50%;">
						<?php 
						if(in_array("title", $gmpcp_show_hide)){
						?>
						<div class="right_title tabldnwls"><?php echo $product->post_title;?>aa</div>
						<?php	
						}
						if(in_array("long_desc", $gmpcp_show_hide)){
						?>
						<div class="right_long_desc tabldnwls">
							<?php 
							$the_content = apply_filters('the_content', $product->post_content);
							if ( !empty($the_content) ) {
							  echo $the_content;
							}
							?>
						</div>
						<?php	
						}
						if(in_array("read_more", $gmpcp_show_hide)){
						?>
						<div class="right_read_more tabldnwls">
							<a href="<?php echo get_permalink( $product_id );?>" target="_blank">Read More</a>
						</div>
						<?php	
						}
						?>
					</td>
				</tr>
				
			</table>
		</div>
		
		<?php 
		
		
	}
	function gmptp_css(){
		$gmpcp_background_color = get_option( 'gmpcp_background_color' );
		$gmpcp_item_background_color = get_option( 'gmpcp_item_background_color' );
		$gmpcp_hf_background_color = get_option( 'gmpcp_hf_background_color' );
		$gmpcp_hf_item_background_color = get_option( 'gmpcp_hf_item_background_color' );
		$gmpcp_pagebreak = get_option( 'gmpcp_pagebreak' );
		?>
		<style type="text/css" media="screen">
			body{
				background-color: <?php echo $gmpcp_background_color;?>;
				color: <?php echo $gmpcp_item_background_color;?>;
			}
			header, footer{
				background-color: <?php echo $gmpcp_hf_background_color;?>;
				color: <?php echo $gmpcp_hf_item_background_color;?>;
			}
			<?php 
			if($gmpcp_pagebreak=='yes'){
				?>
				.main{
					page-break-after: always;
				}
				<?php
			}
			?>
		</style>

		<?php
	}
	

	
	
}


