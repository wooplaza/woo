<?php
/*----------------------------------------------------------------------------------- */
    /* Custom CSS Styles */
    /* ----------------------------------------------------------------------------------- */

    function esell_of_head_css() {
        $output = '';
        $custom_css = of_get_option('esell_customcss');
        if ($custom_css <> '') {
            $output .= $custom_css . "\n";
        }
// Output styles
        if ($output <> '') {
            $output = "<!-- Custom Styling -->\n<style type=\"text/css\">/*<![CDATA[*/\n" . $output . "/*]]>*/</style>\n";
            echo $output;
        }

    }
	
	 add_action('wp_head', 'esell_of_head_css');

		 
	
	  /* ----------------------------------------------------------------------------------- */
    /* Add Favicon
      /*----------------------------------------------------------------------------------- */
    function esell_childtheme_favicon() {
        if (of_get_option('esell_favicon') != '') {
            echo '<link rel="shortcut icon" href="' . of_get_option('esell_favicon') . '"/>' . "\n";
        }
    }
    add_action('wp_head', 'esell_childtheme_favicon');  

/**************************Description Images*******************************/
	function esell_columnimage() {
       if (of_get_option('esell_colimg1') != '') {
            echo '<img src="' . of_get_option('esell_colimg1') . '"/>' . "\n";
			
        }
		else {echo'<img src="' .get_template_directory_uri(). '/images/designinfo.png"/>' . "\n";}
     }
function esell_columnimage2() {
       if (of_get_option('esell_colimg2') != '') {
            echo '<img src="' . of_get_option('esell_colimg2') . '"/>' . "\n";
        }
				else {echo'<img src="' .get_template_directory_uri(). '/images/easusetup.png"/>' . "\n";}
     }
function esell_columnimage3() {
       if (of_get_option('esell_colimg3') != '') {
            echo '<img src="' . of_get_option('esell_colimg3') . '"/>' . "\n";
        }else {echo'<img src="' .get_template_directory_uri(). '/images/easusetup.png"/>' . "\n";}
     }
function esell_columnimage4() {
       if (of_get_option('esell_colimg4') != '') {
            echo '<img src="' . of_get_option('esell_colimg4') . '"/>' . "\n";
        }else {echo'<img src="' .get_template_directory_uri(). '/images/designinfo.png"/>' . "\n";}
     }
function esell_columnimage5() {
       if (of_get_option('esell_colimg5') != '') {
            echo '<img src="' . of_get_option('esell_colimg5') . '"/>' . "\n";
        }else {echo'<img src="' .get_template_directory_uri(). '/images/easusetup.png"/>' . "\n";}
     }
function esell_columnimage6() {
       if (of_get_option('esell_colimg6') != '') {
            echo '<img src="' . of_get_option('esell_colimg6') . '"/>' . "\n";
        }else {echo'<img src="' .get_template_directory_uri(). '/images/designinfo.png"/>' . "\n";}
     }


/* ----------------------------------------------------------------------------------- */
/* Breadcrumbs Plugin
  /*----------------------------------------------------------------------------------- */

function esell_breadcrumbs() {
    $delimiter = '&raquo;';
    $home = 'Home'; // text for the 'Home' link
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    echo '<div id="crumbs">';
    global $post;
    $homeLink = esc_url(home_url('/'));
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
    } elseif (is_day()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . get_the_title() . $after;
        }
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        //$cat = get_the_category($parent->ID); $cat = $cat[0];
        //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . 'Search results for "' . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
        echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . 'Articles posted by ' . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . 'Error 404' . $after;
    }

    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        echo 'Page' . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }

    echo '</div>';
}
?>