<?php

// get all bands
$bands = new_get_all_bands();
?>
<div id="left-bar">
<?php
// list all songs per band
foreach ($bands as $current_band) {
  try {
    ?>
    <h3><a href="<?php echo get_the_permalink($current_band)?>"><?php echo $current_band->post_title ?></a></h3>
    <div>
      <?php
        $songs = new_get_children_songs($current_band);
      ?>
      <ul>
        <?php
        foreach($songs as $current_song) {
        ?>
        <li>
                <a href="<?php echo new_get_first_lesson_permalink($current_song)?>"><?php echo $current_song->post_title ?></a>
        </li>
      </ul>
    <?php
        }
    ?>
    </div>
  <?php
  } catch (Exception $e) {
    echo '<h1>Excepción capturada: ',  $e->getMessage(), "\n<h1>";
  }


}
?>
</div>

