<?php

include_once 'tomate-functions.php';

include_once 'tomate-scripts-and-styles.php';

function new_get_all_bands($posts_per_page = -1, $orderby = 'post_title', $order = 'ASC', $changeLang = false)
{
    if(function_exists(pll_current_language)){
      $lang = pll_current_language();
    }
    if($changeLang){
      $lang = 'en';
    }

    // get all the bands
    $args = array(
      'posts_per_page'   => $posts_per_page,
      'orderby'          => $orderby,
      'order'            => $order,
      'post_type'        => 'new_band',
      'lang'           => $lang,
      'post_mime_type'   => '',
      'post_parent'      => '',
      'post_status'      => 'publish');

    $bands = new WP_Query($args);


    return $bands->posts;
}

/* Recibe un Post de post_type new_song y devuelve el permalink a de la primer lección */
function new_get_first_lesson_permalink($post)
{
//    echo "<!-- debugging new_get_first_lesson_permalink";
    if ($post instanceof WP_Post) {
        $post_id = $post->ID;
    } else { // I assume it got an id
        $post_id = $post;
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

    $permalink = get_permalink($first_lesson->ID);

    //  apc_store ( "bands" , $bands, 2628000000);
    //wp_cache_add('firt-lesson-'.$post->ID, $permalink, "", 2628000000);
    return $permalink;
//    echo "post_id";
//    var_dump($post_id);

//    echo "other_lessons->posts";
//    var_dump($other_lessons->posts);
//    echo " -->";

  // no lessons at all
}

function new_get_children_lessons($song)
{
  $lang = pll_current_language();

    $args = array(
        'post_type' => 'new_lesson',
        'orderby' => 'post_title',
        'order'   => 'ASC',
        'lang'    => $lang,
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

function new_get_all_songs()
{
    $args = array(
        'post_type' => 'new_song',
        'orderby' => 'date',
        'order'   => 'ASC',
        'nopaging' => true
    );
    $songs_query = new WP_Query($args);
    return $songs_query->posts;
}

function new_get_children_songs($band, $changeLang = false)
{
    //$songs = wp_cache_get('songs-'.$band->ID, '');
    if(function_exists(pll_current_language)){
      $lang = pll_current_language();
    }
    if($changeLang){
      $lang = 'en';
    }

    $args = array(
    'post_type' => 'new_song',
    'orderby' => 'date',
    'lang'  => 'en',
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
    //wp_cache_add("songs-". $band->ID, $songs_query->posts, "", 2628000000);

    return $songs_query->posts;
}

function new_get_band_from_song($song)
{
    if (is_int($song)) {
        $id = $song;
    } else {
        $id = $song->ID;
    }
    $band_id = get_post_meta($id, 'new_song_band_id', true);
    return get_post($band_id);
}

function new_get_song_from_lesson($lesson)
{
    if (is_int($lesson)) {
        $id = $lesson;
    } else {
        $id = $lesson->ID;
    }
    $song_id = get_post_meta($id, 'new_lesson_song_id', true);
    return get_post($song_id);
}



function add_custom_types_to_tax($query)
{
    if (is_category() || is_tag() && empty($query->query_vars['suppress_filters'])) {

        // Get all your post types
        $post_types = get_post_types();

        $query->set('post_type', $post_types);
        return $query;
    }
}
add_filter('pre_get_posts', 'add_custom_types_to_tax');


/* Remove billing details from Woocommerce */

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

function custom_override_checkout_fields($fields)
{
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

function SearchFilter($query)
{
    if ($query->is_search && !is_admin()) { // Esto generaba problemas en la busqueda del panel administrador
        $query->set('post_type', array('post', 'new_band', 'new_song', 'new_lesson'));
    }
    return $query;
}


add_filter('pre_get_posts', 'SearchFilter');

include_once 'tomate-bands.php';

include_once 'tomate-songs.php';

include_once 'tomate-lessons.php';

include_once 'tomate-tags-and-categories.php';


function load_custom_fonts($init)
{
    $stylesheet_url = 'http://farhatguitar.com/wp-content/custom-fonts/custom-fonts.css';  // Note #1
    if (empty($init['content_css'])) {
        $init['content_css'] = $stylesheet_url;
    } else {
        $init['content_css'] = $init ['content_css']. ','. $stylesheet_url;
    }

    $font_formats = isset($init['font_formats'])? $init['font_formats']: 'Andale Mono = anale mono, times; Arial = arial, helvetica, sans-serif; Arial Black = arial black, avant garde; Книга Antiqua = book antiqua, palatino; Comic Sans MS = комикс без ms, sans-serif, Courier New = курьером new, курьером, Georgia = georgia, palatino, Helvetica = helvetica; Impact = impact, chicago; Symbol = symbol; Tahoma = tahoma, arial, helvetica, sans-serif; Terminal = terminal, Монако, Times New Roman = times new roman, times; Trebuchet MS = trebuchet ms, geneva; Verdana = verdana, geneva; Webdings = webdings; Wingdings = wingdings, zapf dingbats ';

    $custom_fonts = ';'. 'Farhat Acordes = Farhat Acordes; Farhat Quintas = Farhat Quintas; Farhat Letras = Farhat Letras; FarHatBC Regular = FarHatBC Regular; FarHatChords2 Regular3 = FarHatChords2 Regular3; Consolas = Consolas; Courier Regular = Courier Regular; Georgia = Georgia;';

    $init['font_formats'] = $font_formats. $custom_fonts;

    return $init;
}
//add_filter('tiny_mce_before_init', 'load_custom_fonts');

function wp_editor_fontsize_filter($buttons)
{
    array_shift($buttons);
    array_unshift($buttons, 'fontsizeselect');
    //array_unshift( $buttons, 'formatselect');
    return $buttons;
}
//add_filter('mce_buttons_2', 'wp_editor_fontsize_filter');

function customize_text_sizes($initArray)
{
    $initArray['theme_advanced_font_sizes'] = "10px,11px,12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px,25px,26px,27px,28px,29px,30px,32px";
    return $initArray;
}
//add_filter('tiny_mce_before_init', 'customize_text_sizes');



function generate_template_for_menu()
{
    $all_bands = new_get_all_bands(-1, 'post_title','ASC', true);

    $menu_html = '';

    //   list all songs per band
    foreach ($all_bands as $current_band) {
        try {
            $menu_html .= '<li class="treeview">';
            $menu_html .= '<a href="#"><i class="fa fa-music"></i> <span>'.$current_band->post_title.'</span><i class="fa fa-angle-right pull-right"></i></a>';
            $menu_html .= '<ul class="treeview-menu">';

            $current_songs = new_get_children_songs($current_band, true);
            foreach ($current_songs as $current_song) {
                $menu_html .= '<li>'."";
                $menu_html .= '<a href="#"><i class="fa fa-circle fa-xs"></i> <span>'.$current_song->post_title.'</span><i class="fa fa-angle-right pull-right"></i></a>';
                $menu_html .= '<ul class="treeview-menu">';

                $lessons = new_get_children_lessons($current_song);
                foreach ($lessons as $lesson) {
                    $title = __('Lesson ', 'farhat') .' '. get_post_meta($lesson->ID, 'new_lesson_number', true);
                    $menu_html .= '<li>';
                    $menu_html .= '<a href="'.get_the_permalink($lesson).'" title="'.$title.'">'. $title .'</a>';
                    $menu_html .= '</li>';
                }

                $menu_html .= '</ul>';
                $menu_html .= '</li>';
            }

            $menu_html .= '</ul>';
            $menu_html .= '</li>';
        } catch (Exception $e) {
            $menu_html .= '<h1>Excepción capturada: '.$e->getMessage()."\n<h1>";
        }
    }

    echo $menu_html;

}


function wpinternationlizationtheme_setup(){
    $domain = 'farhat';
    // wp-content/languages/wpinternationlizationtheme/de_DE.mo
    load_theme_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain );
    // wp-content/themes/wpinternationlizationtheme/languages/de_DE.mo
    load_theme_textdomain( $domain, get_stylesheet_directory() . '/languages' );
    // wp-content/themes/wpinternationlizationtheme/languages/de_DE.mo
    load_theme_textdomain( $domain, get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'wpinternationlizationtheme_setup' );