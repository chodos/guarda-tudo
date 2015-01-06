<?php
/**
 * The template for booking
 * Template Name: Reservas - Etapa 3
 *
 * @package InkID
 *
 */

get_header(); 

if ($_POST['reserva_etp2']) {
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

	$result = mail($destinatario, $assunto, $corpo, $headers, "-r". "contato@akitaeventos.com.br");
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
				<li><span class="icon-npassado2"></span><span class="desc-etapa">Seu Box</span></li>
				<li><span class="icon-nfull3"></span><span class="desc-etapa ativo">Sua Reserva</span></li>
			</ul>
		</div>

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
		

		
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>