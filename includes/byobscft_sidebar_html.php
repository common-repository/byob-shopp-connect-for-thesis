<?php


function byobscft_initialize_sidebar(){
    $options = get_option('byobscft_options');
    $use_shop_sidebar = $options['use_shop_sidebar'];
    
    if ($use_shop_sidebar == '1'){
        
        byobscft_register_shopp_sidebar();
    }

}
add_action('init','byobscft_initialize_sidebar');




function byobscft_shopp_sidebar() {
	echo "\t\t<div id=\"sidebars\">\n";
	thesis_hook_before_sidebars(); #hook
	byobscft_add_shopp_sidebar_html();
	thesis_hook_after_sidebars(); #hook
	echo "\t\t</div>\n";
}


function byobscft_add_shopp_sidebar_html(){
    global $thesis_design;

    if (thesis_show_multimedia_box() && apply_filters('thesis_show_multimedia_box', true))
            thesis_multimedia_box();

    ?>
    <div id="sidebar_1" class="sidebar">
        <ul class="sidebar_list">
            <?php thesis_hook_before_sidebar_1();
            if ( !dynamic_sidebar('Shopp Pages Sidebar') ) { ?>
                <li class="widget">
                    <div class="widget_box">
                        <h3><?php _e('Shopp Pages Sidebar Widgets', 'byobscft'); ?></h3>
                        <p>This is your new sidebar.  Add widgets here from your WP Dashboard just like normal.</p>
                    </div>
                </li>
            <?php } 
            thesis_hook_after_sidebar_1();?>
        </ul>    
    </div>
<?php 
}

