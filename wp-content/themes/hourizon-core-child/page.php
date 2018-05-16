<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Hourizon Core
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main">
			<div id="main-content" class="page-content main-content container">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

			</div>
		</div>
	</div><!-- #primary -->
	

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
