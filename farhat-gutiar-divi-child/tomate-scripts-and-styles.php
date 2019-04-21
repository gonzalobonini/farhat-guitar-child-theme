<?php



function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
    wp_enqueue_style('sidebar-style', get_stylesheet_directory_uri() . '/sidebar-menu/sidebar-menu.css');
    wp_enqueue_style('sidr-style', 'https://cdn.jsdelivr.net/npm/sidr@2.2.1/dist/stylesheets/jquery.sidr.bare.css');
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/js/child.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('sidebar-script', get_stylesheet_directory_uri() . '/sidebar-menu/sidebar-menu.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('sidr', 'https://cdnjs.cloudflare.com/ajax/libs/sidr/2.2.1/jquery.sidr.min.js', array('jquery'), '1.0.0', true);
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
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/js/et-settings-fix.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('admin-style', get_stylesheet_directory_uri() . '/admin.css');
}
