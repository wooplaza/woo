<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for shows a box with an incipit and a number phone
 *
 * @package Yithemes
 * @author  Francesco Grasso <francesco.grasso@yithemes.com>
 * @since   1.0.0
 */

$style_title = "style='color:{$title_color}; font-size:{$title_font_size}px'";
$style_subtitle = "style='color:{$subtitle_color}; font-size:{$subtitle_font_size}px'";
$style_btn_size = "style='font-size:{$label_size}px'";
$style_background_color = "style='background-color:{$background_color}'";
if(is_rtl())  $style_arrow_color = "style='border-right-color: {$background_color}'";
else $style_arrow_color = "style='border-left-color: {$background_color}'";


$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
$delay = ( $animation_delay != '' ) ? 'data-delay="' . esc_attr( $animation_delay ) . '"' : '';
?>

<div class="group <?php echo esc_attr( $class ) . $animate; ?>" <?php echo $delay ?>>
    <div class="call-to-action-two-container" <?php echo $style_background_color; ?>>
        <div class="incipit" >
                <span class="call-two-title" <?php echo $style_title; ?>><?php echo $title_text ?></span>
                <span class="call-two-subtitle" <?php echo $style_subtitle; ?>><?php echo $subtitle_text ?></span>
        </div>
        <div class="call-btn btn-flat-red">
        	<div class="call-btn-arrow" <?php echo $style_arrow_color; ?>></div>
            <?php echo do_shortcode( '[special_font size="'.$label_size.'" unit ="px"]<a href="' . esc_url( $href ) . '" class="btn-alternative" >' . $label_button . '</a>[/special_font]' ); ?>
        </div>
    </div>
</div>