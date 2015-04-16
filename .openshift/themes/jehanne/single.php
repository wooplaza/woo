<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */

get_header(); ?>

	<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

			jehanne_post_nav();

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
	?>

<?php
get_footer();
