<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Hourizon Core
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main">
			<div id="main-content" class="home-content main-content container">

			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php get_template_part( 'content', 'single' ); ?>

				<?php hourizon_core_post_nav(); ?>

			<?php endwhile; // end of the loop. ?>
				
			</div>
		</div>
	</div><!-- #primary -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>