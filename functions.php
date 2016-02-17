<?php

include_once 'tomate-functions.php';

include_once 'tomate-scripts-and-styles.php';

/* Recibe un Post de post_type tomate_song y devuelve el permalink a de la primer lección */
function tomate_get_first_lesson_permalink($post) {
    if ($post instanceof WP_Post) {
        $post_id = $post->ID;
    } else { // I assume it got an id
        $post_id = $post;
    }
    $args = array(
        'post_type' => 'tomate_lesson',
        'orderby' => 'date',
        'order'   => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'tomate_lesson_song_id',
                'value' => $post_id,
                'compare' => '=',
            )
        )
    );
    $other_lessons = new WP_Query($args);
    $first_lesson = $other_lessons->posts[0];

    return get_permalink ($first_lesson->ID);
}

function tomate_get_children_lessons($song) {

    $args = array(
        'post_type' => 'tomate_lesson',
        'orderby' => 'date',
        'order'   => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'tomate_lesson_song_id',
                'value' => $song->ID,
                'compare' => '=',
            )
        )
    );
    $lessons_query = new WP_Query($args);
    return $lessons_query->posts;
}

function tomate_get_children_songs($band) {
    $args = array(
        'post_type' => 'tomate_song',
        'orderby' => 'date',
        'order'   => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'tomate_song_band_id',
                'value' => $band->ID,
                'compare' => '=',
            )
        )
    );
    $songs_query = new WP_Query($args);
    return $songs_query->posts;
}

if (!function_exists('write_log')) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}


function add_custom_types_to_tax( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

        // Get all your post types
        $post_types = get_post_types();

        $query->set( 'post_type', $post_types );
        return $query;
    }
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );


/* Remove billing details from Woocommerce */

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_city']);
    return $fields;
}

include_once 'tomate-bands.php';

include_once 'tomate-songs.php';

include_once 'tomate-lessons.php';

include_once 'tomate-tags-and-categories.php';


