<aside id="sidebar">
	<?php 
	//if not viewing the product archive (shop), give the user a link back to the shop
	if( ! is_post_type_archive( 'product' ) ){ ?>
	<section class="widget">
		<a class="button" href="<?php echo get_post_type_archive_link('product'); ?>">Show All Products</a>
	</section>
	<?php } ?>


	<section class="widget">
		<h3 class="widget-title">Filter by Brand:</h3>
		<ul>
			<?php wp_list_categories( array(
				'taxonomy' 		=> 'brand',
				'title_li' 		=> '',
				'show_count' 	=> true,
			) ); ?>
		</ul>
	</section>
</aside>
