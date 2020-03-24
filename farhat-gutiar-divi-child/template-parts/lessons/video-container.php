<?php   $video_link = get_post_meta(get_the_ID(), 'new_lesson_video', true); 
        $song_id = get_post_meta(get_the_ID(), 'new_lesson_song_id', true);
        $song_image = get_default_thumb($song_id);
        //$video_link = 'https://farhatguitar.com/paginasiframes/canciones%20videos/Soda%20Estereo/Enelseptimodia/videos/parte_1.mp4';


$video = (shortcode_exists( 'fvplayer' )) ?  sprintf('[fvplayer src="%s" splash="%s"]', $video_link, $song_image) : sprintf('[video src="%s"]', $video_link);

echo do_shortcode($video); ?>
