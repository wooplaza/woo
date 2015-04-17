<?php
function optimizer_option_defaults() {
	$defaults = array(
		'slider_type_id' =>  'static',
		'center_width' => '85', 
		'site_layout_id' => 'site_full',
		'content_font_id' =>  array('font-family' =>  'sans-serif'),
		'content_font_id' => array('font-size' => '16px'),
		'content_font_id' =>  array('font-weight' =>  'normal'),
		'primtxt_color_id' => '#888888',
		'title_txt_color_id' => '#555555',
		'page_header_color' => '#f5f5f5',
		'page_header_txtcolor'  => '#555555',
		'static_textbox_width' => '85', 
		'static_cta2_txt_color'  => '#ffffff',
		'static_cta2_bg_color'  => '#3590ea',
		'static_cta1_txt_color'  => '#ffffff',
		'static_cta1_bg_color'  => '#3590ea',
		'head_color_id'  => '#fafafa',
		'sec_color_id' => '#3590ea',
		'sectxt_color_id'  => '#ffffff',
		'sidebar_color_id'  => '#ffffff',
		'sidebar_tt_color_id' => '#222222',
		'sidebartxt_color_id' => '#888888',
		'footer_color_id' => '#222222',
		'footer_title_color'  => '#ffffff',
		'footwdgtxt_color_id' => '#666666', 
		'copyright_bg_color' => '#333333', 
		'copyright_txt_color' => '#666666',
		'menutxt_color_id' => '#666666',
		'menutxt_color_hover' => '#3590ea',
		'menu_size_id' => '14px',
		'trans_header_color' => '#ffffff',
		'logo_font_id' => array('font-family' => 'sans-serif'),
		'logo_font_id'=>  array('font-size' => '36px'),
		'logo_color_id' => '#333333',
		'ptitle_font_id' =>  array('font-family' => 'sans-serif'),
		'txt_upcase_id' => true,
		'about_bg_color' => '#ffffff',
		'about_header_color' => '#222222',
		'about_text_color' => '#888888',
		'midrow_color_id' => '#f3f3f3',
		'blocktxt_color_id' => '#999999',
		'blocktitle_color_id' => '#222222',
		'welcome_color_id' => '#f2f2f2',
		'welcometxt_color_id' => '#ffffff',
		'welcome_bg_image' => array('url' => ''. get_stylesheet_directory_uri().'/assets/images/welcome_textbg.jpg'),
		'frontposts_color_id' => '#ffffff',
		'frontposts_title_color' => '#222222',
		'frontposts_bg_color' => '#ffffff',
		'head_transparent' => '1',
		'slider_type_id' => 'static',
		'offline_txt_color' => '#888888',
		'offline_bg_color' => '#f3f3f3',
		'show_blog_thumb' => true,
		'logo_font_id' =>  array('font-weight' => '400'),
		'logo_font_id' =>  array('letter-spacing' => '1px'),
		'ptitle_font_id' =>  array('font-weight' => '400'),
		'home_sort_id' => array('about'=>__('About', 'optimizer'),'blocks'=>__('Blocks', 'optimizer'),'welcome-text'=>__('Welcome Text', 'optimizer'),'posts'=>__('Frontpage Posts', 'optimizer')),
		'front_layout_id' => 1,
		'slider_type_id' => 'static',
		'posts_title_id' => __('Our Work', 'optimizer'),
		'posts_subtitle_id' => __('Check Out Our Portfolio', 'optimizer'),
		'cat_layout_id' => 1,
		'post_info_id' => '1',
		'post_nextprev_id' => '1',
		'post_comments_id' => '1',
		'navigation_type' => 'numbered_ajax',
		'social_button_style' => 'simple',
		'social_bookmark_size' => 'normal',
		'about_preheader_id' => __('A little about...','optimizer'),
		'about_header_id' => __('THE OPTIMIZER','optimizer'),
		'about_content_id' => __('<p>Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.</p>','optimizer'),
		'block_layout_id' => 1,
		'block1_text_id' => __('Lorem Ipsum', 'optimizer'),
		'block1_textarea_id' => __('<p>Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.</p>', 'optimizer'),
		'block2_text_id' => __('Lorem Ipsum', 'optimizer'),
		'block2_textarea_id' =>__('<p>Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.</p>', 'optimizer'),
		'block3_text_id' => __('Lorem Ipsum', 'optimizer'),
		'block3_textarea_id' =>__('<p>Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.</p>', 'optimizer'),
		'block4_text_id' => __('Lorem Ipsum', 'optimizer'),
		'block4_textarea_id' =>__('<p>Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.</p>', 'optimizer'),
		'block5_text_id' => __('Lorem Ipsum', 'optimizer'),
		'block5_textarea_id' =>__('<p>Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.</p>', 'optimizer'),
		'block6_text_id' => __('Lorem Ipsum', 'optimizer'),
		'block6_textarea_id' =>__('<p>Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.</p>', 'optimizer'),
		'welcm_textarea_id' => __('<h2 style="text-align:center;">Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.</h2>', 'optimizer'),
		'static_image_id' => array( 'id' =>'def_slide', 'width' =>'1920', 'height' =>'835', 'url' =>''. get_stylesheet_directory_uri().'/assets/images/slide.jpg'),
		'static_img_text_id' => __('<p style="text-align: center;"><img class="aligncenter size-full wp-image-10751" src="'. get_stylesheet_directory_uri().'/assets/images/slide_icon.png" alt="slide_icon" width="100" height="100" /></p><p style="text-align: center;"><span style="font-size: 36pt; color: #ffffff;">ADVANCED . <strong>STRONG</strong> . RELIABLE</span></p><p style="text-align: center;"><span style="color: #ffffff;">The Optimizer, an easy to customizable multi-purpose theme with lots of powerful features. </span></p>','optimizer'),
		'static_cta1_text' =>__('DEMO','optimizer'),
		'static_cta1_link' => "#",
		'static_cta1_txt_style' => "hollow",
		'static_cta2_text' =>__('DOWNLOAD','optimizer'),
		'static_cta2_link' => "#",
		'static_cta2_txt_style' => "flat",
		'cat_layout_id' => '1',
		'social_bookmark_pos' => 'header',
		'divider_icon' => 'fa-stop',
	);
	
	return apply_filters( 'optimizer_option_defaults', $defaults );
}?>