<?php
/**
 * The sidebar containing the content widget area for posts
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>

	<div class="sidebar-content">
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-5' ); ?>
		</div><!-- .widget-area -->
	</div><!-- .sidebar-content -->
	
<?php endif; ?>
	
