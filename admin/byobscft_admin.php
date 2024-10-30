<?php

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_init', 'byobscft_init' )
// ------------------------------------------------------------------------------


// Init plugin options to white list our options
function byobscft_init(){
    global $pagenow;
    
    register_setting( 'byobscft_plugin_options', 'byobscft_options', 'byobscft_validate_options' );
    wp_register_style( 'byobscft-options-stylesheet', plugins_url('options.css', __FILE__) );
    
    
    if('admin.php' == $pagenow){
         wp_enqueue_style('byobscft-options-stylesheet');
         wp_enqueue_style('thesis-options-stylesheet', THESIS_CSS_FOLDER . '/options.css');
         wp_enqueue_script('thesis-admin-js', THESIS_SCRIPTS_FOLDER . '/thesis.js');
    }

}


// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_menu', 'byobscft_add_options_page');
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_menu' HOOK FIRES, AND ADDS A NEW OPTIONS
// PAGE FOR YOUR PLUGIN TO THE SETTINGS MENU.
// ------------------------------------------------------------------------------

// Add menu page
function byobscft_add_options_page() {
    global $_registered_pages;
    global $byobscft_options_page;
      $pages = array();
      $pages = $_registered_pages;
    if(!$_registered_pages || !key_exists('toplevel_page_byob-thesis-plugins', $pages)){
        add_menu_page( 'BYOB Thesis Plugins', 'BYOB Thesis Plugins', 'manage_options', 'byob-thesis-plugins','byobscft_render_byob_plugins_page', BYOBSCFT_PLUGIN_URL .'images/byob-icon-small.png');
    }
    $byobscft_options_page = add_submenu_page('byob-thesis-plugins', 'BYOB Shopp Connect for Thesis', 'Shopp Connect', 'manage_options', __FILE__, 'byobscft_render_form');
    
    add_action("load-$byobscft_options_page", 'byobscft_plugin_help_tabs');
    
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------

// Render the Plugin options form


// Render the Plugin options form
function byobscft_render_byob_plugins_page() {
	?>
	<div class="wrap">
		
		<!-- Display Plugin Icon, Header, and Description -->
		<div class="icon32"><img src="<?php echo BYOBSCFT_PLUGIN_URL . 'images/byob-icon.png';?>" /><br></div>
		<h2>BYOB Thesis Thesis Plugins</h2>
                
                <h2>Current Free Plugins Available</h2>
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Thesis Simple Header Widgets</h3>
                <p>This plug allows you to create one or two widget areas in the Thesis header.  Using it any widget can be placed in the Thesis header.
                You can either retain or replace the default Thesis header behavior.  You can also add the Thesis Nav Menu and or the search form to either of the header areas.  You can also
                customize the styles for each of the header areas.</p>
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Thesis Footer Widgets</h3>
                <p>This plugin allows you to create up to 3 rows of widgets, each with a maximum of 5 columns of widgets in the Thesis footer.
                You can mix and match the number of widget columns in each row and can specify the width of each widget column.  You can also
                customize the styling of the widget areas.  This plugin is only available via our Facebook Fan Page</p>
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Shopp Connect for Thesis</h3>
                <p>This plugin adds Thesis SEO and Multimedia box settings to Shopp Products.  It also allows you to create a Shopp specific sidebar and set sidebar display
                 options for each Shopp page.  It also allows you to remove comments, post navigation and page titles from Shopp Pages.</p>
                <br />
                <h4 style="color:orange">Premium members of BYOBWebsite.com have access to a number of specialized plugins for Thesis</h4>
		<p><strong>These plugins have been created in order to extend custom functionality to beginners and to save time for experts</strong></p>
                <p><a href="http://www.byobwebsite.com/plugins/">View a Complete List of Plugins available to members</a></p>
                <p><a href="http://www.byobwebsite.com/forum/">Get support and help using these plugins at our forum</a></p>
                <h2>Current Premium Plugins Available</h2>
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Thesis Feature Box</h3>
                <p>This plug allows you to access the feature box without having to add your own custom programming.  You can<br />
                choose to widgetize it, add custom HTML to it, or activate plugins like the Dynamic Content Gallery.</p>
                
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Thesis Landing Pages</h3>
                <p>This plug allows you to create landing pages by removing the Thesis header, footer and sidebars directly <br />
                from the post or page edit screen</p>
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Thesis Mobile Content Switcher</h3>
                <p>This plug allows you to display content designed specifically for mobile devices on any post or page.  It will automatically detect
                a mobile device and will then replace the non mobile content for the mobile content.  You can have an unlimited number of switched blocks of 
                content on any post or page</p>                
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Thesis Navigation Menu</h3>
                <p>This plug allows you to change a number of the default Thesis settings for the navigation menu.  Using this plugin<br />
                you can locate the menu either above or below the header, make the menu span the full width of the page, center the <br />
                navigation menu, and change default menu text styling.</p>
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Thesis Sub Sidebars</h3>
                <p>This plug allows you to create "Sub Sidebars" that can be placed within either of the default Thesis sidebars.  Once created you
                can select which Sub Sidebars will be displayed on each post or page from the post or page edit screen.  These sidebars will show up in
                your sidebar list and you can drag any widgets into the sidebars.</p>                
                <h3 style="border-top:#dddddd 1px solid;padding-top:10px;">BYOB Thesis WP Menus</h3>
                <p>This plug allows you to create an unlimited number of WordPress menus and place them virtually anywhere on your site.  It also allows
                You to create new menu styles and apply those styles to the new WordPress menus.  The process of creating a new menu style is very much
                the same as styling the Thesis Nav Menu.  It also adds additional styling options for the Thesis Nav Menu.  It can work along side of the 
                BYOB Thesis Nav Menu plugin.</p>
	</div>
	<?php	
}


function byobscft_plugin_help_tabs() {
	global $byobscft_options_page;
	$screen = get_current_screen();
	if($screen->id != $byobscft_options_page)
		return;
 
	$screen->add_help_tab(array(
		'id' => 'byobscfts-overview',
		'title' => __('Overview', 'byobscft'),
		'content' => byobscft_help_tab_content('byobscft-overview')
	));
        $screen->add_help_tab(array(
		'id' => 'byobscfts-thesis-post-meta',
		'title' => __('Thesis SEO and Multimedia Box Settings', 'byobscft'),
		'content' => byobscft_help_tab_content('thesis-post-meta')
	));
	$screen->add_help_tab(array(
		'id' => 'byobscfts-sidebars',
		'title' => __('Sidebars on Shopp Pages', 'byobscft'),
		'content' => byobscft_help_tab_content('sidebars')
	));
	$screen->add_help_tab(array(
		'id' => 'byobscfts-widths',
		'title' => __('Adjust Shop Page Widths', 'byobscft'),
		'content' => byobscft_help_tab_content('widths')
	));
        $screen->add_help_tab(array(
		'id' => 'byobscfts-thesis-features',
		'title' => __('Thesis Features on Shopp Pages', 'byobscft'),
		'content' => byobscft_help_tab_content('thesis-features')
	));
        $screen->add_help_tab(array(
		'id' => 'byobscfts-shopp-pages',
		'title' => __('Shopp Page Descriptions', 'byobscft'),
		'content' => byobscft_help_tab_content('shopp-pages')
	));
        $screen->add_help_tab(array(
		'id' => 'byobscfts-body-classes',
		'title' => __('Shopp Page Body Classes', 'byobscft'),
		'content' => byobscft_help_tab_content('shopp-body-classes')
	));
}


function byobscft_help_tab_content($tab = 'byobscft-overview') {
	if($tab == 'byobscft-overview') {
		ob_start(); ?>
			<h3><?php _e('Using the plugin', 'byobscft'); ?></h3>
			<p>The BYOB Shopp Connect for Thesis plugin allows you to:</p>
                        <ul>
                            <li>Create a Shopp specific sidebar that can be displayed on Shopp pages.  For each Shopp page you can display:
                                <ul>
                                    <li>The Shopp specific sidebar</li>
                                    <li>Sidebar 1</li>
                                    <li>No Sidebars</li>
                                </ul>
                            </li>
                            <li>Customize the widths of the content and sidebar on Shopp specific pages</li>
                            <li>Remove comments from Shopp product pages (they are automatically absent from the rest of the Shopp pages)</li>
                            <li>Remove post navigation from Shopp product pages (they are automatically absent from the rest of the Shopp pages)</li>
                            <li>Remove the Thesis page titles and headline meta from any or all Shopp pages</li>
                            <li>Add Thesis <strong>SEO details and additional style</strong> to Shopp product pages</li>
                            <li>Add Thesis <strong>Multimedia Box settings</strong> to Shopp product pages</li>
                        </ul>
                            
		<?php
		return ob_get_clean();
	} elseif ($tab == 'thesis-post-meta') {
		ob_start(); ?>
			<h3><?php _e('Thesis SEO and Multimedia Box Settings', 'byobscft'); ?></h3>
			<p>This plugin places the familiar Thesis SEO and Multimedia Box settings on Shopp Products</p>
                        <h4>SEO Details and Additional Style</h4>
                        <p>Fill out any or all of the settings and Thesis will apply them to individual Shopp Products.  Remember that well written
                        Meta Titles and Meta Descriptions are essential for good SEO.</p>
                        <h4>Multimedia Box Options</h4>
                        <p>The Thesis Multimedia box options work the same way on Shopp product pages as they do on regular pages and posts.
                        Easily add product specific videos or other content using these settings.</p>
                        
		<?php
		return ob_get_clean();
	} elseif ($tab == 'sidebars') {
		ob_start(); ?>
			<h3><?php _e('Sidebars on Shopp Pages', 'byobscft'); ?></h3>
			<p>Create a Shopp Sidebar and choose which sidebar shows on each of the various Shopp pages</p>
                        <h4>Shopp Specific Sidebar</h4>
                        <p>Check the box to create a Shopp Sidebar that can be placed on the various Shopp pages</p>
                        <h4>The Shopp Pages</h4>
                        <p>For each page you can choose to display:</p>
                        <ul>
                            <li>The Shopp Sidebar</li>
                            <li>No Sidebars</li>
                            <li>Sidebar 1<em><strong>Note:  </strong>This choice will leave your existing default sidebar configuration in tact</em></li>
                        </ul>                        
                        <p><em>NOTE: A full description of each Shopp Page can be found on the <strong>Shopp Page Descriptions</strong> help tab below.</em></p>

		<?php
		return ob_get_clean();
	} elseif ($tab == 'widths') {
		ob_start(); ?>
			<h3><?php _e('Adjust Shop Page Widths', 'byobscft'); ?></h3>
                        <h4>Add Custom Widths?</h4>
			<p>To modify the default content and sidebar widths for your Shopp Pages, check the box and then hit SAVE.  Additional options will be available after you hit save.</p>
                        <h4>Content Width</h4>
                        <p>Enter the new desired width of the content in pixels.</p>
                        <h4>Sidebar Width</h4>
                        <p>Enter the new desired width of the sidebar in pixels.</p>
                        <p><em><strong>NOTE:</strong> The total width of content + sidebars cannot be larger than the total entered in Thesis Design Options.  </em>
                        In other words, if the total of sidebars + content entered in Thesis Design Options is 960 pixels.  The layout will break if the total you enter here
                         is greater than 960.</p>

		<?php
		return ob_get_clean();
	} elseif ($tab == 'thesis-features') {
		ob_start(); ?>
			<h3><?php _e('Thesis Features on Shopp Pages', 'byobscft'); ?></h3>
			<p>You can disable various Thesis page elements on your Shopp pages</p>
                        <h4>Comments</h4>
                        <p>Checking this box will remove the comments form from the Shopp Product pages.  There are no comments by default on Shopp Collection, Shopping Cart or Account pages.</p>
                        <h4>Post Navigation</h4>
                        <p>Checking this box will remove the "Next Post" and "Previous Post" links from the bottom of Shopp Product pages.</p>
                        <h4>Page Titles</h4>
                        <p>Check the box beside each page where you want the Thesis page titles and headline meta not to show.</p>
                        <p><em>NOTE: A full description of each Shopp Page can be found on the <strong>Shopp Page Descriptions</strong> help tab below.</em></p>
		<?php
		return ob_get_clean();
	} elseif ($tab == 'shopp-body-classes') {
		ob_start(); ?>
			<h3><?php _e('Shopp Page Body Classes', 'byobscft'); ?></h3>
			<p>Shopp Page specific body classes are added to all Shopp pages allowing you to write page specific CSS rules.</p>
                        
                        <p>The page classes it adds are account, cart, catalog, checkout, collection, confirm, frontpage, product, taxonomy and thanks.  When a page falls into more than
                         one page category multiple classes will be added.  For example a product is both a product page and a catalog page so it will receive both classes.</p>
                        <p><em>NOTE: A full description of each Shopp Page can be found on the <strong>Shopp Page Descriptions</strong> help tab below.</em></p>
		<?php
		return ob_get_clean();
	} elseif ($tab == 'shopp-pages') {
		ob_start(); ?>
			<h3><?php _e('Shopp Page Descriptions', 'byobscft'); ?></h3>
                        <h4>Customer Account Pages</h4>
                        <p>These pages are all related to the customer accounts and include:</p>
                        <ul>
                            <li>Your Orders</li>
                            <li>My Account</li>
                            <li>Downloads</li>
                        </ul>
                        <h4>Cart Page</h4>
                        <p>This is the page that is displayed when the "Edit Shopping Cart" link is selected</p>
                        <h4>Catalog Pages</h4>
                        <p>These pages are all related to the product catalog and include:</p>
                        <ul>
                            <li>Individual Product Pages</li>
                            <li>The main catalog page</li>
                            <li>Smart Collection pages, including Featured Product, Popular Products, Sale Products, etc</li>
                            <li>Product Category and Tag pages</li>
                        </ul>
                        <h4>Checkout Page</h4>
                        <p>This is the page that is displayed when the "Proceed to Checkout" link is selected</p>
                        <h4>Product Collection Pages</h4>
                        <p>These pages are all related to product collections and include:</p>
                        <ul>                            
                            <li>Smart Collection pages, including Featured Product, Popular Products, Sale Products, etc</li>
                            <li>Product Category and Tag pages</li>
                        </ul>
                        <h4>Confirmation Page</h4>
                        <p>This is the page immediately following the Checkout Page.  In it the final taxes and shipping costs are calculated.</p>
                        <h4>Main Store Catalog Page</h4>
                        <p>This is the main store page.  If the page slugs are their default configuration you can access this page via www.yourwebsite.com/shop/</p>
                        <h4>Product Pages</h4>
                        <p>The page that displays a single individual product</p>
                        <h4>Product Category, Tag and other Taxonomy Pages</h4>
                        <p>These pages are all related to WordPress taxonomies and include:</p>
                        <ul>
                            <li>Product Category and Tag pages</li>
                            <li>Custom taxonomies that may be defined for products</li>
                        </ul>
                        <p><strong>Note:  </strong>This does not include Shopp smart collections</p>
                        <h4>Thank You Page</h4>
                        <p>This is the page the purchaser is returned to upon completion of their purchase.</p>
                        
			
		<?php
		return ob_get_clean();
	} 
}

