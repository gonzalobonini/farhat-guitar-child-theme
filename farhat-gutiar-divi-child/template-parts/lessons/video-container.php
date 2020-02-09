<?php   $video_link = get_post_meta(get_the_ID(), 'new_lesson_video', true); ?>

<div class="">
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
        <?php 
              get_template_part('template-parts/lessons/player-js'); ?>
    </div>