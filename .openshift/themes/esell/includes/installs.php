<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function esell_notice() {
	if ( isset( $_GET['activated'] ) ) {
		$return = '<div class="updated activation"><p><strong>';
					$my_theme = wp_get_theme();
		if ( isset( $_GET['previewed'] ) ) {
			$return .= sprintf( __( 'Settings saved and %s activated successfully.', 'esell' ), $my_theme->get( 'Name' ) );
		} else {
			$return .= sprintf( __( '%s activated successfully.', 'esell' ), $my_theme->get( 'Name' ) );
		}
		$return .= '</strong> <a href="' . home_url( '/' ) . '">' . __( 'Visit site', 'esell' ) . '</a></p>';
		$return .= '<p>';
		$return .= ' We have added separate Front Page Option in Home Page please enable it from <a class="button button-primary theme-options" href="' . admin_url( 'themes.php?page=options-framework' ) . '">' . __( 'Theme Options', 'esell' ) . '</a>';
		$return .= ' Any question or suggestion <a class="button button-primary help" href="http://forum.insertcart.com">' . __( 'Help Forum', 'esell' ) . '</a>';
		$return .= '</p></div>';
		echo $return;
	}
}
add_action( 'admin_notices', 'esell_notice' );

/*
 * Hide core theme activation message.
 */
function esell_admincss() { ?>
	<style>
	.themes-php #message2 {
		display: none;
	}
	.themes-php div.activation a {
		text-decoration: none;
	}
	</style>
<?php }
add_action( 'admin_head', 'esell_admincss' );
