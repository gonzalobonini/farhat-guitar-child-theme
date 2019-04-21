<?php

/* This is done just in case user arrives to a song template */

while ( have_posts() ) : the_post();
    $args = array(
        'post_type' => 'new_lesson',
        'orderby' => 'date',
        'order'   => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'new_lesson_song_id',
                'value' => get_the_ID(),
                'compare' => '=',
            )
        )
    );
    $other_lessons = new WP_Query($args);
    $first_lesson = $other_lessons->posts[0];


// Permanent redirection
header("HTTP/1.1 301 Moved Permanently");
header("Location: " . get_permalink ($first_lesson->ID));
exit();
endwhile;