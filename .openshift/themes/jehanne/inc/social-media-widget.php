<?php
/**
 * Add a widget
 */
class jehanne_SocialIcons extends WP_Widget {

	function jehanne_SocialIcons() {

		/* Widget settings. */
		$widget_ops = array(
		'classname' => 'jehanne_socialicons',
		'description' => __('Display Social Media Links.', 'jehanne' ));

		/* Widget control settings. */
		$control_ops = array(
		'width' => 250,
		'height' => 250,
		'id_base' => 'jehanne_socialicons_widget');

		/* Create the widget. */
		$this->WP_Widget('jehanne_socialicons_widget', __( 'Jehanne: Social Media Icons', 'jehanne' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		if( ! array_key_exists( 'title', $instance ) )
			return;
		// Widget output
		extract($args);
		
		$classes = '';

		if( array_key_exists('is_vertical', $instance) )
			$classes = 'vertical';
		else
			$classes = 'horizontal';
			
		if( array_key_exists('is_small', $instance) )
			$classes .= ' small';
		else
			$classes .= ' big';
		
		$out = '<ul class="'.$classes.'">';
		foreach($instance as $id => $icon) {
			if(trim($icon) != '' && $id != 'is_vertical' & $id != 'is_small' & $id != 'title') {
				$out .= '<li><a style="background: url('.get_template_directory_uri().'/img/icons/'.(array_key_exists('is_small', $instance) ? 'small/' : '' ).$id.'.png)" href="'.esc_url($icon).'" target="_blank" title="'.esc_attr($id).'"></a></li>';
			}
		}
		
		$out .= '</ul>';	

		//print the widget for the sidebar
		echo $before_widget;
		if(trim($instance['title']) !== '') echo $before_title.esc_html($instance['title']).$after_title;
		echo $out;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		foreach ( $new_instance as $key => $instance ) {
			if( $key == 'title' || $key == 'is_small' || $key == 'is_vertical' )
				$new_instance[$key] = esc_html($new_instance[$key]);
			else
				$new_instance[$key] = esc_url_raw($new_instance[$key]);
		}
		return $new_instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		// Set up some default widget settings. 
		$defaults = array('title' => '',
						  'is_small'   => '',	
						  'is_vertical'   => '',	
						);
						
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$icons = $this->social_icons();
		
		$instance = wp_parse_args( (array) $instance, $icons ); 
		
		$this->echo_input_text('title', $instance, __( 'Title: ', 'jehanne' ), 0);
		
		$this->echo_input_checkbox('is_small', $instance, __( 'Small Icons.', 'jehanne'));
		$this->echo_input_checkbox('is_vertical', $instance, __( 'Vertical Icons.', 'jehanne'));

		
		foreach ($icons as $id => $icon) {
			$this->echo_input_text($id, $instance, $id);
		}
	}
	function echo_input_text($name, $instance, $title, $show_mage = 1) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( $name );?>"><?php echo esc_html(strtoupper($title)); ?></label>
			<br>
			<?php if ( $show_mage ) : ?>
				<img alt="<?php echo esc_html(strtoupper($title)); ?>" src="<?php echo get_template_directory_uri().'/img/icons/'.$name.'.png'; ?>">
			<?php endif; ?>	
			<input size="34" type="text" name="<?php echo $this->get_field_name( $name ) ?>" id="<?php echo $this->get_field_id( $name ); ?>" value="<?php echo esc_html($instance[$name]); ?>" />		
		</p>
		<hr>
		<?php 
	}
	function echo_input_checkbox($name, $instance, $title) { ?>
			<p>
				<input type="checkbox" name="<?php echo $this->get_field_name( $name ); ?>" id="<?php echo $this->get_field_id( $name ); ?>"  value="1" <?php checked( $instance[$name], '1'); ?> />
				<label for="<?php echo $this->get_field_id( $name ); ?>"><?php echo esc_html($title); ?></label>
			</p>
			<hr>
		<?php
	}
	
	/**
	 * Return array Social Icon's List
	 *
	 * @since jehanne 1.0
	 */
	function social_icons(){
		global $jehanne_options;

		$icons = jehanne_social_icons();
					  
		foreach ($icons as $id => $icon) {
			$icons[$id] = $jehanne_options[$id];
		}
		return $icons;
	}
}
/* Register widget */
function jehanne_register_social_widgets() {
	register_widget( 'jehanne_SocialIcons' );
}
add_action( 'widgets_init', 'jehanne_register_social_widgets' );
