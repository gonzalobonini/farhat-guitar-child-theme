<?php


/* Lesson */

add_action( 'init', 'create_tomate_lesson' );
function create_tomate_lesson() {
    register_post_type( 'tomate_lesson',
        array(
            'labels' => array(
                'name' => __( 'Lessons Plus' ),
                'singular_name' => __( 'Lesson Plus' ),
                'supports' => array('title', 'editor')
            ),
            'public' => true,
            'has_archive' => true
        )
    );
}

add_action( 'add_meta_boxes', 'add_tomate_lesson_metaboxes' );

/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'tomate_lesson_save', 10, 2 );
// Add the Lessons Meta Boxes

function add_tomate_lesson_metaboxes() {
    add_meta_box(
        'lesson_meta_box',       // $id
        'Lesson data',                  // $title
        'tomate_lesson_style',  // $callback
        'tomate_lesson',                 // $page
        'normal',                  // $context
        'high'                     // $priority
    );

}

// The Event Location Metabox

function tomate_lesson_style() {
    global $post;

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'tomate_lesson_save_meta_box_data', 'tomate_lesson_meta_box_nonce' );

    print_html_for_meta($post, 'lesson_song_id', 'Song ID');

    print_html_for_meta($post, 'lesson_video', 'Video Link', 'link');
    print_html_for_meta($post, 'lesson_cart_link', 'Cart Link', 'link');
    print_html_for_meta($post, 'lesson_download_tabs', 'Download Tabs Link', 'link');

}

/* Save the meta box's post metadata. */
function tomate_lesson_save( $post_id, $post ) {
    write_log("guardando lección...");
    $post_type = "tomate_lesson";

    tomate_update_post_meta($post_id, "lesson_song_id", $post_type);
    tomate_update_post_meta($post_id, "lesson_video", $post_type, 'link');
    tomate_update_post_meta($post_id, "lesson_cart_link", $post_type, 'link');
    tomate_update_post_meta($post_id, "lesson_download_tabs", $post_type, 'link');

}