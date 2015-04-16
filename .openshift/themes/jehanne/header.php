<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<div id="page-wrap" class="site-wrap">
			<!-- Header -->
			<header id="masthead" class="site-header" role="banner">	
				<!-- First Top Menu -->		
				<?php do_action('jehanne_first_menu'); ?>

				<?php get_sidebar('top'); ?>
				
				<!-- Second Top Menu -->	
				<?php do_action('jehanne_second_menu'); ?>
				
				<?php get_sidebar('top-2'); ?>

				<div class="site-main-info">
				
					<?php do_action('jehanne_sidebar_header'); ?>
				
					<?php do_action('jehanne_sidebar_menu'); ?>

					<?php get_sidebar(); ?>
					
				</div>
			</header><!-- #masthead -->
			<div class="site-content"> 
				<div class="content">