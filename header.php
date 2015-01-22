<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package InkID
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<?php inkid_hook_header(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/BeatPicker.min.js"></script>
	<script>
		$(document).ready(function(){
			$('h2.accordion').click(function(){
				$(this).next('div.accordion').slideToggle(400);
			});

			var varButtonReserva = $('button.button-reserva-header').css('width');
			$('div.box-promocao-header').css('width', varButtonReserva);

			$('#linha-reserva').on('mouseenter', function () {
   	 			$(this).find('div.box-promocao-header').slideToggle(400);
			}).on('mouseleave', function () {
   	 			$(this).find('div.box-promocao-header').hide();
			});

		});

		$(function() {    // Makes sure the code contained doesn't run until all the DOM elements have loaded

   			$('#campo_conheceu').change(function(){
       			$('#campo_outro').hide();
        		$('#campo_' + $(this).val()).show();
    		});
		});
	</script>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="topo-header">
				<img class="logo-header" src="<?php echo get_template_directory_uri(); ?>/images/headers/logo.png" />
				<div class="box-header-buttons">
						<?php inkid_show_booking_button(); ?>
					<li id="linha-reserva">
						<?php inkid_show_header_promotion(); ?>
					</li>			
				</div>
				<?php inkid_slider_phones(); ?>
			</div>

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<button class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></button>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					<?php //get_search_form(); ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main">
