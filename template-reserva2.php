<?php
/**
 * The template for booking
 * Template Name: Reservas - Etapa 2
 *
 * @package InkID
 *
 */

get_header(); 

if ($_POST['reserva_etp1']) {

	$nome = $_POST['campo_nome'];
	$email = $_POST['campo_email'];
	$razao = $_POST['campo_razaosocial'];
	$fone = $_POST['campo_fone'];
	$unidade = $_POST['campo_unidade'];

	$promocao = $_POST['campo_promocao'];
}

?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : 
			the_post(); 
		?>

		<div class="line-block">
			<h1 class="reserva"><?php the_title(); ?></h1>
			<ul id="etapas-reserva">
				<li><span class="icon-npassado1"></span><span class="desc-etapa">Seus Dados</span></li>
				<li><span class="icon-nfull2"></span><span class="desc-etapa ativo">Seu Box</span></li>
				<li><span class="icon-number3"></span><span class="desc-etapa">Sua Reserva</span></li>
			</ul>
		</div>
		<form id="ReservaEtp1" class="form-reserva" method="post" action="<?php echo get_permalink(53); ?>">
			
			<input type="hidden" name="campo_nome" value="<?php echo $nome; ?>">
			<input type="hidden" name="campo_email" value="<?php echo $email; ?>">
			<input type="hidden" name="campo_razao" value="<?php echo $razao; ?>">
			<input type="hidden" name="campo_fone" value="<?php echo $fone; ?>">
			<input type="hidden" name="campo_unidade" value="<?php echo $unidade; ?>">
			<input type="hidden" name="campo_promocao" value="<?php echo $promocao; ?>">
			
			<div class="size-choice">
				<input type="radio" name="campo_tamanho" value="2m2">
				<h2>2 m²</h2>
				<p>08 caxas médias,1 geladeira, 1 sofá, 4 cadeiras e uma mesa</p>
				<img src="<?php echo get_template_directory_uri(); ?>/images/tamanhos/self-storage-2m.jpg" width="100%">
			</div>
			<div class="size-choice">
				<input type="radio"  name="campo_tamanho" value="5m2">
				<h2>5 m²</h2>
				<p>Mobília completa de 1 apartamento de 1 dormitório com aprox. 70 m²</p>
				<img src="<?php echo get_template_directory_uri(); ?>/images/tamanhos/self-storage-5m.jpg" width="100%">
			</div>
			<div class="size-choice">
				<input type="radio" name="campo_tamanho" value="7,5m2">
				<h2>7,5 m²</h2>
				<p>Mobília completa de 1 apartamento de 2 dormitórios com aprox. 90 m²</p>
				<img src="<?php echo get_template_directory_uri(); ?>/images/tamanhos/self-storage-7m.jpg" width="100%">
			</div>
			<div class="size-choice">
				<input type="radio" name="campo_tamanho" value="21m2">
				<h2>21 m²</h2>
				<p>Mobilia completa de uma casa de 4 dormitórios com aprox. 300m²</p>
				<img src="<?php echo get_template_directory_uri(); ?>/images/tamanhos/self-storage-21m.jpg" width="100%">
			</div>
			<div class="size-choice">
				<input type="radio" name="campo_tamanho" value="indefinido">
				<h2>+ OPÇÕES</h2>
				<p>São 15 tamanhos diferentes de boxes, variando de 1 m² a 40 m². <b>Ficou indeciso?</b> Marque essa opção para indicarmos a melhor opção para você.</p>
			</div>

			<p class="aviso amarelo">Tamanhos de box sujeitos a disponibilidade.</p>
			
			<?php if ((isset($promocao)) && ($promocao != '')) { ?>
				<p class="aviso verde">Promoção: <?php echo $promocao; ?></p>
			<?php } ?>

			<p style="margin-top:20px;"><label style="width:20%" for="campo_data">Entrada Prevista</label><input type="text" id="campo_data" name="campo_data" data-beatpicker="true" data-beatpicker-module="footer,clear" data-beatpicker-format="['DD','MM','YYYY'],separator:'/'"></p>

			<p>
				<label style="width:20%" for="campo_conheceu">Como nos conheceu?</label>
				<select style="width:25%" id="campo_conheceu" name="campo_conheceu">
					<option value="Site de Busca">Site de Busca</option>
					<option value="Lista Amarela">Lista Amarela</option>
					<option value="Mala Direta">Mala Direta</option>
					<option value="Indicação">Indicação</option>
					<option value="outro">Outro</option>
				</select>
				<span id="campo_outro" style="display:none"><label style="width:20%">Qual?</label><input type="text" name="campo_outro" style="width:30%"></span>
			</p>
			
			<p style="text-align:right"><input type="submit" name="reserva_etp2" value="Concluir Reserva"></p>
		</form>

		
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>