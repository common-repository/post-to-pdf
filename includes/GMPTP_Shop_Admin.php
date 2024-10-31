<?php
$gmptp_shop_enable_product = get_option( 'gmptp_shop_enable_product' );
$gmptp_shop_display_location = get_option( 'gmptp_shop_display_location' );
$gmptp_shop_taxo = get_option( 'gmptp_shop_taxo' );
$gmptp_shop_button_text = get_option( 'gmptp_shop_button_text' );
?>
<form method="post" action="options.php">
	<?php settings_fields( 'gmptp_shop_options_group' ); ?>
	<table class="form-table">
		 <tr valign="top">
            <th scope="row">
               <label for="gmptp_shop_enable"><?php _e('Enable Category Page', 'gmptp'); ?></label>
            </th>
            <td>
               <input class="regular-text" type="checkbox" id="gmptp_shop_enable_product" <?php echo (($gmptp_shop_enable_product=='yes')?'checked':'') ; ?> name="gmptp_shop_enable_product" value="yes" />
            </td>
         </tr>
         <tr valign="top">
            <th scope="row">
               <label for="gmptp_shop_enable"><?php _e('Button Text', 'gmptp'); ?></label>
            </th>
            <td>
               <input class="regular-text" type="text" name="gmptp_shop_button_text" value="<?php echo $gmptp_shop_button_text;?>" />
            </td>
         </tr>
         <tr valign="top">
            <th scope="row">
               <label ><?php _e('Enable Taxonomy', 'gmptp'); ?></label>
            </th>
            <td>
            	<?php
            	$args = array(
						  'public'   => true,
						); 
            	$taxonomies = get_taxonomies($args,'objects');
            	foreach ($taxonomies as $keytaxonomies => $valuetaxonomies) {
            		?>
            		<input class="regular-text" type="checkbox" <?php echo ((isset($gmptp_shop_taxo[$valuetaxonomies->name]) && $gmptp_shop_taxo[$valuetaxonomies->name]=='yes')?'checked':'') ; ?> name="gmptp_shop_taxo[<?php echo $valuetaxonomies->name;?>]" value="yes" /><?php echo $valuetaxonomies->label;?><br/>
            		<?php
            	}
            	?>
             
            </td>
         </tr>
         <tr>
			<th scope="row"><label><?php _e('Display Location', 'gmptp'); ?></label></th>
			<td>
				<input type="radio" name="gmptp_shop_display_location" <?php echo ($gmptp_shop_display_location=='before')?'checked':''; ?> value="before"><?php _e('Before Loop', 'gmptp'); ?>
				<input type="radio" name="gmptp_shop_display_location" <?php echo ($gmptp_shop_display_location=='after')?'checked':''; ?> value="after"><?php _e('After Loop', 'gmptp'); ?>
			</td>
		</tr>
	</table>
	<?php  submit_button(); ?>
</form>
				