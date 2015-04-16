<?php
/**
 * woodizain child functions and definitions
 *
 * @package woodizain child
 */
 
if ( ! function_exists( 'woodizain_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
 
function woodizain_setup() {
    
	/*
	 * Make WooDizain available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Ridizain, use a find and
	 * replace to change 'woodizain' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'woodizain', get_template_directory() . '/languages' );
	
	/*
	 * Enable support for WooCemmerce.
	*/
	add_theme_support( 'woocommerce' );
	
	// Declare WooCommerce Thumbnails sizes.
	add_image_size( 'shop_catalog_image_size', 472, 300, true );
	add_image_size( 'shop_single_image_size', 672, 472, true );
	add_image_size( 'shop_thumbnail_image_size', 372, 186, true );
	
	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'ridizain_child_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );
	
}
endif; // woodizain_setup
add_action( 'after_setup_theme', 'woodizain_setup' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (class_exists('woocommerce')) {
add_filter('add_to_cart_fragments', 'woodizain_header_add_to_cart_fragment');

function woodizain_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woodizain'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woodizain'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
}

}

function woodizain_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'woodizain_woo_options' , array(
       'title'      => __('WooDizain Commerce Options','woodizain'),
	   'description' => sprintf( __( 'Set the desired options for your WooCommerce Shop', 'woodizain' )),
       'priority'   => 35,
    ) );
	
	$wp_customize->add_setting(
        'woodizain_fullwidth_woo_shop', array (
			'sanitize_callback' => 'woodizain_sanitize_checkbox',
		)
    );

    $wp_customize->add_control(
        'woodizain_fullwidth_woo_shop',
    array(
        'type'     => 'checkbox',
        'label'    => __('Set Shop to full width', 'woodizain'),
        'section'  => 'woodizain_woo_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
        'woodizain_fullwidth_woo_product', array (
			'sanitize_callback' => 'woodizain_sanitize_checkbox',
		)
    );

    $wp_customize->add_control(
        'woodizain_fullwidth_woo_product',
    array(
        'type'     => 'checkbox',
        'label'    => __('Set Single Product to full width', 'woodizain'),
        'section'  => 'woodizain_woo_options',
		'priority' => 2,
        )
    );

}
add_action( 'customize_register', 'woodizain_customize_register' );

/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'woodizain_sanitize_checkbox' ) ) :
	function woodizain_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}
endif;

function woodizain_woo_scripts() {
if ( class_exists( 'WooCommerce' ) && is_shop() && get_theme_mod( 'woodizain_fullwidth_woo_shop' ) != 0 ) {
    echo
	    '<style>
	        .content-sidebar { display: none;}
			body.woocommerce #primary { width: 100%; }
			.site-content { margin-right: 3.33333333%; }
	    </style>';
}

if ( class_exists( 'WooCommerce' ) && is_product() && get_theme_mod( 'woodizain_fullwidth_woo_product' ) != 0 ) {
    echo
	    '<style>
	        .content-sidebar { display: none;}
			body.woocommerce #primary { width: 100%; }
			.site-content { margin-right: 3.33333333%; }
	    </style>';
}

}
add_action( 'wp_head', 'woodizain_woo_scripts' );