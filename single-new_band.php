<?php get_header(); ?>

<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
                <?php
                    $debug = false;

                    $songs = new_get_children_songs(get_post());

                    $genres = get_the_terms( get_the_ID(), 'Style' );

                    $genres_names = new_get_array_of_properties($genres, 'name');



                    $members = get_the_terms( get_the_ID(), 'Member' );

                    $past_members = get_the_terms( get_the_ID(), 'Past Member' );


                    $tags = get_the_terms( get_the_ID(), 'post_tag' );


                    $args = array(
                            'posts_per_page' => 3,
                            'post_type' => 'new_band',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'Style',
                                    'field' => 'name',
                                    'terms' => $genres_names,
                                    'operator' => 'IN'
                                )
                            )
                        );

                    $related_bands_query = new WP_Query($args);



                    $related_bands = $related_bands_query->posts;

                    $origin = get_post_meta( get_the_ID(), 'new_band_origin', true );
                    $active = get_post_meta( get_the_ID(), 'new_band_active', true );
                    $website = get_post_meta( get_the_ID(), 'new_band_website', true );


//                    $i = 0;
//                    $lesson = array();
//                    foreach ($songs as $song) {
//                        $lessons[$i] = new_get_children_lessons($song);
//                        $i++;
//                    }

                    if( $debug ) {
//                            echo "genres_names";
//                            var_dump($genres_names);
//                            echo "genres";
//                            var_dump($genres);
//                            echo "members";
//                            var_dump($members);
//                            echo "past_members";
//                            var_dump($past_members);
//                            echo "tags";
//                            var_dump($tags);
//                            echo "origin";
//                            var_dump($origin);
//                            echo "active";
//                            var_dump($active);
//                            echo "website";
//                            var_dump($website);
                        echo "songs";
                        var_dump($songs);
                        echo "related bands";
                        var_dump($related_bands);
                    }


                    ?>
                            <h1><?php the_title(); ?></h1>



                            <div class="entry-content">
                                <div class="et_pb_section et_section_regular">



                                    <div class="et_pb_row">
                                        <div class="et_pb_column et_pb_column_4_4">
                                            <img src="<?php echo new_get_featured_image_link(get_the_ID()); ?>" alt="" class="et-waypoint et_pb_image et_pb_animation_fade_in band-main-image et_pb_image_sticky et-animated"><div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left band-name-title">

                                                <p><?php the_title(); ?></p>

                                            </div> <!-- .et_pb_text -->
                                        </div> <!-- .et_pb_column -->
                                    </div> <!-- .et_pb_row -->

                                </div> <!-- .et_pb_section --><div class="et_pb_section songs-and-details-section et_section_regular" style="background-color:#ffffff;">



                                    <div class="et_pb_row">
                                        <div class="et_pb_column et_pb_column_3_4">
                                            <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left band-songs-title section-title">
                                                Songs
                                            </div> <!-- .et_pb_text -->
                                        </div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_4">
                                            <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left details-songs-title section-title">
                                                Details
                                            </div> <!-- .et_pb_text -->
                                        </div> <!-- .et_pb_column -->
                                    </div> <!-- .et_pb_row --><div class="et_pb_row">
                                        <div class="et_pb_column et_pb_column_3_4">
                                        <?php foreach ($songs as $song) { ?>
                                            <div class="et_pb_column et_pb_column_1_4">
                                                <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left song-lessons-list">

                                                    <div class="item-song-header"><a title="<?php echo $song->post_title; ?>" href="<?php echo new_get_first_lesson_permalink($song); ?>"><img class="alignnone  wp-image-1588" src="<?php echo new_get_featured_image_link($song); ?>" alt="220px-ACDC_Back_in_Black_Single_Cover" width="105" height="105"></a></div>
                                                    <div class="item-song-title">
                                                        <h3><?php echo $song->post_title; ?></h3>
                                                        <h3></h3>
                                                    </div>
                                                    <div class="part-songs-list">
                                                        <ul class="lcp_catlist" id="lcp_instance_0">
                                                            <?php
                                                            $lessons = new_get_children_lessons($song);
                                                            foreach ($lessons as $lesson) {
                                                                ?>
                                                            <li>
                                                                <a href="<?php echo get_the_permalink($lesson); ?>"
                                                                   title="<?php echo $lesson->post_title; ?>">
                                                                    <?php echo $lesson->post_title; ?>
                                                                </a>
                                                            </li>
                                                                <?php
                                                            } ?>
                                                        </ul>
                                                    </div>

                                                </div> <!-- .et_pb_text --><!-- .et_pb_text -->
                                            </div>
                                        <?php } ?> <!-- .et_pb_column -->
                                            </div>
                                        <div class="et_pb_column et_pb_column_1_4">
                                            <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left details-list">

                                                <ul>
                                                    <li>
                                                        <div class="details-first-column">Origin:</div>
                                                        <div class="details-second-column">
                                                            <?php echo $origin; ?>
                                                        </div>
                                                        <hr>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <div class="details-first-column">Active:</div>
                                                        <div class="details-second-column">
                                                            <?php echo $active; ?>
                                                        </div>
                                                        <hr>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <div class="details-first-column">Labels:</div>
                                                        <div class="details-second-column" style="text-align: left;">
                                                            <?php echo new_get_separeted_by_commas_list($tags); ?>
                                                        </div>
                                                        <hr>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <div class="details-first-column">Genre:</div>
                                                        <div class="details-second-column">
                                                            <?php echo new_get_separeted_by_commas_list($genres); ?>
                                                        </div>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <div class="details-first-column">Website:</div>
                                                        <div class="details-second-column">
                                                            <a href="<?php echo $website; ?>"><?php echo $website; ?></a>
                                                        </div>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <div class="details-first-column">&nbsp;Members:</div>
                                                        <div class="details-second-column">
                                                            <?php echo new_get_separeted_by_commas_list($members); ?>
                                                        <hr>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <div class="details-first-column">Past Members:</div>
                                                        <div class="details-second-column">
                                                            <?php echo new_get_separeted_by_commas_list($past_members); ?>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="details-second-column"></div>
                                                        <hr>
                                                    </li>
                                                </ul>

                                            </div> <!-- .et_pb_text -->
                                        </div> <!-- .et_pb_column -->
                                    </div> <!-- .et_pb_row -->

                                </div> <!-- .et_pb_section --><div class="et_pb_section et_section_regular">



                                    <div class="et_pb_row">
                                        <div class="et_pb_column et_pb_column_4_4">
                                            <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left related-artists-title section-title">
                                                Related Artists
                                            </div> <!-- .et_pb_text --><div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left related-bands">

                                                <ul class="lcp_catlist" id="lcp_instance_0">
                                                    <?php
                                                    foreach($related_bands as $band) {
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

                                </div> <!-- .et_pb_section -->
                            </div> <!-- .entry-content -->


                        </article>



<!-- content ends -->
				<?php
					if ( ! post_password_required() ) :

						et_divi_post_meta();

						$thumb = '';

						$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

						$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
						$classtext = 'et_featured_image';
						$titletext = get_the_title();
						$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
						$thumb = $thumbnail["thumb"];

						$post_format = get_post_format();

						if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) {
							printf(
								'<div class="et_main_video_container">
									%1$s
								</div>',
								$first_video
							);
						} else if ( ! in_array( $post_format, array( 'gallery', 'link', 'quote' ) ) && 'on' === et_get_option( 'divi_thumbnails', 'on' ) && '' !== $thumb ) {
							print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
						} else if ( 'gallery' === $post_format ) {
							et_gallery_images();
						}
					?>

					<?php
						$text_color_class = et_divi_get_post_text_color();

						$inline_style = et_divi_get_post_bg_inline_style();

						switch ( $post_format ) {
							case 'audio' :
								printf(
									'<div class="et_audio_content%1$s"%2$s>
										%3$s
									</div>',
									esc_attr( $text_color_class ),
									$inline_style,
									et_pb_get_audio_player()
								);

								break;
							case 'quote' :
								printf(
									'<div class="et_quote_content%2$s"%3$s>
										%1$s
									</div> <!-- .et_quote_content -->',
									et_get_blockquote_in_content(),
									esc_attr( $text_color_class ),
									$inline_style
								);

								break;
							case 'link' :
								printf(
									'<div class="et_link_content%3$s"%4$s>
										<a href="%1$s" class="et_link_main_url">%2$s</a>
									</div> <!-- .et_link_content -->',
									esc_url( et_get_link_url() ),
									esc_html( et_get_link_url() ),
									esc_attr( $text_color_class ),
									$inline_style
								);

								break;
						}

					endif;
				?>

					<div class="entry-content">
					<?php
						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

					<?php
					if ( et_get_option('divi_468_enable') == 'on' ){
						echo '<div class="et-single-post-ad">';
						if ( et_get_option('divi_468_adsense') <> '' ) echo( et_get_option('divi_468_adsense') );
						else { ?>
							<a href="<?php echo esc_url(et_get_option('divi_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a>
				<?php 	}
						echo '</div> <!-- .et-single-post-ad -->';
					}
				?>

					<?php
						if ( ( comments_open() || get_comments_number() ) && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) )
							comments_template( '', true );
					?>
				</article> <!-- .et_pb_post -->

				<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>
			<?php endwhile; ?>
			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>
