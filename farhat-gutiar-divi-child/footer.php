<?php if ('on' == et_get_option('divi_back_to_top', 'false')) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

	?>

</div> <!-- #et-main-area -->


			
	</div> <!-- #page-container -->

	<footer id="main-footer">
		<?php get_sidebar('footer'); ?>


		<?php
            if (has_nav_menu('footer-menu')) : ?>

				<div id="et-footer-nav">
					<div class="container">
						<?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer-menu',
                                'depth'          => '1',
                                'menu_class'     => 'bottom-nav',
                                'container'      => '',
                                'fallback_cb'    => '',
                            ));
						?>
						
					</div>
				</div> <!-- #et-footer-nav -->

			<?php endif; ?>
			<div class="container">
			<div class="ad-footer"> 
						
						<?php 
						$detect = get_mobile_detect();

						if ( is_active_sidebar( 'footer-ad' ) && !$detect->isMobile() && !$detect->isTablet()) { ?>
								<?php dynamic_sidebar('footer-ad'); ?>
						<?php } ?>
					</div>
			</div>

				<div id="footer-bottom">
					<div class="container clearfix">
					
				<?php
                    if (false !== et_get_option('show_footer_social_icons', true)) {
                        get_template_part('includes/social_icons', 'footer');
                    }
                ?>

						<p id="footer-info"><?php printf(__('Designed by %1$s + %2$s', 'Divi'), '<a href="http://www.latorregabriel.com" target="_blank" title="latorregabriel.com">Gabriel La Torre</a>', '<a href="http://www.gonza.io" target="_blank" title="gonza.io">Gonza.io</a>');  ?></p>
					
					
					</div>	<!-- .container -->
				</div>
			</footer> <!-- #main-footer -->

	<?php wp_footer(); ?>

</body>
</html>

