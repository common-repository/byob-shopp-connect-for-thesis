<?php

function byobscft_write_sidebar_css_to_head(){
    global $thesis_design;
    $options = get_option('byobscft_options');
    $use_custom_widths = $options['adjust_widths'];
    $float = '';
    
    if($use_custom_widths == '1'){
        
        $content_width = $options['shopp_adjusted_content_width']; 
        $sidebar_width = $options['shopp_adjusted_sidebar_width'];
        if($thesis_design->layout['columns'] == 3){
            $float = ' float:left;';
        }
        
        echo "<style type=\"text/css\" media=\"screen\">.no_sidebars #content{width:" . $content_width . "em;" . $float . "}.no_sidebars #sidebars{width:" . $sidebar_width . "em;}.no_sidebars #sidebar_1{width:100%;}</style> \n";

    }elseif($thesis_design->layout['columns'] == 3){
        
        $content_width = $options['default_content_width'];
        $sidebar_width = $options['default_sidebar_width'];
        echo "<style type=\"text/css\" media=\"screen\">.no_sidebars #content{width:" . $content_width . "em;}.no_sidebars #sidebars{width:" . $sidebar_width . "em;}.no_sidebars #sidebar_1{width:100%;}</style> \n";
        
    }else{
        
        $content_width = $options['default_content_width']; 
        echo "<style type=\"text/css\" media=\"screen\">.no_sidebars #content{width:" . $content_width . "em;}</style> \n";
        
    }     
}

