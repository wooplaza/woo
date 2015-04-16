<?php
/**
 * The sidebar containing the top widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 */
?>

<?php if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/front-page-no-column.php' ) ) : ?>

	<?php if ( is_active_sidebar( 'sidebar-40' ) ) : ?>
		
		<div id="sidebar-40" class="sidebar-top-full sidebar-before-content">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-40' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-top-full -->
	
	<?php endif; ?>
	
<?php endif; ?>