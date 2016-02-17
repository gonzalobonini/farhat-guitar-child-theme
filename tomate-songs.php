<?php

/* Song */


add_action( 'init', 'create_tomate_song' );
function create_tomate_song() {
    register_post_type( 'tomate_song',
        array(
            'labels' => array(
                'name' => __( 'Songs Plus' ),
                'singular_name' => __( 'Song Plus' ),
                'add_new' => __( 'Add New Song Plus' ),
                'add_new_item' => __( 'Add New Song Plus' ),
                'edit' => __( 'Edit' ),
                'edit_item' => __( 'Edit Song Plus' ),
                'new_item' => __( 'New Song Plus' ),
                'view' => __( 'View Song Plus' ),
                'view_item' => __( 'View Song Plus' ),
                'search_items' => __( 'Search Song Plus' ),
                'not_found' => __( 'No Song Plus found' ),
                'not_found_in_trash' => __( 'No Song Plus found in Trash' )
            ),
            'supports' => array('title', 'thumbnail', 'categories'),
            'public' => true,
            'has_archive' => true
        )
    );
}

add_action( 'add_meta_boxes', 'add_tomate_song_metaboxes' );

/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'tomate_song_save', 10, 2 );
// Add the Lessons Meta Boxes

function add_tomate_song_metaboxes() {
    add_meta_box(
        'lesson_meta_box',       // $id
        'Lesson data',                  // $title
        'tomate_song_style',  // $callback
        'tomate_song',                 // $page
        'normal',                  // $context
        'high'                     // $priority
    );

}

// The Event Location Metabox

function tomate_song_style() {
    global $post;

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'tomate_song_save_meta_box_data', 'tomate_song_meta_box_nonce' );
    print_html_for_meta($post, 'song_band_id', 'Band ID');
}

/* Save the meta box's post metadata. */
function tomate_song_save( $post_id, $post ) {

    $post_type = "tomate_song";

    tomate_update_post_meta($post_id, "song_band_id", $post_type);

}
