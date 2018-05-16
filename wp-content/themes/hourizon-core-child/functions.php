<?php
// File Security Check
add_action( 'init', 'woo_add_brands', 10 );
if ( ! function_exists( 'woo_add_brands' ) ) {
	function woo_add_brands() 
	{
	  $labels = array(
	    'name' => _x( 'brands', 'post type general name', 'woothemes' ),
	    'singular_name' => _x( 'brands', 'post type singular name', 'woothemes' ),
	    'add_new' => _x( 'Add New', 'brands', 'woothemes' ),
	    'add_new_item' => __( 'Add brands', 'woothemes' ),
	    'edit_item' => __( 'Edit brands', 'woothemes' ),
	    'new_item' => __( 'New brands', 'woothemes' ),
	    'view_item' => __( 'View brands', 'woothemes' ),
	    'search_items' => __( 'Search brands', 'woothemes' ),
	    'not_found' =>  __( 'No brands found', 'woothemes' ),
	    'not_found_in_trash' => __( 'No brands found in Trash', 'woothemes' ), 
	    'parent_item_colon' => '',
		'menu_name'          => 'Brands'
	  );
	  
	  $infobox_rewrite = get_option( 'woo_brands_rewrite' );
	  if( empty( $infobox_rewrite ) ) { $infobox_rewrite = 'brands'; }
	  
	  $args = array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true, 
	    'query_var' => true,
	    'rewrite' => array( 'slug'=> $infobox_rewrite ),
	    'capability_type' => 'post',
	    'hierarchical' => false,
		'has_archive' => true,
	    'menu_icon' => get_stylesheet_directory_uri() . '/includes/images/box.png',
	    'menu_position' => null,
	    'supports' => array( 'title', 'editor' , 'thumbnail' , 'author', 'thumbnail', /*'excerpt', 'comments'*/ )
	  ); 
	  register_post_type( 'brands', $args );
	}
}


add_action( 'add_meta_boxes', 'brands_price_box' );
function brands_price_box() {
    add_meta_box( 
        'brands_price_box',
        __( 'Url Link', 'myplugin_textdomain' ),
        'brands_price_box_content',
        'brands',
        'normal',
        'low'
    );
}

function brands_price_box_content( $post ) {
 global $post;
	$custom_textfield = get_post_custom($post->ID);
    $brands_price = $custom_textfield["brands_price"][0];  

	wp_nonce_field( plugin_basename( __FILE__ ), 'brands_price_box_content_nonce' );
	echo '<input type="text" id="brands_price" style="width:90%;" name="brands_price" value="'. $brands_price .'"/>';
	echo '</br>';
}

add_action( 'save_post', 'brands_price_box_save' );
function brands_price_box_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;

	if ( !wp_verify_nonce( $_POST['brands_price_box_content_nonce'], plugin_basename( __FILE__ ) ) )
	return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}
	$brands_price = $_POST['brands_price'];
	update_post_meta( $post_id, 'brands_price', $brands_price );
}
 
/**
 * Enqueue scripts and styles.
 */
 
 
 remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display' , 15 );
 remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20  );
 remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );



add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
		    echo '<img class="ccover" src="' . $image . '" alt="" />';
		}
	}
}

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) 
{
    global $woocommerce;
    ob_start(); ?>

	<a id="shopping_cart" class="shopping_cart tog cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"> Cart <span class="item-total"><?php echo $woocommerce->cart->cart_contents_count;?></span></a>
			
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
	wp_enqueue_style( 'qtip2-css', 'http://cdn.jsdelivr.net/qtip2/2.2.0/jquery.qtip.min.css', null, false, false );
	wp_enqueue_script( 'qtip2-js', 'http://cdn.jsdelivr.net/qtip2/2.2.0/jquery.qtip.min.js', array('jquery'), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

function woocommerce_product_loop_start() { 
	echo '<div style="clear:both; float:none;">';
	echo '<div class="products row new-productlist">'; 
}

function woocommerce_product_loop_end() { 
	echo '</div>'; 
}

require get_template_directory() . '/metabox/metabox.php';

require get_template_directory() . '/Tax-meta-class/Tax-meta-class.php';



if (is_admin()){
  /* 
   * prefix of meta keys, optional
   */
  $prefix = 'ba_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'prod_meta_box',          // meta box id, unique per meta box
    'title' => 'Cat Box',          // meta box title
    'pages' => array('product_cat'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  
  /*
   * Add fields to your meta box
   */
  
  //text field
  //checkbox field
  $my_meta->addCheckbox($prefix.'cat_nolink',array('name'=> __('Product No link?','tax-meta')));
  $my_meta->addText($prefix.'cat_shoplink',array('name'=> __('Shop Link ','tax-meta'),'desc' => ''));
  $my_meta->addText($prefix.'cat_fb',array('name'=> __('Facebook Link','tax-meta'),'desc' => ''));
  $my_meta->addText($prefix.'cat_web',array('name'=> __('Website Link','tax-meta'),'desc' => ''));
  $my_meta->addText($prefix.'cat_video',array('name'=> __('Youtube Link','tax-meta'),'desc' => ''));
  
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  
  
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  //$my_meta->addRepeaterBlock($prefix.'re_',array('inline' => true, 'name' => __('This is a Repeater Block','tax-meta'),'fields' => $repeater_fields));
  /*
   * Don't Forget to Close up the meta box decleration
   */
  //Finish Meta Box Decleration
  $my_meta->Finish();
}

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
		width:219px !important;
		background-size: auto;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );



