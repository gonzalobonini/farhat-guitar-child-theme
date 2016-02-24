<?php


add_action( 'init', 'create_tomate_band' );
function create_tomate_band() {
    register_post_type( 'tomate_band',
        array(
            'labels' => array(
                'name' => __( 'Bands Plus' ),
                'singular_name' => __( 'Band Plus' )
            ),
            'supports' => array('title', 'thumbnail', 'categories'),
            'public' => true,
            'has_archive' => true,
            'taxonomies' => array('post_tag')
        )
    );
}


/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'tomate_band_save', 10, 2 );
// Add the Lessons Meta Boxes

function add_tomate_band_metaboxes() {
    add_meta_box(
        'lesson_meta_box',       // $id
        'Lesson data',                  // $title
        'tomate_band_style',  // $callback
        'tomate_band',                 // $page
        'normal',                  // $context
        'high'                     // $priority
    );
}


add_action( 'add_meta_boxes', 'add_tomate_band_metaboxes' );

// The Event Location Metabox

function tomate_band_style() {
    global $post;

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'tomate_band_save_meta_box_data', 'tomate_band_meta_box_nonce' );

    print_html_for_meta($post, "band_origin", "Origin");
    print_html_for_meta($post, "band_active", "Active");
    print_html_for_meta($post, "band_website", "Website");


}

/* Save the meta box's post metadata. */
function tomate_band_save( $post_id, $post ) {
    $post_type = "tomate_band";

    tomate_update_post_meta($post_id, "band_origin", $post_type);
    tomate_update_post_meta($post_id, "band_active", $post_type);
    tomate_update_post_meta($post_id, "band_website", $post_type);

}