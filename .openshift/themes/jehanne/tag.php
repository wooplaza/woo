<?php
/**
 * The template for displaying Tag pages
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0.8
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

	<header class="archive-header">
		<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'jehanne' ), single_cat_title( '', false ) ); ?></h1>
	</header><!-- .archive-header -->

	<?php
			while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );
			
			endwhile;
			
			jehanne_paging_nav();

		else :
		
			get_template_part( 'content', 'none' );

		endif;

get_footer();
