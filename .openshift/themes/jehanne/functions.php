<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
*/

/**
 * Set up the content width value.
 *
 * @since jehanne 1.0
 */
  
if ( ! isset( $content_width ) ) {
	$content_width = 967;
}

if ( ! function_exists( 'jehanne_setup' ) ) :

/**
 * Jehanne setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @since jehanne 1.0
 */

function jehanne_setup() {

	global $jehanne_options;
	$jehanne_options = jehanne_get_options();
	
	global $content_width;
	$content_width = apply_filters( 'jehanne_content_width', $jehanne_options['max_width'] - 382);

	register_nav_menu( 'primary', __( 'Primary Menu', 'jehanne' ));
	
	if ( $jehanne_options['is_show_top_menu'] == '1' )
		register_nav_menu( 'top1', __( 'First Top Menu', 'jehanne' ));
	if ( $jehanne_options['is_show_second_top_menu'] == '1' )
		register_nav_menu( 'top2', __( 'Second Top Menu', 'jehanne' ));
	if ( $jehanne_options['is_show_footer_menu'] == '1' )
		register_nav_menu( 'footer', __( 'Footer Menu', 'jehanne' ));

	load_theme_textdomain( 'jehanne', get_template_directory() . '/languages' );
	
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'cccccc',
	) );

	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( 300, 9999 ); 
	
		$args = array(
		'default-text-color'     => 'd6d6d6',
		'default-image'          => get_template_directory_uri() . '/img/jehanne.png',
		'height'                 => 300,
		'width'                  => 300,
		'flex-height'            => true,
		'flex-width'             => false,
		'wp-head-callback'       => 'jehanne_header_style',
		'admin-head-callback'    => 'jehanne_admin_header_style',
		'admin-preview-callback' => 'jehanne_admin_header_image',
	);
	add_theme_support( 'custom-header', $args );
		
	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );
	
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'caption'
	) );
	
	/*
	 * Enable support for woocommerce (hide non-support message).
	 */
	 
	add_theme_support( 'woocommerce' );
	
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'jehanne_setup' );
endif;

if ( ! function_exists( '_wp_render_title_tag' ) ) :
/**
 *  Backwards compatibility for older versions (4.1)
 * 
 * @since jehanne 1.0.3
 */
	function jehanne_render_title() {
	?>
		 <title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
	}
	add_action( 'wp_head', 'jehanne_render_title' );
	
/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since jehanne 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function jehanne_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'jehanne' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'jehanne_wp_title', 10, 2 );
	
endif;

if ( ! function_exists( 'jehanne_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 * 
 * @since jehanne 1.0
 */
function jehanne_header_style() {
	$text_color = get_header_textcolor();

	if ( !display_header_text() )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="jehanne-header-css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		.site-title a {
			color: #<?php echo esc_attr( $text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
if ( ! function_exists( 'jehanne_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @since jehanne 1.0
 */
function jehanne_admin_header_style() {
?>
	<style type="text/css" id="jehanne-admin-header-css">
	.appearance_page_custom-header #headimg {
		background: #fff;
		border: none;
		width: 300px;
	}
	#headimg {
		font-family: 'Philosopher', sans-serif;
	}
	#headimg h1 {
		font-size: 36px;
		margin-bottom: 0;
		text-align: center;
	}
	#headimg h1 a {
		color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
	}	
	#headimg h1 a:hover {
		color: #339900;
	}
	#headimg .displaying-header-text.site-description {
		color: #339900;
		text-align: center;
		font-size: 14px;
		font-weight: bold;
		margin-top: 0;
		margin-bottom: 20px;
		padding: 0;
	}
	#headimg img {
		vertical-align: middle;
	}
	</style>
<?php
}
endif; 

if ( ! function_exists( 'jehanne_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @since jehanne 1.0
 */
function jehanne_admin_header_image() {

?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo sprintf( ' style="color:#%s;"', esc_attr(get_header_textcolor()) ); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 class="displaying-header-text site-description"><?php bloginfo( 'description' ); ?></h2>

		<?php if ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif;

/**
 * Load our special font CSS file.
 *
 * @since jehanne 1.0
 */
function jehanne_custom_header_fonts() {
	$font_url = jehanne_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'jehanne-fonts', esc_url_raw( $font_url ), array(), null );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'jehanne_custom_header_fonts' );

/**
 * Return the Google font stylesheet URL if available.
 *
 * @since jehanne 1.0
 */
function jehanne_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Philosopher, Lobster fonts, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Philosopher, Lobster fonts: on or off', 'jehanne' ) ) {
		$subsets = 'latin,latin-ext';
		$family = 'Philosopher%7CLobster:400italic,400';

		/* translators: To add an additional Philosopher, Lobster character subset specific to your language,	
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Font: add new subset (greek, cyrillic, vietnamese)', 'jehanne' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		}
		if ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$query_args = array(
			'family' => $family,
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
		
	}

	return $font_url;
}
/**
 * Enqueue scripts and styles for front-end.
 *
 * @since jehanne 1.0
 */
function jehanne_scripts_styles() {
	global $wp_styles;
	
	// Add Genericons font.
	wp_enqueue_style( 'jehanne-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '2122014' );
	
	$font_url = jehanne_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'jehanne-fonts', esc_url_raw( $font_url ), array(), null );
		
	// Loads our main stylesheet.
	wp_enqueue_style( 'jehanne-style', get_stylesheet_uri() );
			
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'jehanne-ie', get_template_directory_uri() . '/css/ie.css', array( 'jehanne-style' ), '20141210' );
	$wp_styles->add_data( 'jehanne-ie', 'conditional', 'lt IE 9' );
	
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
	// Adds JavaScript for handing the navigation menu and top sidebars hide-and-show behavior.
	wp_enqueue_script( 'jehanne-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20141201', true );
	
	// Adds JavaScript for handing the custom widget behavior.
	wp_enqueue_script( 'jehanne-custom-widget', get_template_directory_uri() . '/js/custom-widget.js', array( 'jquery' ), '20141012', true );
	
	// Adds JavaScript for handing the custom widget behavior.
	wp_enqueue_script( 'jehanne-image-widget', get_template_directory_uri() . '/js/image-widget.js', array( 'jquery' ), '20141212', true );
	
	global $jehanne_options;
	$jehanne_options = jehanne_get_options();//doesn't update new setting in customizer preview
	if($jehanne_options['color_scheme'] != 'light') {
		wp_enqueue_style( 'jehanne-colors', get_template_directory_uri() . '/colors/'.$jehanne_options['color_scheme'].'.css', array('jehanne-style'), '20141212' );	
	}
	
	if($jehanne_options['is_responsive'] == 0) {
		wp_enqueue_style( 'jehanne-style-static', get_template_directory_uri() . '/css/not-responsive.css', array('jehanne-style'), '20141212' );	
	}
}
add_action( 'wp_enqueue_scripts', 'jehanne_scripts_styles' );
 
/**
 * Add Editor styles and fonts to Tiny MCE
 *
 * @since jehanne 1.0
 */
function jehanne_add_editor_styles() {
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( 'css/editor-style.css' );
	
	$font_url = jehanne_get_font_url();
	if ( ! empty( $font_url ) )
		 add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'jehanne_add_editor_styles' );

/**
 * Extend the default WordPress body classes.
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 *
 * @since jehanne 1.0
 */
function jehanne_body_class( $classes ) {

	global $jehanne_options;

	$background_color = get_background_color();
	$background_image = get_background_image();
	
	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background';
		elseif ( in_array( $background_color, array( 'ccc', 'cccccc' ) ) )
			$classes[] = 'custom-background';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'jehanne-fonts', 'queue' ) )
		$classes[] = 'google-fonts-on';
		
	if( $jehanne_options['sticky_top_menu'] == '1' )
		$classes[] = 'sticky-top-menu';

	if( $jehanne_options['sticky_header'] == '1' )
		$classes[] = 'sticky-header';
		
	return $classes;
}
add_filter( 'body_class', 'jehanne_body_class' );


/**
 * Create not empty title
 *
 * @since jehanne 1.0
 *
 * @param string $title Default title text.
 * @param int $id.
 * @return string The filtered title.
 */
function jehanne_title( $title, $id = null ) {

    if ( trim($title) == '' && (is_archive() || is_home() || is_search() ) ) {
        return ( esc_html( get_the_date() ) );
    }
    return $title;
}
add_filter( 'the_title', 'jehanne_title', 10, 2 );
/**
 * Register sidebars and widgetized areas.
 *
 * @since jehanne 1.0
 */
function jehanne_widgets_init() {
	global $jehanne_options;
	
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'jehanne' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="before-widget-title"></div><h3 class="widget-title">',
		'after_title' => '</h3><div class="after-widget-title"></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Top Sidebar', 'jehanne' ),
		'id' => 'sidebar-4',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Top Sidebar (25%)', 'jehanne' ),
		'id' => 'sidebar-2',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar', 'jehanne' ),
		'id' => 'sidebar-3',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Second Footer Sidebar', 'jehanne' ),
		'id' => 'sidebar-7',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Content Sidebar', 'jehanne' ),
		'id' => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Main Sidebar for Pages', 'jehanne' ),
		'id' => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="before-widget-title"></div><h3 class="widget-title">',
		'after_title' => '</h3><div class="after-widget-title"></div>',
	) );
	
/* Home Page Widgets */
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar 1 (Header)', 'jehanne' ),
		'id' => 'sidebar-10',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Home Page Sidebar 2 (25%) (Header)', 'jehanne' ),
		'id' => 'sidebar-22',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar 3', 'jehanne' ),
		'id' => 'sidebar-40',
		'before_widget' => '<div class="widget-wrap '.$jehanne_options['front_style'].'"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar 4 (Content)', 'jehanne' ),
		'id' => 'sidebar-11',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar 5', 'jehanne' ),
		'id' => 'sidebar-20',
		'before_widget' => '<div class="widget-wrap '.$jehanne_options['front_style'].'"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Page Main Sidebar', 'jehanne' ),
		'id' => 'sidebar-12',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="before-widget-title"></div><h3 class="widget-title">',
		'after_title' => '</h3><div class="after-widget-title"></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar 6', 'jehanne' ),
		'id' => 'sidebar-23',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar 7 (Footer)', 'jehanne' ),
		'id' => 'sidebar-14',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar 8 (Footer)', 'jehanne' ),
		'id' => 'sidebar-15',
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
			
}
add_action( 'widgets_init', 'jehanne_widgets_init' );

if ( ! function_exists( 'jehanne_post_nav' ) ) :
/**
 * Display navigation to next/previous post.
 *
 * @since jehanne 1.0
 */
function jehanne_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'jehanne' ); ?></h1>
		<div class="nav-link">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'jehanne' ) );
			else :
				$next = next_post_link( '%link ', __( '<span class="nav-next">%title &rarr;</span>', 'jehanne' ) );
				if ( $next ) :
					previous_post_link( '%link', __( '<span class="nav-previous">&larr; %title</span>', 'jehanne' ) );
					$next;
				else :
					previous_post_link( '%link', __( '<span class="nav-previous-one">&larr; %title</span>', 'jehanne' ) );
				endif;
				
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<div class="clear-right"></div>
	<?php
}
endif;

if ( ! function_exists( 'jehanne_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since jehanne 1.0
 */
function jehanne_paging_nav() {

	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'jehanne' ),
		'next_text' => __( 'Next &rarr;', 'jehanne' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'jehanne' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
	
}
endif;

if ( ! function_exists( 'jehanne_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since jehanne 1.0
 */
function jehanne_the_attached_image() {
	$post                = get_post();

	$attachment_size     = apply_filters( 'jehanne_attachment_size', array( 987, 9999 ) );
	$next_attachment_url = wp_get_attachment_url();

	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'jehanne_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since Jehanne 1.0
 */
function jehanne_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . __( 'Sticky', 'jehanne' ) . '</span>';
	}

	// Set up and print post meta information.
	printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
	
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'jehanne' ), __( '1 Comment', 'jehanne' ), __( '% Comments', 'jehanne' ) );
		echo '</span>';
	}
}
endif;

/**
 * Return array theme options
 *
 * @since Jehanne 1.0.1
 */
function jehanne_get_options() {

	$defaults = jehanne_get_defaults();
	foreach( $defaults as $key => $value ) {
		if( get_theme_mod( $key, -1 ) != -1 )
			$defaults[$key] = get_theme_mod( $key );
	}

	return $defaults;
}

/**
 * Return array Default Icons
 *
 * @since jehanne 1.0
 */
function jehanne_social_icons(){
	$icons = array(
					'facebook' => '#',
					'twitter' => '#',
					'google' => '#',
					'wordpress' => '#',
					'blogger' => '',
					'yahoo' => '',
					'youtube' => '',
					'myspace' => '',
					'livejournal' => '',
					'linkedin' => '',
					'friendster' => '',
					'friendfeed' => '',
					'digg' => '',
					'delicious' => '',
					'aim' => '',
					'ask' => '',
					'buzz' => '',
					'tumblr' => '',		
					'flickr' => '',						
					'rss' => '',
				  );
	return apply_filters( 'jehanne_icons_defaults', $icons );
}
/**
 * Return array Default Colors
 *
 * @since jehanne 1.0.1
 */
function jehanne_get_colors( $skin ){
	$defaults = array();

	if( 'blue' == $skin) {
		$defaults['rgba'] = '0';
		$defaults['main_rgba_color'] = '#fff';
		$defaults['opacity'] = '0.7';
		
		$defaults['link'] = '#1e73be';
		$defaults['heading'] = '#000';
		$defaults['first_menu_color'] = '#fff';
		$defaults['first_menu_link'] = '#1e73be';
		$defaults['first_menu_link_hover'] = '#fff';
		$defaults['first_menu_link_hover_back'] = '#1e73be';
		$defaults['second_menu_color'] = '#000066';
		$defaults['second_menu_link'] = '#fff';
		$defaults['second_menu_link_hover'] = '#fff';
		$defaults['second_menu_link_hover_back'] = '#1e73be';
		
		$defaults['footer_menu_color'] = '#000066';
		$defaults['footer_menu_link'] = '#fff';
		$defaults['footer_menu_link_hover'] = '#fff';
		$defaults['footer_menu_link_hover_back'] = '#1e73be';
		$defaults['column_header_color'] = '#000066';
		$defaults['column_header_text'] = '#fff';
		$defaults['column_color'] = '#fff';
		$defaults['column_link'] = '#1e73be';
		$defaults['column_hover'] = '#000066';
		$defaults['column_text'] = '#666';
		$defaults['widget_back'] = '#fff';

		$defaults['top_sidebar_color'] = '#fff';
		$defaults['top_sidebar_link'] = '#1e73be';
		$defaults['top_sidebar_link_hover'] = '#339900';
		$defaults['top_sidebar_text'] = '#757575';
		$defaults['footer_sidebar_color'] = '#63add0';
		$defaults['footer_sidebar_link'] = '#fff';
		$defaults['footer_sidebar_link_hover'] = '#000066';
		$defaults['footer_sidebar_text'] = '#e3e3e3';
	} elseif( 'black' == $skin) {	
		$defaults['rgba'] = 'linear';
		$defaults['main_rgba_color'] = '#000';
		$defaults['opacity'] = '1';
		
		$defaults['link'] = '#eee';
		$defaults['heading'] = '#dddddd';
		$defaults['first_menu_color'] = '#595959';
		$defaults['first_menu_link'] = '#ddd';
		$defaults['first_menu_link_hover'] = '#aaa';
		$defaults['first_menu_link_hover_back'] = '#595959';
		$defaults['second_menu_color'] = '#595959';
		$defaults['second_menu_link'] = '#ddd';
		$defaults['second_menu_link_hover'] = '#aaa';
		$defaults['second_menu_link_hover_back'] = '#595959';
		$defaults['footer_menu_color'] = '#600000';
		$defaults['footer_menu_link'] = '#fff';
		$defaults['footer_menu_link_hover'] = '#fff';
		$defaults['footer_menu_link_hover_back'] = '#600000';
		
		$defaults['column_header_color'] = '#595959';
		$defaults['column_header_text'] = '#ccc';
		$defaults['column_color'] = '#212121';
		$defaults['column_link'] = '#aaa';
		$defaults['column_hover'] = '#fff';
		$defaults['column_text'] = '#969696';
		$defaults['widget_back'] = '#2b2b2b';

		$defaults['top_sidebar_color'] = '#333333';
		$defaults['top_sidebar_link'] = '#eeeeee';
		$defaults['top_sidebar_link_hover'] = '#dd3333';
		$defaults['top_sidebar_text'] = '#cccccc';
		$defaults['footer_sidebar_color'] = '#600000';
		$defaults['footer_sidebar_link'] = '#cccccc';
		$defaults['footer_sidebar_link_hover'] = '#dd3333';
		$defaults['footer_sidebar_text'] = '#cccccc';
	}elseif( 'red' == $skin) {
		$defaults['rgba'] = 'linear';
		$defaults['main_rgba_color'] = '#111';
		$defaults['opacity'] = '1';
		
		$defaults['link'] = '#eee';
		$defaults['heading'] = '#dddddd';
		$defaults['first_menu_color'] = '#dd1111';
		$defaults['first_menu_link'] = '#fff';
		$defaults['first_menu_link_hover'] = '#600000';
		$defaults['first_menu_link_hover_back'] = '#d8d215';
		$defaults['second_menu_color'] = '#dd1111';
		$defaults['second_menu_link'] = '#fff';
		$defaults['second_menu_link_hover'] = '#fff';
		$defaults['second_menu_link_hover_back'] = '#600000';
		$defaults['footer_menu_color'] = '#600000';
		$defaults['footer_menu_link'] = '#fff';
		$defaults['footer_menu_link_hover'] = '#fff';
		$defaults['footer_menu_link_hover_back'] = '#600000';
		
		$defaults['column_header_color'] = '#dd3333';
		$defaults['column_header_text'] = '#fff';
		$defaults['column_color'] = '#212121';
		$defaults['column_link'] = '#000';
		$defaults['column_hover'] = '#333';
		$defaults['column_text'] = '#666';
		$defaults['widget_back'] = '#d6d6d6';

		$defaults['top_sidebar_color'] = '#333333';
		$defaults['top_sidebar_link'] = '#eeeeee';
		$defaults['top_sidebar_link_hover'] = '#dd3333';
		$defaults['top_sidebar_text'] = '#cccccc';
		$defaults['footer_sidebar_color'] = '#600000';
		$defaults['footer_sidebar_link'] = '#cccccc';
		$defaults['footer_sidebar_link_hover'] = '#dd3333';
		$defaults['footer_sidebar_text'] = '#cccccc';
	}
	
	return apply_filters( 'jehanne_colors_defaults', $defaults );
}

 /**
 * Return array default theme options
 *
 * @since Jehanne 1.0.1
 */
function jehanne_get_defaults() {
	$defaults = array();
	$defaults['logotype_url'] = '';
	$defaults['is_show_primary_menu'] = '1';
	$defaults['is_show_top_menu'] = '';
	$defaults['is_show_second_top_menu'] = '1';
	$defaults['is_show_footer_menu'] = '1';
	
	$defaults['social_buttons_in_the_header'] = '1';
	$defaults['social_buttons_class'] = 'big';
	
	$defaults['layout'] = 'boxed';
	$defaults['margin_top'] = '0';
	$defaults['margin_bottom'] = '20';
	$defaults['max_width'] = '1349';
	
	$defaults['color_scheme'] = 'light';
	$defaults['color_skin'] = 'blue';
	
	$defaults['scroll_button'] = 'right';
	$defaults['scroll_animate'] = 'none';
	
	$defaults['favicon'] = '';
	$defaults['is_responsive'] = 1;
	$defaults['min_width'] = '960';
	$defaults['hide_top_1_sidebar'] = '1';
	$defaults['hide_1_menu'] = '1';
	$defaults['hide_2_menu'] = '1';
	$defaults['hide_3_menu'] = '1';
	$defaults['hide_4_menu'] = '1';
	
	$defaults['thumbnail_style'] = 'small';
	$defaults['thumbnail_class'] = 'right';
	$defaults['front_style'] = 'default';
	
	$defaults['sticky_top_menu'] = '1';
	$defaults['sticky_header'] = '1';
	
	$defaults['is_show_widgets'] = '1';

	$defaults = wp_parse_args( 
        $defaults, 
        jehanne_social_icons() 
    );
	
	$defaults = wp_parse_args( 
        $defaults, 
        jehanne_get_colors($defaults['color_skin']) 
    );
	
	return apply_filters( 'jehanne_option_defaults', $defaults );
}

/**
 * Print Top Menu and Logo
 *
 * @since Jehanne 1.0.1
 */
function jehanne_echo_top_menu() {

	global $jehanne_options;

	if ( $jehanne_options['is_show_top_menu'] == '1' ) : ?>
		<div id="top-1-navigation" class="nav-container">
		
			<?php if ( $jehanne_options['logotype_url'] != '' ) : ?>

				<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
					<img src='<?php echo esc_url( $jehanne_options['logotype_url'] ); ?>' class="logo" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
				</a>
				
			<?php endif; ?>
			
			<nav id="menu-1" class="horisontal-navigation" role="navigation">
				<div class="menu-toggle"></div>
				<?php wp_nav_menu( array( 'theme_location' => 'top1', 'menu_class' => 'nav-horizontal' ) ); ?>
			</nav>
			<div class="clear"></div>
		</div>
	<?php else : ?>

		<?php if ( $jehanne_options['logotype_url'] != '' ) : ?>

			<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
				<img src='<?php echo esc_url( $jehanne_options['logotype_url'] ); ?>' class="logo" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
			</a>
			
		<?php endif; ?>
	<?php endif; 
}
add_action( 'jehanne_first_menu', 'jehanne_echo_top_menu' );

 
 /**
 * Print Footer Menu
 *
 * @since Jehanne 1.0.1
 */
function jehanne_echo_footer_menu() {

	global $jehanne_options;

	if ( $jehanne_options['is_show_footer_menu'] == '1' ) : ?>
		<div id="footer-navigation" class="nav-container">
			<nav id="menu-4" class="horisontal-navigation" role="navigation">
				<div class="menu-toggle"></div>
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-horizontal' ) ); ?>
			</nav>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>		
	<?php else : ?>
		<div class="empty-menu"></div>
	<?php endif; 
}
add_action( 'jehanne_footer_menu', 'jehanne_echo_footer_menu' );

 /**
 * Print credit links
 *
 * @since Jehanne 1.0.1
 */
function jehanne_site_info() {

	global $jehanne_options;
?>
	<div class="site-info">
		<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'jehanne' )); ?>"><?php printf( __( 'Proudly powered by %s', 'jehanne' ), 'WordPress' ); ?></a><?php esc_html( _e( ' theme by ', 'jehanne' ) ); ?><a href="<?php echo esc_url( 'http://wpblogs.ru/themes/' ); ?>">WP Blogs</a>
	</div><!-- .site-info -->
	
	<?php if( $jehanne_options['scroll_button'] != 'none' ) : ?>
		<a href="#" class="scrollup <?php echo esc_attr($jehanne_options['scroll_button']).esc_attr($jehanne_options['scroll_animate'] == 'none' ? '' : ' '.$jehanne_options['scroll_animate'] ); ?>"></a>
	<?php endif; 
}
add_action( 'jehanne_site_info', 'jehanne_site_info' );

 /**
 * Print Second Top Menu.
 *
 * @since Jehanne 1.0.1
 */
function jehanne_echo_top_2_menu() {

	global $jehanne_options;

	if ( $jehanne_options['is_show_second_top_menu'] == '1' ) : ?>
		<div id="top-navigation" class="nav-container">
			<nav id="menu-2" class="horisontal-navigation" role="navigation">
				<div class="menu-toggle"></div>
				<?php wp_nav_menu( array( 'theme_location' => 'top2', 'menu_class' => 'nav-horizontal' ) ); ?>
			</nav>
			<div class="clear"></div>
		</div>
	<?php endif;
}
add_action( 'jehanne_second_menu', 'jehanne_echo_top_2_menu' );

 /**
 * Print Header in Left Column.
 *
 * @since Jehanne 1.0.1
 */
function jehanne_sidebar_header() {
	global $jehanne_options;
	
	if ( is_page_template( 'page-templates/front-page-no-column.php' ) || is_page_template( 'page-templates/no-column.php' ) )
		return;
 ?>
	<div class="header-wrap">
	<!-- Site Name -->
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<!-- Dscription -->
	<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	
	<!-- Social Media -->
	<?php do_action('jehanne_print_social_icons'); ?>
	
	<!-- Banner -->
	<?php if ( get_header_image() ) : ?>
		<div class="img-container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
			</a>
		</div>
	<?php endif; ?>
	<div class="search-container">
		<div class="search-box">
			<?php get_search_form(); ?>
		</div>
	</div>
	</div>
<?php
}
add_action( 'jehanne_sidebar_header', 'jehanne_sidebar_header' );
 /**
 * Print Social Icons.
 *
 * @since Jehanne 1.0.1
 */
function jehanne_print_social_icons() {
	global $jehanne_options;
	
	if ( is_page_template( 'page-templates/front-page-no-column.php' ) || is_page_template( 'page-templates/no-column.php' ) )
		return;
	
	$instance = jehanne_social_icons();
	
	if ( $jehanne_options['social_buttons_in_the_header'] == '' )
		return;

	$classes = 'horizontal header ';
		
	$classes .= $jehanne_options['social_buttons_class'];
	
	$out = '<div class="jehanne_socialicons"><ul class="'.$classes.'">';
	foreach($instance as $id => $icon) {
		if(trim($jehanne_options[$id]) != '' ) {
			$out .= '<li><a style="background: url('.get_template_directory_uri().'/img/icons/'.($jehanne_options['social_buttons_class'] == 'small' ? 'small/' : '' ).$id.'.png)" href="'.esc_url($jehanne_options[$id]).'" target="_blank" title="'.esc_attr($id).'"></a></li>';
		}
	}
	$out .= '</ul></div>';	
	echo $out;
?>

<?php
}
add_action( 'jehanne_print_social_icons', 'jehanne_print_social_icons' );

 /**
 * Print Menu in left column.
 *
 * @since Jehanne 1.0.1
 */
function jehanne_sidebar_menu() {
	global $jehanne_options;
	
	if ( is_page_template( 'page-templates/front-page-no-column.php' ) || is_page_template( 'page-templates/no-column.php' ) )
		return;

?>
	<!-- Primary Menu -->		
	<?php if ( $jehanne_options['is_show_primary_menu'] == '1' ) : ?>
		<nav id="menu-3" class="site-navigation" role="navigation">
			<div class="menu-toggle"></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav>
	<?php endif;
}
add_action( 'jehanne_sidebar_menu', 'jehanne_sidebar_menu' );
 /**
 * Print Favicon.
 *
 * @since Jehanne 1.0.1
 */
function jehanne_hook_favicon() {
	global $jehanne_options;

?>
	<?php if ( trim( $jehanne_options['favicon'], '' ) != '' ) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url($jehanne_options['favicon']); ?>" />
	<?php endif;
}
add_action('wp_head', 'jehanne_hook_favicon');

 /**
 * Print the post thumbnail.
 *
 * @since Jehanne 1.0.2
 */
function jehanne_print_image() {
	global $jehanne_options;
	if ( $jehanne_options['thumbnail_style'] != 'small' )
		return;

?>
	<div class="image-and-cats <?php echo esc_attr($jehanne_options['thumbnail_class']); ?>">
		<div class="category-list">
			<?php echo get_the_category_list(); ?>
		</div>
		<?php if ( ! post_password_required() && ! is_attachment() ) :
					the_post_thumbnail();
		endif; ?>
		<div class="tags">
			<?php echo get_the_tag_list('<span class="genericon genericon-tag">', '</span><span class="genericon genericon-tag">', '</span>');?>
		</div>
	</div>
<?php
}
add_action('jehanne_image_and_cats_small', 'jehanne_print_image');
 /**
 * @return int sidebar width.
 * @param $sidebar_id string sidebar id
 * @since Jehanne 1.0.3
 */
function jehanne_sidebar_width( $sidebar_id ) {
	global $jehanne_options;

	switch ( $sidebar_id ) {
	//columns
		case 'sidebar-1':
		case 'sidebar-6':
		case 'sidebar-12':
			$width = 280;
		break;
	//25% sidebars
		case 'sidebar-2':
		case 'sidebar-22':
		case 'sidebar-23':
			$width = 341;
		break;
	//footer sidebar
		case 'sidebar-3':
		case 'sidebar-14':
			$width = 350;
		break;
	//100% sidebars
		case 'sidebar-4':
		case 'sidebar-7':
		case 'sidebar-15':
		case 'sidebar-10':
		case 'sidebar-20':
		case 'sidebar-40':
			$width = $jehanne_options['max_width'];
		break;
	//content sidebars
		case 'sidebar-5':
		case 'sidebar-11':
			$width = $jehanne_options['max_width'] - 382 - 20;
		break;
		default:
			$width = $jehanne_options['max_width'];
		break;
	}
	
	return apply_filters( 'jehanne_sidebar_width', $width, $sidebar_id);
}

/**
 * Add new wrapper for woocommerce pages.
 *
 * @since Jehanne 1.0.1
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'jehanne_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'jehanne_wrapper_end', 10);

function jehanne_wrapper_start() {
  echo '<div id="woocommerce-wrapper">';
}

function jehanne_wrapper_end() {
  echo '</div>';
}

// Add custom widget.
require get_template_directory() . '/inc/widget.php';
// Add custom social media icons widget.
require get_template_directory() . '/inc/social-media-widget.php';
// Add custom Image widget.
require get_template_directory() . '/inc/image-widget.php';
// Add customize options.
require get_template_directory() . '/inc/customize.php';