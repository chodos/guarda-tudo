<?php
/**
 * Theme setup variable
 *
 * @package InkID Guarda-Tudo
 */


/* ----------------------------------------------------------------------------------
	ADD CUSTOM VARIABLES
---------------------------------------------------------------------------------- */

/* Add global variables used in Redux framework */
function inkid_reduxvariables() { 

	// Fetch options stored in $data.
	global $redux_inkid;

	//  1.1.     General settings - Header.
	//$GLOBALS['thinkup_general_logoswitch']                  = inkid_var ( 'thinkup_general_logoswitch' );
	//$GLOBALS['thinkup_general_logolink']                    = inkid_var ( 'thinkup_general_logolink', 'url' );
	$GLOBALS['opt_background_header']                  		= inkid_var ( 'opt-background-header', 'url' );
	$GLOBALS['opt_color_header']                  			= inkid_var ( 'opt-color-header' );
	$GLOBALS['opt_layout_sections_home']                  	= inkid_var ( 'opt-layout-sections-home' );
	$GLOBALS['opt_layout_sections_what_video']              = inkid_var ( 'opt-layout-sections-what-video' );
	$GLOBALS['opt_select_main_post_home']    	            = inkid_var ( 'opt-select-main-post-home' );
	$GLOBALS['opt_background_footer']                  		= inkid_var ( 'opt-background-footer' );
	$GLOBALS['opt_color_footer']                  			= inkid_var ( 'opt-color-footer' );
	
	$GLOBALS['opt_endereco_saopaulo']                  		= inkid_var ( 'opt-endereco-saopaulo' );
	$GLOBALS['opt_telefone_saopaulo']                 		= inkid_var ( 'opt-telefone-saopaulo' );
	$GLOBALS['opt_mailcontato_saopaulo']                  	= inkid_var ( 'opt-mail-contato-saopaulo' );
	$GLOBALS['opt_mailreserva_saopaulo']                  	= inkid_var ( 'opt-mail-reserva-saopaulo' );
	$GLOBALS['opt_endereco_campinas']                  		= inkid_var ( 'opt-endereco-campinas' );
	$GLOBALS['opt_telefone_campinas']                 		= inkid_var ( 'opt-telefone-campinas' );
	$GLOBALS['opt_mailcontato_campinas']                  	= inkid_var ( 'opt-mail-contato-campinas' );
	$GLOBALS['opt_mailreserva_campinas']                  	= inkid_var ( 'opt-mail-reserva-campinas' );
	$GLOBALS['opt_endereco_rio']                  			= inkid_var ( 'opt-endereco-rio' );
	$GLOBALS['opt_telefone_rio']                 			= inkid_var ( 'opt-telefone-rio' );
	$GLOBALS['opt_mailcontato_rio']                  		= inkid_var ( 'opt-mail-contato-rio' );
	$GLOBALS['opt_mailreserva_rio']                  		= inkid_var ( 'opt-mail-reserva-rio' );
	
	$GLOBALS['opt_social_facebook']                  		= inkid_var ( 'opt-social-facebook' );
	$GLOBALS['opt_social_twitter']                 			= inkid_var ( 'opt-social-twitter' );
	$GLOBALS['opt_social_google']                  			= inkid_var ( 'opt-social-google' );
	$GLOBALS['opt_social_linkedin']                  		= inkid_var ( 'opt-social-linkedin' );
	
}
add_action( 'inkid_hook_header', 'inkid_reduxvariables' );

?>