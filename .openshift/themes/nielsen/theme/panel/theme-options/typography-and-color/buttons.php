<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Theme Options > Typography and Color > Buttons
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Buttons */

	array(
		'type' => 'title',
		'name' => __( 'Buttons Ghost', 'yit' ),
		'desc' => ''
	),

	array(
		'id'              => 'button-ghost-font',
		'type'            => 'typography',
		'name'            => __( 'Buttons Typography', 'yit' ),
		'desc'            => __( 'Select the typography for buttons text.', 'yit' ),
		'min'             => 1,
		'max'             => 80,
		'default_font_id' => 'typography-website-title',
		'std'             => array(
			'size'      => 11,
			'unit'      => 'px',
			'family'    => 'default',
			'style'     => '700',
			'transform' => 'uppercase',
		),
		'style'           => array(
			'selectors'  => '.btn-ghost, a.btn-ghost, .price-table div.button-container a.btn-flat',

			'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
		)
	),

	array(
		'id'         => 'button-ghost-text-color',
		'type'       => 'colorpicker',
		'name'       => __( 'Buttons Text color', 'yit' ),
		'desc'       => __( 'Select the color of the text for the buttons of every page', 'yit' ),
		'variations' => array(
			'normal' => __( 'Text color', 'yit' ),
			'hover'  => __( 'Text hover color', 'yit' )
		),
		'std'        => array(
			'color' => array(
				'normal' => '#6d6c6c',
				'hover'  => '#ffffff'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-ghost, a.btn-ghost, a.btn-ghost.added,
				                 .price-table div.button-container a.btn-flat,
                                 .btn.btn-ghost i.fa',

				'properties' => 'color'
			),
			'hover'  => array(
				'selectors'  => '.btn-ghost:hover, a.btn-ghost:hover,
                                .btn.btn-ghost:hover i.fa,
                                .price-table div.button-container a.btn-flat:hover,
                                .btn.btn-ghost i.fa:hover',

				'properties' => 'color'
			)
		)
	),

	array(
		'id'         => 'button-ghost-border-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Border color', 'yit' ),
			'hover'  => __( 'Border hover color', 'yit' )
		),
		'name'       => __( 'Buttons border color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons border of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#898584',
				'hover'  => '#898584'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-ghost, a.btn-ghost, .price-table div.button-container a.btn-flat',

				'properties' => 'border-color'
			),
			'hover'  => array(
				'selectors'  => '.btn-ghost:hover, a.btn-ghost:hover, .price-table div.button-container a.btn-flat:hover',
				'properties' => 'border-color'
			)
		)
	),

	array(
		'id'         => 'button-ghost-background-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Background color', 'yit' ),
			'hover'  => __( 'Background hover color', 'yit ' )
		),
		'name'       => __( 'Buttons background color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons background of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => 'transparent',
				'hover'  => '#898584'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-ghost, a.btn-ghost, .price-table div.button-container a.btn-flat',

				'properties' => 'background-color, background'
			),
			'hover'  => array(
				'selectors'  => '.btn-ghost:hover, a.btn-ghost:hover, .price-table div.button-container a.btn-flat:hover',

				'properties' => 'background-color, background'
			)
		)
	),

	array(
		'type' => 'title',
		'name' => __( 'Buttons Flat Red', 'yit' ),
		'desc' => ''
	),

	array(
		'id'              => 'button-flat-red-font',
		'type'            => 'typography',
		'name'            => __( 'Buttons Typography', 'yit' ),
		'desc'            => __( 'Select the typography for buttons text.', 'yit' ),
		'min'             => 1,
		'max'             => 80,
		'default_font_id' => 'typography-website-title',
		'std'             => array(
			'size'      => 11,
			'unit'      => 'px',
			'family'    => 'default',
			'style'     => '700',
			'transform' => 'uppercase',
		),
		'style'           => array(
			'selectors'  => '.btn-flat-red, a.btn-flat-red, .reply_link .comment-reply-link, .login-form-checkout input.button, #commentform #submit,
			                .wishlist_table .add_to_cart.button,
			                .price-table div.button-container a.btn-alternative,
			                .show-products.show-products-list ul.products li.product.list .product-wrapper .product-actions-wrapper .product-action-button a span,
			                #my-account-content div.woocommerce form p input[type="submit"],
			                .widget.widget_price_filter button[type="submit"],
			                table.compare-list .add-to-cart td a span,
			                .yith-woocompare-widget a.compare.button,
			                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a,
			                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]',

			'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
		)
	),

	array(
		'id'         => 'button-flat-red-text-color',
		'type'       => 'colorpicker',
		'name'       => __( 'Buttons Text color', 'yit' ),
		'desc'       => __( 'Select the color of the text for the buttons of every page', 'yit' ),
		'variations' => array(
			'normal' => __( 'Text color', 'yit' ),
			'hover'  => __( 'Text hover color', 'yit' )
		),
		'std'        => array(
			'color' => array(
				'normal' => '#ffffff',
				'hover'  => '#ffffff'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-red, a.btn-flat-red, a.btn-flat-red.added,
                                .reply_link .comment-reply-link, .login-form-checkout input.button, #commentform #submit,
                                .btn.btn-flat-red i.fa, .wishlist_table .add_to_cart.button,
                                .price-table div.button-container a.btn-alternative,
                                .show-products.show-products-list ul.products li.product.list .product-wrapper .product-actions-wrapper .product-action-button a span,
                                #my-account-content div.woocommerce form p input[type="submit"],
                                .widget.widget_price_filter button[type="submit"],
                                table.compare-list .add-to-cart td a span,
                                .yith-woocompare-widget a.compare.button,
                                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a,
                                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]',

				'properties' => 'color'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-red:hover, a.btn-flat-red:hover, .reply_link .comment-reply-link:hover, .login-form-checkout input.button:hover, #commentform #submit:hover,
                                .btn.btn-flat-red:hover i.fa,
                                .btn.btn-flat-red i.fa:hover,
                                .btn-flat-red:focus, .btn-flat-red.focus,
                                .price-table div.button-container a.btn-alternative:hover,
                                .wishlist_table .add_to_cart.button:hover,
                                .show-products.show-products-list ul.products li.product.list .product-wrapper .product-actions-wrapper .product-action-button a:hover span,
                                #my-account-content div.woocommerce form p input[type="submit"]:hover,
                                .widget.widget_price_filter button[type="submit"]:hover,
                                table.compare-list .add-to-cart td a span:hover,
                                .yith-woocompare-widget a.compare.button:hover,
                                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a:hover,
                                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]:hover',

				'properties' => 'color'
			)
		)
	),

	array(
		'id'         => 'button-flat-red-border-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Border color', 'yit' ),
			'hover'  => __( 'Border hover color', 'yit' )
		),
		'name'       => __( 'Buttons border color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons border of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#a12418',
				'hover'  => '#ae4a14'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-red, a.btn-flat-red, .reply_link .comment-reply-link, .login-form-checkout input.button, #commentform #submit,
                                 .wishlist_table .add_to_cart.button,
                                 .price-table div.button-container a.btn-alternative,
                                 .show-products.show-products-list ul.products li.product.list .product-wrapper .product-actions-wrapper .product-action-button,
                                 #my-account-content div.woocommerce form p input[type="submit"],
                                 .widget.widget_price_filter button[type="submit"],
                                 table.compare-list .add-to-cart td a span,
                                 .yith-woocompare-widget a.compare.button,
                                 .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a,
                                 div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]',

				'properties' => 'border-color'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-red:hover, a.btn-flat-red:hover, .reply_link .comment-reply-link:hover, .login-form-checkout input.button:hover, #commentform #submit:hover,
				                .wishlist_table .add_to_cart.button:hover,
				                .price-table div.button-container a.btn-alternative:hover,
				                .show-products.show-products-list ul.products li.product.list .product-wrapper .product-actions-wrapper .product-action-button:hover,
				                #my-account-content div.woocommerce form p input[type="submit"]:hover,
				                .widget.widget_price_filter button[type="submit"]:hover,
				                table.compare-list .add-to-cart td a span:hover,
				                .yith-woocompare-widget a.compare.button:hover,
				                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a:hover,
				                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]:hover',
				'properties' => 'border-color'
			)
		)
	),

	array(
		'id'         => 'button-flat-red-background-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Background color', 'yit' ),
			'hover'  => __( 'Background hover color', 'yit ' )
		),
		'name'       => __( 'Buttons background color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons background of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#a12418',
				'hover'  => '#ae4a14'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-red, a.btn-flat-red, .reply_link .comment-reply-link, .login-form-checkout input.button, #commentform #submit,
				                 .wishlist_table .add_to_cart.button,
				                 .price-table div.button-container a.btn-alternative,
				                 .show-products.show-products-list ul.products li.product.list .product-wrapper .product-actions-wrapper .product-action-button,
				                 #my-account-content div.woocommerce form p input[type="submit"],
				                 .widget.widget_price_filter button[type="submit"],
				                 table.compare-list .add-to-cart td a span,
				                 .yith-woocompare-widget a.compare.button,
				                 .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button,
				                 div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]',

				'properties' => 'background-color, background'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-red:hover, a.btn-flat-red:hover, .reply_link .comment-reply-link:hover, .login-form-checkout input.button:hover, #commentform #submit:hover,
				                .wishlist_table .add_to_cart.button:hover,
				                .price-table div.button-container a.btn-alternative:hover,
				                .show-products.show-products-list ul.products li.product.list .product-wrapper .product-actions-wrapper .product-action-button:hover,
				                #my-account-content div.woocommerce form p input[type="submit"]:hover,
				                .widget.widget_price_filter button[type="submit"]:hover,
				                table.compare-list .add-to-cart td a span:hover,
				                .yith-woocompare-widget a.compare.button:hover,
				                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button:hover,
				                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]:hover',

				'properties' => 'background-color, background'
			)
		)
	),

	array(
		'type' => 'title',
		'name' => __( 'Buttons Flat Orange', 'yit' ),
		'desc' => ''
	),

	array(
		'id'              => 'button-flat-orange-font',
		'type'            => 'typography',
		'name'            => __( 'Buttons Typography', 'yit' ),
		'desc'            => __( 'Select the typography for buttons text.', 'yit' ),
		'min'             => 1,
		'max'             => 80,
		'default_font_id' => 'typography-website-title',
		'std'             => array(
			'size'      => 11,
			'unit'      => 'px',
			'family'    => 'default',
			'style'     => '700',
			'transform' => 'uppercase',
		),
		'style'           => array(
			'selectors'  => '.btn-flat-orange, a.btn-flat-orange,
			                 .widget .searchform #searchsubmit,
			                 .woocommerce.widget.widget_product_search #searchform #searchsubmit',

			'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
		)
	),

	array(
		'id'         => 'button-flat-orange-text-color',
		'type'       => 'colorpicker',
		'name'       => __( 'Buttons Text color', 'yit' ),
		'desc'       => __( 'Select the color of the text for the buttons of every page', 'yit' ),
		'variations' => array(
			'normal' => __( 'Text color', 'yit' ),
			'hover'  => __( 'Text hover color', 'yit' )
		),
		'std'        => array(
			'color' => array(
				'normal' => '#ffffff',
				'hover'  => '#ffffff'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-orange, a.btn-flat-orange, a.btn-flat-orange.added,
                                .woocommerce.widget.widget_product_search #searchform #searchsubmit,
				                .widget .searchform #searchsubmit,
                                .btn.btn-flat-orange i.fa',

				'properties' => 'color'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-orange:hover, a.btn-flat-orange:hover,
				                .widget .searchform #searchsubmit:hover,
				                .woocommerce.widget.widget_product_search #searchform #searchsubmit:hover,
                                .btn.btn-flat-orange:hover i.fa,
                                .btn.btn-flat-orange i.fa:hover',

				'properties' => 'color'
			)
		)
	),

	array(
		'id'         => 'button-flat-orange-border-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Border color', 'yit' ),
			'hover'  => __( 'Border hover color', 'yit' )
		),
		'name'       => __( 'Buttons border color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons border of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#da8207',
				'hover'  => '#ae4a14'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-orange, a.btn-flat-orange, .woocommerce.widget.widget_product_search #searchform #searchsubmit,
				                 .widget .searchform #searchsubmit',


				'properties' => 'border-color'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-orange:hover, a.btn-flat-orange:hover, .woocommerce.widget.widget_product_search #searchform #searchsubmit:hover,
				                 .widget .searchform #searchsubmit:hover',

				'properties' => 'border-color'
			)
		)
	),

	array(
		'id'         => 'button-flat-orange-background-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Background color', 'yit' ),
			'hover'  => __( 'Background hover color', 'yit ' )
		),
		'name'       => __( 'Buttons background color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons background of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#da8207',
				'hover'  => '#ae4a14'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-orange, a.btn-flat-orange, .woocommerce.widget.widget_product_search #searchform #searchsubmit,
                                 .widget .searchform #searchsubmit',


				'properties' => 'background-color, background'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-orange:hover, a.btn-flat-orange:hover, .woocommerce.widget.widget_product_search #searchform #searchsubmit:hover,
				                 .widget .searchform #searchsubmit:hover',


				'properties' => 'background-color, background'
			)
		)
	),
);

