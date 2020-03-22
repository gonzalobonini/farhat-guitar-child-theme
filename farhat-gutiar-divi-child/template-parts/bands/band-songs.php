
<div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left band-songs-title section-title">
            Songs
</div> <!-- .et_pb_text -->

<?php 
//$original_post = pll_get_post(get_the_ID(),'en');
$original_post = get_the_ID();
$songs = new_get_children_songs($original_post); ?>
<div class="row"> 
<?php 
foreach ($songs as $song) {     ?>
    <div class="col-md-4 col-xs-12">
        <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left song-lessons-list">

            <div class="item-song-header"><a title="<?php echo $song->post_title; ?>" href="<?php echo new_get_first_lesson_permalink($song); ?>"><img class="alignnone  wp-image-1588" src="<?php echo new_get_featured_image_link($song); ?>" alt="220px" width="105" height="105"></a></div>
            <div class="item-song-title">
                <h3><?php echo $song->post_title; ?></h3>
            </div>
            <div class="part-songs-list">
                <ul class="lcp_catlist" id="lcp_instance_0">
                    <?php
                    $lessons = new_get_children_lessons($song);
                    foreach ($lessons as $lesson) {
                    ?>
                    <li>
                        <a href="<?php echo get_the_permalink($lesson); ?>"
                            title="Lesson <?php echo get_post_meta($lesson->ID, 'new_lesson_number', true); ?>">
                            <?php _e('Lesson ', 'farhat'); ?> <?php echo get_post_meta($lesson->ID, 'new_lesson_number', true); ?>
                        </a>
                    </li>
                        <?php
                    } ?>
                </ul>
            </div>

        </div> <!-- .et_pb_text --><!-- .et_pb_text -->
    </div>
    <?php } ?>
</div>
