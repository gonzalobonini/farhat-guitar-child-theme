<?php

// get all bands
$all_bands = new_get_all_bands(-1, 'post_title','ASC', true);
?>


<ul class="sidebar-menu">
  
<li class="header">
	  <li class="treeview active">
      <a href="<?php echo get_site_url() ?>/donate"><i class="fa fa-paypal"></i> <span><?php _e('Donate', 'farhat'); ?></span>	</a>
   </li>
</li>
    

  <?php
  if (isset($cart_link)) {
      ?>
  
    <li class="header">
      <li class="treeview active">
      <a href="<?php echo $cart_link ?>"
         target="_blank"><i class="fa fa-shopping-cart"> </i> <span><?php _e('BUY THIS LESSONS', 'farhat'); ?></span>
      </a>		  
    </li>
    </li>

  <?php
  }
  if (isset($tabs_link)) {
      ?>

    <li class="header">
	  <li class="treeview active">
      <a href="<?php echo $tabs_link ?>"
         target="_blank">
         <i class="fa fa-download"></i> <span><?php _e('DOWNLOAD TABS (PDF)', 'farhat'); ?></span>
      </a>		  
   </li>
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
						     title="Lesson <?php echo get_post_meta($lesson->ID, 'new_lesson_number', true); ?>">
							  <?php _e('Lesson ', 'farhat'); ?> <?php echo get_post_meta($lesson->ID, 'new_lesson_number', true); ?>
						  </a>
					  </li>
				  <?php
      } ?>
			  </ul>
	  </li>
    </li>

  <?php
  }
  generate_template_for_menu();
  //include "left-bar.html";
  ?>
</ul>
