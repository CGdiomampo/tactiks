<?php
/**
 * Template Name: Store Locator Page
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
         <h1 class="entry-title"> <?php  the_title(); ?>  </h1>  

		 <div class="row">
		 
		 <?php
			$i = 1;
			$args = array( 'post_type'=> 'store_locator', 'order'    => 'ASC' );
			// The Query
			query_posts( $args );
			
			// The Loop
			while ( have_posts() ) : the_post();
			?>

			<?php $store_image = get_post_meta( get_the_ID(), '_cmb_store_image', true); ?>
				<?php if ( !empty($store_image) ) : ?>
			
				<div class="col-xs-12 col-md-12">
				
					<div class="stbox row" >
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
						?>
						<div class="row" style="margin-top:30px;">
						  <div class="col-md-6">
							<img src="<?php echo $store_image; ?>" style="width:100%;" />
						  </div>
						  <div class="col-md-6">
						  
								<?php 
									the_content(); 
									echo '<h3>Store List</h3>';
									echo '<p>' . get_post_meta( get_the_ID(), '_cmb_list', true) .'</p>';
								?>
								
								
				
								<div class="bottom-btn">
									<div class="row">
										<div class="col-md-4">
											<?php $cat_fb = get_post_meta( get_the_ID(), '_cmb_fblink', true);   ?>
											<a href="<?php echo $cat_fb; ?>"  target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/fb-page.png'; ?>" style="width: 150px;margin: 10px;"></a>
										</div>
									</div>
								</div>
						  
						  </div>
						</div>
					</div>
					
				</div>
				<?php endif; ?>
			
			<?php
			endwhile;
			// Reset Query
			wp_reset_query();
			?>
		</div>
			
		<div class="row" style="margin-bottom:30px;">
		 
		 <?php
			$i = 1;
			$args = array( 'post_type'=> 'store_locator', 'order'    => 'ASC' );
			// The Query
			query_posts( $args );
			
			// The Loop
			while ( have_posts() ) : the_post();
			?>

			<?php $store_image = get_post_meta( get_the_ID(), '_cmb_store_image', true); ?>
			
	
				<?php if ( empty($store_image) ) : ?>
				<div class="col-xs-3 col-md-3">
					<div class="stbox minibox" style="height:500px;" >
						<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						}
						echo '<h3>Store List</h3>';
						the_content(); 
						?>
						
								
								
				
								<div class="bottom-btn" style="position: absolute;bottom: 0px;">
											<?php $cat_fb = get_post_meta( get_the_ID(), '_cmb_fblink', true);   ?>
											<a href="<?php echo $cat_fb; ?>"  target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/fb-page.png'; ?>" style="width: 150px;margin: 10px;"></a>
								</div>
					</div>
				</div>
				<?php endif; ?>
			
			<?php
			endwhile;
			// Reset Query
			wp_reset_query();
			?>
		</div>
			
         </div>
		</main><!-- #main -->
	</section><!-- #primary -->
	
	
<?php

 get_footer(); ?>
