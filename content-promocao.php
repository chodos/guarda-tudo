<?php
/**
 * The promotions content
 * 
 *
 * @package InkID
 */

?>

<div class="line-block">
	<div class="single-promotion">
		<h2><?php the_title(); ?></h2>
		<h3><?php echo get_post_meta(get_the_ID(), 'valor_desconto_promocao', true); ?> de desconto</h3>
		<p><?php echo get_post_meta(get_the_ID(), 'descricao_promocao', true); ?></p>
	</div>
	<div class="single-promotion">
		<form id="formReservaPromocao" name="formReservaPromocao" method="post" action="<?php echo get_permalink(51); ?>">
			<p class="titulo">Reserve ONLINE</p>
			<p>Em poucos passos você realiza sua reserva online</p>
			<p><label for="campo_nome">Nome</label><input type="text" id="campo_nome" name="campo_nome" required></p>
			<p><label for="campo_email">E-mail</label><input type="email" id="campo_email" name="campo_email" required></p>
			<p><label for="campo_fone">Telefone</label><input type="text" id="campo_fone" name="campo_fone"></p>
			<input type="hidden" name="campo_unidade" value="<?php echo get_post_meta(get_the_ID(), 'unidade_responsavel_promocao', true); ?>">
			<input type="hidden" name="campo_promocao" value="<?php the_title(); ?>">
			<p style="width:95%;text-align:right"><input type="submit" name="reserva_etp1" value="Continue"></p>
		</form>
		<p class="titulo">Ligue Agora</p>
		<p class="numbers">
			<?php
				global $opt_telefone_saopaulo;
				global $opt_telefone_campinas;
				global $opt_telefone_rio;
				$unidade = get_post_meta(get_the_ID(), 'unidade_responsavel_promocao', true);

				if ( $unidade == "São Paulo" ) {
					foreach ($opt_telefone_saopaulo as $fone) {
						echo "<span>" . $fone . "</span>";
					}
				}
				else {
					if ( $unidade == "Rio de Janeiro" ) {
						foreach ($opt_telefone_rio as $fone) {
							echo "<span>" . $fone . "</span>";
						}
					}
					else {
						if ( $unidade == "Campinas" ) {
							foreach ($opt_telefone_campinas as $fone) {
								echo "<span>" . $fone . "</span>";
							}
						}
						else {
							echo "WR/NC Unit";
						}
					}
				}
			?>
		</p>
	</div>
</div>

<?php

	$args = array(
				'post_type' => 'promocoes',
				'post__not_in' => array( get_the_ID() )
			);
	$promotions = new WP_Query($args);

	if( $promotions->have_posts() ):  ?>
		<div class="line-block">
			<p class="mais-promocoes"><span>Mais Promoções</span></p>
			<?php while ( $promotions->have_posts() ) : $promotions->the_post(); ?>
				<div class="single-promotion">
					<div class="selo-promocao"><?php echo get_post_meta(get_the_ID(), 'valor_desconto_promocao', true); ?></div>
					<div class="descricao">
						<h4><?php the_title(); ?></h4>
						<p><?php echo get_post_meta(get_the_ID(), 'descricao_promocao', true); ?></p>
						<p style="text-align:right"><a href="<?php the_permalink(); ?>"><button>Saiba Mais</button></a></p>
					</div>
				</div>
<?php 		endwhile; ?>
		</div>
<?php endif; ?>