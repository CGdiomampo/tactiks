<?php
if (!function_exists( 'woo_options')) {
	function woo_options() {
	
		// THEME VARIABLES
		$themename = "Hourizon Core";
		$themeslug = "hourizoncore";

		// STANDARD VARIABLES. DO NOT TOUCH!
		$shortname = "woo";
		$manualurl = 'http://www.hourizon.com/'.$themeslug.'/';
		
		//Access the WordPress Categories via an Array
		$woo_categories = array();
		$woo_categories_obj = get_categories( 'hide_empty=0' );
		foreach ($woo_categories_obj as $woo_cat) {
			$woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
		$categories_tmp = array_unshift($woo_categories, "Select a category:" );
		
		//Access the WordPress Pages via an Array
		$woo_pages = array();
		$woo_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
		foreach ($woo_pages_obj as $woo_page) {
			$woo_pages[$woo_page->ID] = $woo_page->post_name; }
		$woo_pages_tmp = array_unshift($woo_pages, "Select a page:" );
		
		//Stylesheets Reader
		/*
		$alt_stylesheet_path = get_template_directory() . '/styles/';
		$alt_stylesheets = array();
		if ( is_dir($alt_stylesheet_path) ) {
			if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) {
				while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
					if(stristr($alt_stylesheet_file, ".css") !== false) {
						$alt_stylesheets[] = $alt_stylesheet_file;
					}
				}
			}
		}
		*/
		
		//More Options
		$other_entries = array( "Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19" );

		//URL Shorteners
		if (_iscurlinstalled()) {
			$options_select = array("Off","TinyURL","Bit.ly");
			$short_url_msg = 'Select the URL shortening service you would like to use.'; 
		} else {
			$options_select = array("Off");
			$short_url_msg = '<strong>cURL was not detected on your server, and is required in order to use the URL shortening services.</strong>'; 
		}
		
		// Setup an array of pages for a dropdown.
		$args = array( 'echo' => 0 );
		$pages_dropdown = wp_dropdown_pages( $args );
		$pages = array();
		
		// Quick string hack to make sure we get the pages with the indents.
		$pages_dropdown = str_replace( '<select name="page_id" id="page_id">', '', $pages_dropdown );
		$pages_dropdown = str_replace( '</select>', '', $pages_dropdown );
		$pages_split = explode( '</option>', $pages_dropdown );
		
		$pages[] = __( 'Select a Page:', 'woothemes' );
		
		foreach ( $pages_split as $k => $v ) {
	
			$id = '';
			
			// Get the ID value.
			preg_match( '/value="(.*?)"/i', $v, $matches );
			
			if ( isset( $matches[1] ) ) {
				
				$id = $matches[1];
				
				$pages[$id] = trim( strip_tags( $v ) );
			
			}
			
		} // End FOREACH Loop
		
		$woo_pages = $pages;

		// THIS IS THE DIFFERENT FIELDS
		$options = array();
		
		// THIS IS THE DIFFERENT FIELDS
		$options = array();

		/* General */

		$options[] = array( "name" => __( 'General Settings', 'woothemes' ),
							"type" => "heading",
							"icon" => "general" );
		 
		$options[] = array( 'name' => __( 'Quick Start', 'woothemes' ),
							'type' => 'subheading' );

		$options[] = array( "name" => __( 'Custom Logo', 'woothemes' ),
							"desc" => __( 'Upload a logo for your theme, or specify an image URL directly. ( 277 x 115 )', 'woothemes' ),
							"id" => $shortname."_logo",
							"std" => "",
							"type" => "upload" );    
									  
		$options[] = array( "name" => __( 'Custom Favicon', 'woothemes' ),
							"desc" => __( 'Upload a 16px x 16px <a href="http://www.faviconr.com/">ico image</a> that will represent your website\'s favicon.', 'woothemes' ),
							"id" => $shortname."_custom_favicon",
							"std" => "",
							"type" => "upload" ); 
													   
		$options[] = array( "name" => __( 'Tracking Code', 'woothemes' ),
							"desc" => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'woothemes' ),
							"id" => $shortname."_google_analytics",
							"std" => "",
							"type" => "textarea" ); 
							
		/* Subscribe & Connect */
		$options[] = array( "name" => __( 'Subscribe & Connect', 'woothemes' ),
							"type" => "heading",
							"icon" => "connect" ); 

						

		$options[] = array( 'name' => __( 'Connect Settings', 'woothemes' ),
							'type' => 'subheading' );

		$options[] = array( "name" => __( 'Enable RSS', 'woothemes' ),
							"desc" => __( 'Enable the subscribe and RSS icon.', 'woothemes' ),
							"id" => $shortname."_connect_rss",
							"std" => 'true',
							"type" => "checkbox" ); 

		$options[] = array( "name" => __( 'Twitter URL', 'woothemes' ),
							"desc" => __( 'Enter your  <a href="http://www.twitter.com/">Twitter</a> URL e.g. http://www.twitter.com/woothemes', 'woothemes' ),
							"id" => $shortname."_connect_twitter",
							"std" => '',
							"type" => "text" ); 

		$options[] = array( "name" => __( 'Facebook URL', 'woothemes' ),
							"desc" => __( 'Enter your  <a href="http://www.facebook.com/">Facebook</a> URL e.g. http://www.facebook.com/woothemes', 'woothemes' ),
							"id" => $shortname."_connect_facebook",
							"std" => '',
							"type" => "text" ); 
		$options[] = array( "name" => __( 'Skype URL', 'woothemes' ),
							"desc" => __( 'Enter your  <a href="http://www.skype.com/">Skype</a> URL e.g. http://www.skype.com/woothemes', 'woothemes' ),
							"id" => $shortname."_connect_skype",
							"std" => '',
							"type" => "text" );
       	$options[] = array( "name" => __( 'Instagram URL', 'woothemes' ),
							"desc" => __( 'Enter your  <a href="http://www.instagram.com/">Instagram</a> URL e.g. http://www.instagram.com/woothemes', 'woothemes' ),
							"id" => $shortname."_connect_instagram",
							"std" => '',
							"type" => "text" );
		  $options[] = array( "name" => __( 'Vimeo URL', 'woothemes' ),
							"desc" => __( 'Enter your  <a href="http://www.vimeo.com/">Vimeo</a> URL e.g. http://www.vimeo.com/woothemes', 'woothemes' ),
							"id" => $shortname."_connect_vimeo",
							"std" => '',
							"type" => "text" );					
      $options[] = array( "name" => __( 'Google Plus URL', 'woothemes' ),
							"desc" => __( 'Enter your  <a href="http://www.google.com/">GooglePlus</a> URL e.g. http://www.google.com/woothemes', 'woothemes' ),
							"id" => $shortname."_connect_goggleplus",
							"std" => '',
							"type" => "text" );
    	
	$options[] = array( "name" => __( 'Homeslider Content', 'woothemes' ),
							"desc" => __( 'Paste your Slider Content Here.', 'woothemes' ),
							"id" => $shortname."_slider_content",
							"std" => "",
							"type" => "textarea" ); 							
		
		// Add extra options through function
		if ( function_exists( "woo_options_add") )
			$options = woo_options_add($options);

		if ( get_option( 'woo_template') != $options) update_option( 'woo_template',$options);
		if ( get_option( 'woo_themename') != $themename) update_option( 'woo_themename',$themename);
		if ( get_option( 'woo_shortname') != $shortname) update_option( 'woo_shortname',$shortname);
		if ( get_option( 'woo_manual') != $manualurl) update_option( 'woo_manual',$manualurl);
		
		// Woo Metabox Options
		// Start name with underscore to hide custom key from the user
		$woo_metaboxes = array();
		
		global $post;
		
		if ( get_post_type() == 'slide' || !get_post_type() ) {

			$woo_metaboxes[] = array (	"name" => "image",
										"label" => __( 'Slide Image', 'woothemes' ),
										"type" => "upload",
										"desc" => __( 'Upload an image or enter an URL to your slide image', 'woothemes' ) );

		}
		
		// Add extra metaboxes through function
		if ( function_exists( "woo_metaboxes_add") )
			$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);

		if ( get_option( 'woo_custom_template' ) != $woo_metaboxes) update_option( 'woo_custom_template', $woo_metaboxes );
		
	}
}

	// Add options to admin_head
	add_action( 'admin_head','woo_options' );

	//Enable WooSEO on these Post types
	$seo_post_types = array( 'post','page' );
	define( "SEOPOSTTYPES", serialize($seo_post_types));

	//Global options setup
	add_action( 'init','woo_global_options' );
	function woo_global_options(){
		// Populate WooThemes option in array for use in theme
		global $woo_options;
		$woo_options = get_option( 'woo_options' );
	}
?>