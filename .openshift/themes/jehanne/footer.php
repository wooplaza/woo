<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Jehanne
 * @since Jehanne 1.0
 */
?>
				</div><!-- .content -->
				<div class="clear"></div>
			</div><!-- .site-content -->
			<footer id="colophon" class="site-footer">
				<?php if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/front-page-no-column.php' ) ) : ?>
					<?php get_sidebar('before-footer'); ?>
				<?php endif; ?>
				
				<?php do_action('jehanne_footer_menu'); ?>
		
				<?php get_sidebar('footer'); ?>
				
				<?php do_action('jehanne_site_info'); ?>

			</footer><!-- #colophon -->
		</div><!-- #page-wrap -->
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>