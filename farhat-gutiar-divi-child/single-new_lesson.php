<?php get_header(); ?>

<div id="main-content" class="lesson">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
			<?php while (have_posts()) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') {
    echo(et_get_option('divi_integration_single_top'));
} ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>
                        <?php
                            $debug = false;
                            $is_lesson = true;
                            $song_id = get_post_meta(get_the_ID(), 'new_lesson_song_id', true);
                            $song = get_post($song_id);

                            $band_id = get_post_meta($song_id, 'new_song_band_id', true);
                            $band = get_post($band_id);

                            $args = array(
                                'post_type' => 'new_lesson',
                                'orderby' => 'date',
                                'order'   => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'new_lesson_song_id',
                                        'value' => $song_id,
                                        'compare' => '=',
                                    )
                                )
                            );
                            $other_lessons = new WP_Query($args);
                            $args = array('orderby' => 'rand', 'fields' => 'all');

                            if ($debug) {
                                var_dump($song);
                                var_dump($band);
                                var_dump($related_songs);
                            }

                            $cart_link = get_post_meta(get_the_ID(), 'new_lesson_cart_link', true);
                            $tabs_link = get_post_meta(get_the_ID(), 'new_lesson_download_tabs', true);
                            $terms = wp_get_post_terms($song_id, 'style');


                        ?>
                           


                        <div class="entry-content">
                        

                            <div class="et_pb_section video-section et_section_regular">

                            <div class="row"> 
                                    <?php get_template_part('template-parts/lessons/video-container'); ?>        
                                    <header>
                                        <span class="lesson-song-name"><?php echo $band->post_title ?></span>|
                                        <span class="lesson-title"><?php echo $song->post_title ?></span>
                                        <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left">
                                                <strong><span style="color: #ff6600;">&nbsp;<?php _e('Style:', 'farhat');?><span style="color: #000000;">&nbsp;</span></span></strong><span style="color: #ff6600;"><span style="color: #000000;">
                                                                <?php	echo new_get_separeted_by_commas_list($terms);
                                                                ?>
                                                </span></span> &nbsp; &nbsp;
                                        </div> <!-- .et_pb_text -->
                                  </header>
                                    <div class="entry-content tablatura">
                                        <?php
                                        the_content();
                                        ?>
                                    </div> <!-- .entry-content -->                                               
                            </div>
                            

                            </div> <!-- .et_pb_section -->
                            
                            <div class="et_pb_section et_section_regular">
                            <div class="row"> 
                                <div class="col-md-3">
                                    <?php include('left-bar.php'); ?>
                                </div>
                                <div class="col-md-7">
                                 
                                    <?php get_template_part('template-parts/lessons/related-songs'); ?>
                                </div> 
                                <div class="col-md-2">
                                    <div class="ad-right"> 
                                                
                                        <?php 
                                            $detect = get_mobile_detect();

                                            if ( is_active_sidebar( 'right-ad' ) && !$detect->isMobile() && !$detect->isTablet()) { ?>
                                                <?php dynamic_sidebar('right-ad'); ?>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div> <!-- row -->
                            </div> <!-- .et_pb_section -->
                        </div> <!-- .entry-content -->


                    </article>



<!-- content ends -->
				<?php
                    if (! post_password_required()) :

                        et_divi_post_meta();

                        $thumb = '';

                        $width = (int) apply_filters('et_pb_index_blog_image_width', 1080);

                        $height = (int) apply_filters('et_pb_index_blog_image_height', 675);
                        $classtext = 'et_featured_image';
                        $titletext = get_the_title();
                        $thumbnail = get_thumbnail($width, $height, $classtext, $titletext, $titletext, false, 'Blogimage');
                        $thumb = $thumbnail["thumb"];

                        $post_format = get_post_format();

                        if ('video' === $post_format && false !== ($first_video = et_get_first_video())) {
                            printf(
                                '<div class="et_main_video_container">
									%1$s
								</div>',
                                $first_video
                            );
                        } elseif (! in_array($post_format, array( 'gallery', 'link', 'quote' )) && 'on' === et_get_option('divi_thumbnails', 'on') && '' !== $thumb) {
                            print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height);
                        } elseif ('gallery' === $post_format) {
                            et_gallery_images();
                        }
                    ?>

					<?php
                        $text_color_class = et_divi_get_post_text_color();

                        $inline_style = et_divi_get_post_bg_inline_style();

                        switch ($post_format) {
                            case 'audio':
                                printf(
                                    '<div class="et_audio_content%1$s"%2$s>
										%3$s
									</div>',
                                    esc_attr($text_color_class),
                                    $inline_style,
                                    et_pb_get_audio_player()
                                );

                                break;
                            case 'quote':
                                printf(
                                    '<div class="et_quote_content%2$s"%3$s>
										%1$s
									</div> <!-- .et_quote_content -->',
                                    et_get_blockquote_in_content(),
                                    esc_attr($text_color_class),
                                    $inline_style
                                );

                                break;
                            case 'link':
                                printf(
                                    '<div class="et_link_content%3$s"%4$s>
										<a href="%1$s" class="et_link_main_url">%2$s</a>
									</div> <!-- .et_link_content -->',
                                    esc_url(et_get_link_url()),
                                    esc_html(et_get_link_url()),
                                    esc_attr($text_color_class),
                                    $inline_style
                                );

                                break;
                        }

                    endif;
                ?>


					<?php
                    if (et_get_option('divi_468_enable') == 'on') {
                        echo '<div class="et-single-post-ad">';
                        if (et_get_option('divi_468_adsense') <> '') {
                            echo(et_get_option('divi_468_adsense'));
                        } else {
                            ?>
							<a href="<?php echo esc_url(et_get_option('divi_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a>
				<?php
                        }
                        echo '</div> <!-- .et-single-post-ad -->';
                    }
                ?>

					<?php
                        if ((comments_open() || get_comments_number()) && 'on' == et_get_option('divi_show_postcomments', 'on')) {
                            comments_template('', true);
                        }
                    ?>
				</article> <!-- .et_pb_post -->

				<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') {
                        echo(et_get_option('divi_integration_single_bottom'));
                    } ?>
			<?php endwhile; ?>
			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php require_once('template-parts/lessons/player-js.php'); ?>
<?php get_footer(); ?>
