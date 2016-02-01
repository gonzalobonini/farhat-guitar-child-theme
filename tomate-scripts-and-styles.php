<?php


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
    wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/js/child.js', array('jquery'), '1.0.0', true );
}

add_action( 'admin_menu', 'et_settings_fix' );
function et_settings_fix() {
    wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/js/et-settings-fix.js', array('jquery'), '1.0.0', true );
}

add_action( 'admin_print_styles', 'add_admin_css' );
function add_admin_css() {
    wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/js/et-settings-fix.js', array('jquery'), '1.0.0', true );
    wp_enqueue_style( 'admin-style', get_stylesheet_directory_uri() . '/admin.css');
}