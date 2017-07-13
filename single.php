<?php get_header(); //includes header.php ?>
<main id="content">

<?php //THE LOOP - this handles the display of posts and pages. 
if( have_posts() ){ 
	while( have_posts() ){
		the_post(); //required so we don't get an infinite loop. "moves on" to the next post ?>
	<article id="post-<?php the_ID();?>" <?php post_class('clearfix'); ?>>
		<h2 class="entry-title"> 
			<a href="<?php the_permalink(); ?>"> 
				<?php the_title(); ?> 
			</a>
		</h2>

		<?php if( has_post_thumbnail() ){ ?>
		<a href="<?php the_permalink(); ?>" class="featured-image-link">
			<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'featured-image-thumb' ) ); //featured image ?>
		</a>
		<?php } ?>

		<div class="entry-content">
			<?php
			//if viewing a single post or page 
			if( is_single() OR is_page() ){
				the_content();
				wp_link_pages(); //for paginated posts
			}else{
				the_excerpt();
			} ?>
		</div>
		<div class="postmeta">
			<span class="author">by: <?php the_author(); ?> </span>
			<span class="date"> <?php the_date(); ?> </span>
			<span class="num-comments"> <?php comments_number(); ?> </span>
			<span class="categories"> 
				<?php the_category(); ?>
			</span>
			<span class="tags"><?php the_tags(); ?></span>
		</div>
		<!-- end postmeta -->
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

<?php get_sidebar(); //includes sidebar.php ?>		

<?php get_footer(); //includes footer.php ?>