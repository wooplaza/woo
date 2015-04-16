<?php
/**
 * The sidebar containing the top widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 */
?>

<?php if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/front-page-no-column.php' ) ) : ?>

	<?php if ( is_active_sidebar( 'sidebar-10' ) ) : ?>
		
		<div id="sidebar-1" class="sidebar-top-full hidden">
		<div class="sidebar-toggle"></div>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-10' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-top-full -->
	
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'sidebar-22' ) ) : ?>
	
		<div id="sidebar-2" class="sidebar-top">
			<div class="sidebar-toggle"></div>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-22' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-top -->
	
	<?php endif; ?>
	
<?php else: ?>

	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
	
		<div id="sidebar-3" class="sidebar-top-full hidden">
			<div class="sidebar-toggle"></div>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-top-full -->
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'sidebar-2' )  ) : ?>
	
		<div id="sidebar-4" class="sidebar-top">
			<div class="sidebar-toggle"></div>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-top -->
	<?php endif; ?>
	
<?php endif; ?>