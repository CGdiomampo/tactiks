<?php

get_header(); 

wp_reset_postdata();
?>
	

	<section id="blog-loop" class="section-wide" role="main">
	
		<main id="main" class="site-main" role="main">
		<div id="main-content" class="page-content main-content container">
         <h1 class="entry-title"> <?php  _e('Brands')  ?>  </h1>  
		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts( 'post_type=brands&orderby=date&order=ASC'  );  ?>
				
				<ul class="listbrands">
		<?php if ( have_posts() ) : ?>
		
		

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				
			
				<li class="perbrand">
				<?php  
                $custom_textfield = get_post_custom(get_the_ID());
                $brands_price = $custom_textfield["brands_price"][0];
                
				?>
				<div class="wrapperbrandimg">
				
				<a href="<?php echo  $brands_price; ?>" target="_blank"><?php  the_post_thumbnail(); ?></a>
				</div>
				<div class="brncontent">
				<?php  the_content();  ?>
				
				</div>
				</li>
				

			<?php endwhile; ?>
             </ul>  
			<?php// wp_pagenavi( ); ?>
<div style="clear:both;"></div>
	

		

		<?php endif; ?>
		<div style="clear:both;"></div>
         </div>
		</main><!-- #main -->
	</section><!-- #primary -->
	
	
<?php

 get_footer(); ?>
