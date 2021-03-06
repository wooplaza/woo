<?php
/**
 * @package dustlandexpress
 */
$images = get_posts( array("numberposts"=>-1,"post_type"=>"attachment","post_mime_type"=>"image","orderby" => "menu_order", "order" => "ASC","post_parent"=>$post->ID) );
$has_img = 'post-no-img';
if ( has_post_thumbnail() ) {
    $has_img = '';
}
$post_blog_layout = '';
if ( get_theme_mod( 'kra-blog-layout', false ) ) {
    $post_blog_layout = ' ' . get_theme_mod( 'kra-blog-layout' );
} ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $has_img . $post_blog_layout ); ?>>
    
    <?php
    if ( $images ) : ?>
    <div class="post-loop-images">
        
        <div class="post-loop-images-carousel-wrapper post-loop-images-carousel-wrapper-remove">
            <div class="post-loop-images-prev"><i class="fa fa-angle-left"></i></div>
            <div class="post-loop-images-next"><i class="fa fa-angle-right"></i></div>
            
            <div class="post-loop-images-carousel post-loop-images-carousel-remove">
                
                <?php
                foreach ( $images as $image ) {
                    $title = $image->post_title;
                    if ( get_theme_mod( 'kra-blog-layout', false ) == 'blog-post-side-layout' ) {
                        $thumbimage = wp_get_attachment_image_src( $image->ID, 'blog_img_side' );
                    } else {
                        $thumbimage = wp_get_attachment_image_src( $image->ID, 'blog_img_top' );
                    } ?>
                    <div><img src="<?php echo $thumbimage[0]; ?>" alt="<?php echo esc_html( $title ) ?>" /></div>
                <?php
                } ?>
            
            </div>
            
        </div>
        
    </div>
    <?php endif; ?>
    
    <div class="post-loop-content">
    
    	<header class="entry-header">
    		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

    		<?php if ( 'post' == get_post_type() ) : ?>
    		<div class="entry-meta">
    			<?php dustlandexpress_posted_on(); ?>
    		</div><!-- .entry-meta -->
    		<?php endif; ?>
    	</header><!-- .entry-header -->

    	<div class="entry-content">
    		<?php
    			/* translators: %s: Name of current post */
    			// the_content( sprintf(
    			// 	__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'dustlandexpress' ),
    			// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
    			// ) );
                the_excerpt();
    		?>

    		<?php
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . __( 'Pages:', 'dustlandexpress' ),
    				'after'  => '</div>',
    			) );
    		?>
    	</div><!-- .entry-content -->

    	<footer class="entry-footer">
    		<?php dustlandexpress_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
    
    </div>
    
    <div class="clearboth"></div>
</article><!-- #post-## -->