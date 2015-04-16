<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne
 */

get_header(); ?>

<div class="content-container">

	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Not Found', 'jehanne' ); ?></h1>
	</header>
	
	<div class="entry-content">

		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'jehanne' ); ?></p>

		<?php get_search_form(); ?>
	</div><!-- .entry-content -->

</div><!-- .content-container -->

<?php
get_footer();