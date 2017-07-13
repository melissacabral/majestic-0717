<?php get_header(); ?>

<main id="content">
	<?php 
	//THE LOOP
	if( have_posts() ){ 
		while( have_posts() ){
			the_post();
	?>
	
	<article>
		<h2><?php the_title(); ?></h2>

		<?php the_content(); ?>
	</article>

	<?php
		} //end while
	}else{
		echo 'sorry, no posts found';
	} //end THE LOOP
	?>
</main>

<?php get_sidebar('page'); //require sidebar-page.php ?>
<?php get_footer(); ?>

