<?php

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: byobscft_plugin_startup()
// ------------------------------------------------------------------------------

function byobscft_plugin_option_defaults(){
    $tmp = get_option('byobscft_options');
    
    if(!is_array($tmp)) {
        $arr = array( 
                        'use_shop_sidebar' => '',
                        'account' => 'no_sidebars', 
                        'cart' => 'no_sidebars',
                        'catalog' => 'shopp_sidebar',
                        'checkout' => 'no_sidebars',
                        'collection' => 'shopp_sidebar',
                        'confirm' => 'no_sidebars',
                        'frontpage' => 'shopp_sidebar',
                        'product' => 'shopp_sidebar',
                        'taxonomy' => 'shopp_sidebar',
                        'thanks' => 'shopp_sidebar',
                        'adjust_widths' => '',
                        'shopp_content_width' => '',
                        'shopp_sidebar_width' => '',
                        'hide_comments' => '1',
                        'hide_post_nav' => '1'
                    );
        update_option('byobscft_options', $arr);
    }     
}



// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------


// Render the Plugin options form

function byobscft_render_form() {
    
    if(!class_exists('Thesis_CSS')){ // Test to make sure that Thesis is active
        wp_die ('This plugin only works with the <strong>Thesis Theme</strong> version 1.8 or higher.');
    }
    
    $plugin_data = get_plugin_data ( BYOBSCFT_PLUGIN_DIR . 'byob-shopp-connect-for-thesis.php' , $markup = true );
    
    ?>
    <div class="wrap">

            <!-- Display Plugin Icon, Header, and Description -->
            <div class="icon32"><img src="<?php echo BYOBSCFT_PLUGIN_URL . 'images/byob-icon.png';?>" /><br></div>
            <h2><?php _e('BYOB Shopp Connect for Thesis Options - <em>Version ', 'byobscft'); echo $plugin_data['Version']; ?></em> </h2>
            <h4 style="color:orange"><?php _e('For help using this plugin see the <em>Help</em> tab in the upper right corner of this window.', 'byobscft');?></h4>
            
    </div>
    <div id="thesis_options" class="wrap">
    <!-- Beginning of the Plugin Options Form -->
        <form method="post" action="options.php">
            <?php 
            settings_fields('byobscft_plugin_options');
            $options = get_option('byobscft_options'); 
            $use_shop_sidebar = $options['use_shop_sidebar'];
            $modify_widths = $options['adjust_widths'];
            
            
            $shop_pages = byobscft_shop_page_list();

            ?>
            <div class="options_column">  <!-- Top of the First Column in the Options Form -->
                <div class="options_module" id="shopp-pages-sidebars">
                    <h3><?php _e('Sidebars on Shopp Pages', 'byobscft'); ?></h3>
                    <p><?php _e('Set the sidebar options for each type of Shopp page.', 'byobscft'); ?></p>
                    
                    <div class="module_subsection">
                        <h4 class="module_switch"><a href="" title="<?php _e('Show/hide additional information', 'byobscft'); ?>"><span class="pos">+</span><span class="neg">&#8211;</span></a><?php _e('Shopp Specific Sidebar', 'byobscft'); ?></h4>
                        <div class="more_info">
                            <p><?php _e('Create a Shopp Specific Sidebar?', 'byobscft'); ?></p>
                            <ul class="column_structure" id="_background_transparent">
                                <li>
                                    <input name="byobscft_options[use_shop_sidebar]" type="checkbox" value="1" <?php if (isset($options['use_shop_sidebar'])) { checked('1', $options['use_shop_sidebar']); } ?> /><label><?php _e(' Use a Shopp specific sidebar on Shopp pages', 'byobscft'); ?></label><br />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    foreach ($shop_pages as $page){
                        ?>

                        <div class="module_subsection">
                            <h4 class="module_switch"><a href="" title="<?php _e('Show/hide additional information', 'byobscft'); ?>"><span class="pos">+</span><span class="neg">&#8211;</span></a><?php _e($page['label'], 'byobscft'); ?></h4>
                            <div class="more_info">
                            <p><?php _e($page['description'], 'byobscft'); ?></p>
                                <ul class="column_structure" id="header_areas">
                                    <?php if($use_shop_sidebar === '1'){ ?>
                                    <li>
                                        <label><input name="byobscft_options[<?php echo $page['name'];?>]" type="radio" value="shopp_sidebar" <?php checked('shopp_sidebar', $options[$page['name']]); ?> /><?php _e(' Display the Shopp Sidebar', 'byobscft'); ?></label><br />
                                    </li>
                                    <?php } ?>
                                    <li>
                                        <label><input name="byobscft_options[<?php echo $page['name'];?>]" type="radio" value="no_sidebars" <?php checked('no_sidebars', $options[$page['name']]); ?> /><?php _e(" Don't Display any Sidebars", 'byobscft'); ?></label><br />
                                    </li>
                                    <li>
                                        <label><input name="byobscft_options[<?php echo $page['name'];?>]" type="radio" value="sidebar_1" <?php checked('sidebar_1', $options[$page['name']]); ?> /><?php _e(' Display Sidebar 1', 'byobscft'); ?></label><br />
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
            </div>  <!-- Bottom of the First Column in the Options Form -->
            
            <div class="options_column">  <!-- Top of the Second & Third Columns in the Options Form -->
                
                <div class="options_module button_module">
                    <input type="submit" class="save_button" id="design_submit" name="submit" value="<?php thesis_save_button_text(); ?>" />
                </div>
                        
                <div class="options_module" id="structure-widths">
                    <h3><?php _e('Adjust Shop Page Widths', 'byobscft'); ?></h3>
                    <p><?php _e('Modify the widths of the content area and side bar.', 'byobscft'); ?></p>
                    
                    <div class="module_subsection">
                        <h4 class="module_switch"><a href="" title="<?php _e('Show/hide additional information', 'byobscft'); ?>"><span class="pos">+</span><span class="neg">&#8211;</span></a><?php _e('Add Custom Widths?', 'byobscft'); ?></h4>
                        <div class="more_info">
                            <p><?php _e('Modify the Existing Content and Sidebar Widths?', 'byobscft'); ?></p>
                            <ul class="column_structure" id="_background_transparent">
                                <li>
                                    <input name="byobscft_options[adjust_widths]" type="checkbox" value="1" <?php if (isset($options['adjust_widths'])) { checked('1', $options['adjust_widths']); } ?> /><label><?php _e(' Yes I want to enter custom widths', 'byobscft'); ?></label><br />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php 
                    if($modify_widths === '1'){
                    ?>
                    <div class="module_subsection">
                        <h4 class="module_switch"><a href="" title="<?php _e('Show/hide additional information', 'byobscft'); ?>"><span class="pos">+</span><span class="neg">&#8211;</span></a><?php _e('Content Width', 'byobscft'); ?></h4>
                        <div class="more_info">
                            <p><?php _e('Specify a custom width for the content', 'byobscft'); ?></p>
                            <p class="form_input add_margin">
                                <input type="text" class="short" name="byobscft_options[shopp_content_width]" value="<?php echo $options['shopp_content_width']; ?>" />
                                <label for="byobscft_options[shopp_content_width]" class="inline"><?php _e('Enter the desired width (in pixels) - <strong>Numerals Only</strong>', 'thesis'); ?> </label>
                            </p>
                        </div>
                    </div>
                    <div class="module_subsection">
                        <h4 class="module_switch"><a href="" title="<?php _e('Show/hide additional information', 'byobscft'); ?>"><span class="pos">+</span><span class="neg">&#8211;</span></a><?php _e('Sidebar Width', 'byobscft'); ?></h4>
                        <div class="more_info">
                            <p><?php _e('Specify a custom width for the sidebar', 'byobscft'); ?></p>
                            <p class="form_input add_margin">
                                <input type="text" class="short" name="byobscft_options[shopp_sidebar_width]" value="<?php echo $options['shopp_sidebar_width']; ?>" />
                                <label for="byobscft_options[shopp_sidebar_width]" class="inline"><?php _e('Enter the desired width (in pixels) - <strong>Numerals Only</strong>', 'byobscft'); ?> </label>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
                
                <div class="options_module" id="thesis-features">
                    <h3><?php _e('Thesis Features on Shopp Pages', 'byobscft'); ?></h3>
                    <p><?php _e('Remove Thesis features from the Shopp pages.', 'byobscft'); ?></p>
                    
                    <div class="module_subsection">
                        <h4 class="module_switch"><a href="" title="<?php _e('Show/hide additional information', 'byobscft'); ?>"><span class="pos">+</span><span class="neg">&#8211;</span></a><?php _e('Comments', 'byobscft'); ?></h4>
                        <div class="more_info">
                            <p><?php _e('Remove Comments', 'byobscft'); ?></p>
                            <ul class="column_structure" id="_background_transparent">
                                <li>
                                    <input name="byobscft_options[hide_comments]" type="checkbox" value="1" <?php if (isset($options['hide_comments'])) { checked('1', $options['hide_comments']); } ?> /><label><?php _e(' Remove comments from product pages', 'byobscft'); ?></label><br />
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="module_subsection">
                        <h4 class="module_switch"><a href="" title="<?php _e('Show/hide additional information', 'byobscft'); ?>"><span class="pos">+</span><span class="neg">&#8211;</span></a><?php _e('Post Navigation', 'byobscft'); ?></h4>
                        <div class="more_info">
                            <p><?php _e('Remove the Thesis Post Navigation', 'byobscft'); ?></p>
                            <ul class="column_structure" id="_background_transparent">
                                <li>
                                    <input name="byobscft_options[hide_post_nav]" type="checkbox" value="1" <?php if (isset($options['hide_post_nav'])) { checked('1', $options['hide_post_nav']); } ?> /><label><?php _e(' Remove post navigation from product pages', 'byobscft'); ?></label><br />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="module_subsection">
                        <h4 class="module_switch"><a href="" title="<?php _e('Show/hide additional information', 'byobscft'); ?>"><span class="pos">+</span><span class="neg">&#8211;</span></a><?php _e('Page Titles', 'byobscft'); ?></h4>
                        <div class="more_info">
                            <p><?php _e('Remove Page Titles from selected pages', 'byobscft'); ?></p>
                            
                            <ul class="column_structure" id="_background_transparent">
                                <?php
                                
                                foreach ($shop_pages as $page){
                                    $name = $page['name'];
                                    $label = $page['label'];
                                    ?>
                                    <li>
                                        <input name="byobscft_options[hide_<?php echo $name; ?>_page_titles]" type="checkbox" value="1" <?php if (isset($options['hide_' . $name . '_page_titles'])) { checked('1', $options['hide_' . $name . '_page_titles']); } ?> /><label><?php _e($label, 'byobscft'); ?></label><br />
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
             </div>

        </form>
    </div>

    <?php	
//     print_r($options);           

}



// Sanitize and validate input. Accepts an array, return a sanitized array.
function byobscft_validate_options($input) {
    global $thesis_design;
        
    
    // validate use shopp sidebars
    $input['use_shop_sidebar'] = apply_filters('byobscft_sanitize_checkbox', $input['use_shop_sidebar']);
    
    // validate which sidebars to use on each page
    $shop_pages = array('account', 'cart', 'catalog', 'checkout', 'collection', 'confirm',' frontpage', 'product', 'taxonomy', 'thanks');
    
    foreach($shop_pages as $page){
        $input[$page] = apply_filters('byobscft_sanitize_sidebars', $input[$page]);
    }
    
    
    // validate use adjust content and sidebar widths
    $input['adjust_widths'] = apply_filters('byobscft_sanitize_checkbox', $input['adjust_widths']);
    
    // validate widths
    $input['shopp_content_width'] = filter_var($input['shopp_content_width'], FILTER_VALIDATE_INT, array("options" => array("min_range"=>100, "max_range"=>1200)));
    $input['shopp_sidebar_width'] = filter_var($input['shopp_sidebar_width'], FILTER_VALIDATE_INT, array("options" => array("min_range"=>100, "max_range"=>600)));

    // validate remove comments
    $input['hide_comments'] = apply_filters('byobscft_sanitize_checkbox', $input['hide_comments']);
    
    // validate remove post nav
    $input['hide_post_nav'] = apply_filters('byobscft_sanitize_checkbox', $input['hide_post_nav']);
    
    // validate remove shopp page titles
    foreach ($shop_pages as $page){
        
        $input['hide_' . $page . '_page_titles'] = apply_filters('byobscft_sanitize_checkbox', $input['hide_' . $page . '_page_titles']);
    }
    
    // calculate default content width    
    $default_width = $thesis_design->layout['widths']['content'];
    $input['default_content_width'] = byobscft_calculate_content_width( $default_width );
    
    if($thesis_design->layout['columns'] == 3){
        $default_width = $thesis_design->layout['widths']['sidebar_1'] + $thesis_design->layout['widths']['sidebar_2'];
        $input['default_sidebar_width'] = byobscft_calculate_sidebar_width( $default_width );
    }
    
    // calculate shopp content and sidebar widths
    if($input['adjust_widths'] == '1'){
        
        if ($input['shopp_content_width'] != ''){
            $input['shopp_adjusted_content_width'] = byobscft_calculate_content_width( $input['shopp_content_width'] );
        }
        
        if ($input['shopp_sidebar_width'] != ''){
            $input['shopp_adjusted_sidebar_width'] = byobscft_calculate_sidebar_width( $input['shopp_sidebar_width'] );
        }        
    }
     
    return $input;

}

/**
 * Place an explicit value in the checkbox.
 *
 * @param    string    the value of the input.
 * @return   string
 *
 */
function byobscft_sanitize_checkbox($input) {
    if ($input) {
        $output = "1";
    } else {
        $output = "0";
    }
    return $output;
}

add_filter('byobscft_sanitize_checkbox', 'byobscft_sanitize_checkbox');

function byobscft_sanitize_sidebars($value) {
    $recognized = byobscft_recognized_sidebars();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('byobscft_default_sidebar', current($recognized));
}

add_filter('byobscft_which_sidebar', 'byobscft_sanitize_sidebars');

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function byobscft_recognized_sidebars() {
    $default = array(        
        'shopp_sidebar' => 'Shopp Sidebar',
        'no_sidebars' => 'No Sidebars',
        'sidebar_1' => 'Sidebar 1'
    );
    return apply_filters('byobscft_recognized_sidebars', $default);
}

function byobscft_calculate_content_width( $default_width ){
    global $thesis_design;
    
    $size = $thesis_design->fonts['sizes']['content'];
    $line_height = $size + 8;

    if ($line_height % 2 == 1){
        $line_height = $line_height - 1;
    }

    $padding = $line_height * 1.5 + 1;
    if(!$thesis_design->layout['order']){
        $adjusted_width = round((($default_width + $padding - 2) / 10),1);
    }else{
        $adjusted_width = round((($default_width + $padding) / 10),1);
    }

    return $adjusted_width;
}

function byobscft_calculate_sidebar_width( $specified_width ){
    global $thesis_design;
    
    $size = $thesis_design->fonts['sizes']['sidebars'];
    $line_height = $size + 2;

    if ($line_height % 2 == 1){
        $line_height = $line_height - 1;
    }

    $padding = $line_height * 1.5;
    $adjusted_width = round((($specified_width + $padding) / 10),1);

    return $adjusted_width;
}