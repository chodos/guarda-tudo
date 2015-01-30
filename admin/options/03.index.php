<?php
/**
 * Index config Functions.
 *
 * @package InkID
 */

function show_main_what_video_home() {
	global $opt_layout_sections_home;
	global $opt_layout_sections_what_video;

	if (!empty($opt_layout_sections_home['enabled']['whatvideo'])) {
		$number_enable = count($opt_layout_sections_what_video['enabled']);
	
		if (($number_enable == 3) && (!empty($opt_layout_sections_what_video['enabled']['selo']))) {
			$number_enable = 5;
		}
	
		$layout = $opt_layout_sections_what_video['enabled'];
	
		if ($layout): foreach ($layout as $key=>$value) {
			if ($key == 'what') {
				show_main_post_home($number_enable);
			}
			else {
				if ($key == 'video') {
					show_video_home($number_enable);
				}
				else {
					if ($key == 'selo') {
						echo "<img class='selo-home$number_enable' src='" . get_template_directory_uri() . "/images/selo.png' />";
					}
				}
			}
		}
		endif;
	}
}

function show_main_post_home($enables) {
	global $opt_select_main_post_home;
	
	$args = array(
				'p' => $opt_select_main_post_home,
				'posts_per_page' => 1
			);
	$main_post = new WP_Query($args);

	if( $main_post->have_posts() ):  
		$main_post->the_post();
		echo "<div class='box-what size$enables'>";
		get_template_part( 'main-post-home', get_post_format() );	
		echo "</div>";
	endif;
}

function show_video_home($enables){
	echo "<div class='box-what size$enables' style='max-width:48%'>
				<iframe width='100%' height='215px' src='//www.youtube.com/embed/w-KKTS8sXEw?rel=0&amp;showinfo=0' frameborder='0' allowfullscreen></iframe>
			</div>";
}

function inkid_show_info_units_index() {
	global $opt_endereco_saopaulo;
	global $opt_telefone_saopaulo;
	global $opt_endereco_campinas;
	global $opt_telefone_campinas;
	global $opt_endereco_rio;
	global $opt_telefone_rio;

	if ((!empty($opt_endereco_saopaulo)) || ( (!empty($opt_telefone_saopaulo['1'])) || (!empty($opt_telefone_saopaulo['2'])) )) {
		echo 	"<h2 class='accordion'>Unidade São Paulo<span>+</span></h2>
				<div class='accordion'>
					<p>$opt_endereco_saopaulo</p><p>";

					foreach ($opt_telefone_saopaulo as $fone) {
						echo "<span>" . $fone . "</span>";
					}
		echo	"</p></div>";
	}

	if ((!empty($opt_endereco_campinas)) || ( (!empty($opt_telefone_campinas['1'])) || (!empty($opt_telefone_campinas['2'])) )) {
		echo 	"<h2 class='accordion'>Unidade Campinas<span>+</span></h2>
				<div class='accordion'>
					<p>$opt_endereco_campinas</p><p>";

					foreach ($opt_telefone_campinas as $fone) {
						echo "<span>" . $fone . "</span>";
					}
		echo	"</p></div>";
	}

	if ((!empty($opt_endereco_rio)) || ( (!empty($opt_telefone_rio['1'])) || (!empty($opt_telefone_rio['2'])) )) {
		echo 	"<h2 class='accordion'>Unidade Rio de Janeiro<span>+</span></h2>
				<div class='accordion'>
					<p>$opt_endereco_rio</p><p>";

					foreach ($opt_telefone_rio as $fone) {
						echo "<span>" . $fone . "</span>";
					}
		echo	"</p></div>";
	}	
}

function inkid_show_home_promotion() {
	$args = array(
				'post_type' => 'promocoes',
				'meta_query'=> array(
        							array(
            							'key' => 'exibicao_desconto_promocao',
            							'compare' => '=',
            							'value' => 'Home',
        							)
   	 							)
			);
	$slide_promotion = new WP_Query($args);

	if( $slide_promotion->have_posts() ):  ?>
		<div style="position:absolute;z-index:5;margin-top:-6px;margin-left:30px"><img src="<?php echo get_template_directory_uri(); ?>/images/promocao.png"></div>
		<ul class="rslides">
		<?php while ( $slide_promotion->have_posts() ) : $slide_promotion->the_post(); ?>
			<li>		
				<a href="<?php the_permalink(); ?>">		
					<div class="box-slider-promocao">
						<div class="image-promocao">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="info-promocao">
							<p class="titulo"><?php the_title(); ?></p>
							<p>GUARDA-TUDO</p>
							<p class="botao">Saiba Mais</p>
						</div>
					</div>
				</a>
			</li>		
		<?php endwhile; ?>
		</ul>
	<?php endif;
}

function inkid_show_promocao_selo() {
	global $opt_layout_sections_home;

	if (!empty($opt_layout_sections_home['enabled']['selopromotion'])) { ?>
		<div style="width:48%;display:inline-block;vertical-align:top;margin:25px 0;text-align:center">
			<img src="<?php echo get_template_directory_uri() . '/images/asbrass.png'?>">
		</div>
		<div style="width:50%;display:inline-block;">	
			<?php inkid_show_home_promotion(); ?>
		</div>
	<?php }
}

function inkid_show_testimonial_button() {
	$pag_testimonial = return_testimonial_page();
	if ($pag_testimonial) {
		echo '<a href="' . $pag_testimonial . '" title="Avaliações de nossos clientes"><div class="comentarios-desc-home"><h4>Veja as avaliações de nossos clientes</h4><p>Deixe aqui o seu depoimento também!</p></div></a>';
	}
}

?>