<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	
	<?php if (  get_post_meta( get_the_ID(), '_cmb_layout', true) == 'standard' ||  get_post_meta( get_the_ID(), '_cmb_layout', true) == '') : ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main">
			<div id="main-content" class="home-content main-content container">
			
				<div class="prod-head" >
					<img src='<?php echo get_post_meta( get_the_ID(), '_cmb_head_image', true); ?>' >
				</div>

		
				<div id="prodshop-full">
				
					<div style="margin-top:30px; " >
					
					<?php //echo get_post_meta( get_the_ID(), '_cmb_features_wysiwyg', true); ?>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
		</div>
	</div>

			</div>
		</div>
	</div><!-- #primary -->
	
	<?php elseif (  get_post_meta( get_the_ID(), '_cmb_layout', true) == 'custom' ) : ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main">
			<div id="main-content" class="home-content main-content container">
			
				<div class="prod-head" >
					<img src='<?php echo get_post_meta( get_the_ID(), '_cmb_head_image', true); ?>' >
				</div>
				
				<div class="prod-feature row">
					<div class="fe-desc col-md-6">
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div>
					<div class="fe-list col-md-6">
						<h3>Features</h3>
						<?php echo  get_post_meta( get_the_ID(), '_cmb_features_wysiwyg', true); ?>
					</div>
				</div>
				
				<div class="prod-video"  >
						<?php $url = esc_html(get_post_meta( get_the_ID(), '_cmb_embed', true) ); 
							//$url = esc_html( cmb2_get_option( 'cmb2_options', '_cmb_embed' ) );
							echo wp_oembed_get( $url );
						?>
				</div>
				
				<div class="bottom-btn">
					<div class="row">
						<div class="col-md-4">
							<a href="<?php echo  get_post_meta( get_the_ID(), '_cmb_shoplink', true); ?>" target="_blank" class="btn btn-primary btn-lg">Shop Now</a>
						</div>
						<div class="col-md-4">
							<a href="<?php echo  get_post_meta( get_the_ID(), '_cmb_fb', true); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/fb-page.png'; ?>"></a>
						</div>
						<div class="col-md-4">
							
							<a href="<?php echo  get_post_meta( get_the_ID(), '_cmb_web', true); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/visitus.png'; ?>"></a>
						</div>
					</div>
				</div>

					</div>
				</div>
			</div><!-- #primary -->
	
	
	<?php endif; ?>

<?php get_footer( 'shop' ); ?>