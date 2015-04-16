<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */

get_header(); ?>
		<?php if ( have_posts() ) : 
		
			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );
				
			endwhile; 

			jehanne_paging_nav();
			
			 else : 

				get_template_part( 'content', 'none' );

		endif; ?>

<?php
get_footer();