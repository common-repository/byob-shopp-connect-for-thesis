<?php

function byobscft_choose_sidebar(){
    if(is_shopp_page()){
        $options = get_option('byobscft_options');
        $use_shop_sidebar = $options['use_shop_sidebar'];        
        $shop_pages = byobscft_shop_page_list();
        
        foreach($shop_pages as $page){
            $page_name = $page['name'];
            
            if($page['slug']()){
                if($options[$page_name] == 'shopp_sidebar' && $use_shop_sidebar == '1'){
                    byobscft_use_shopp_sidebar();
                }elseif($options[$page_name] == 'no_sidebars'){
                    byobscft_use_no_sidebars();
                }
            }
        }        
    }
}

add_action('template_redirect', 'byobscft_choose_sidebar');

function byobscft_use_shopp_sidebar(){
    add_filter('thesis_show_sidebars', 'byobscft_remove_thesis_sidebars');
    add_action('wp_head', 'byobscft_write_sidebar_css_to_head');
    add_action('thesis_hook_content_box_top', 'byobscft_shopp_sidebar');
}

function byobscft_use_no_sidebars(){
    add_filter('thesis_show_sidebars', 'byobscft_remove_thesis_sidebars');
}

function byobscft_remove_thesis_sidebars(){
    
    return false;
}

function byobscft_remove_headline_area(){
    if(is_shopp_page()){
        $options = get_option('byobscft_options'); 
        
        if(is_catalog_page()){
            if($options['hide_catalog_page_titles'] == '1'){
                return false;
            }            
        }
        if(is_shopp_product()){
            if($options['hide_product_page_titles'] == '1'){
                return false;
            }            
        }
        if(is_shopp_collection()){
            if($options['hide_collection_page_titles'] == '1'){
                return false;
            }            
        }
        if(is_shopp_taxonomy()){
            if($options['hide_taxonomy_page_titles'] == '1'){
                return false;
            }            
        }
        if(is_catalog_frontpage()){
            if($options['hide_frontpage_page_titles'] == '1'){
                return false;
            }            
        }
        if(is_cart_page()){
            if($options['hide_cart_page_titles'] == '1'){
                return false;
            }            
        }
        if(is_checkout_page()){
            if($options['hide_checkout_page_titles'] == '1'){
                return false;
            }            
        }
        if(is_confirm_page()){
            if($options['hide_confirm_page_titles'] == '1'){
                return false;
            }            
        }
        if(is_thanks_page()){
            if($options['is_thanks_page'] == '1'){
                return false;
            }            
        }
        if(is_account_page()){
            if($options['hide_account_page_titles'] == '1'){
                return false;
            }            
        }
        return true;
    }
    return true;
}
add_filter('thesis_show_headline_area', 'byobscft_remove_headline_area');


function byobscft_remove_post_navigation(){
    if(is_shopp_product()){
        $options = get_option('byobscft_options'); 
        
        if($options['hide_post_nav'] == '1'){
            remove_action('thesis_hook_after_content', 'thesis_prev_next_posts');          
        }
    }
}
add_action('template_redirect', 'byobscft_remove_post_navigation');


function byobscft_remove_comments_from_products($open){
    $options = get_option('byobscft_options'); 
    if(is_shopp_product()){
        
        if($options['hide_comments'] == '1'){
              $open = false;        
        }
    }
    return $open;
}
add_filter( 'comments_open', 'byobscft_remove_comments_from_products', 10, 2 );

function byobscft_add_shopp_page_body_class($classes){
    if(is_shopp_page()){
        
        $shop_pages = byobscft_shop_page_list();
        
        foreach($shop_pages as $page){
            $page_name = $page['name'];
            
            if($page['slug']()){
                $classes[] .= $page_name;
            }
        }        
    }
    return $classes;
}

add_filter('thesis_body_classes', 'byobscft_add_shopp_page_body_class');
