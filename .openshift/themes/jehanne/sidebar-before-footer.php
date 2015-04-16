<?php
/**
 * The sidebar containing the before footer widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
?>

<?php if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/front-page-no-column.php' ) ) : ?>

	<?php if ( is_active_sidebar( 'sidebar-20' ) ) : ?>
		<div class="home sidebar-content-before-footer sidebar-footer-full">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-20' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-top -->
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'sidebar-23' ) ) : ?>

		<div class="sidebar-before-footer">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-23' ); ?>
			</div><!-- .widget-area -->
		</div><!-- ..sidebar-before-footer -->
		
	<?php endif; ?>
	
<?php endif; ?>