 <?php global $option_setting; ?>
<?php if ($option_setting['facebook']) : ?>
<a <?php _e('Facebook','seller'); ?>="<?php echo esc_url( $option_setting['facebook'] ); ?>"><i class="fa fa-facebook"></i></a>
<?php endif; ?>
<?php if ($option_setting['google']) : ?>
<a <?php _e('Google Plus','seller'); ?>="<?php echo esc_url( $option_setting['google'] ); ?>"><i class="fa fa-google-plus"></i></a>
<?php endif; ?>
<?php if ($option_setting['twitter']) : ?>
<a <?php _e('Twitter','seller'); ?>="<?php echo esc_url( $option_setting['twitter'] ); ?>"><i class="fa fa-twitter"></i></a>
<?php endif; ?>
<?php if ($option_setting['rss-feed']) : ?>
<a <?php _e('Subscribe to RSS Feeds','seller'); ?>="<?php echo esc_url( $option_setting['rss-feed'] ); ?>"><i class="fa fa-rss"></i></a>
<?php endif; ?>
<?php if ($option_setting['instagram']) : ?>
<a <?php _e('Instagram','seller'); ?>="<?php echo esc_url( $option_setting['instagram'] ); ?>"><i class="fa fa-instagram"></i></a>
<?php endif; ?>
<?php if ($option_setting['flickr']) : ?>
<a <?php _e('Flickr','seller'); ?>="<?php echo esc_url( $option_setting['flickr'] ); ?>"><i class="fa fa-flickr"></i></a>
<?php endif; ?>