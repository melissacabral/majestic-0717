<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

	<?php wp_head(); //HOOK. required for the admin bar and plugins to work ?>
</head>
<body <?php body_class(); ?>>
	<header role="banner" id="header" 
		style="background-image:url(<?php header_image(); ?>);">
		<div class="header-bar">

			<?php 
			//show the custom logo if it exists, otherwise show the title of the site
			if( has_custom_logo() ){
				the_custom_logo();
			}else{ 
			?>
			<h1 class="site-title"><a href="<?php echo home_url(); ?>">
				<?php bloginfo('name'); ?>
			</a></h1>
			<?php } //end if has custom logo ?>


			<h2><?php bloginfo('description'); ?></h2>

			<?php 
			//display a registered nav menu
			wp_nav_menu( array(
				'theme_location' 	=> 'main_menu',
				'container'			=> 'nav',
				'fallback_cb' 		=> false,
			) ); 
			?>

			<?php get_search_form(); //includes searchform.php or default WP search ?>

		</div>
	</header>
	<div class="wrapper">