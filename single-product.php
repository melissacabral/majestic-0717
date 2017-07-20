<?php get_header(); //includes header.php ?>
<main id="content">

<?php //THE LOOP - this handles the display of posts and pages. 
if( have_posts() ){ 
	while( have_posts() ){
		the_post(); //required so we don't get an infinite loop. "moves on" to the next post ?>
	<article id="post-<?php the_ID();?>" <?php post_class('clearfix'); ?>>
		<h2 class="entry-title"> 
			<?php the_title(); ?> 
		</h2>

<?php the_terms( $post->ID, 'brand', '<h3 class="brand">', ', ', '</h3>' ); ?>

		<div class="column-1">
			<?php the_meta();  //show all custom fields in a list ?>

			<?php the_post_thumbnail( 'large' ); ?>
		</div>

		<div class="column-2">
			<?php the_content(); ?>
		</div>

	</article>
	<!-- end post -->
<?php 
		} //end while

		majestic_pagination();

	}else{ 
?>
		<h2>No Posts Found</h2>
		<p>Sorry.</p>

<?php } //end of THE LOOP.?>

</main>
<!-- end #content -->
	

<?php get_footer(); //includes footer.php ?>