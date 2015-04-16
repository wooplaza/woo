<?php
/**
 * Template Name: Front Page, Full Width Template
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
__( 'Front Page, Full Width Template', 'jehanne' );

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>