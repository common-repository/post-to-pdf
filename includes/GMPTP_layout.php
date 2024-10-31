<?php
$gmpcp_show_hide = get_option( 'gmpcp_show_hide' );
$gmpcp_pagebreak = get_option( 'gmpcp_pagebreak' );
$gmpcp_header_text = get_option( 'gmpcp_header_text' );
$gmpcp_footer_text = get_option( 'gmpcp_footer_text' );


$gmpcp_background_color = get_option( 'gmpcp_background_color' );
$gmpcp_item_background_color = get_option( 'gmpcp_item_background_color' );
$gmpcp_hf_background_color = get_option( 'gmpcp_hf_background_color' );
$gmpcp_hf_item_background_color = get_option( 'gmpcp_hf_item_background_color' );
?>
<div class="inside">
    <form action="#" method="post" id="wp_gmpcp_layout">
        <?php wp_nonce_field( 'gmpcp_nonce_action_layout', 'gmpcp_nonce_field_layout' ); ?>
        <h3><?php _e('Settings', 'gmpcp'); ?></h3>
       
        <table class="form-table">
            
            <tr valign="top">
                <th scope="row">
                   <label >Show/Hide Options</label>
                </th>
                <td>
                   <input class="regular-text" type="checkbox" name="gmpcp_show_hide[]" <?php echo ((in_array("title", $gmpcp_show_hide))?'checked':'') ; ?> value="title" />Title <br/>
                   <input class="regular-text" type="checkbox" name="gmpcp_show_hide[]" <?php echo ((in_array("images", $gmpcp_show_hide))?'checked':'') ; ?> value="images" />Images <br/>
                   <input class="regular-text" type="checkbox" name="gmpcp_show_hide[]" <?php echo ((in_array("long_desc", $gmpcp_show_hide))?'checked':'') ; ?> value="long_desc" />Description <br/>
                   <input class="regular-text" type="checkbox" name="gmpcp_show_hide[]" <?php echo ((in_array("read_more", $gmpcp_show_hide))?'checked':'') ; ?> value="read_more" />Read More <br/>
                 
                   
                </td>
             </tr>
            <tr valign="top">
                <th scope="row">
                   <label >Page Break After Product</label>
                </th>
                <td>
                   <input class="regular-text" type="checkbox" name="gmpcp_pagebreak" <?php echo (($gmpcp_pagebreak=='yes')?'checked':'') ; ?> value="yes" />Per Page Come one Product
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Header Text', 'gmtrip'); ?></label></th>
                <td>
                   <input type="text"  readonly style="width: 100%" name="gmpcplayotarr[gmpcp_header_text]" value="<?php echo $gmpcp_header_text; ?>">
                   <a href="https://www.codesmade.com/store/post-to-pdf-pro/" target="_blank">Get Pro version</a> 
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Footer Text', 'gmtrip'); ?></label></th>
                <td>
                    <textarea readonly style="width: 100%;"  name="gmpcplayotarr[gmpcp_footer_text]" ><?php echo $gmpcp_footer_text;?></textarea>
                    <a href="https://www.codesmade.com/store/post-to-pdf-pro/" target="_blank">Get Pro version</a> 
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Background Color', 'gmtrip'); ?></label></th>
                <td>
                   <input type="text"  class="gmpcp-color-field" name="gmpcplayotarr[gmpcp_background_color]" value="<?php echo $gmpcp_background_color; ?>">
                   <p class="description">
                        <?php _e('Enter Color Like <strong>#fff</strong>. Default will be take <strong>#fff</strong>', 'gmtrip'); ?>
                    </p>
                   
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Color', 'gmtrip'); ?></label></th>
                <td>
                   <input type="text"  class="gmpcp-color-field" name="gmpcplayotarr[gmpcp_item_background_color]" value="<?php echo $gmpcp_item_background_color; ?>">
                   <p class="description">
                        <?php _e('Enter Color Like <strong>#000</strong>. Default will be take <strong>#000</strong>', 'gmtrip'); ?>
                    </p>
                   
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Header/Footer Background Color', 'gmtrip'); ?></label></th>
                <td>
                   <input type="text"  class="gmpcp-color-field" name="gmpcplayotarr[gmpcp_hf_background_color]" value="<?php echo $gmpcp_hf_background_color; ?>">
                   <p class="description">
                        <?php _e('Enter Color Like <strong>#fff</strong>. Default will be take <strong>#fff</strong>', 'gmtrip'); ?>
                    </p>
                   
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Header/Footer  Color', 'gmtrip'); ?></label></th>
                <td>
                   <input type="text"  class="gmpcp-color-field" name="gmpcplayotarr[gmpcp_hf_item_background_color]" value="<?php echo $gmpcp_hf_item_background_color; ?>">
                   <p class="description">
                        <?php _e('Enter Color Like <strong>#000</strong>. Default will be take <strong>#000</strong>', 'gmtrip'); ?>
                    </p>
                   
                </td>
            </tr>
            
            
        </table>
        
        <p class="submit">
            <input type="hidden" name="action" value="wp_gmpcp_layout">
            <input type="submit" name="submit"  class="button button-primary" value="Save">
        </p>
    </form>
</div>