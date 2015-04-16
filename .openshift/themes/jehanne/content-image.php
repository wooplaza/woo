<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
?>
<div class="content-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
		
			<div class="post-format image">
				<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><?php echo get_post_format_string( 'image' ); ?></a>
			</div>
			
			<?php  do_action('jehanne_image_and_cats_small');  ?>

			<?php 
			if ( is_single() ) : 
			
				the_title( '<h1 class="entry-title">', '</h1>' );		
				
			else : 
			
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );

			endif; ?>
			
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content( __('<div class="meta-nav">Read more... &rarr;</div>', 'jehanne') ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'jehanne'), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<div class="clear"></div>
		<footer class="entry-meta">
			<span class="post-date">
				<?php jehanne_posted_on(); ?>
			</span>
			<?php edit_post_link( __( 'Edit', 'jehanne' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
</div><!-- .content-container -->
