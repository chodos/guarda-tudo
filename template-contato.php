<?php
/**
 * The template for contact
 * Template Name: Contato
 *
 * @package InkID
 *
 */

get_header(); 

if ($_POST['envia_mail']) {

		$nome = $_POST['campo_nome'];
		$email = $_POST['campo_email'];
		$unidade =	$_POST['campo_unidade'];
		$mensagem = $_POST['campo_mensagem'];
		
		$destinatario = chx_input_contact_destiny( $unidade );
		$assunto = "Contato via SITE";
		
		$extra_fields = chx_write_extra_fields($_POST);
		
		$corpo = '
		<html>
			<head>
				<title>Novo Contato via Site</title>
			</head>
			<body>
				<b>Correio Eletrônico.</b> Você recebeu uma nova mensagem de um visitante.<br />
				<h2>'. $nome .'</h2>
				<br />
				<h3>Mensagem: '. $mensagem .'</h3>
				<br />
				<p>
				E-mail: '. $email .'<br />
				</p>
				' . $extra_fields . '
			</body>
		</html>
		'; 
	
		//para o envio em formato HTML
		$headers = "MIME-Version: 1.1\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		
		//endereço do remetente
		$headers .= "From: Storage Guarda-Tudo<site@storageguardatudo.com.br>\n";
		$headers .= "Return-Path: Storage Guarda-Tudo<site@storageguardatudo.com.br>\n";
	
		//endereços que receberão uma copia 
		//$headers .= "Cc: caio.hodos@yahoo.com.br\r\n"; 
	
	
		//$result = mail($destinatario,$assunto,$corpo,$headers);
		$result = mail($destinatario, $assunto, $corpo, $headers, "-r". "site@storageguardatudo.com.br");
		
		$erro = '<p><b>Falha no envio de e-mail, por favor tente novamente.</b></p>';
		
		$sucesso = '<p><b>E-mail enviado com sucesso, em breve retornaremos o contato.</b></p>';		
}

?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : 
				the_post(); 
				$chamada_topo = get_post_meta(get_the_ID(), 'call_action_page', true);
				$botao_topo = get_post_meta(get_the_ID(), 'button_action_page', true);
				$link_topo = get_post_meta(get_the_ID(), 'link_action_page', true);
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="line-block">
				<?php if(has_post_thumbnail()) : ?>
				<?php 
					inkid_top_sidebar_change( $post->ID ); 
				?>
					<div class="page-topo">
						<?php if(!empty($chamada_topo)) { ?>
						<div class="capa-overflow">
							<p><?php echo $chamada_topo; ?></p>
							<?php if(!empty($botao_topo)) { ?> <a href="<?php echo $link_topo; ?>"><button><?php echo $botao_topo; ?></button></a> <?php } ?>
						</div>
						<?php } the_post_thumbnail('full'); ?>
					</div>
				<?php endif; ?>
					<div class="page-title"><h1><?php the_title(); ?></h1></div>	
					<?php inkid_print_destaques_pages(get_post_meta(get_the_ID(), '_destaques_topo_page', true)); ?>
					<div class="contact-confirmation"><?php if(!$result) : echo $erro; else : echo $sucesso; endif; ?></div>
				</header>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
			</article>		
			
			<form id="formContato" class="form-contato line-block" name="formContato" method="post" action="#contato">
				<p><label>Nome*</label>
					<input type="text" name="campo_nome" required></p>
				<p><label>E-mail*</label>
					<input type="email" name="campo_email" required></p>
				<?php chx_newinput_contact(); ?>
				<p>
					<label>Unidade*</label>
					<span class="input-radio"><input type="radio" id="campo_unidade_sp" name="campo_unidade" value="SP" required><label class="label-radio" for="campo_unidade_sp">São Paulo</label></span>
					<span class="input-radio"><input type="radio" id="campo_unidade_rj" name="campo_unidade" value="RJ" required><label class="label-radio" for="campo_unidade_rj">Rio de Janeiro</label></span>
					<span class="input-radio"><input type="radio" id="campo_unidade_ca" name="campo_unidade" value="CA" required><label class="label-radio" for="campo_unidade_ca">Campinas</label></span>
				</p>
				<p><label>Mensagem</label>
					<textarea name="campo_mensagem" rows="4" required></textarea></p>
				<p style="text-align:right"><input type="submit" class="send-button" name="envia_mail" value="Enviar" /></p>
			</form>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>