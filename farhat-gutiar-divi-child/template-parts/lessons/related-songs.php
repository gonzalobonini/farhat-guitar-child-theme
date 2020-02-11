<?php 
    $song_id = get_post_meta(get_the_ID(), 'new_lesson_song_id', true);

    $terms = wp_get_post_terms($song_id, 'style', $args);

    $args = array(
        'posts_per_page' => 6,
        'post_type' => 'new_song',
        'orderby' => 'rand',
        'post__not_in' => array($song_id),
        'lang' => 'en'
    );

    $related_songs_query = new WP_Query($args);
    $related_songs = $related_songs_query->posts;
?>

<div class="et_pb_row width-100">
    <div class="et_pb_column et_pb_column_4_4">
        <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left section-title">

            <h3><span style="color: #ff6600;">&nbsp;<?php _e('Related songs:', 'farhat');?></span></h3>
            <hr>

        </div> <!-- .et_pb_text -->
        
        <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left related-songs">

            <div class="row">
                <?php
                    foreach ($related_songs as $song) { ?>
                     
                        <div class="col-md-4 related-song">
                            
                                <a
                                href="<?php echo new_get_first_lesson_permalink($song); ?>"
                                title="<?php echo $song->post_title; ?>">
                                <?php  
                                $thumb = get_default_thumb($song->ID);
                                echo $img = sprintf('<img width="150" height="150" src="%s" class="attachment-thumbnail wp-post-image"  alt="%s">', $thumb, $song->post_title); ?>
                       
                                </a>
                            <br>
                            <a
                                href="<?php echo new_get_first_lesson_permalink($song); ?>"
                                title="<?php echo $song->post_title; ?>">
                                <?php echo $song->post_title; ?>
                            </a>
                    </div>
                    <?php
                    }
                ?>
            </div>
                

        </div> <!-- .et_pb_text -->
    </div> <!-- .et_pb_column -->
</div> <!-- .et_pb_row -->