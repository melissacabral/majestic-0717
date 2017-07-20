<?php 
// This file is for custom functionality, and activating "sleeping" features. 
// It is loaded at the top of every page, including the admin panel and feeds

//max width of auto-embeds
if ( ! isset( $content_width ) ) $content_width = 735;

//adds editor-style.css for the wysiwyg editor
add_editor_style();

//activate "featured images"
add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-background' );

//don't forget to put header_image() in header.php
add_theme_support( 'custom-header', array( 
	'width' => 1000,
	'height' => 330,
) );

//don't forget to put the_custom_logo() in your templates
add_theme_support( 'custom-logo', array(
	'width' => 180,
	'height' => 50,
) );

//if you have a blog/news feed, you NEED this:
add_theme_support( 'automatic-feed-links' );

//improved <title> tags for SEO
//remove <title> from the header file, WP will dynamically add it with this:
add_theme_support( 'title-tag' );

//always use this for the most modern markup on generated HTML:
add_theme_support( 'html5', array('search-form', 'comment-list', 'comment-form', 'gallery', 'caption') );

//allows you to style different kinds of posts differently
add_theme_support( 'post-formats', array('image', 'gallery', 'video', 'link', 'aside', 
	'audio', 'chat', 'status', 'quote') );


/**
 * Improve Excerpts. Change the length and fix the [...]
 * @since  0.1 
 */
function majestic_ex_length(){
	//shorter excerpts on search results, longer excerpts everywhere else.
	if( is_search() ){
		return 30; //words
	}else{
		return 75; //words
	}
}
add_filter( 'excerpt_length', 'majestic_ex_length' );

//    [...]
function majestic_ex_more(){
	return '&hellip; <a href="' . get_permalink() . '" class="readmore">Read More</a>';
}
add_filter( 'excerpt_more', 'majestic_ex_more' );


/**
 * Quick example of action hook, not really practical
 */
function majestic_action_example(){
	echo 'This is the WP footer hook!';
}
//add_action( 'wp_footer', 'majestic_action_example' );

/**
 * Set up Menu Locations. This design needs two. 
 * remember to call wp_nav_menu() in your theme
 */
function majestic_menus(){
	register_nav_menus( array(
		'main_menu' => 'Main Menu',
		'utilities' => 'Utility Menu',
	) );
}
add_action( 'init', 'majestic_menus' );

/**
 * Callback function for empty menu areas
 */
function majestic_menu_fallback(){
	echo  '<div>Go make a menu in the admin panel</div>';
}

/**
 * Set up Widget Areas (Dynamic Sidebars)
 * This theme will have 4 widget areas
 */
add_action( 'widgets_init', 'majestic_widget_areas' );
function majestic_widget_areas(){
	//Blog sidebar
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id'			=> 'blog_sidebar',
		'description' 	=> 'Appears next to blog and archive pages',

		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',

		'before_title'	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	) );

	//Home Widget Area
	register_sidebar( array(
		'name' 			=> 'Home Widgets',
		'id'			=> 'home_widgets',
		'description' 	=> 'Appears on the front page',

		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',

		'before_title'	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	) );
	//Page Sidebar
	register_sidebar( array(
		'name' 			=> 'Page Sidebar',
		'id'			=> 'page_sidebar',
		'description' 	=> 'Appears alongside all static pages',

		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',

		'before_title'	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	) );
	//footer Widget Area
	register_sidebar( array(
		'name' 			=> 'Footer Widgets',
		'id'			=> 'footer_widgets',
		'description' 	=> 'Appears at the bottom of every page',

		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',

		'before_title'	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	) );
}


/**
 * Pagination output to use on any template - Single or archive
 */
function majestic_pagination(){
	?>
	<div class="pagination">
		<?php 
		if( is_singular() ){
			previous_post_link( '%link', '&larr; Older: %title' );  //1 older post
			next_post_link( '%link', 'Newer: %title &rarr;' ); //1 newer post
		}
		//if on mobile, show next/prev buttons. otherwise show numbered pagination
		elseif( wp_is_mobile() ){
			previous_posts_link( '&larr; Newer Posts' ); 
			next_posts_link( 'Older Posts &rarr;' );
		}else{
			//numbered pagination
			the_posts_pagination( array(
				'mid_size' => 3,
				'next_text' => 'Next &rarr;',
			) );
		}
		?>
	</div>

	<?php
}

/**
 * Fix the Number of comments to only include REAL comments (not pingbacks or trackbacks)
 */
add_filter( 'get_comments_number', 'majestic_comment_count' );
function majestic_comment_count(){
	//get the current post id
	global $id;
	$comments = get_approved_comments( $id );
	$comment_count = 0;
	foreach ( $comments as $comment ) {
		//only count it if it is a "normal" comment
		if( $comment->comment_type == "" ){
			$comment_count++;
		}
	}
	return $comment_count;
}

/**
 * Improve UX of comment replies
 */
add_action( 'wp_enqueue_scripts', 'majestic_reply' );
function majestic_reply(){
	if( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}
}


/**
 * Template tag to show the price custom field of any product
 */
function the_price(){
	global $post;
?>
	<span class="price">
		<?php echo get_post_meta( $post->ID, 'price', true ); ?>
	</span>
<?php
}

//no close PHP