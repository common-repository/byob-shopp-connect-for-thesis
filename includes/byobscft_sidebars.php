<?php

function byobscft_register_shopp_sidebar(){
    register_sidebar(array(
			'name' => 'Shopp Pages Sidebar',
                        'id' => 'shopp_sidebar',
                        'description' => 'This sidebar will only show up on Shopp pages.  Set the pages for it to display in the BYOB Shopp Connect for Thesis plugin options',        
			'before_widget' => '<li class="widget %2$s" id="%1$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
			));
}

