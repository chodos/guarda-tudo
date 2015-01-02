<?php
/**
 * The template for booking
 * Template Name: Reservas - Etapa 1
 *
 * @package InkID
 *
 */

get_header(); 

?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : 
			the_post(); 
		?>

		<div class="line-block">
			<h1 class="reserva"><?php the_title(); ?></h1>
			<ul id="etapas-reserva">
				<li><span class="icon-nfull1"></span><span class="desc-etapa ativo">Seus Dados</span></li>
				<li><span class="icon-number2"></span><span class="desc-etapa">Seu Box</span></li>
				<li><span class="icon-number3"></span><span class="desc-etapa">Sua Reserva</span></li>
			</ul>
		</div>
		<form id="ReservaEtp1" class="form-reserva" method="post" action="#contato">
			<p><label for="campo_nome">Nome*</label><input type="text" id="campo_nome" name="campo_nome" value="<?php echo $nome; ?>" required></p>
			<p><label for="campo_razaosocial">Razão Social</label><input type="text" id="campo_razaosocial" name="campo_razaosocial"></p>
			<p><label for="campo_email">E-mail*</label><input type="email" id="campo_email" name="campo_email" value="<?php echo $email; ?>" required></p>
			<p><label for="campo_fone">Telefone</label><input type="text" id="campo_fone" name="campo_fone"></p>
			<p><label>Unidade*</label>
				<span class="input-radio"><input type="radio" id="campo_unidade_sp" name="campo_unidade" value="São Paulo" required><label class="label-radio" for="campo_unidade_sp">São Paulo</label></span>
				<span class="input-radio"><input type="radio" id="campo_unidade_rj" name="campo_unidade" value="Rio de Janeiro" required><label class="label-radio" for="campo_unidade_rj">Rio de Janeiro</label></span>
				<span class="input-radio"><input type="radio" id="campo_unidade_ca" name="campo_unidade" value="Campinas" required><label class="label-radio" for="campo_unidade_ca">Campinas</label></span>
			</p>
			<p style="text-align:right"><input type="submit" name="reserva_etp1" value="Continue"></p>
		</form>

		
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>