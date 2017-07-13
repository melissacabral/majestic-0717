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

<?php get_sidebar('home'); //require sidebar-home.php ?>
<?php get_footer(); ?>

