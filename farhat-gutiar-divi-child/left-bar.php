<?php

$this_lesson = get_the_ID();
// get all bands
$all_bands = new_get_all_bands(-1, 'post_title','ASC', true);
$paypal = get_paypal_link();
$cart_link = get_post_meta(get_the_ID(), 'new_lesson_cart_link', true);
$tabs_link = get_post_meta(get_the_ID(), 'new_lesson_download_tabs', true);
?>

<a id="simple-menu" class="toggle-sidebar" href="#sidr"><i class="fa fa-music"></i></a>

<div class="" id="sidr">
    <div class="et_pb_column left-bar-container">

    <ul class="sidebar-menu">
      
      <li class="header">
          <li class="treeview actionable active">
            <a href="<?php echo $paypal ?>" target="_blank" ><i class="fa fa-paypal"></i> <span><?php _e('Donate', 'farhat'); ?></span>	</a>
        </li>
      </li>
          
      
        <?php
        if ($cart_link) {
            ?>
        
          <li class="header">
            <li class="treeview actionable active">
            <a href="<?php echo $cart_link ?>"
              target="_blank"><i class="fa fa-shopping-cart"> </i> <span><?php _e('BUY THIS LESSONS', 'farhat'); ?></span>
            </a>		  
          </li>
          </li>
      
        <?php
        }
        if ($tabs_link) {
            ?>
      
          <li class="header">
          <li class="treeview actionable active">
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
        $all_bands = new_get_all_bands(-1, 'post_title','ASC', true);

        $menu_html = '';

        //   list all songs per band
        foreach ($all_bands as $current_band) {
            try {
                $menu_html .= '<li class="treeview">';
                $menu_html .= '<a href="#"><i class="fa fa-music"></i> <span>'.$current_band->post_title.'</span><i class="fa fa-angle-right pull-right"></i></a>';
                $menu_html .= '<ul class="treeview-menu">';
                $a = $current_band->ID;
                $current_songs = new_get_children_songs($current_band->ID, true);
                foreach ($current_songs as $current_song) {
                    
                    $menu_html .= '<li>'."";
                    //$menu_html .= '<a href="#"><i class="fa fa-circle fa-xs"></i> <span>'.$current_song->post_title.'</span><i class="fa fa-angle-right pull-right"></i></a>';
                    $menu_html .= '<a  class="no_translate" href="#"><span>'.$current_song->post_title.'</span><i class="fa fa-angle-right pull-right"></i></a>';
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
        ?>
      </ul>
  
    </div>
</div>

<main id="panel">
</main>