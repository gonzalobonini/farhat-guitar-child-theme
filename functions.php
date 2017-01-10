<?php

include_once 'tomate-functions.php';

include_once 'tomate-scripts-and-styles.php';

function new_get_all_bands($posts_per_page = -1, $orderby = 'post_title', $order = 'ASC') {

  //$bands = apc_fetch('bands');
  $bands = wp_cache_get( 'bands', '');

  if ($bands) {
    return $bands;
  }

  // get all the bands
  $args = array(
      'posts_per_page'   => $posts_per_page,
      'orderby'          => $orderby,
      'order'            => $order,
      'post_type'        => 'new_band',
      'post_mime_type'   => '',
      'post_parent'      => '',
      'post_status'      => 'publish');

  $bands = get_posts( $args );

//  apc_store ( "bands" , $bands, 2628000000);
  wp_cache_add( "bands" , $bands, "", 2628000000);

  return $bands;
}

/* Recibe un Post de post_type new_song y devuelve el permalink a de la primer lección */
function new_get_first_lesson_permalink($post) {
//    echo "<!-- debugging new_get_first_lesson_permalink";
    if ($post instanceof WP_Post) {
        $post_id = $post->ID;
    } else { // I assume it got an id
        $post_id = $post;
    }

  $permalink = wp_cache_get( 'firt-lesson-'.$post->ID, '');

  if ($permalink) {
    return $permalink;
  }

  $args = array(
    'post_type' => 'new_lesson',
    'orderby' => 'date',
    'order'   => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'new_lesson_song_id',
        'value' => $post_id,
        'compare' => '=',
      )
    )
  );
  $other_lessons = new WP_Query($args);
  if (sizeof($other_lessons->posts) == 0) {
    return "";
  }
  $first_lesson = $other_lessons->posts[0];

  $permalink = get_permalink ($first_lesson->ID);

//  apc_store ( "bands" , $bands, 2628000000);
  wp_cache_add( 'firt-lesson-'.$post->ID , $permalink, "", 2628000000);
  return $permalink;
//    echo "post_id";
//    var_dump($post_id);

//    echo "other_lessons->posts";
//    var_dump($other_lessons->posts);
//    echo " -->";

  // no lessons at all
}

function new_get_children_lessons($song) {

    $args = array(
        'post_type' => 'new_lesson',
        'orderby' => 'post_title',
        'order'   => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'new_lesson_song_id',
                'value' => $song->ID,
                'compare' => '=',
            )
        )
    );
    $lessons_query = new WP_Query($args);
    return $lessons_query->posts;
}

function new_get_all_songs() {
    $args = array(
        'post_type' => 'new_song',
        'orderby' => 'date',
        'order'   => 'ASC',
        'nopaging' => true
    );
    $songs_query = new WP_Query($args);
    return $songs_query->posts;
}

function new_get_children_songs($band) {

  $songs = wp_cache_get( 'songs-'.$band->ID, '');

  if ($songs) {
    return $songs;
  }
  $args = array(
    'post_type' => 'new_song',
    'orderby' => 'date',
    'nopaging' => true,
    'order'   => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'new_song_band_id',
        'value' => $band->ID,
        'compare' => '=',
      )
    )
  );
  $songs_query = new WP_Query($args);
//  apc_store ( "bands" , $bands, 2628000000);
  wp_cache_add( "songs-". $band->ID , $songs_query->posts, "", 2628000000);

  return $songs_query->posts;
}

function new_get_band_from_song($song) {
    if (is_int($song)) {
        $id = $song;
    } else {
        $id = $song->ID;
    }
    $band_id = get_post_meta( $id, 'new_song_band_id', true );
    return get_post($band_id);
}

function new_get_song_from_lesson($lesson) {
    if (is_int($lesson)) {
        $id = $lesson;
    } else {
        $id = $lesson->ID;
    }
    $song_id = get_post_meta( $id, 'new_lesson_song_id', true );
    return get_post($song_id);
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

function SearchFilter($query) {
  if ($query->is_search) {
    $query->set('post_type', array('post', 'new_band', 'new_song'));
  }
  return $query;
}

add_filter('pre_get_posts','SearchFilter');

include_once 'tomate-bands.php';

include_once 'tomate-songs.php';

include_once 'tomate-lessons.php';

include_once 'tomate-tags-and-categories.php';


