<?php
function blackpaper_setup() {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(166, 124, TRUE);
	add_theme_support( 'automatic-feed-links' );
	global $content_width;
	if ( ! isset( $content_width ) )
	$content_width = 960;
}
add_action( 'after_setup_theme', 'blackpaper_setup' );
function blackpaper_scripts(){
  if (!is_admin()) {
 	wp_register_style('open-sans', '//fonts.googleapis.com/css?family=Open+Sans');
 	wp_enqueue_style('open-sans');
  }
	wp_enqueue_style( 'blackpaper', get_stylesheet_uri() );
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}
add_action('wp_enqueue_scripts', 'blackpaper_scripts');
function blackpaper_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'blackpaper' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'blackpaper_wp_title', 10, 2 );
function blackpaper_menu() {
	add_theme_page('Black Paper Setup', 'Black Paper Options', 'edit_theme_options', 'blackpaper', 'blackpaper_menu_page');
}
add_action('admin_menu', 'blackpaper_menu');
function blackpaper_menu_page() {
echo '
<br>
<h1><center><a href="http://justpx.com/theme-black-paper-pro">Black Paper PRO</a></h1></center><br><br>
<center><img src="' . get_template_directory_uri() . '/images/pro-vs-free.png"></ceter>
';
}
?>