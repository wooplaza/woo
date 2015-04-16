<?php
/**
 * The sidebar containing the footer widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 */
?>

<?php if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/front-page-no-column.php' ) ) : ?>
	
	<?php if ( is_active_sidebar( 'sidebar-14' ) ) : ?>

		<div class="sidebar-footer">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-14' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-footer -->
		
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-15' ) ) : ?>

		<div class="sidebar-footer-full">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-15' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-footer-full -->
	
	<?php endif; ?>
	
<?php else: ?>
	<?php if ( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-7') ) : ?>

		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		
			<div class="sidebar-footer">
				<div class="widget-area">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div><!-- .widget-area -->
			</div><!-- .sidebar-footer -->
			
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
		
			<div class="sidebar-footer-full">
				<div class="widget-area">
					<?php dynamic_sidebar( 'sidebar-7' ); ?>
				</div><!-- .widget-area -->
			</div><!-- .sidebar-footer-full -->
			
		<?php endif; ?>
	<?php else: ?>
	
		<div class="sidebar-footer-full">
			<div class="widget-area">
				<?php 
					global $jehanne_options;
					
					if( $jehanne_options['is_show_widgets'] == '1' ) {// display demo widgets


						the_widget('jehanne_image', 'is_link_0=1&link_0=#&image_link_0='.esc_url(get_template_directory_uri() . '/img/beauty.jpg').'&effect_id_0=effect-2&is_animate_0=1&title_0='.
											get_bloginfo( 'name' ).'&text_0='.get_bloginfo( 'description' ).'&link_caption_0='.__('Download', 'jehanne'));
						$text = '<p style="border-bottom: 1px dashed #fff; display: block; margin-bottom:0; text-align:center; font-size: 74px;background-color: #000; "><a style="color:#ccc;" href="'.esc_url( home_url( '/' ) ).'">'.get_bloginfo( 'name' ).'</a></p>';
						the_widget( 'WP_Widget_Text', 'title=&text='.$text, 'before_widget=<div class="widget-wrap"><aside class="widget">&after_widget=</aside></div>&before_title=<h3 class="widget-title">&after_title=</h3>');
						$text = '<p style=" display: block; margin-bottom:0; background-color:#000; text-align:center; color:#1e73be;padding-bottom:5px;">'.get_bloginfo( 'description' ).'</p>';
						the_widget( 'WP_Widget_Text', 'title=&text='.$text, 'before_widget=<div class="widget-wrap"><aside class="widget">&after_widget=</aside></div>&before_title=<h3 class="widget-title">&after_title=</h3>');
						the_widget('jehanne_image', 'count=3&columns=column-3&is_step=1&is_animate_0=1&is_animate_1=1&is_animate_2=1'.
												   '&padding_right=15&padding_left=15&padding_top=50&padding_bottom=50'.
												   '&effect_id_0=effect-10&effect_id_1=effect-10&effect_id_2=effect-10'.
												   '&is_animate_once_0=1&is_animate_once_1=1'.
												   '&link_caption_1='.__('Call', 'jehanne').'&is_link_1=1&link_1=#'.
												   '&title_0='.__('About', 'jehanne').'&text_0='.__('This is a Sample Demo Jehanne Image Widget. You can replace Demo Widgets in Second Footer Sidebar by your own widgets at Appearance >> Widgets. Drag and Drop Jehanne Image Widget into Second Footer Sidebar and customize it by using your own Image, Text, Description, Link, margins and hover effect for it.', 'jehanne').
												   '&title_1='.__('Demo Phone', 'jehanne').'&text_1=+7-123-456-789'.
												   '&title_2='.__('Question', 'jehanne').'&text_2='.__('You can switch off Footer Demo Widgets at Appearance >> Customize >> Demo Widgets. Jehanne comes with two footers: 1/3 and full width footer without margins and paddings. You can insert any custom html with inline css styles into it via standard Text Widget. Example: <div style="color: white;background: black;text-align:center;">TEXT</div>', 'jehanne').
												   '&image_link_0="'.esc_url(get_template_directory_uri() . '/img/ok.png').'"'.
												   '&image_link_1="'.esc_url(get_template_directory_uri() . '/img/phone.png').'"'.
												   '&image_link_2="'.esc_url(get_template_directory_uri() . '/img/question.png').'"');
												   
						$text = '<p style="border-bottom: 1px dashed #fff; display: block; margin-bottom:0; text-align:center; font-size: 74px;background-color: #333; "><a style="color:#ccc;" href="'.esc_url( home_url( '/' ) ).'">'.get_bloginfo( 'name' ).'</a></p>';
						the_widget( 'WP_Widget_Text', 'title=&text='.$text, 'before_widget=<div class="widget-wrap"><aside class="widget">&after_widget=</aside></div>&before_title=<h3 class="widget-title">&after_title=</h3>');
						$text = '<p style=" display: block; margin-bottom:0; background-color:#333; text-align:center; color:#1e73be;padding-bottom:5px;">'.get_bloginfo( 'description' ).'</p>';
						the_widget( 'WP_Widget_Text', 'title=&text='.$text, 'before_widget=<div class="widget-wrap"><aside class="widget">&after_widget=</aside></div>&before_title=<h3 class="widget-title">&after_title=</h3>');
						
						the_widget('jehanne_image', 'main_title='.__('This widget is Customizable', 'jehanne').'&is_has_description=1&main_description='.__('You can find more free Images at pixabay.com (http://pixabay.com/en/call-calling-cell-cellphone-15836/). This is a responsive theme for all devices. It has custom colors, 4 nav menus and other options. For example, this widget has 10 different css3 hover effects. You can find number of demo sites for this theme: WooCommerce Shop: http://wpblogs.ru/themes/jehanne/, sidebars structure and demo for options: http://wpblogs.ru/themes/jehanne-structure/. home page: http://wpblogs.ru/themes/blog/theme/jehanne/.', 'jehanne').'&image_link_0='.esc_url(get_template_directory_uri() . '/img/jehanne_call.jpg').'&padding_right=2&padding_left=2&effect_id_0=effect-2&is_animate_0=1&title_0='.
											get_bloginfo( 'name' ).'&text_0='.get_bloginfo( 'description' ).'&link_caption_0='.__('Download', 'jehanne'));

					}

				?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-footer-full -->
		
	<?php endif; ?>
	
<?php endif; ?>