<?php 
$args = array(
    'posts_per_page'   => 4,
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => 'new_song',
    'lang'             => 'en',
    'post_status'      => 'publish');

$last_songs = get_posts($args); 
$detect = get_mobile_detect();
if (!($detect->isMobile() && !$detect->isTablet())) {
    $last_updates_class = "et_pb_column_2_3";
    $list_updates_class = "et_pb_column_1_3";
} else {
    $last_updates_class = "et_pb_column_3_3";
    $list_updates_class = $last_updates_class;
}
?>

<div class="et_pb_row">
    <div class="et_pb_column <?php echo $last_updates_class ?>">
        <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left latest-uploads">

            <p>
                <?php echo get_post_meta($post->ID, 'update_home', true); ?>
            </p>

        </div>
        <!-- .et_pb_text -->
        <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left bands-list">
            <ul id="lcp_instance_0" class="lcp_catlist">
                <?php

                foreach ($last_songs as $current_song) {
                    $url = new_get_first_lesson_permalink($current_song);
                    $title = $current_song->post_title;
                    ?>
                    <li>
                    <a title="<?php echo $title; ?>" href="<?php echo  $url;?>"><?php echo $title; ?></a> 
                    <a title="<?php echo $title; ?>" href="<?php echo $url; ?>">
                    <img width="105" height="105" alt="Muse_hysteria_cd-105" class="attachment-105x105 size-105x105 wp-post-image" src="<?php echo new_get_featured_image_link($current_song, array(105,105)) ?>">
                    </a>
                    </li>
                    <?php
                }?>

            </ul>
        </div>
        <!-- .et_pb_text -->
    </div>
    <!-- .et_pb_column -->
    <?php         
   
    if (!($detect->isMobile() && !$detect->isTablet())) {
                    ?>
        <div class="et_pb_column et_pb_column_1_3">
            <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left home-side-banner">
                <div>
                    <div id="home-right-banner">
                        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1247097506454706" data-ad-slot="3782497198" data-ad-format="auto"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </div>
            <!-- .et_pb_text -->
        </div>
        <!-- .et_pb_column -->
        <?php
                }
    ?>
</div>
<!-- .et_pb_row -->