<?php
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo __( 'Search for:', 'i-craft' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo __( 'Search...', 'i-craft' ) ?>" value="<?php echo esc_url(get_search_query()) ?>" name="s" title="<?php echo __( 'Search for:', 'i-craft' ) ?>" />
	</label>
    <input type="hidden" value="product" name="post_type" id="post_type" />
	<input type="submit" class="search-submit" value="<?php echo __( 'Search', 'i-craft' ) ?>" />
</form>