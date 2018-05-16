<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}
?>
<?php
if ( ! is_admin() ) { add_action( 'wp_enqueue_scripts', 'hrz_add_javascript' ); }

if ( ! function_exists( 'hrz_add_javascript' ) ) {
	function hrz_add_javascript() {

		//wp_enqueue_script( 'validate', get_template_directory_uri() . '/js/jquery.validate.js', array('jquery'), '20120206', true );
		//wp_enqueue_script( 'cycleall', get_template_directory_uri() . '/js/jquery.cycle.all.js', array('jquery'), '1.9.0', true );
		wp_enqueue_script( 'bootstrapJS', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '2.0.0' );
		//wp_enqueue_script( 'hoverIntentJS', get_template_directory_uri() . '/js/superfish/hoverIntent.js', array('jquery'), '11202013' );
		//wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.js', array('jquery'), '11202013' );
		
		wp_enqueue_script( 'hourizon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
		
		do_action( 'hrz_add_javascript' );
	} // End hrz_add_javascript()
}

if ( ! is_admin() ) { add_action( 'wp_print_styles', 'hrz_add_css' ); }

if ( ! function_exists( 'hrz_add_css' ) ) {
	function hrz_add_css () {
		wp_enqueue_style( 'openSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700' );
		wp_enqueue_style( 'cssReset', get_template_directory_uri() . '/css/reset.css' );
		wp_enqueue_style( 'bootstrapCSS', get_template_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'hourizon-style', get_stylesheet_uri() );
		//wp_enqueue_style( 'superfishCSS', get_template_directory_uri() . '/css/superfish/superfish.css' );
		
		do_action( 'hrz_add_css' );
	} // End hrz_add_css()
}

add_action('wp_head','html5_shiv');
function html5_shiv() {
	echo '<!--[if lte IE 8]>';
	echo '<script src="' . esc_url( 'https://html5shiv.googlecode.com/svn/trunk/html5.js' ) . '"></script>'. "\n";
	echo '<![endif]-->';
}
?>