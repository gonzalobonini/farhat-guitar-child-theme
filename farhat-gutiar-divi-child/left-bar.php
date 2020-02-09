<?php

$this_lesson = get_the_ID();
// get all bands
$all_bands = new_get_all_bands(-1, 'post_title','ASC', true);
$theme_options = get_option('farhat_opciones');
$paypal = $theme_options['paypal_url'];
?>

<a id="simple-menu" class="toggle-sidebar" href="#sidr"><i class="fa fa-music"></i></a>

<div class="" id="sidr">
    <div class="et_pb_column left-bar-container">

    <ul class="sidebar-menu">
      
      <li class="header">
          <li class="treeview active">
            <a href="<?php echo $paypal ?>" target="_blank" ><i class="fa fa-paypal"></i> <span><?php _e('Donate', 'farhat'); ?></span>	</a>
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
                $current_lesson = ($lesson->ID == $this_lesson) ? 'current_lesson' : '';
                ?>
                  <li>
                    <a href="<?php echo get_the_permalink($lesson); ?>" class="<?php echo $current_lesson ?>"
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
        ?>
      </ul>
  
    </div>
</div>
