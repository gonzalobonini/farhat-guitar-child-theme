<?php

// get all bands
$all_bands = new_get_all_bands();
?>

<ul class="sidebar-menu">
    <li class="header">
      <a href="#" onclick="$('#paypal-1').click()"><i class="fa fa-paypal"></i> <span>DONATE</span>
      </a>
    </li>

  <?php
  if (isset($cart_link)) {
  ?>
    <li class="header">
      <a href="<?php echo $cart_link ?>"
         target="_blank"><i class="fa fa-shopping-cart"></i> <span>BUY THIS LESSONS</span>
      </a>
    </li>

  <?php
  }
  if (isset($tabs_link)) {
    ?>
    <li class="header">
      <a href="<?php echo $tabs_link ?>"
         target="_blank"><i class="fa fa-download"></i> <span>DOWNLOAD TABS (PDF)</span>
      </a>
    </li>

  <?php
  }
  if (isset($other_lessons) && isset($song)) {
    ?>
    <li class="header">
	  <li class="treeview active">
		  <a href="#">
			  <i class="fa fa-music"></i> <span><?php echo $song->post_title ?></span>
			  <i class="fa fa-angle-right pull-right"></i>
		  </a>
			  <ul class="treeview-menu">
				  <?php
				  $lessons = new_get_children_lessons($song);
				  foreach ($lessons as $lesson) {
					  ?>
					  <li>
						  <a href="<?php echo get_the_permalink($lesson); ?>"
						     title="Lesson <?php echo get_post_meta( $lesson->ID, 'new_lesson_number', true ); ?>">
							  Lesson <?php echo get_post_meta( $lesson->ID, 'new_lesson_number', true ); ?>
						  </a>
					  </li>
				  <?php
				  } ?>
			  </ul>
	  </li>
    </li>

  <?php
  }
  // list all songs per band
  foreach ($all_bands as $current_band) {
    try {
      ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-music"></i> <span><?php echo $current_band->post_title ?></span>
          <i class="fa fa-angle-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php
          $current_songs = new_get_children_songs($current_band);
          foreach($current_songs as $current_song) {
            ?>
            <li>
              <a href="#">
                <i class="fa fa-circle fa-xs"></i> <span><?php echo $current_song->post_title ?></span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php
                $lessons = new_get_children_lessons($current_song);
                foreach ($lessons as $lesson) {
                  ?>
                  <li>
                    <a href="<?php echo get_the_permalink($lesson); ?>"
                       title="Lesson <?php echo get_post_meta( $lesson->ID, 'new_lesson_number', true ); ?>">
                      Lesson <?php echo get_post_meta( $lesson->ID, 'new_lesson_number', true ); ?>
                    </a>
                  </li>
                <?php
                } ?>
              </ul>
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
