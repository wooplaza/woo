<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
?>
<div class="content-container">

	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'jehanne' ); ?></h1>
	</header>

		<div class="entry-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jehanne' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jehanne' ); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jehanne' ); ?></p>
		<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .entry-content -->
</div><!-- .content-container -->