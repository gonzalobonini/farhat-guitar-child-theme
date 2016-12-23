<?php

// get all bands
$bands = new_get_all_bands();
?>

<ul id="left-menu">
<?php
  // list all songs per band
  foreach ($bands as $current_band) {
    try {
      ?>
      <li><div><a href="<?php echo get_the_permalink($current_band)?>"><?php echo $current_band->post_title ?></a></div>
      <ul>
        <?php
        $songs = new_get_children_songs($current_band);
        ?>
          <?php
          foreach($songs as $current_song) {
          ?>
          <li>
            <a href="<?php echo new_get_first_lesson_permalink($current_song)?>"><?php echo $current_song->post_title ?></a>
          </li>
      <?php
      }
      ?>
      </ul>
      </li>
    <?php
    } catch (Exception $e) {
      echo '<h1>Excepción capturada: ',  $e->getMessage(), "\n<h1>";
    }


  }
?>
</ul>