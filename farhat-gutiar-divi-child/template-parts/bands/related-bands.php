<?php


$genres = get_the_terms(get_the_ID(), 'style');

$genres_names = new_get_array_of_properties($genres, 'name');

$args = array(
    'posts_per_page' => 3,
    'post_type' => 'new_band',
    'tax_query' => array(
      array(
        'taxonomy' => 'style',
        'field' => 'name',
        'terms' => $genres_names,
        'operator' => 'IN'
      )
    ),
    'lang' => $lang,
    'post__not_in' => array(get_the_ID())
  );

  $related_bands_query = new WP_Query($args);


  $related_bands = $related_bands_query->posts;

  wp_reset_postdata(); ?>

  

  <div class="et_pb_row">
  <div class="et_pb_column et_pb_column_4_4">
    <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left related-artists-title section-title">
      <?php _e('Related Artists', 'farhat'); ?>
    </div> <!-- .et_pb_text --><div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left related-bands">

      <ul class="lcp_catlist" id="lcp_instance_0">
        <?php
        foreach ($related_bands as $band) {
            ?>
          <li><a href="<?php echo get_the_permalink($band); ?>"
                 title="<?php echo $band->post_title ?>"><?php echo $band->post_title ?></a> <a
              href="<?php echo get_the_permalink($band); ?>"
              title="<?php echo $band->post_title ?>"><img width="144" height="95"
                                                           src="<?php echo new_get_featured_image_link($band); ?>"
                                                           class="attachment-thumbnail wp-post-image"
                                                           alt="AC:DC2_145_95"></a></li>
        <?php
        }
        ?>

      </ul>

    </div> <!-- .et_pb_text -->
  </div> <!-- .et_pb_column -->
</div> <!-- .et_pb_row -->

