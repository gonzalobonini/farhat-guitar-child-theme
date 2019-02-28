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
                            $terms = wp_get_post_terms($song_id, 'Style', $args);


                            $args = array(
                                'posts_per_page' => 3,
                                'post_type' => 'new_song',
                                'orderby' => 'rand',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'Style',
                                        'field' => 'name',
                                        'terms' => new_get_separeted_by_commas_list(array($terms[0])),
                                        'operator' => 'IN'
                                    )
                                )
                            );

//                            $args = array(
//                                'post_type' => 'new_song',
//                                'orderby' => 'rand',
//                                'meta_query' => array(
//                                    array(
//                                        'key' => 'new_song_band_id',
//                                        'value' => $band_id,
//                                        'compare' => '=',
//                                    )
//                                )
//                            );

                            $related_songs_query = new WP_Query($args);
                            $related_songs = $related_songs_query->posts;

                            if ($debug) {
                                var_dump($song);
                                var_dump($band);
                                var_dump($related_songs);
                            }

                            $cart_link = get_post_meta(get_the_ID(), 'new_lesson_cart_link', true);
                            $tabs_link = get_post_meta(get_the_ID(), 'new_lesson_download_tabs', true);
                            $video_link = get_post_meta(get_the_ID(), 'new_lesson_video', true);

                        ?>
												<header>
													<span class="lesson-song-name"><?php echo $band->post_title ?></span>|
													<span class="lesson-title"><?php echo $song->post_title ?></span>
													<div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left">
															<strong><span style="color: #ff6600;">&nbsp;Style:<span style="color: #000000;">&nbsp;</span></span></strong><span style="color: #ff6600;"><span style="color: #000000;">
																			<?php	echo new_get_separeted_by_commas_list($terms);
                                                                            ?>
															</span></span> &nbsp; &nbsp;
													</div> <!-- .et_pb_text -->
												</header>


                        <div class="entry-content">
                            <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left tab-container">

                              <div class="entry-content tablatura">
                                <?php
                                the_content();

                                wp_link_pages(array( 'before' => '<div class="page-links">' . __('Pages:', 'Divi'), 'after' => '</div>' ));
                                ?>
                              </div> <!-- .entry-content -->
                            </div>


														<a id="simple-menu" class="toggle-sidebar" href="#sidr"><i class="fa fa-music"></i></a>

														<div class="et_pb_section video-section et_section_regular">
															<div class="" id="sidr">
																<div class="et_pb_column et_pb_column_1_4 left-bar-container">
																	<?php include "left-bar.php"; ?>
																</div>
															</div>

                                <div class="et_pb_row">
                                    <div class="et_pb_column et_pb_column_3_4 row-video-container">
                                        <!-- the player -->
                                        <div id="flowplayer"
                                             class="flowplayer functional is-ready is-paused is-finished is-playing is-mouseout"
                                             data-swf="flowplayer.swf" data-ratio="0.4167"
                                             style="z-index: 9; background-size: cover;">
                                            <video
                                                src="<?php echo $video_link; ?>"
                                                type="video/mp4" class="fp-engine" autoplay="autoplay" preload="none"
                                                x-webkit-airplay="allow"></video>
                                            <div class="buttons">
                                                <span>0.5x</span><span>0.6x</span><span>0.7x</span><span>0.8x</span><span>0.9x</span>
                                                <span class="active">1x</span></div>
                                            <div class="fp-ratio"></div>
                                            <div class="fp-ui">
                                                <div class="fp-waiting"><em></em><em></em><em></em></div>
                                                <a class="fp-fullscreen"></a> <a class="fp-unload"></a>

                                                <p class="fp-speed"></p>

                                                <div class="fp-controls"><a class="fp-play"></a>

                                                    <div class="fp-timeline">
                                                        <div class="fp-buffer" style="width: 100%;"></div>
                                                        <div class="fp-progress"
                                                             style="width: 100%; overflow: hidden;"></div>
                                                    </div>
                                                    <div class="fp-volume"><a class="fp-mute"></a>

                                                        <div class="fp-volumeslider">
                                                            <div class="fp-volumelevel" style="width: 32%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fp-time"><em class="fp-elapsed">00:20</em> <em
                                                        class="fp-remaining">-00:00</em> <em
                                                        class="fp-duration">00:20</em></div>
                                                <div class="fp-message"><h2></h2>

                                                    <p></p></div>
                                            </div>
                                            <div class="fp-help"><a class="fp-close"></a>

                                                <div class="fp-help-section fp-help-basics"><p><em>space</em>play /
                                                        pause</p>

                                                    <p><em>esc</em>stop</p>

                                                    <p><em>f</em>fullscreen</p>

                                                    <p><em>shift</em> + <em>←</em><em>→</em>slower / faster
                                                        <small>(latest Chrome and Safari)</small>
                                                    </p>
                                                </div>
                                                <div class="fp-help-section"><p><em>↑</em><em>↓</em>volume</p>

                                                    <p><em>m</em>mute</p></div>
                                                <div class="fp-help-section"><p><em>←</em><em>→</em>seek</p>

                                                    <p><em>&nbsp;. </em>seek to previous </p>

                                                    <p><em>1</em><em>2</em>…<em>6</em> seek to 10%, 20%, …60% </p></div>
                                            </div>
                                            <a href="http://flowplayer.org"
                                               style="display: none; position: absolute; left: 16px; bottom: 36px; z-index: 99999; width: 100px; height: 20px; background-image: url(&quot;//d32wqyuo10o653.cloudfront.net/logo.png&quot;);"></a>
                                        </div>

	                                    <div class="et_pb_row width-100">
		                                    <div class="et_pb_column et_pb_column_4_4">
			                                    <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left section-title">

				                                    <h3><span style="color: #ff6600;">&nbsp;Related songs</span></h3>
				                                    <hr>

			                                    </div> <!-- .et_pb_text --><div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left related-songs">

				                                    <div>
					                                    <ul class="lcp_catlist" id="lcp_instance_0">
						                                    <?php
                                                            for ($i=0; ($i< count($related_songs)) && ($i<5); $i++) {
                                                                ?>
							                                    <li><a
									                                    href="<?php echo new_get_first_lesson_permalink($related_songs[$i]); ?>"
									                                    title="<?php echo $related_songs[$i]->post_title; ?>">
									                                    <img width="150" height="150"
									                                         src="<?php echo new_get_featured_image_link($related_songs[$i]); ?>"
									                                         class="attachment-thumbnail wp-post-image"
									                                         alt="AC:DC_jailbreak_140_95"></a>
								                                    <br>
								                                    <a
									                                    href="<?php echo new_get_first_lesson_permalink($related_songs[$i]); ?>"
									                                    title="<?php echo $related_songs[$i]->post_title; ?>">
									                                    <?php echo $related_songs[$i]->post_title; ?>
								                                    </a>
							                                    </li>
						                                    <?php
                                                            }
                                                            ?>


					                                    </ul>
				                                    </div>

			                                    </div> <!-- .et_pb_text -->
		                                    </div> <!-- .et_pb_column -->
	                                    </div> <!-- .et_pb_row -->
                                    </div>
	                                <div class="et_pb_column et_pb_column_1_4 right-banner-lesson-container">
		                                <script src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" async=""></script>
		                                <!-- Adaptable -->
		                                <ins class="adsbygoogle" style="display: block;" data-ad-client="ca-pub-1247097506454706" data-ad-slot="9146739595" data-ad-format="auto"></ins>
		                                <script>// <![CDATA[
			                                (adsbygoogle = window.adsbygoogle || []).push({});
			                                // ]]></script>
	                                </div>
                                </div>
                                <!-- .et_pb_row -->

                            </div> <!-- .et_pb_section --><div class="et_pb_section et_section_regular">





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

<?php get_footer(); ?>
