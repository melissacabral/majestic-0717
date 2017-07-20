<?php get_header(); //includes header.php ?>
<main id="content">
	
<?php //THE LOOP - this handles the display of posts and pages. 
if( have_posts() ){ 
	?>

	<h1>All Products By: <?php single_cat_title(); ?></h1>
	<div class="product-grid">
		<?php
		while( have_posts() ){
			the_post(); //required so we don't get an infinite loop. "moves on" to the next post ?>
			<article id="post-<?php the_ID();?>" <?php post_class('one-product'); ?>>

				<?php if( has_post_thumbnail() ){ ?>
				<a href="<?php the_permalink(); ?>" class="featured-image-link">
					<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'featured-image-thumb' ) ); //featured image ?>
				</a>
				<?php } ?>
				<div class="caption">

				<h2 class="entry-title"> 
					<a href="<?php the_permalink(); ?>"> 
						<?php the_title(); ?> 
					</a>
				</h2>

				<?php the_terms( $post->ID, 'brand', '<h3 class="brand">', ', ', '</h3>' ); ?>

				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>

				<?php the_price(); ?>
			</div>
			</article>
			<!-- end post -->
			<?php 
		} //end while
		
		majestic_pagination();
		?>
	</div>
	<?php

}else{ 
	?>
	<h2>No Posts Found</h2>
	<p>Sorry.</p>

	<?php } //end of THE LOOP.?>

</main>
<!-- end #content -->

<?php get_sidebar('shop'); //includes sidebar-shop.php ?>		

<?php get_footer(); //includes footer.php ?>