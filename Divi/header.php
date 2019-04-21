<?php if ( ! isset( $_SESSION ) ) session_start(); ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?></title>
	<?php elegant_description(); ?>
	<?php elegant_keywords(); ?>
	<?php elegant_canonical(); ?>

	<?php do_action( 'et_head_meta' ); ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( $template_directory_uri . '/js/html5.js"' ); ?>" type="text/javascript"></script>
	<![endif]-->

	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page-container">
<?php
	if ( is_page_template( 'page-template-blank.php' ) ) {
		return;
	}

	$et_secondary_nav_items = et_divi_get_top_nav_items();

	$et_phone_number = $et_secondary_nav_items->phone_number;

	$et_email = $et_secondary_nav_items->email;

	$et_contact_info_defined = $et_secondary_nav_items->contact_info_defined;

	$show_header_social_icons = $et_secondary_nav_items->show_header_social_icons;

	$et_secondary_nav = $et_secondary_nav_items->secondary_nav;

	$primary_nav_class = 'et_nav_text_color_' . et_get_option( 'primary_nav_text_color', 'dark' );

	$secondary_nav_class = 'et_nav_text_color_' . et_get_option( 'secondary_nav_text_color', 'light' );

	$et_top_info_defined = $et_secondary_nav_items->top_info_defined;
?>

	<?php if ( $et_top_info_defined ) : ?>
		<div id="top-header" class="<?php echo esc_attr( $secondary_nav_class ); ?>">
			<div class="container clearfix">

			<?php if ( $et_contact_info_defined ) : ?>

				<div id="et-info">
				<?php if ( '' !== ( $et_phone_number = et_get_option( 'phone_number' ) ) ) : ?>
					<span id="et-info-phone"><?php echo esc_html( $et_phone_number ); ?></span>
				<?php endif; ?>

				<?php if ( '' !== ( $et_email = et_get_option( 'header_email' ) ) ) : ?>
					<a href="<?php echo esc_attr( 'mailto:' . $et_email ); ?>"><span id="et-info-email"><?php echo esc_html( $et_email ); ?></span></a>
				<?php endif; ?>

				<?php
				if ( true === $show_header_social_icons ) {
					get_template_part( 'includes/social_icons', 'header' );
				} ?>
				</div> <!-- #et-info -->

			<?php endif; // true === $et_contact_info_defined ?>

				<div id="et-secondary-menu">
				<?php
					if ( ! $et_contact_info_defined && true === $show_header_social_icons ) {
						get_template_part( 'includes/social_icons', 'header' );
					} else if ( $et_contact_info_defined && true === $show_header_social_icons ) {
						ob_start();

						get_template_part( 'includes/social_icons', 'header' );

						$duplicate_social_icons = ob_get_contents();

						ob_end_clean();

						printf(
							'<div class="et_duplicate_social_icons">
								%1$s
							</div>',
							$duplicate_social_icons
						);
					}

					if ( '' !== $et_secondary_nav ) {
						echo $et_secondary_nav;
					}

					et_show_cart_total();
				?>
				</div> <!-- #et-secondary-menu -->

			</div> <!-- .container -->
		</div> <!-- #top-header -->
	<?php endif; // true ==== $et_top_info_defined ?>

		<header id="main-header" class="<?php echo esc_attr( $primary_nav_class ); ?>">
			<div class="container clearfix">
			<?php
				$logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && '' != $user_logo
					? $user_logo
					: $template_directory_uri . '/images/logo.png';
			?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="logo" />
				</a>
<div id="contact-information">
<?php $post_banner = get_post(2107); 
						$content = $post_banner->post_content;
						echo apply_filters( 'the_content',  $content );

					?>
</div>

				<div id="et-top-navigation">
					<nav id="top-menu-nav">
					<?php
						$menuClass = 'nav';
						if ( 'on' == et_get_option( 'divi_disable_toptier' ) ) $menuClass .= ' et_disable_top_tier';
						$primaryNav = '';

						$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => 'top-menu', 'echo' => false ) );

						if ( '' == $primaryNav ) :
					?>
						<ul id="top-menu" class="<?php echo esc_attr( $menuClass ); ?>">
							<?php if ( 'on' == et_get_option( 'divi_home_link' ) ) { ?>
								<li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'Divi' ); ?></a></li>
							<?php }; ?>

							<?php show_page_menu( $menuClass, false, false ); ?>
							<?php show_categories_menu( $menuClass, false ); ?>
						</ul>
					<?php
						else :
							echo( $primaryNav );
						endif;
					?>
					</nav>

					<?php
					if ( ! $et_top_info_defined ) {
						et_show_cart_total( array(
							'no_text' => true,
						) );
					}
					?>

					<?php if ( false !== et_get_option( 'show_search_icon', true ) ) : ?>
					<div id="et_top_search">
						<span id="et_search_icon"></span>
						<form role="search" method="get" class="et-search-form et-hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php
							printf( '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
								esc_attr__( 'Search &hellip;', 'Divi' ),
								get_search_query(),
								esc_attr__( 'Search for:', 'Divi' )
							);
						?>
						</form>
					</div>
					<?php endif; // true === et_get_option( 'show_search_icon', false ) ?>

					<?php do_action( 'et_header_top' ); ?>
				</div> <!-- #et-top-navigation -->
				

			</div> <!-- .container -->
		</header> <!-- #main-header -->
<div class="header-banner">
					<?php $post_banner = get_post(1716); 
						$content = $post_banner->post_content;
						echo apply_filters( 'the_content',  $content );

					?>
				</div>
		<div id="et-main-area">

            <ul class="alphabetical-list">
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_1"><li><a href="http://farhatguitar.com/bands/acdc/" title="AC/DC">AC/DC</a>  </li><li><a href="http://farhatguitar.com/bands/andres-calamaro/" title="Andres Calamaro">Andres Calamaro</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_2"><li><a href="http://farhatguitar.com/bands/black-sabbath/" title="Black Sabbath">Black Sabbath</a>  </li><li><a href="http://farhatguitar.com/bands/blink-182/" title="Blink 182">Blink 182</a>  </li><li><a href="http://farhatguitar.com/bands/bob-marley/" title="Bob Marley">Bob Marley</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_3"><li><a href="http://farhatguitar.com/bands/chuck-berry/" title="Chuck Berry">Chuck Berry</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_4"><li><a href="http://farhatguitar.com/bands/deep-purple/" title="Deep Purple">Deep Purple</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_5"><li><a href="http://farhatguitar.com/bands/education-lessons/" title="Educational Lessons">Educational Lessons</a>  </li><li><a href="http://farhatguitar.com/bands/emerson-lake-and-palmer/" title="Emerson, Lake and Palmer">Emerson, Lake and Palmer</a>  </li><li><a href="http://farhatguitar.com/bands/eric-clapton/" title="Eric Clapton">Eric Clapton</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_6"></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_7"><li><a href="http://farhatguitar.com/bands/george-harrison/" title="George Harrison">George Harrison</a>  </li><li><a href="http://farhatguitar.com/bands/gipsy-kings/" title="Gipsy Kings">Gipsy Kings</a>  </li><li><a href="http://farhatguitar.com/bands/green-day/" title="Green Day">Green Day</a>  </li><li><a href="http://farhatguitar.com/bands/guns-n-roses/" title="Guns N’ Roses">Guns N’ Roses</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_8"></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_9"><li><a href="http://farhatguitar.com/bands/iron-maiden/" title="Iron Maiden">Iron Maiden</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_10"><li><a href="http://farhatguitar.com/bands/joaquin-sabina/" title="Joaquin Sabina">Joaquin Sabina</a>  </li><li><a href="http://farhatguitar.com/bands/john-lennon/" title="John Lennon">John Lennon</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_11"></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_12"><li><a href="http://farhatguitar.com/bands/led-zeppelin/" title="Led Zeppelin">Led Zeppelin</a>  </li><li><a href="http://farhatguitar.com/bands/lynyrd-skynyrd/" title="Lynyrd Skynyrd">Lynyrd Skynyrd</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_13"><li><a href="http://farhatguitar.com/bands/mago-de-oz/" title="Mago de Oz">Mago de Oz</a>  </li><li><a href="http://farhatguitar.com/bands/mana-2/" title="Mana">Mana</a>  </li><li><a href="http://farhatguitar.com/bands/megadeth/" title="Megadeth">Megadeth</a>  </li><li><a href="http://farhatguitar.com/bands/metallica/" title="Metallica">Metallica</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_14"><li><a href="http://farhatguitar.com/bands/nacha-pop/" title="Nacha Pop">Nacha Pop</a>  </li><li><a href="http://farhatguitar.com/bands/nirvana/" title="Nirvana">Nirvana</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_15"><li><a href="http://farhatguitar.com/bands/oasis/" title="Oasis">Oasis</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_16"><li><a href="http://farhatguitar.com/bands/patricio-rey-y-sus-redonditos-de-ricota/" title="Patricio Rey y sus Redonditos de Ricota">Patricio Rey y sus Redonditos de Ricota</a>  </li><li><a href="http://farhatguitar.com/bands/pink-foyd/" title="Pink Foyd">Pink Foyd</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_17"><li><a href="http://farhatguitar.com/bands/queen/" title="Queen">Queen</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_18"><li><a href="http://farhatguitar.com/bands/rata-blanca/" title="Rata Blanca">Rata Blanca</a>  </li><li><a href="http://farhatguitar.com/bands/red-hot-chilli-peppers/" title="Red Hot Chilli Peppers">Red Hot Chilli Peppers</a>  </li><li><a href="http://farhatguitar.com/bands/rolling-stones/" title="Rolling Stones">Rolling Stones</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_19"><li><a href="http://farhatguitar.com/bands/silvio-rodriguez/" title="Silvio Rodriguez">Silvio Rodriguez</a>  </li><li><a href="http://farhatguitar.com/bands/soda-stereo/" title="Soda Stereo">Soda Stereo</a>  </li><li><a href="http://farhatguitar.com/bands/sui-generis/" title="Sui Generis">Sui Generis</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_20"><li><a href="http://farhatguitar.com/bands/the-beatles/" title="The Beatles">The Beatles</a>  </li><li><a href="http://farhatguitar.com/bands/the-cure/" title="The Cure">The Cure</a>  </li><li><a href="http://farhatguitar.com/bands/the-doors/" title="The Doors">The Doors</a>  </li><li><a href="http://farhatguitar.com/bands/the-eagles/" title="The Eagles">The Eagles</a>  </li><li><a href="http://farhatguitar.com/bands/the-jimi-hendrix-experience/" title="The Jimi Hendrix Experience">The Jimi Hendrix Experience</a>  </li><li><a href="http://farhatguitar.com/bands/the-police/" title="The Police">The Police</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_21"><li><a href="http://farhatguitar.com/bands/u2/" title="U2">U2</a>  </li></ul></div>
                </li>
                <li>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_22"></ul></div>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_23"></ul></div>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_24"></ul></div>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_25"></ul></div>
                    <div class="list-container"><ul class="lcp_catlist" id="lcp_instance_26"></ul></div>
                </li>
            </ul>
