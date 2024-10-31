<?php
$gmptp_enable_single_product = get_option( 'gmptp_enable_single_product' );
$gmptp_single_display_location = get_option( 'gmptp_single_display_location' );
$gmptp_shop_post = get_option( 'gmptp_shop_post' );
$gmptp_single_button_text = get_option( 'gmptp_single_button_text' );
?>
<form method="post" action="options.php">
	<?php settings_fields( 'gmptp_options_group' ); ?>
	<table class="form-table">
		<tr valign="top">
            <th scope="row">
               <label for="gmptp_enable_single_product"><?php _e('Enable Single Product Page', 'gmwsvs'); ?></label>
            </th>
            <td>
               <input class="regular-text" type="checkbox" id="gmptp_enable_single_product" <?php echo (($gmptp_enable_single_product=='yes')?'checked':'') ; ?> name="gmptp_enable_single_product" value="yes" />
            </td>
         </tr>
          <tr valign="top">
            <th scope="row">
               <label><?php _e('Button Text', 'gmptp'); ?></label>
            </th>
            <td>
               <input class="regular-text" type="text" name="gmptp_single_button_text" value="<?php echo $gmptp_single_button_text;?>" />
            </td>
         </tr>
          <tr valign="top">
            <th scope="row">
               <label ><?php _e('Enable Post Type', 'gmptp'); ?></label>
            </th>
            <td>
            	<?php
            	$args = array(
						  'public'   => true,
						); 
            	$get_post_types = get_post_types($args,'objects');
            	foreach ($get_post_types as $keyget_post_types => $valueget_post_types) {
            		?>
            		<input class="regular-text" type="checkbox" <?php echo ((isset($gmptp_shop_post[$valueget_post_types->name]) && $gmptp_shop_post[$valueget_post_types->name]=='yes')?'checked':'') ; ?> name="gmptp_shop_post[<?php echo $valueget_post_types->name;?>]" value="yes" /><?php echo $valueget_post_types->label;?><br/>
            		<?php
            	}
            	?>
             
            </td>
         </tr>
		<tr>
			<th scope="row"><label><?php _e('Display Location', 'gmptp'); ?></label></th>
			<td>
				<input type="radio" name="gmptp_single_display_location" <?php echo ($gmptp_single_display_location=='before_content')?'checked':''; ?> value="before_content"><?php _e('Before Content', 'gmptp'); ?>
				<input type="radio" name="gmptp_single_display_location" <?php echo ($gmptp_single_display_location=='after_content')?'checked':''; ?> value="after_content"><?php _e('After Content', 'gmptp'); ?>
            <input type="radio" name="gmptp_single_display_location" <?php echo ($gmptp_single_display_location=='custom')?'checked':''; ?> value="custom"><?php _e('Custom Location', 'gmptp'); ?><br/>
            <strong><em>Note : Custom Location for you need to use shortcode</em></strong>
			</td>
		</tr>
		<tr class="showcustmil">
         <th scope="row"><label><?php _e('ShortCode', 'gmptp'); ?></label></th>
         <td>
            <code>[gmptp_single_post]</code> or<code>[gmptp_single_post id='{post_id}']</code>
         </td>
      </tr>
	</table>
	<?php  submit_button(); ?>
</form>