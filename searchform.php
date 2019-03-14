<div id="et_top_search">
  <span id="et_search_icon"></span>
  <form role="search" method="get" class="et-search-form et-hidden" action="<?php echo esc_url(home_url('/')); ?>">
  <?php
                  printf(
    '<input type="search" class="et-search-field desktop" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
    esc_attr__('Search &hellip;', 'Divi'),
    get_search_query(),
    esc_attr__('Search for:', 'Divi')
                  );
              ?>
  </form>
</div>
