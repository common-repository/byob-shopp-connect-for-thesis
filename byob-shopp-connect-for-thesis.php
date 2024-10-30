<?php
/*
 Plugin Name: BYOB Shopp Conncect for Thesis
 Plugin URI: http://www.byobwebsite.com/plugins/byob-shopp-connect-for-thesis/
 Description: This plugin adds the Thesis SEO and Multimedia box to Shopp products.  With it you can specify custom meta titles and descriptions, you can specify custom body class and you can specify product specific cotent for the Multimedia Box.  You can also create a sidebar for use only on Shopp pages and can choose which sidebar configuration to use on each page.  <strong>It reguires Thesis 1.8 or above and Shopp 1.2 or above.</strong>
 Version: 1.0
 Author: Rick Anderson
 Author URI: http://www.byobwebsite.com/about/
 License: GPLv2
 Date: June 17, 2012
 */

/*  Copyright 2012 Rick Anderson - email rick@byobwebsite.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// ------------------------------------------------------------------------
// PLUGIN PREFIX:                                                          
// ------------------------------------------------------------------------


// 'byobscft_' prefix is derived from [byob][s]hopp [c]onnect [f]or [t]hesis

// ------------------------------------------------------------------------
// REGISTER HOOKS & CALLBACK FUNCTIONS:                                    
// ------------------------------------------------------------------------

if(is_admin()){
    require_once 'byobscft_delete_plugin.php';
    require_once 'admin/byobscft_admin.php';
    require_once 'admin/byobscft_options.php';
    require_once 'admin/byobscft_thesis_post_meta.php';
}


require_once 'includes/byobscft_sidebars.php';
require_once 'includes/byobscft_sidebar_html.php';
require_once 'includes/byobscft_shopp_page_html.php';
require_once 'includes/byobscft_write_css.php';


define( 'BYOBSCFT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BYOBSCFT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


// ------------------------------------------------------------------------
// REGISTER HOOKS & CALLBACK FUNCTIONS:                                    
// ------------------------------------------------------------------------


// Set-up Hooks
register_activation_hook(__FILE__, 'byobscft_plugin_startup');
register_deactivation_hook(__FILE__, 'byobscft_deactivate');
register_uninstall_hook(__FILE__, 'byobscft_delete_plugin_options');
add_action('admin_init', 'byobscft_init' );
add_action('admin_menu', 'byobscft_add_options_page');

load_plugin_textdomain( 'byobscft', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');


// --------------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_deactivation_hook(__FILE__, 'byobscft_deactivate')
// --------------------------------------------------------------------------------------

// Delete the CSS file stuff when plugin deactivated
function byobscft_deactivate() {
    
    // Delete CSS from byob-custom.css
    // byobscft_delete_css();
}


// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_activation_hook(__FILE__, 'byobscft_plugin_startup')
// ------------------------------------------------------------------------------

// Check WordPress and Thesis Versions
function byobscft_plugin_startup() {
    global $wp_version;
    global $thesis;
    
    /* Checks WP version */

    if(version_compare($wp_version, "3.0", "<")){   //Check for WP version at least 2.9
        deactivate_plugins(basename (__FILE__));
        wp_die (__('This plugin requires WordPress version 3.0 or higher.', 'byobscft'));
    }

    /* Checks for Thesis */

    $theme_name = get_current_theme();   
    $pos = strrpos($theme_name, "Thesis");
    if ($pos === false){
        deactivate_plugins(basename (__FILE__));
        wp_die (__('This plugin only works with the <strong>Thesis Theme</strong> version 1.8 or higher.', 'byobscft'));

    }
    
    /* Checks Thesis version */
    
    $thesis_theme_version = thesis_version();
    if ($thesis_theme_version < '1.8'){
        deactivate_plugins(basename (__FILE__));
        wp_die (__('This plugin requires Thesis 1.8 or higher.', 'byobscft'));
    }
    
    /* Checks Shopp version */
    
    
    if (SHOPP_VERSION < '1.2'){
        deactivate_plugins(basename (__FILE__));
        wp_die (__('This plugin requires Shopp 1.2 or higher.', 'byobscft'));
    }
    /* Sets Options Defaults */
    
    byobscft_plugin_option_defaults();
       
}

function byobscft_shop_page_list(){
    $shop_pages = array('account' => array(
                                            'name' => 'account',
                                            'slug' => 'is_account_page',
                                            'label' => 'Customer Account Page',
                                            'description' => 'This is where a customer manages their own account information'
                                            ),
                        'cart' => array(
                                            'name' => 'cart',
                                            'slug' => 'is_cart_page',
                                            'label' => 'Cart Page',
                                            'description' => 'The shopping cart page'
                        ),
                        'catalog' => array(
                                            'name' => 'catalog',
                                            'slug' => 'is_catalog_page',
                                            'label' => 'Catalog Page',
                                            'description' => 'All of the various catalog pages'
                        ),                                
                        'checkout' => array(
                                            'name' => 'checkout',
                                            'slug' => 'is_checkout_page',
                                            'label' => 'Checkout Page',
                                            'description' => 'The final checkout page'
                        ),
                        'collection' => array(
                                            'name' => 'collection',
                                            'slug' => 'is_shopp_collection',
                                            'label' => 'Product Collection Pages',
                                            'description' => 'Shows all products in the various Shopp collections'
                        ),                                
                        'confirm' => array(
                                            'name' => 'confirm',
                                            'slug' => 'is_confirm_page',
                                            'label' => 'Confirmation Page',
                                            'description' => 'The checkout confirmation page'
                        ),
                        'frontpage' => array(
                                            'name' => 'frontpage',
                                            'slug' => 'is_catalog_frontpage',
                                            'label' => 'Main Store Catalog Page',
                                            'description' => 'The main front page of the store'
                        ),
                        'product' => array(
                                            'name' => 'product',
                                            'slug' => 'is_shopp_product',
                                            'label' => 'Product Pages',
                                            'description' => 'The pages displaying individual products'
                        ),
                        'taxonomy' => array(
                                            'name' => 'taxonomy',
                                            'slug' => 'is_shopp_taxonomy',
                                            'label' => 'Product Category, Tag and other Taxonomy Pages',
                                            'description' => 'Shows all products in a given Product Category, Tag or custom taxonomy'
                        ),
                        'thanks' => array(
                                            'name' => 'thanks',
                                            'slug' => 'is_thanks_page',
                                            'label' => 'Thank You Page',
                                            'description' => 'The Thank You Page, custonmers are returned here after a purchase is made'
                        )
                );
    
    return $shop_pages;
}
