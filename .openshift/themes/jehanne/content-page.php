<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
?>
<div class="content-container">

	<?php if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/front-page-no-column.php' ) ) : ?>
		<?php get_sidebar('home-top-content'); ?>
	<?php endif; ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="image-and-cats">
					<?php the_post_thumbnail(); ?>
				</div><!-- .image-and-cats -->
			<?php endif; ?> 
			<?php the_title( '<h1 class="entry-title">', '</h1>' );	?>
										
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'jehanne' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
			<footer class="entry-meta">
				<?php edit_post_link( __( 'Edit', 'jehanne' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
</div><!-- .content-container -->