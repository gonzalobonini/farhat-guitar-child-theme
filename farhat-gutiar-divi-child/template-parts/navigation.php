<?php 
$detect = get_mobile_detect();
$et_email = "contact@farhatguitar.com";//$et_secondary_nav_items->email;
$et_secondary_nav_items = et_divi_get_top_nav_items();
$et_phone_number = $et_secondary_nav_items->phone_number;


$et_contact_info_defined = $et_secondary_nav_items->contact_info_defined;

$show_header_social_icons = $et_secondary_nav_items->show_header_social_icons;

$et_secondary_nav = $et_secondary_nav_items->secondary_nav;

$primary_nav_class = 'et_nav_text_color_' . et_get_option('primary_nav_text_color', 'dark');

$secondary_nav_class = 'et_nav_text_color_' . et_get_option('secondary_nav_text_color', 'light');

$et_top_info_defined = $et_secondary_nav_items->top_info_defined;

if ($et_top_info_defined) : ?>
    <div id="top-header" class="<?php echo esc_attr($secondary_nav_class); ?>">
        <div class="container clearfix">

            <div id="et-secondary-menu">
            <?php
                if (! $et_contact_info_defined && true === $show_header_social_icons) {
                    get_template_part('includes/social_icons', 'header');
                } elseif ($et_contact_info_defined && true === $show_header_social_icons) {
                    ob_start();

                    get_template_part('includes/social_icons', 'header');

                    $duplicate_social_icons = ob_get_contents();

                    ob_end_clean();

                    printf(
                        '<div class="et_duplicate_social_icons">
                            %1$s
                        </div>',
                        $duplicate_social_icons
                    );
                }

                if ('' !== $et_secondary_nav) {
                    echo $et_secondary_nav;
                }


            ?>
            </div> <!-- #et-secondary-menu -->

        </div> <!-- .container -->
    </div> <!-- #top-header -->
<?php endif; // true ==== $et_top_info_defined?>

    <header id="main-header" class="<?php echo esc_attr($primary_nav_class); ?>">
        <div class="container clearfix">
        <?php
            $logo = ($user_logo = et_get_option('divi_logo')) && '' != $user_logo
                ? $user_logo
                : $template_directory_uri . '/images/logo.png';
        $small_logo = ($detect->isMobile() && !$detect->isTablet()) ? " style='max-height: 50px' ": "";
        ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="ocultable">
                <img src="<?php echo esc_attr($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
            </a>
<div id="contact-information" class="ocultable">

<div id="mail-phone">

    <?php $post_banner = get_post(2107);
    $content = $post_banner->post_content;
    echo apply_filters('the_content', $content);
    ?>

    <div id="et-info">
        <?php //if ( '' !== ( $et_phone_number = et_get_option( 'phone_number' ) ) ) :?>
        <!--<span id="et-info-phone"><?php //echo esc_html( $et_phone_number );?></span>-->
        <?php //endif;?>

        <?php //if ( '' !== ( $et_email = et_get_option( 'header_email' ) ) ) :?>
        <a href="<?php echo esc_attr('mailto:' . $et_email); ?>"><span id="et-info-email"><?php echo esc_html($et_email); ?></span></a>
        <?php //endif;?>

        <?php
        if (true === $show_header_social_icons) {
            //get_template_part( 'includes/social_icons', 'header' );
        } ?>
    </div> <!-- #et-info -->
    <br>
</div>
<div class="social-icons-container">
    <?php get_template_part('includes/social_icons', 'header'); ?>
    <div class="donate-container">
        <form method="post" action="https://www.paypal.com/cgi-bin/webscr">
            <input type="hidden" value="_s-xclick" name="cmd">
            <input type="hidden" value="USP7M8W7CK728" name="hosted_button_id">
            <input type="image" id="paypal-1" src="http://farhatguitar.com/wp-content/uploads/2015/06/donate.png" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
    </div>
</div>
<br>
<?php // Exclude tablets.
//if (!($detect->isMobile() && !$detect->isTablet())) {
    ?>
    
<?php
//}
?>



<?php
// Exclude tablets.
//if (!($detect->isMobile() && !$detect->isTablet())) {

//}
                ?>
<?php if ($et_contact_info_defined) : ?>



<?php endif; // true === $et_contact_info_defined?>
</div>
</div>

            <div id="et-top-navigation">
                <div class="container clearfix"> 
                <nav id="top-menu-nav">
                <?php
                    $menuClass = 'nav';
                    if ('on' == et_get_option('divi_disable_toptier')) {
                        $menuClass .= ' et_disable_top_tier';
                    }
                    $primaryNav = '';

                    $primaryNav = wp_nav_menu(array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => 'top-menu', 'echo' => false ));

                    if ('' == $primaryNav) :
                ?>
                    <ul id="top-menu" class="<?php echo esc_attr($menuClass); ?>">
                        <?php if ('on' == et_get_option('divi_home_link')) {
                    ?>
                            <li <?php if (is_home()) {
                        echo('class="current_page_item"');
                    } ?>><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'Divi'); ?></a></li>
                        <?php
                }; ?>

                        <?php show_page_menu($menuClass, false, false); ?>
                        <?php show_categories_menu($menuClass, false); ?>
                    </ul>
                <?php
                    else :
                        echo($primaryNav);
                    endif;
                ?>
                </nav>

                <?php if (false !== et_get_option('show_search_icon', true)) : ?>
                <?php get_search_form(); 
                    //et_show_cart_total($defaults); ?>
                <?php endif; // true === et_get_option( 'show_search_icon', false )?>

                <?php do_action('et_header_top'); ?>

                </div>
                
            </div> <!-- #et-top-navigation -->

            <div class="search-mobile">

                <form role="search" method="get" class="et-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <a class="go-home" href="/"><i class="fa fa-home fa-2x"></i></a>
                    <?php
            printf(
                    '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
                    esc_attr__('Search &hellip;', 'Divi'),
                    get_search_query(),
                    esc_attr__('Search for:', 'Divi')
            );
            ?>
                </form>

            </div>


        </div> <!-- .container -->
    </header> <!-- #main-header -->