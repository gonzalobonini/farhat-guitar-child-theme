<?php

$detect = get_mobile_detect();

?>
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
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(); ?></title>
	<?php elegant_description(); ?>
	<?php elegant_keywords(); ?>
	<?php elegant_canonical(); ?>

	<?php do_action('et_head_meta'); ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url($template_directory_uri . '/js/html5.js"'); ?>" type="text/javascript"></script>
	<![endif]-->



	<?php wp_head(); ?>


</head>
<body <?php body_class(); ?> > 

<?php get_template_part('template-parts/navigation');

?>


<div id="page-container">
<?php
    if (is_page_template('page-template-blank.php')) {
        return;
    }

    
?>

	

      
		<div id="et-main-area">
