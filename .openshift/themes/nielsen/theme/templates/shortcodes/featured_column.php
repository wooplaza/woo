<?php
$subtitle = ( $subtitle == '' ) ? '' : '<h5>' . $subtitle . '</h5>';
$title = ( $title == '' ) ? '' : '<h3>' . $title . '</h3>';
$button_style = ( isset( $button_style)  ) ? $button_style : 'ghost';
$class =  ( $last == 'yes' ) ? 'last' : '';
$class .=  ( $first == 'yes' ) ? ' first' : '';
$bg =  ( $background_image == '' ) ? '' : 'style="background-image: url(' . $background_image . ')"';

$animate = ( $animate != '' ) ? ' yit_animate '.$animate : '';
$delay = ( $animation_delay  != '' ) ? 'data-delay="'. esc_attr( $animation_delay ) .'"' : '';
?>

<div class="featured-column <?php echo esc_attr( $class . $animate ) ?>" <?php echo $bg . $delay ?>>
    <?php echo $subtitle ?>
    <?php echo $title ?>
    <p><?php echo do_shortcode( $content ) ?></p>
    <?php if ( $show_button == 'yes' ): ?>
        <a class="btn btn-<?php echo esc_attr( $button_style ) ?>" href="<?php echo esc_url( $url_button ) ?>"><?php echo $label_button ?></a>
    <?php endif ?>
</div>
