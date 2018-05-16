<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php $term_id = get_queried_object()->term_id; ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main">
			<div id="main-content" class="home-content main-content container">

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
				
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php endif; ?>
		
		<div id="prodshop-full">

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>
				

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
		
		</div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
				
				
				<div class="prod-video"  >
						<?php $url = esc_html(get_term_meta($term_id ,'ba_cat_video',true)); 
							//$url = esc_html( cmb2_get_option( 'cmb2_options', '_cmb_embed' ) );
							echo wp_oembed_get( $url );
						?>
				</div>
				
				<div class="bottom-btn">
					<div class="row">
						<div class="col-md-4">
							<?php $shoplink = get_term_meta($term_id ,'ba_cat_shoplink',true);   ?>
							<a href="<?php echo  $shoplink; ?>" target="_blank" class="btn btn-primary btn-lg">Shop Now</a>
						</div>
						<div class="col-md-4">
							<?php $cat_fb = get_term_meta($term_id ,'ba_cat_fb',true);   ?>
							<a href="<?php echo $cat_fb; ?>"  target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/fb-page.png'; ?>"></a>
						</div>
						<div class="col-md-4">
							<?php $ba_cat_web = get_term_meta($term_id ,'ba_cat_web',true);   ?>
							<a href="<?php echo  $ba_cat_web; ?>"  target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/visitus.png'; ?>"></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div><!-- #primary -->

<?php get_footer( 'shop' ); ?>