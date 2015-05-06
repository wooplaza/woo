<?php
/**
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Seller
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php global $option_setting; ?>
<div id="page" class="hfeed site">
<div id="top-bar">
	<div class="container">
			<div class="col-md-6">
				<?php
					if (isset($option_setting['mail-id'])) :
						 get_template_part('top', 'left');
					else :
						get_template_part('defaults/top', 'left');
					endif;	  ?>
			</div>
			
			<?php if (isset($option_setting['enable-social-icons'])) : 
					if($option_setting['enable-social-icons']) : ?>
						<div id="social-icons" class="col-md-6">
							<?php get_template_part('social', 'fa'); ?>
						</div>
					<?php endif;
				  else : ?>
				  		<div id="social-icons" class="col-md-6">
							<?php get_template_part('defaults/social', 'default'); ?>
						</div>
				 <?php endif; ?>
					
	</div><!--.container-->
</div><!--#top-bar-->

<header id="masthead" class="site-header" role="banner">
	<div class="container">
		<div class="site-branding col-lg-4 col-md-12">
				<?php if (isset($option_setting['logo']['url'])) : ?>
					<?php if( $option_setting['logo']['url'] != "" ) : ?>
						<div id="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($option_setting['logo']['url']) ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
						</div>
					<?php else : ?>	
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-hover="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php endif; ?>	
				<?php else : ?>	
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-hover="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; ?>	
		</div>
	
	
		<div id="top-nav" class="col-lg-8 col-md-12">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="menu-toggle"><?php _e( 'Menu', 'seller' ); ?></h1>
				<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'seller' ); ?></a>
					
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->	
		</div>
	</div><!--.container-->
		
</header><!-- #masthead -->


	
	<?php
	if (isset($option_setting['slider-enable-on-home'])) :
	 get_template_part('slider');
	 get_template_part('showcase');
	else :
	 get_template_part('defaults/slider','default');
	 get_template_part('defaults/showcase','default');
	endif; 
	  ?>
	
	<div id="content" class="site-content container">