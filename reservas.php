<?php
/**
 * The template for booking
 * Template Name: Reservas
 *
 * @package InkID
 *
 */

get_header(); 

if (isset($_POST['reserva_etp1'])) {

	$nome = $_POST['campo_nome'];
	$email = $_POST['campo_email'];
	$razao = $_POST['campo_razaosocial'];
	$fone = $_POST['campo_fone'];
	$unidade = $_POST['campo_unidade'];

	$promocao = $_POST['campo_promocao'];

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
		<form id="ReservaEtp1" class="form-reserva" method="post" action="">
			
			<input type="hidden" name="campo_nome" value="<?php echo $nome; ?>">
			<input type="hidden" name="campo_email" value="<?php echo $email; ?>">
			<input type="hidden" name="campo_razaosocial" value="<?php echo $razao; ?>">
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

<?php } else {

if (isset($_POST['reserva_etp2'])) {
	global $opt_mailreserva_saopaulo;
	global $opt_mailreserva_campinas;
	global $opt_mailreserva_rio;

	$nome = $_POST['campo_nome'];
	$email = $_POST['campo_email'];
	$razao = $_POST['campo_razaosocial'];
	$fone = $_POST['campo_fone'];
	$unidade = $_POST['campo_unidade'];

	$promocao = $_POST['campo_promocao'];

	$tamanho = $_POST['campo_tamanho'];
	$data = $_POST['campo_data'];
	$conhecido = $_POST['campo_conheceu'];

	if ($unidade == "São Paulo") {
		$destinatario = $opt_mailreserva_saopaulo;
	}
	else {
		if ($unidade == "Rio de Janeiro") {
			$destinatario = $opt_mailreserva_rio;
		}
		else {
			$destinatario = $opt_mailreserva_campinas;
		}
	}

	$assunto = "Reserva via Site";

	$corpo = '
		<html>
			<head>
				<title>Reserva via Site</title>
			</head>
			<body>
				<p><b>E-mail Automático.</b> Você recebeu uma nova reserva feita via site.</p>
				<p>	Nome: '. $nome .'<br />
					Razão Social: '. $razao .'<br />
					E-mail: '. $email .'<br />
					Telefone: '. $fone .'</p>
				<p>	Promoção: '. $promocao .'</p>
				<p>	Unidade: '. $unidade .'<br />
					Tamanho: '. $tamanho .'<br />
					Data Prevista de Entrada: '. $data .'</p>
				<p>Como Conheceu: '. $conhecido .'</p>
			</body>
		</html>
		'; 

	//para o envio em formato HTML
	$headers = "MIME-Version: 1.1\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		
	//endereço do remetente
	$headers .= "From: Storage Guarda-Tudo<contato@storageguardatudo.com.br>\n";
	$headers .= "Return-Path: Storage Guarda-Tudo<contato@storageguardatudo.com.br>\n";

	$result = mail($destinatario, $assunto, $corpo, $headers, "-r". "contato@astorageguardatudo.com.br");

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
				<li><span class="icon-npassado2"></span><span class="desc-etapa">Seu Box</span></li>
				<li><span class="icon-nfull3"></span><span class="desc-etapa ativo">Sua Reserva</span></li>
			</ul>
		</div>

		<?php if ($result) : ?>

		<div class="line-block">
			<p>Reserva efetuada com sucesso em breve entraremos em contato para confirmar detalhes do seu box.</p>
			<p class="reserva-info">
				<span>Unidade Storage Guarda-Tudo</span>
				<?php
					global $opt_endereco_saopaulo;
					global $opt_telefone_saopaulo;
					global $opt_endereco_campinas;
					global $opt_telefone_campinas;
					global $opt_endereco_rio;
					global $opt_telefone_rio;

	
					if ( $unidade == "São Paulo" ) {
						echo '<span style="color:#144461">São Paulo<br />';
						echo $opt_endereco_saopaulo . "<br />";
						foreach ($opt_telefone_saopaulo as $fone) {
							echo '<span>' . $fone . '</span>';
						}
						echo '</span>';
					}
					else {
						if ( $unidade == "Rio de Janeiro" ) {
							echo '<span style="color:#144461">Rio de Janeiro<br />';
							echo $opt_endereco_rio . "<br />";
							foreach ($opt_telefone_rio as $fone) {
								echo '<span>' . $fone . '</span>';
							}
							echo '</span>';
						}
						else {
							if ( $unidade == "Campinas" ) {
								echo '<span style="color:#144461">Campinas<br />';
								echo $opt_endereco_campinas . "<br />";
								foreach ($opt_telefone_campinas as $fone) {
									echo '<span>' . $fone . '</span>';
								}
								echo '</span>';
							}
							else {
								echo "WR/NC Unit";
							}
						}
					}
				?>
			</p>
			<p class="reserva-info"><span>Data Prevista de Entrada</span><span style="color:#144461"><?php echo $data; ?></span></p>
		</div>
		
		<?php else : ?>

		<div class="line-block">
			<p>Houve um erro no envio de sua reserva, por favor tente novamente mais tarde.</p>
		</div>

		<?php endif; ?>
		
		<?php endif; ?>
	</div>
</div>
<?php } else { ?>

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
		<form id="ReservaEtp1" class="form-reserva" method="post" action="">
			<p><label for="campo_nome">Nome*</label><input type="text" id="campo_nome" name="campo_nome" value="<?php echo $nome; ?>" required></p>
			<p><label for="campo_razaosocial">Razão Social</label><input type="text" id="campo_razaosocial" name="campo_razaosocial"></p>
			<p><label for="campo_email">E-mail*</label><input type="email" id="campo_email" name="campo_email" value="<?php echo $email; ?>" required></p>
			<p><label for="campo_fone">Telefone</label><input type="text" id="campo_fone" name="campo_fone"></p>
			<p><label>Unidade*</label>
				<span class="input-radio"><input type="radio" id="campo_unidade_sp" name="campo_unidade" value="São Paulo" required><label class="label-radio" for="campo_unidade_sp">São Paulo</label></span>
				<span class="input-radio"><input type="radio" id="campo_unidade_rj" name="campo_unidade" value="Rio de Janeiro" required><label class="label-radio" for="campo_unidade_rj">Rio de Janeiro</label></span>
				<span class="input-radio"><input type="radio" id="campo_unidade_ca" name="campo_unidade" value="Campinas" required><label class="label-radio" for="campo_unidade_ca">Campinas</label></span>
			</p>
			<p style="text-align:right"><input type="submit" name="reserva_etp1" value="Escolha o Box"></p>
		</form>

		
		<?php endif; ?>
	</div>
</div>

<?php }
}

get_footer(); ?>