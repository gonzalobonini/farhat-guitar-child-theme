<?php



function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); 
    wp_enqueue_style('sidr-style', 'https://cdn.jsdelivr.net/npm/sidr@2.2.1/dist/stylesheets/jquery.sidr.bare.css');
    wp_enqueue_script( 'jquery-ui-accordion' );
    wp_enqueue_script('sidr', 'https://cdnjs.cloudflare.com/ajax/libs/sidr/2.2.1/jquery.sidr.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('farhat-all', get_stylesheet_directory_uri() . '/assets/js/farhat-all.js', array('jquery'), '1.0.0', true);
    //wp_enqueue_script('slicknav', get_stylesheet_directory_uri() . '/slicknav/jquery.slicknav.min.js', array('jquery'), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

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
