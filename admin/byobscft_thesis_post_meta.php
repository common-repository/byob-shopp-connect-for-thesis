<?php

function thesis_for_shopp_post_types() {
    
    if(class_exists('thesis_post_options')){
        $post_options = new thesis_post_options;
        $post_options->meta_boxes();
        
        foreach ($post_options->meta_boxes as $meta_name => $meta_box) {
            if($meta_box['id'] == 'thesis_seo_meta' || $meta_box['id'] == 'thesis_multimedia_meta' ){
                    add_meta_box($meta_box['id'], $meta_box['title'], array('thesis_post_options', 'output_' . $meta_name . '_box'), 'shopp_product', 'normal', 'high');
            }
        }
        
        add_action('save_post', array('thesis_post_options', 'save_meta'));
    }
}
add_action('admin_init', 'thesis_for_shopp_post_types');
 