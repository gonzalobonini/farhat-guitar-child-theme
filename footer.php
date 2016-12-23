<?php if ( 'on' == et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<footer id="main-footer">
				<?php get_sidebar( 'footer' ); ?>


		<?php
			if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<div id="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> <!-- #et-footer-nav -->

			<?php endif; ?>

				<div id="footer-bottom">
					<div class="container clearfix">
				<?php
					if ( false !== et_get_option( 'show_footer_social_icons', true ) ) {
						get_template_part( 'includes/social_icons', 'footer' );
					}
				?>

						<p id="footer-info"><?php printf( __( 'Designed by %1$s | Powered by %2$s', 'Divi' ), '<a href="http://www.latorregabriel.com" target="_blank" title="latorregabriel.com">Gabriel La Torre</a>', '<a href="http://www.wordpress.org">WordPress</a>' ); ?></p>
					</div>	<!-- .container -->
				</div>
			</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php wp_footer(); ?>
	<script src="<?php bloginfo( "wpurl" ); ?>/wp-content/themes/farhat-gutiar-divi-child/flowplayer-5.5.2/flowplayer.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo( "wpurl" ); ?>/wp-content/themes/farhat-gutiar-divi-child/flowplayer-5.5.2/skin/functional.css">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo( "wpurl" ); ?>/wp-content/themes/farhat-gutiar-divi-child/flowplayer-5.5.2/skin/flowplayer-buttons.css">

<link rel="stylesheet" href="<?php bloginfo( "wpurl" ); ?>/wp-content/themes/farhat-gutiar-divi-child/slicknav/slicknav.css" />
<script src="<?php bloginfo( "wpurl" ); ?>/wp-content/themes/farhat-gutiar-divi-child/slicknav/jquery.slicknav.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
      $.sidebarMenu($('.sidebar-menu'));
    });
</script>
</body>
</html>
