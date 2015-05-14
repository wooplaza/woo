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
* Template file for print border line
*
* @package Yithemes
* @author Francesco Licandro <francesco.licandro@yithemes.com>
* @author Emanuela Castorina <emanuela.castorina@yithemes.com>
* @since 1.0.0
*/
$width   = ( $width != '' ) ? 'style="width:' . esc_attr( $width ) . 'px;"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
$delay   = ( $animation_delay != '' ) ? 'data-delay="' . esc_attr( $animation_delay ) . '"' : '';
?>
<div class="border-line <?php echo esc_attr( $animate )?>" <?php echo $delay." ".$width ?> ></div>