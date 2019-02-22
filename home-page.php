<?php

/*
Template Name: Home Page
*/

get_header();

require_once 'Mobile-Detect-2.8.26/Mobile_Detect.php';
$detect = new Mobile_Detect;


$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

    <div class="container">
    <div id="content-area" class="clearfix">
    <div id="left-area">

<?php endif; ?>

<?php while ( have_posts() ) : the_post();

    ?>

    <div id="et-main-area">

    <div id="main-content">



    <article class="page type-page status-publish hentry post-<?php get_the_ID() ?>" id="<?php get_the_ID() ?>">


    <div class="entry-content">
    <?php
    
    // get the last 4 songs

        $args = array(
            'posts_per_page'   => 4,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => 'new_song',
            'post_status'      => 'publish');

        $last_songs = get_posts( $args );

//        echo "last songs";
//        var_dump($last_songs);


        // get all the bands
        $bands = new_get_all_bands();

//        echo "last songs";
//        var_dump($last_songs);

        // get all the style tags

        $styles = get_terms('Style');

//        echo "styles";
//        var_dump($styles);

        // get all the difficult level tags

        $difficulties = get_terms('Difficulty');

//        echo "difficulties";
//        var_dump($difficulties);


        // list the left bar
    
// Exclude tablets.
if(!$detect->isMobile() || $detect->isTablet() ){
    ?>
    <div style="background-color:#ffffff;" class="et_pb_section et_pb_section_parallax et_pb_fullwidth_section et_section_regular">

        <?php
        // get the last band with featured category

        $args = array(
            'posts_per_page'   => 1,
            'offset'           => 0,
            'category'         => 'featured',
            'orderby'          => 'rand',
            'post_type'        => 'new_song',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish');

        $featured = get_posts( $args )[0];

        $featured_parent_band = new_get_band_from_song($featured);

//        echo "featured";
//        var_dump($featured);


        
        ?>


        <div class="et_pb_slider et_pb_slider_no_arrows et_pb_slider_no_pagination et_pb_bg_layout_dark">
            <div class="et_pb_slides">
                <div style="background-color:#ffffff;background-image:url(<?php echo new_get_featured_image_link($featured_parent_band) ?>);" class="et_pb_slide et_pb_slide_with_image et_pb_bg_layout_dark et_pb_media_alignment_center et-pb-active-slide">

                    <div class="et_pb_container clearfix" style="min-height: 486px;">
                        <div class="et_pb_slide_image" style="margin-top: 0px;"><img alt="<?php echo $featured->post_title ?>" src="<?php echo new_get_featured_image_link($featured) ?>" style="max-height: 388px;" class="active"></div>
                        <div class="et_pb_slide_description">

                            <div class="et_pb_slide_content">
                                <p><span style="color: #ffffff;"></span><?php echo $featured_parent_band->post_title ?></p>
                            </div>
                            <a class="et_pb_more_button" href="<?php echo new_get_first_lesson_permalink($featured) ?>"><?php echo $featured->post_title ?></a>
                        </div> <!-- .et_pb_slide_description -->
                    </div> <!-- .et_pb_container -->

                </div> <!-- .et_pb_slide -->

            </div> <!-- .et_pb_slides -->
        </div> <!-- .et_pb_slider -->


    </div> <!-- .et_pb_section --><div style="background-color:#ffffff;" class="et_pb_section et_section_regular" id="home-lists">

<?php
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

                    <p><?php echo get_post_meta( $post->ID, 'update_home', true ); ?></p>

                </div> <!-- .et_pb_text --><div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left bands-list">
                    <ul id="lcp_instance_0" class="lcp_catlist">
                        <?php

                        foreach ($last_songs as $current_song) {
                            ?>
                            <li><a title="<?php echo $current_song->post_title ?>" href="<?php echo new_get_first_lesson_permalink($current_song) ?>"><?php echo $current_song->post_title ?></a> <a
                                title="<?php echo $current_song->post_title ?>" href="<?php echo new_get_first_lesson_permalink($current_song) ?>"><img width="105"
                                                                                                            height="105"
                                                                                                            alt="Muse_hysteria_cd-105"
                                                                                                            class="attachment-105x105 size-105x105 wp-post-image"
                                                                                                            src="<?php echo new_get_featured_image_link($current_song, array(105,105)) ?>"></a>
                        </li>
                            <?php
                        }?>

                    </ul>
                </div> <!-- .et_pb_text -->
            </div> <!-- .et_pb_column -->
       <?php         if(!( $detect->isMobile() && !$detect->isTablet() )){
 ?>
            <div class="et_pb_column et_pb_column_1_3">
                    <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left home-side-banner">
                        <div>
                            <div id="home-right-banner">
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-1247097506454706"
                                     data-ad-slot="3782497198"
                                     data-ad-format="auto"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </div>
                        </div>
                    </div> <!-- .et_pb_text -->
            </div> <!-- .et_pb_column -->
                <?php
                }
 ?>
        </div> <!-- .et_pb_row --><div class="et_pb_row">
            <div class="et_pb_column et_pb_column_4_4">
                <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left latest-uploads section-title">
                    <?php echo get_post_meta( $post->ID, 'lessons_by', true ); ?>
                </div> <!-- .et_pb_text -->
            </div> <!-- .et_pb_column -->
        </div> <!-- .et_pb_row --><div class="et_pb_row">
            <div class="et_pb_column <?php echo $list_updates_class ?>">
                <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left sub-section-title">
                    <?php echo get_post_meta( $post->ID, 'artist', true ); ?>
                </div> <!-- .et_pb_text --><div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left alphabetical-list">

                    <ul class="alphabetical-list">
                    <?php
                        foreach($bands as $current_band) {
                    ?>
                          <div
                            class="et_pb_blurb et_pb_bg_layout_light et_pb_text_align_center style-filter et_pb_blurb_position_left">
                            <div class="et_pb_blurb_content">
                              <div class="et_pb_main_blurb_image"><a href="<?php echo get_the_permalink($current_band) ?>"><img
                                    class="et-waypoint et_pb_animation_off et-animated" alt="" src=""></a></div>
                              <h4><a href="<?php echo get_the_permalink($current_band) ?>"><?php echo $current_band->post_title ?></a></h4>

                            </div>
                            <!-- .et_pb_blurb_content -->
                          </div>
                    <?php
                         }
                    ?>
                    </ul>

                </div> <!-- .et_pb_text -->
            </div> <!-- .et_pb_column -->
             <?php
             if( $detect->isMobile() && !$detect->isTablet() ){
                // Si es celular
                 ?>
                 </div><!-- termino row-->
                 <div class="et_pb_row"> <!-- empiezo otro row -->
 <?php
             }
 ?>
            <div class="et_pb_column <?php echo $list_updates_class ?>">
                <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left sub-section-title">
                    <?php echo get_post_meta( $post->ID, 'style', true ); ?>
                </div>
                <!-- .et_pb_text -->
                <?php
                    foreach($styles as $current_style) {
                ?>
                        <div
                            class="et_pb_blurb et_pb_bg_layout_light et_pb_text_align_center style-filter et_pb_blurb_position_left">
                            <div class="et_pb_blurb_content">
                                <div class="et_pb_main_blurb_image"><a href="<?php echo get_term_link($current_style) ?>"><img
                                            class="et-waypoint et_pb_animation_off et-animated" alt="" src=""></a></div>
                                <h4><a href="<?php echo get_term_link($current_style) ?>"><?php echo $current_style->name ?></a></h4>

                            </div>
                            <!-- .et_pb_blurb_content -->
                        </div>
                        <!-- .et_pb_blurb -->
                <?php
                    }
                ?>

            </div>
            <?php
             if( $detect->isMobile() && !$detect->isTablet() ){
                // Si es celular
                 ?>
                 </div><!-- termino row-->
                 <div class="et_pb_row"> <!-- empiezo otro row -->
 <?php
             }
 ?>
            <!-- .et_pb_column -->
            <div class="et_pb_column <?php echo $list_updates_class ?>">
                <div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left sub-section-title">
                    <?php echo get_post_meta( $post->ID, 'experience', true ); ?>
                </div>
                <?php
                foreach($difficulties as $current_difficulty) {
                    ?>
                    <div
                        class="et_pb_blurb et_pb_bg_layout_light et_pb_text_align_center style-filter et_pb_blurb_position_left">
                        <div class="et_pb_blurb_content">
                            <div class="et_pb_main_blurb_image"><a href="<?php echo get_term_link($current_difficulty) ?>"><img
                                        class="et-waypoint et_pb_animation_off et-animated" alt="" src=""></a></div>
                            <h4><a href="<?php echo get_term_link($current_difficulty) ?>"><?php echo $current_difficulty->name ?></a></h4>

                        </div>
                        <!-- .et_pb_blurb_content -->
                    </div>
                    <!-- .et_pb_blurb -->
                <?php
                }
                ?>
            </div> <!-- .et_pb_column -->
        </div> <!-- .et_pb_row -->

    </div> <!-- .et_pb_section -->
    </div> <!-- .entry-content -->


    </article> <!-- .et_pb_post -->



    </div> <!-- #main-content -->


    <span class="et_pb_scroll_top et-pb-icon et-hidden" style="display: inline;"></span>


    </div> <!-- #main-content -->

<?php
    endwhile;
    get_footer();