<?php


/* Lesson */

add_action( 'init', 'create_new_lesson' );
function create_new_lesson() {
    register_post_type( 'new_lesson',
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

add_action( 'add_meta_boxes', 'add_new_lesson_metaboxes' );

/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'new_lesson_save', 10, 2 );
// Add the Lessons Meta Boxes

function add_new_lesson_metaboxes() {
    add_meta_box(
        'lesson_meta_box',       // $id
        'Lesson data',                  // $title
        'new_lesson_style',  // $callback
        'new_lesson',                 // $page
        'normal',                  // $context
        'high'                     // $priority
    );

}

// The Event Location Metabox

function new_lesson_style() {
    global $post;

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'new_lesson_save_meta_box_data', 'new_lesson_meta_box_nonce' );

    print_html_for_meta($post, 'lesson_song_id', 'Song ID');

    print_html_for_meta($post, 'lesson_video', 'Video Link', 'link');
    print_html_for_meta($post, 'lesson_cart_link', 'Cart Link', 'link');
    print_html_for_meta($post, 'lesson_download_tabs', 'Download Tabs Link', 'link');

}

/* Save the meta box's post metadata. */
function new_lesson_save( $post_id, $post ) {
    write_log("guardando lección...");
    $post_type = "new_lesson";

    new_update_post_meta($post_id, "lesson_song_id", $post_type);
    new_update_post_meta($post_id, "lesson_video", $post_type, 'link');
    new_update_post_meta($post_id, "lesson_cart_link", $post_type, 'link');
    new_update_post_meta($post_id, "lesson_download_tabs", $post_type, 'link');

}