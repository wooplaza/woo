<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
 
 	if ( is_page_template( 'page-templates/front-page-no-column.php' ) || is_page_template( 'page-templates/no-column.php' ) )
		return;
?>

<?php if ( is_page_template( 'page-templates/front-page.php' ) ) : ?>
	
	<?php if ( is_active_sidebar( 'sidebar-12' ) ) : ?>

		<div id="sidebar-5" class="column">
			<div class="sidebar-toggle"></div>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-12' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .column -->
	
	<?php endif; ?>
	
<?php elseif ( is_page() ) : ?>

	<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
	
		<div id="sidebar-6" class="column">
			<div class="sidebar-toggle"></div>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-6' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .column -->
		
	<?php endif; ?>

<?php else: ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	
		<div id="sidebar-7" class="column">		
			<div class="sidebar-toggle"></div>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .column -->
		
	<?php endif; ?>
	
<?php endif; ?>
