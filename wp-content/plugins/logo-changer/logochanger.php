<?php
/**
 * Plugin Name: Logo changer
 * Description: This plugin set and retrive the logo url link and set a description.
 * Version: 1.0
 * Author: James D. Ballesteros
  * License:Hourizon
 */
 function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload',plugins_url() .'/logo-changer/js/my-script.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
 
function my_admin_styles() {
wp_enqueue_style('thickbox');
}
 

add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');


 
 add_action('admin_menu', 'logo_create_menu');
add_filter( 'login_headerurl', 'dot_cll_login_headerurl'  );// Change Login header Titleadd_filter( 'login_headertitle',  'dot_cll_login_headertitle'  );// Change the default Login page Logoadd_action('login_head', 'our_custom_login_page_style');	
function logo_create_menu() {

	//create new top-level menu
	add_menu_page('Logo Changer Plugin Settings', 'Logo Changer Settings', 'administrator', __FILE__, 'logo_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'logo-settings-group', 'fb_url_link' );
	register_setting( 'logo-settings-group', 'fb_desc' );
	register_setting( 'logo-settings-group', 'tw_url_link' );
	register_setting( 'logo-settings-group', 'tw_desc' );
	register_setting( 'logo-settings-group', 'fb_img' );
	register_setting( 'logo-settings-group', 'upload_image' );
	register_setting( 'logo-settings-group', 'upload_image_tw' );
	register_setting( 'logo-settings-group', 'upload_image_fl' );
	register_setting( 'logo-settings-group', 'fl_url_link' );
	register_setting( 'logo-settings-group', 'fl_desc' );
	//register_setting( 'baw-settings-group', 'some_other_option' );
	//register_setting( 'baw-settings-group', 'option_etc' );
} function our_custom_login_page_style() {	   $wp_logo_uploaded = get_option('upload_image');	   $photoinfo = getimagesize($wp_logo_uploaded);		$type = $photoinfo['mime'];		$width = $photoinfo [0];		$height = $photoinfo [1];			if($width > $height  ||  $height  > $width){				$width = "150";		}			    echo '<style type="text/css">	        h1 a { background-image: url('. $wp_logo_uploaded.') !important; width:'.sanitize_text_field( $width ).'px !important;  }	    </style>';     }	  	  				function dot_cll_login_headertitle() {			return get_bloginfo( 'name' );		}		function dot_cll_login_headerurl( ) {			return home_url();		}

function logo_settings_page() {
 $wplogo_fblink = get_option('fb_url_link');
 $wplogo_fbdesc = get_option('fb_desc');
 $wplogo_twlink = get_option('tw_url_link');
 $wplogo_twdesc = get_option('tw_desc');
 $wplogo_fb_img = get_option('fb_img');
$wplogo_prev = get_option('upload_image');
 
$wplogo_tw_img_fname = get_option('upload_image_tw');
$wplogo_fl_img_fname = get_option('upload_image_fl');
 $wplogo_fllink = get_option('fl_url_link');
 $wplogo_fldesc = get_option('fl_desc');   /*--------------------------------------------*		 * Plugin Functions		 *--------------------------------------------*/       
?>
<script type="text/javascript">

jQuery(document).ready(function() {
 
jQuery('#upload_image_button').click(function() {
 formfield = jQuery('#upload_image').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#logoprev').val(imgurl);
 jQuery('#upload_image').val(imgurl);
 tb_remove();
}
 return false;
});
 


 jQuery('#upload_image_button_tw').click(function() {
 formfield = jQuery('#upload_image_tw').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 window.send_to_editor = function(html) {
 imgurl2 = jQuery('img',htm).attr('src');
 jQuery('#logotw').val(imgurl2);
 jQuery('#upload_image_tw').val(imgurl2);
 tb_remove();
}
 
 return false;
});
 
 
 jQuery('#upload_image_button_fl').click(function() {
 formfield = jQuery('#upload_image_fl').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 window.send_to_editor = function(html) {
 imgurl3 = jQuery('img',html).attr('src');
 jQuery('#logofl').val(imgurl3);
 jQuery('#upload_image_fl').val(imgurl3);
 tb_remove();
}
 
 return false;
});

});


</script>
<div class="wrap">
<h2>Company Logo</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'logo-settings-group' ); ?>
    <?php //do_settings( 'logo-settings-group' ); ?>
	<table class="form-table">
		<tr valign="top">
        <th scope="row">Upload Logo Image</th>
		<td><input id="upload_image" type="text" size="36" name="upload_image" value="<?php echo $wp_logo_upload; ?>" /><input id="upload_image_button" type="button" value="Upload Image" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">Logo Preview</th>
		<td><img id="logoprev" src="<?php echo $wplogo_prev; ?>" style="max-width:100%;"/></td>
		</tr>
	</table>
  
	 
     
    <?php submit_button(); ?>

</form><?php	?>
</div>
 
<?php 
 
 }
 
 
 ?>