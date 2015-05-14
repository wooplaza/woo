<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce, $wp;

$my_account_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
?>

<div class="user-profile clearfix">

    <div class="user-image">
        <?php
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        echo get_avatar( $user_id, 80 );

        ?>
    </div>
    <div class="user-logout">
        <span class="username"><?php echo $current_user->display_name?></span>
        <?php if( isset( $current_user ) && $current_user->ID != 0 ) : ?>
            <span class="logout"><a href="<?php echo wp_logout_url(); ?>">x <?php _e( 'logout', 'yit' ) ?></a></span>
        <?php endif; ?>
    </div>

</div>

<div class="clear"></div>
<ul>
    <li>
        <span class="fa fa-folder-open"></span>
        <a href="<?php echo $my_account_url ?>" title="<?php _e( 'My Orders', 'yit' ); ?>" <?php echo ( ! isset( $wp->query_vars['recent-downloads'] ) && ! isset( $wp->query_vars['wishlist'] ) && ! isset( $wp->query_vars['edit-address'] ) && ! isset( $wp->query_vars['edit-account'] ) ) ? ' class="active"' : ''; ?> ><?php _e( 'My Orders', 'yit' ); ?></a>
    </li>
    <li>
        <span class="fa fa-download"></span>
        <a href="<?php echo wc_get_endpoint_url('recent-downloads', '', $my_account_url ) ?>" title="<?php _e( 'My Download', 'yit' ); ?>"<?php echo isset( $wp->query_vars['recent-downloads'] ) ? ' class="active"' : ''; ?>><?php _e( 'My Downloads', 'yit' ) ?></a>
    </li>
    <li>
        <span class="fa fa-heart-o"></span>
        <a href="<?php echo wc_get_endpoint_url('wishlist', '', $my_account_url ) ?>" title="<?php _e( 'My Wishlist', 'yit' ); ?>"<?php echo isset( $wp->query_vars['wishlist'] ) ? ' class="active"' : ''; ?>><?php _e( 'My Wishlist', 'yit' ) ?></a>
    </li>
    <li>
        <span class="fa fa-pencil-square-o"></span>
        <a href="<?php echo wc_get_endpoint_url('edit-address', '', $my_account_url ) ?>" title="<?php _e( 'Edit Address', 'yit' ); ?>"<?php echo isset( $wp->query_vars['edit-address'] ) ? ' class="active"' : ''; ?>><?php _e( 'Edit Address', 'yit' ) ?></a>
    </li>
    <li>
        <span class="fa fa-pencil-square-o"></span>
        <a href="<?php echo wc_get_endpoint_url('edit-account', '', $my_account_url ) ?>" title="<?php _e( 'Edit Account', 'yit' ); ?>"<?php echo isset( $wp->query_vars['edit-account'] ) ? ' class="active"' : ''; ?>><?php _e( 'Edit Account', 'yit' ) ?></a>
    </li>
</ul>

