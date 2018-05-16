<?php
/**
 * Template Name: Partner Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package denali
 */

get_header(); 

?>

<section id="blog-loop" class="section-wide" role="main">
	<main id="main" class="site-main" role="main">
		<div id="main-content" class="page-content main-content container">
		
			<h1 class="entry-title"> <?php  _e('Our Partners')  ?>  </h1>  
		
			<div class="row" style="margin:30px 0 0 0;">
				<div class="col-md-6">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partners/ayala.jpg" style="width:100%;">
				</div>
				<div class="col-md-6">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partners/sm.jpg" style="width:100%;">
				</div>
			</div>
		
		</div>
	</main>
</section>

<?php

 get_footer(); ?>
