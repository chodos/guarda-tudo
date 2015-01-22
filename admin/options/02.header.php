<?php
/**
 * Header config Functions.
 *
 * @package InkID
 */

/* ----------------------------------------------------------------------------------
	HEADER STYLE
---------------------------------------------------------------------------------- */

function inkid_personalize_header() {
	global $opt_background_header;
	global $opt_color_header;

	$output = NULL;

	if ( !empty( $opt_background_header ) ) {
		$output .= '.site-header { background: url("' . $opt_background_header . '") repeat-x 30% 72% }' . "\n";
	}

	if ( !empty( $opt_color_header ) ) {
		$output .= '.site-header { background-color: ' . $opt_color_header . ' }' . "\n";
	}

	return $output;
}

function inkid_input_personalize_header() {
	$output = NULL;

	$output .= inkid_personalize_header();

	if ( !empty( $output ) ) {
		echo    '<style type="text/css" class="personalize-output">' . "\n" . $output . '</style>';
	}
}
add_action( 'wp_head', 'inkid_input_personalize_header', 13 );

function inkid_slider_phones() {
	global $opt_telefone_saopaulo;
	global $opt_telefone_campinas;
	global $opt_telefone_rio;

	if ( (empty($opt_telefone_saopaulo['1'])) && (empty($opt_telefone_saopaulo['2'])) && (empty($opt_telefone_campinas['1'])) && (empty($opt_telefone_campinas['2'])) &&(empty($opt_telefone_rio['1'])) && (empty($opt_telefone_rio['2'])) )
		return 0;

	echo '<div id="slider-fones">
			<ul class="rslides">';

				if ( (!empty($opt_telefone_saopaulo['1'])) || (!empty($opt_telefone_saopaulo['2'])) ) {
					echo '<li><p><span class="title">São Paulo</span><br /><span class="fones">';
					foreach ($opt_telefone_saopaulo as $fone) {
						echo $fone . '<br />';
					}
					echo '</span></p></li>';
				}

				if ( (!empty($opt_telefone_rio['1'])) || (!empty($opt_telefone_rio['2'])) ) {
					echo '<li><p><span class="title">Rio de Janeiro</span><br /><span class="fones">';
					foreach ($opt_telefone_rio as $fone) {
						echo $fone . '<br />';
					}
					echo '</span></p></li>';
				}

				if ( (!empty($opt_telefone_campinas['1'])) || (!empty($opt_telefone_campinas['2'])) ) {
					echo '<li><p><span class="title">Campinas</span><br /><span class="fones">';
					foreach ($opt_telefone_campinas as $fone) {
						echo $fone . '<br />';
					}
					echo '</span></p></li>';
				}
	echo '</ul>
		</div>';
}

function inkid_show_header_promotion() {
	$args = array(
				'post_type' => 'promocoes',
				'meta_query'=> array(
        							array(
            							'key' => 'exibicao_desconto_promocao',
            							'compare' => '=',
            							'value' => 'Cabeçalho',
        							)
   	 							),
				'posts_per_page' => 1
			);
	$main_promotion = new WP_Query($args);

	if( $main_promotion->have_posts() ):  
		$main_promotion->the_post(); ?>

		<a href="<?php the_permalink(); ?>"><button class="button-reserva-header">Promoção! &nbsp;&nbsp;&#x25BC;</button></a>
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<div class="box-promocao-header">
				<p class="titulo"><?php the_title(); ?></p>
				<p class="desconto"><?php echo get_post_meta(get_the_ID(), 'valor_desconto_promocao', true); ?> desconto</p>
				<p class="reserve">Reserve Agora</p>
			</div>
		</a>
				
	<?php endif;
}

function inkid_show_booking_button() {
	$pag_booking = return_booking_page();
	if ($pag_booking) {
		echo '<p><a href="' . $pag_booking . '" title="Consulte valores de Armazenagem"><button>Solicite Orçamento</button></a></p>';
	}
}

?>