<?php



function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
  
    wp_enqueue_style('font-awesome', 'https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css'); 
    if(is_single()){
        wp_enqueue_style('sidr-style', 'https://cdn.jsdelivr.net/npm/sidr@2.2.1/dist/stylesheets/jquery.sidr.bare.css');
        wp_enqueue_script( 'jquery-ui-accordion' );
        wp_enqueue_script('sidr', 'https://cdn.jsdelivr.net/npm/sidr@2.2.1/dist/jquery.sidr.min.js', array('jquery'), false, true);    
    }
    wp_enqueue_script('farhat-all', get_stylesheet_directory_uri() . '/assets/js/farhat-all.js', array('jquery'), false, true);
    wp_enqueue_script('google-ads', 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function remove_unnecesary_scripts(){
    wp_dequeue_script( 'magnific-popup' );
    wp_deregister_script( 'magnific-popup' );
    wp_dequeue_script( 'waypoints' );
    wp_deregister_script( 'waypoints' );
    //wp_dequeue_script( 'divi-fitvids' );
    //wp_deregister_script( 'divi-fitvids' );
    wp_dequeue_script( 'divi-custom-script' );
    wp_deregister_script( 'divi-custom-script' );
}
add_filter( 'wp_enqueue_scripts', 'remove_unnecesary_scripts', 20);

add_action('admin_menu', 'et_settings_fix');
function et_settings_fix()
{
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/js/et-settings-fix.js', array('jquery'), '1.0.0', true);
}

add_action('admin_print_styles', 'add_admin_css');
function add_admin_css()
{
    wp_enqueue_style('admin-style', get_stylesheet_directory_uri() . 'assets/css/admin.css');
}
