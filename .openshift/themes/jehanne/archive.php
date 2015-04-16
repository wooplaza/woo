<?php
/**
 * The template for displaying Archive pages
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

	<header class="archive-header">
		<h1 class="archive-title">
			<?php
				if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'jehanne' ), get_the_date() );

				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'jehanne' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'jehanne' ) ) );

				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'jehanne' ), get_the_date( _x( 'Y', 'yearly archives date format', 'jehanne' ) ) );

				else :
					_e( 'Archives', 'jehanne' );

				endif;
			?>
		</h1>
	</header><!-- .page-header -->

	<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

			endwhile;
			
			jehanne_paging_nav();

		else :

			get_template_part( 'content', 'none' );

		endif;

get_footer();
