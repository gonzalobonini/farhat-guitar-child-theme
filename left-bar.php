<?php

// get all bands
$bands = tomate_get_all_bands();
?>
<div id="left-bar">
<?php
// list all songs per band
foreach ($bands as $current_band) {
?>
    <h3><?php echo $current_band->post_title ?></h3>
    <div>
    <?php
        $songs = tomate_get_children_songs($current_band);
    ?>
        <ul>
    <?php
        foreach($songs as $current_song) {
    ?>
            <li>
                <a href="<?php echo tomate_get_first_lesson_permalink($current_song)?>"><?php echo $current_song->post_title ?></a>
            </li>
        </ul>
        <?php
        }
    ?>
    </div>
<?php
}
?>
</div>

