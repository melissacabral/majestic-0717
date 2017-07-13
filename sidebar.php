<aside id="sidebar">
	<?php 
	if( ! dynamic_sidebar( 'blog_sidebar' ) ){
	?>
	
	<section id="categories" class="widget">
		<h3 class="widget-title"> Categories </h3>
		<ul>
			<?php wp_list_categories( array(
				'title_li' 		=> '',
				'show_count' 	=> 1,
				'number' 		=> 10,
				'orderby'  		=> 'count',
				'order'			=> 'DESC',
				) ); ?>
			</ul>
		</section>
		<section id="archives" class="widget">
			<h3 class="widget-title"> Archives </h3>
			<ul>
				<?php 
					//get the yearly archives
				wp_get_archives( array(
					'type' 				=> 'yearly',
					'show_post_count' 	=> 1
					) ); ?>
				</ul>
			</section>
			<section id="tags" class="widget">
				<h3 class="widget-title"> Tags </h3>
				<?php 
				//get the 20 most popular tags as a list
				wp_tag_cloud( array(
					'format' 	=> 'list',
					'smallest' 	=> 1,
					'largest' 	=> 1,
					'unit' 		=> 'em',  //make every tag 1 em
					'orderby' 	=> 'count',
					'order'		=> 'DESC',
					'number' 	=> 20,
					) ); ?>
				</section>
				<section id="meta" class="widget">
					<h3 class="widget-title"> Meta </h3>
					<ul>
						<?php wp_register(); // register button or admin panel or nothing ?>
						<li><?php wp_loginout(); ?></li>
					</ul>
				</section>

				<?php 
			//show the login form if not logged in
				if( ! is_user_logged_in() ){ ?>
				<section>
					<?php wp_login_form(); ?>
				</section>
				<?php 
			}else{
				echo 'You are logged in!';
			} ?>

	<?php } //end if no widgets ?>

</aside>
<!-- end #sidebar -->