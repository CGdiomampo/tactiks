<?php
/**
 * Template Name: Blog Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package denali
 */

get_header(); 

wp_reset_postdata();
?>

	<section id="blog-loop" class="section-wide" role="main">
	
		<main id="main" class="site-main" role="main">
		<div id="main-content" class="page-content main-content container">
         <h1 class="entry-title"> <?php  _e('Latest Blog')  ?>  </h1>  
		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts('posts_per_page=4&paged=' . $paged . '&cat=211'  );  ?>
		<?php if ( have_posts() ) : ?>
		
		

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<h4 class="blogtitle"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
				
				<div class="entry-meta">
					<?php hourizon_core_posted_on(); ?>
				</div><!-- .entry-meta -->
				
				<div class="innerContent" >
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="blog-readmore">read more</a>
				</div><!-- .entry-content -->

			<?php endwhile; ?>

			<?php// wp_pagenavi( ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>
        </div>
		</main><!-- #main -->
	</section><!-- #primary -->
	
<?php
wp_reset_postdata();
 get_footer(); ?>
