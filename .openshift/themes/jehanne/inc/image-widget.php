<?php
/**
 * Add a widget
 */
 
class jehanne_Image extends WP_Widget {

	function jehanne_Image() {

		/* Widget settings. */
		$widget_ops = array(
		'classname' => 'jehanne_image',
		'description' => __('Display Custom Images with CSS3 hover effects.', 'jehanne' ));

		/* Widget control settings. */
		$control_ops = array(
		'width' => 250,
		'height' => 250,
		'id_base' => 'jehanne_image_widget');

		/* Create the widget. */
		$this->WP_Widget('jehanne_image_widget', __( 'Jehanne: Images', 'jehanne' ), $widget_ops, $control_ops );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}
	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_media();

		wp_enqueue_script( 'jehanne-upload-image', get_template_directory_uri() . '/js/meta-box-image.js', array('jquery') );

	}

	function widget( $args, $instance ) {

		// Widget output
		extract($args);
		$sidebar_id = ( isset($args['id']) ? $args['id'] : '' );
		
		// Set up some default widget settings. 
						
		$instance = wp_parse_args( (array) $instance, $this->defaults( $instance ) );
		$instance = wp_parse_args( (array) $instance, $this->defaults_for_count($instance, $instance['count']) ); 
		
		preg_match_all('!\d+!', $instance['columns'], $matches);
		$width = $this->get_width($sidebar_id, absint(implode(' ', $matches[0])), $instance['padding_right'], $instance['padding_left']);
		$post_thumbnail_size = $this->get_image_width( $width );
		
		$pos_class = '';
		if( $instance['is_has_description'] != 0 ) {
			$pos_class = (($instance['is_right']) == 1 ? ' right' : ' left');
		}
		
		$out = '<div class="main-wrapper'.$pos_class.'" style="padding:'. esc_attr($instance['padding_top']).'px '.
														    esc_attr($instance['padding_right']).'% '.
														    esc_attr($instance['padding_bottom']).'px '.
														    esc_attr($instance['padding_left']).'%'.';">';
							if( $instance['is_has_description'] != 0) {
								$out.= '<div class="description">
											<h3>'.esc_html($instance['main_title']).'</h3>
											<p>'.esc_html($instance['main_description']).'</p>
										</div>';
							}
							$out.='<div class="wrapper '.esc_attr($instance['columns']).
								( $instance['is_step'] ? ' step' : ' all' ).
								( $instance['is_hover_all'] ? ' hover-all' : '' ).
								( $instance['is_margin_0'] ? ' margin-0' : '' ).
								'">';
			
		for( $i = 0; $i < $instance['count']; $i++) {
			
			$out.='<div class="element '.esc_attr($instance['effect_id_'.$i]).
								( $instance['is_animate_once_'.$i] ? ' once' : '' ).
								( $instance['is_animate_'.$i] ? ' animate' : '' ).
								( $instance['is_zoom_'.$i] ? ' zoom' : '' ).
								'">'. ( isset($instance['image_link_'.$i]) ?	
							'<img src="'.esc_url($instance['image_link_'.$i]).'" alt="'.esc_attr($instance['title_'.$i]).'"/>' : 
							wp_get_attachment_image($instance['image_'.$i], $post_thumbnail_size) ).
							'<div class="hover"> '.($instance['effect_id_'.$i]=='effect-4' ? '</div>
							<div class="text">' : '' ).'
								<h2>'.esc_html($instance['title_'.$i]).'</h2>
								<p>'.esc_html($instance['text_'.$i]).'</p>'.
								($instance['is_link_'.$i] != '' ?
								'<a href="'.esc_url($instance['link_'.$i]).'" class="link">'.esc_html($instance['link_caption_'.$i]).'</a>' : '').
							'</div>
					</div>';
		}
		
		$out.='<div class="clear"></div>
			</div>
		</div>';
		//print the widget for the sidebar
		echo $before_widget;
		if(trim($instance['title']) !== '') echo $before_title.esc_html($instance['title']).$after_title;
		echo $out;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		
		$new_instance[$count] = absint($new_instance[$count]);
		$new_instance[$count] = ($new_instance[$count] > 0 ? $new_instance[$count] : 1);
		
		$new_instance['title'] = esc_html($new_instance['title']); 
		$possible_values = array('column-1', 'column-2', 'column-3', 'column-4');	
		$new_instance['columns'] = ( in_array( $new_instance['columns'], $possible_values ) ? $new_instance['columns'] : 'column-1');
		
		if( isset($new_instance['is_step']) )
			$new_instance['is_step'] = 1;
		if( isset($new_instance['is_hover_all']))
			$new_instance['is_hover_all'] = 1;		
		if( isset($new_instance['is_has_description']))
			$new_instance['is_has_description'] = 1;		
		if( isset($new_instance['is_right']))
			$new_instance['is_right'] = 1;	
	
		$new_instance['main_title'] = esc_html($new_instance['main_title']); 
		$new_instance['main_description'] = esc_html($new_instance['main_description']); 

		$new_instance['padding_right'] = absint($new_instance['padding_right']);
		$new_instance['padding_right'] = ($new_instance['padding_right'] < 50 ? $new_instance['padding_right'] : 0);
		
		$new_instance['padding_right'] = absint($new_instance['padding_left']);
		$new_instance['padding_right'] = ($new_instance['padding_left'] < 50 ? $new_instance['padding_left'] : 0);

		$new_instance['padding_top'] = absint($new_instance['padding_top']);
		$new_instance['padding_bottom'] = absint($new_instance['padding_bottom']);
		
		for( $i = 0; $i < $new_instance[$count]; $i++ ) {
			$new_instance['title_'.$i] = esc_html($new_instance['title_'.$i]); 
			$new_instance['text_'.$i] = esc_html($new_instance['text_'.$i]); 
			$new_instance['link_'.$i] = esc_url_raw($new_instance['link_'.$i]);
			$new_instance['image_'.$i] = absint($new_instance['image_'.$i]);
			$new_instance['image_link_'.$i] = esc_url_raw($new_instance['image_link_'.$i]);
			$possible_values = array('effect-1', 'effect-2', 'effect-3', 'effect-4', 'effect-5', 'effect-6', 'effect-7', 'effect-8', 'effect-9', 'effect-10');	
			$new_instance['effect_id_'.$i] = ( in_array( $new_instance['effect_id_'.$i], $possible_values ) ? $new_instance['effect_id_'.$i] : 'effect-1');
			if( isset($new_instance['is_animate_'.$i]) )
				$new_instance['is_animate_'.$i] = 1;
			if( isset($new_instance['is_animate_once_'.$i]) )
				$new_instance['is_animate_once'.$i] = 1;
			if( isset($new_instance['is_zoom_'.$i]) )
				$new_instance['is_zoom_'.$i] = 1;
			if( isset($new_instance['is_link_'.$i]) )
				$new_instance['is_link_'.$i] = 1;
			$new_instance['link_caption_'.$i] = esc_html($new_instance['link_caption_'.$i]); 
		}
		
		return $new_instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		// Set up some default widget settings. 
						
		$instance = wp_parse_args( (array) $instance, $this->defaults( $instance ) ); 
		$instance = wp_parse_args( (array) $instance, $this->defaults_for_count($instance, $instance['count']) ); 
		
		$this->echo_input_text('title', $instance, __( 'Title: ', 'jehanne' ), 0);
		
		esc_html_e('Columns:', 'jehanne'); ?>
		<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" style="width:100%;">
		<?php 
			$styles=array( __('1', 'jehanne'), __('2', 'jehanne'), __('3', 'jehanne'), __('4', 'jehanne'));
			$styles_ids=array('column-1', 'column-2', 'column-3', 'column-4');

			for ($i=0; $i<4; $i++) {
				echo '<option value="'.esc_attr($styles_ids[$i]).'" ';
				selected( $instance['columns'], $styles_ids[$i] );
				echo '>'.esc_html($styles[$i]).'</option>';
			}
		?>
		</select>
		<?php 
		
		$this->echo_input_checkbox('is_step', $instance, __( 'Step Animation', 'jehanne'));
		$this->echo_input_checkbox('is_hover_all', $instance, __( 'Play Hover for all Elements at once', 'jehanne'));
		$this->echo_input_checkbox('is_margin_0', $instance, __( 'No Margins', 'jehanne'));
		$this->echo_input_checkbox('is_has_description', $instance, __( 'Display description block', 'jehanne'));
		
		if( $instance['is_has_description'] != 0 ) {
			$this->echo_input_checkbox('is_right', $instance, __( 'Right', 'jehanne'));
			$this->echo_input_text('main_title', $instance, __( 'Main Title: ', 'jehanne' ));
			$this->echo_input_text('main_description', $instance, __( 'Main Description: ', 'jehanne' ));
		}
		
		$this->echo_input_text('padding_right', $instance, __( 'Padding right(%): ', 'jehanne' ));
		$this->echo_input_text('padding_left', $instance, __( 'Padding left(%): ', 'jehanne' ));
		$this->echo_input_text('padding_top', $instance, __( 'Padding top(px): ', 'jehanne' ));
		$this->echo_input_text('padding_bottom', $instance, __( 'Padding bottom(px): ', 'jehanne' ));

		for( $i = 0; $i < $instance['count']; $i++) {
			?> 
			<hr>
			<hr>
			<p style="font-size: 30px; color: red; "> 
				<?php 
					esc_html_e('Image ', 'jehanne'); 
					echo ($i + 1); 
				?>
			</p>
			<hr>
			<hr>

			<?php 
			$this->echo_input_upload_id('image_'.$i, $instance, __( 'Image: ', 'jehanne' ));
			$this->echo_input_text('title_'.$i, $instance, __( 'Header: ', 'jehanne' ));
			$this->echo_input_text('text_'.$i, $instance, __( 'Text: ', 'jehanne' ));
			$this->echo_input_text('link_'.$i, $instance, __( 'Link: ', 'jehanne' ));
			$this->echo_input_hover_style('effect_id_'.$i, $instance);
			$this->echo_input_checkbox('is_animate_'.$i, $instance, __( 'Animate', 'jehanne'));
			$this->echo_input_checkbox('is_animate_once_'.$i, $instance, __( 'Once', 'jehanne'));
			$this->echo_input_checkbox('is_zoom_'.$i, $instance, __( 'Zoom In', 'jehanne'));
			$this->echo_input_checkbox('is_link_'.$i, $instance, __( 'Display Link', 'jehanne'));
			$this->echo_input_text('link_caption_'.$i, $instance, __( 'Button caption: ', 'jehanne' ), 0);
		}
		
		$this->echo_input_text('count', $instance, __( 'Count: ', 'jehanne' ), 0);
		
	}
	function echo_input_checkbox($name, $instance, $title) { ?>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name( $name ); ?>" id="<?php echo $this->get_field_id( $name ); ?>"  value="1" <?php checked( $instance[$name], '1'); ?> />
			<label for="<?php echo $this->get_field_id( $name ); ?>"><?php echo esc_html($title); ?></label>
		</p>
		<?php
	}
	function echo_input_hover_style($name, $instance) {
		esc_html_e('Hover Effect Style:', 'jehanne'); ?>
		<select id="<?php echo $this->get_field_id($name); ?>" name="<?php echo $this->get_field_name($name); ?>" style="width:100%;">
		<?php 
			$styles=array( __('Effect 1', 'jehanne'), __('Effect 2', 'jehanne'), __('Effect 3', 'jehanne'), 
			__('Effect 4', 'jehanne'), __('Effect 5', 'jehanne'), __('Effect 6', 'jehanne'), 
			__('Effect 7', 'jehanne'), __('Effect 8', 'jehanne'), __('Effect 9', 'jehanne'), __('Effect 10', 'jehanne'));
			$styles_ids=array('effect-1', 'effect-2', 'effect-3', 'effect-4', 'effect-5', 'effect-6', 'effect-7', 'effect-8', 'effect-9', 'effect-10');

			for ($i=0; $i<10; $i++) {
				echo '<option value="'.esc_attr($styles_ids[$i]).'" ';
				selected( $instance[$name], $styles_ids[$i] );
				echo '>'.esc_html($styles[$i]).'</option>';
			}
		?>
		</select>
		<?php 
	}
	function echo_input_upload_id($name, $instance, $title) { ?>
			<hr>
			<?php echo wp_get_attachment_image($instance[$name]); ?>
			<br>
			
            <label for="<?php echo $this->get_field_id( $name ); ?>"><?php esc_html_e( 'Url:', 'jehanne' ); ?></label>
            <input name="<?php echo $this->get_field_name( $name ); ?>" id="<?php echo $this->get_field_id( $name ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_attr($instance[$name]); ?>" />		
  		    <input id="<?php echo $this->get_field_id( $name ); ?>_b" class="upload_id_button button button-primary" type="button" value="<?php esc_html_e( 'Upload Image', 'jehanne'); ?>" />
			<hr>
		<?php
	}
	
	function echo_input_upload($name, $instance, $title) { ?>
		<hr>
			<?php if(trim($instance[$name]) != '') : ?>
				<img src="<?php echo esc_url(($instance[$name])); ?>" style="max-width:100%;" alt="<?php esc_attr_e('Upload', 'jehanne'); ?>" />
			<?php endif; ?>
			
			<br>
            <label for="<?php echo $this->get_field_id( $name ); ?>"><?php esc_html_e( 'Url:', 'jehanne' ); ?></label>
            <input name="<?php echo $this->get_field_name( $name ); ?>" id="<?php echo $this->get_field_id( $name ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $instance[$name] ); ?>" />		
  		    <input id="<?php echo $this->get_field_id( $name ); ?>_b" class="upload_image_button button button-primary" type="button" value="<?php esc_html_e( 'Upload Image', 'jehanne'); ?>" />
		<hr>
		<?php
	}
	function echo_input_text($name, $instance, $title) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( $name );?>"><?php echo esc_html(strtoupper($title)); ?></label>
			<br>
			<input size="34" type="text" name="<?php echo $this->get_field_name( $name ) ?>" id="<?php echo $this->get_field_id( $name ); ?>" value="<?php echo esc_html($instance[$name]); ?>" />		
		</p>
		<hr>
		<?php 
	}
	function echo_input_textarea($name, $instance, $title, $rows=10, $cols=30) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( $name ); ?>"><?php echo esc_html($title); ?></label>
			<br>
			<textarea name="<?php echo $this->get_field_name( $name ) ?>" cols="<?php echo $cols;?>" rows="<?php echo $rows;?>" id="<?php echo $this->get_field_id( $name ); ?>"><?php echo esc_textarea($instance[$name]); ?></textarea>		
		</p>
		<?php
	}	
	
	/**
	 * Return array Defaults
	 *
	 * @since jehanne 1.0.1
	 */
	function defaults( $instance ){
	
		$defaults = array('title' => '',
						  'count'   => '1',	
						  'columns'   => 'column-1',	
						  'is_step'   => '',
						  'is_hover_all'   => '',
						  'is_margin_0'   => '',
						  'title_0'   => __('The Title', 'jehanne'),	
						  'image_0'   => '',	
						  'text_0'   => __('The Text', 'jehanne'),	
						  'link_0'   => '',	
						  'effect_id_0'   => 'effect-1',
						  'is_animate_0'   => ($instance == null ? 1 : ''),
						  'is_animate_once_0'   => ($instance == null ? 1 : ''),
						  'is_zoom_0'   => '',
						  'is_link_0'   => ($instance == null ? 1 : ''),
						  'link_caption_0'   => __('Read more...', 'jehanne'),
						  'padding_right'   => '0',
						  'padding_left'   => '0',
						  'padding_top'   => '0',
						  'padding_bottom'   => '0',
						  'is_has_description'   => 0,
						  'main_description'   => 'Description...',
						  'main_title'   => 'Title...',
						  'is_right'   => ($instance == null ? 1 : ''),
						);
		
		return $defaults;
	}
	/**
	 * Return array Defaults
	 *
	 * @param int $count count of fields
	 * @since jehanne 1.0.1
	 */
	function defaults_for_count( $instance, $count ){
	
		$defaults = array();
		for( $i = 1; $i < $count; $i++ ) {
			$defaults['title_'.$i] = __('The Title', 'jehanne'); 
			$defaults['text_'.$i] = __('The Text', 'jehanne'); 
			$defaults['link_'.$i] = ''; 
			$defaults['image_'.$i] = ''; 
			$defaults['effect_id_'.$i] = 'effect-1'; 
			$defaults['is_animate_'.$i] = ( ! isset($instance['effect_id_'.$i]) ? 1 : ''); 
			$defaults['is_animate_once_'.$i] = ( ! isset($instance['effect_id_'.$i]) ? 1 : ''); 
			$defaults['is_zoom_'.$i] = ''; 
			$defaults['is_link_'.$i] = ( ! isset($instance['effect_id_'.$i]) ? 1 : '');
			$defaults['link_caption_'.$i] = __('Read more...', 'jehanne');
		}
		
		return $defaults;
	}
	
	/* widget column width
	 * @param int $sidebar_id sidebar id.
	 * @param int $columns number of $columns.
	 * @param int $i1 widget left margin.
	 * @param int $i2 widget right margin.
	 * @return int width.
	 * @since jehanne 1.0.3
	 */
	function get_width( $sidebar_id, $columns, $i1 = 0, $i2 = 0 ) {	
		if($columns <= 0) $columns = 1;
		$width = jehanne_sidebar_width($sidebar_id);
		$width = ($width - $width*$i1/100 - $width*$i2/100)/$columns;
		return $width;
	}
	/* image size
	 * @param int $width column width.
	 * @return array image size.
	 */
	function get_image_width( $width ) {	
		return array( $width, $width);
	}
	
}
/* Register widget */
function jehanne_register_image_widgets() {
	register_widget( 'jehanne_image' );
}
add_action( 'widgets_init', 'jehanne_register_image_widgets' );
