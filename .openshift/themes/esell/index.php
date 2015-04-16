<?php get_header(); ?>
<!-- BEGIN PAGE -->
	<div id="page">
		<div id="page-inner" class="clearfix">
		<?php if ( of_get_option('esell_banner_top') <> "" ) 
		{
			echo'<div id="banner-top">';
			echo stripslashes(of_get_option('esell_banner_top'));
			echo'</div>'; 
		}
	?>
			<div id="content">
					<?php if(have_posts()) : 
						while(have_posts())  : the_post(); 
						get_template_part('/includes/post');
						endwhile;
						else :
					?>
							<div class="post">
								<div class="posttitle">
									<h2><?php _e('404 Error&#58; Not Found', 'esell' ); ?></h2>
									<span class="posttime"></span>
								</div>
							</div>
						<?php endif; ?>
					<?php get_template_part('/includes/pagenav'); ?>
				</div> <!-- end div #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>