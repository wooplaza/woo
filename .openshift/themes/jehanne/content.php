<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
?>
<div class="content-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<?php if ( ( is_search() && has_post_thumbnail()) || ! is_search() ) : ?>

			
				<?php  do_action('jehanne_image_and_cats_small');  ?>

				
			<?php endif; 
			
			if ( is_single() ) :

				the_title( '<h1 class="entry-title">', '</h1>' );		
				
			else : 
			
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
	
			endif; ?>

			
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __('<div class="meta-nav">Read more... &rarr;</div>', 'jehanne' )); ?>
			<?php  do_action('jehanne_after_content');  ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'jehanne'), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		<div class="clear-right"></div>
		<footer class="entry-meta">
			<span class="post-date">
				<?php jehanne_posted_on(); ?>
			</span>
			<?php edit_post_link( __( 'Edit', 'jehanne' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		<?php if ( is_single() ) :
				get_sidebar('content');
			  endif; 
		?>
		
	</article><!-- #post -->
</div><!-- .content-container -->