<?php
/*
* Index Page 
* eSell Theme
* 
*/

if ( 'posts' == get_option( 'show_on_front' ) && of_get_option('esell_frontpage' ) =='0' ) {
     get_template_part('index');
}elseif ( 'page' == get_option( 'show_on_front' ) && of_get_option('esell_frontpage' ) =='0' ) {
    $template = get_post_meta( get_option( 'page_on_front' ), '_wp_page_template', true );
	$template = ( $template == 'default' ) ? 'index.php' : $template;
	locate_template( $template, true );
}else {
	get_template_part('featured-home');
    // Custom content markup goes here
}
	

?>