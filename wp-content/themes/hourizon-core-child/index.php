<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hourizon Core
 */

get_header(); ?>

	<div id="home-banner" >
		<ul id="slider">
			<li>
				<div class="innerSlide" style="background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/banner-new.jpg) center center; background-size: cover;" >
					<div class="container" >
						<div class="caption">
						<?php /*	<p>Denali Concepts Inc. began with the simple idea of providing more outdoor toys to the Filipinos. We believe that playing outdoor toys is a way of bringing back the touch points of health, fitness, and quality time in every individual's lifestyle.</p>
							<p>Our company lives up to its commitment to quality and affordable products and knowledgeable customer service. It is our mission is to help each customer get the most out of his or her adventures.</p>
						*/?>
						<?php echo get_option('woo_slider_content');  ?>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>

	<div id="primary" class="content-area">
		<div id="main" class="site-main">
			<div id="main-content" class="home-content main-content container">
				<h1 id="homebrand-head">Our Brands</h1>

				<div class="row home-brand">
					<li class="col-sm-3 col-md-3" ><a href="#" title="aerobie"><div class="brandbox"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/himawari-175x175.jpg" /></div></a></li>
					<li class="col-sm-3 col-md-3" ><a href="<?php echo site_url('product-category/aeropress/'); ?>" title="aeropress"><div class="brandbox"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo3.jpg" /></div></a></li>
					<li class="col-sm-3 col-md-3" ><a href="<?php echo site_url('product-category/chaser/'); ?>" title="chaser"><div class="brandbox"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo2.jpg" /></div></a></li>
					<li class="col-sm-3 col-md-3" ><a href="#" title="shore + earth"><div class="brandbox"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/royal-baby-175x175.jpg" /></div></a></li>
				</div>

				<div class="row  home-brand">
					<li class="col-sm-3 col-md-3 col-md-offset-1" ><a href="<?php echo site_url('product-category/tactics/'); ?>" title="tactics"><div class="brandbox"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo4.jpg" /></div></a></li>
					<li class="col-sm-3 col-md-3" ><a href="<?php echo site_url('product-category/win-max/'); ?>" title="win max"><div class="brandbox"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo5.jpg" /></div></a></li>
					<li class="col-sm-3 col-md-3" ><a href="<?php echo site_url('product-category/spark/'); ?>" title="win max"><div class="brandbox"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo7.jpg" /></div></a></li>
				</div>

					<h1 id="homepartner-head">Our Partners</h1>

					<div class="row home-brand" style="margin:0 0 20px 0;">
						<li class="col-sm-3 col-md-6" ><div class="brandbox1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partners/ayala.jpg" style="width:50%;"></div></li>
						<li class="col-sm-3 col-md-6" ><div class="brandbox1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partners/sm.jpg" style="width:50%;"></div></li>
					</div>

			</div>
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>
