<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Extends classic WP_Nav_Menu_Edit
 *
 * @since 1.0.0
 */

class YIT_Walker_Nav_Menu_Div extends YIT_Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n<div class=\"submenu clearfix\">\n";
        $output .= "\n$indent<ul class=\"sub-menu clearfix\">\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() )
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n".($depth ? "$indent\n" : "");
        $output .= "\n</div>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {

        $item_output = '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $this->_load_custom_fields( $item );

        $class_names = $value = '';
        $children_number = isset($args->children_number) ? $args->children_number : '0';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names .= ' menu-item-children-' . $children_number;
        if($depth == 1 && $this->_is_custom_item( $item ) ) {
            $class_names .= ' menu-item-custom-content';
        }
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $prepend = '';
        $append = '';
        $icon = $image = $tooltip = '';
        if( ! empty( $item->description ) ){
            $description = $item->description;

            if( preg_match('/\[icon ([a-zA-Z0-9-:]+)\]/', $description, $matches) ){
               $icon = do_shortcode('[icon icon_theme="'.$matches[1].'" icon_type="theme-icon" circle="no" icon_size="19" color="" ]');
            }

	        if( preg_match('/\[background ([a-zA-Z0-9\-\_\/\:\.\s\%]*\.(jpg|jpeg|png|gif))\]/', $description, $matches) ){
		        $image_id = yit_get_attachment_id( $matches[1] );
		        list( $matches[1], $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, "full" );
		        $image = "<a class='custom-item-{$item->ID} custom-item-yitimage custom-item-image' href='". esc_attr( $item->url ) ."'><img src='". $matches[1] ."' alt='". apply_filters( 'the_title', $item->title, $item->ID ) ."' width='". $thumbnail_width ."' height='". $thumbnail_height ."' /></a>";
	        }

	        if( preg_match('/\[tooltip (["]?[\w^"]*)(\s[#]?[0-9a-f]{3,6})?\]/', $description, $matches) ){
				$text  = isset( $matches[1] ) ? trim( $matches[1], '"' ) : null;
		        $color = isset( $matches[2] ) ? trim( $matches[2], ' #' ) : null;

		        if ( ! empty( $text ) ) {
			        $arrow_color = ! empty( $color ) ? ' style="border-top-color: #' . $color . '"' : '';
			        $inner_color = ! empty( $color ) ? ' style="background-color: #' . $color . '"' : '';
			        $tooltip_class  = 'tooltip top';
			        $tooltip_class .= str_word_count( $text ) == 1 ? ' tooltip-' . strtolower( $text ) : '';
			        $tooltip_class  = ' class="' . $tooltip_class . '"';
			        $tooltip = sprintf( '<span%s><span class="tooltip-arrow"%s></span><span class="tooltip-inner"%s>%s</span></span>', $tooltip_class, $arrow_color, $inner_color, $text );
		        }
	        }

        }
        $item_output = is_object( $args ) ? $args->before : '';

        if($depth == 1 && $this->_is_custom_item( $item ) ) {
            $item_output .= '<a'. $attributes .'>'.$icon;
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $this->_parse_string($item->title), $item->ID ).$append;
            $item_output .= $args->link_after;
            $item_output .= '</a>';

        } else {
            $link_before  =  is_object( $args ) ? $args->link_before : '';
            $item_output .= '<a'. $attributes .'>'.$icon;
            $item_output .= $link_before .$prepend.apply_filters( 'the_title', $this->_parse_string($item->title), $item->ID ).$append;
            $item_output .= is_object( $args ) ? $args->link_after : '';
            $item_output .= '</a>';
        }

	    $item_output .= $tooltip . $image;
        $item_output .= is_object( $args ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}
