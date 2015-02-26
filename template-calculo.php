<?php
/**
 * The template for displaying "Calculadora de Box"
 * Template Name: Calculadora
 *
 * @package InkID
 *
 */

get_header(); 
wp_enqueue_script('calculadora-script');
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
				</header>

					<div class="entry-content">

						<?php the_content(); ?>

						<form id="form1" name="form1">

						<input id="calculadora_unidade" name="calculadora_unidade" type="hidden" value="<?php echo chx_return_page_calculdora($post->ID); ?>" />

						<div class="calculo_1">
							<ul class="calculo_menu">
								<li><a href="#" class="sala">Sala</a></li>
								<li><a href="#" class="dormitorio">Dormitório</a></li>
								<li><a href="#" class="cozinha">Cozinha / Serviço</a></li>
								<li><a href="#" class="escritorio">Escritório</a></li>
								<li><a href="#" class="embalagem">Embalagem / Diversos</a></li>
								<li><a href="#" class="outros">Outros objetos</a></li>
							</ul>
							<div class="div_calculos">
								<ul id="sala" class="escondido">
									<li>
										<label>Banqueta - Puff</label>
										<input name="textfield2" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="puff" ID="puff" value="0.11" class="camp_obj" />
									</li>
									<li>
										<label>Bar grande</label>
										<input name="textfield3" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="barg" ID="barg" value="1.1" class="camp_obj" />
									</li>
									<li>
										<label>Bar pequeno</label>
										<input name="textfield4" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="barp" class="camp_obj" ID="barp" value="0.66" />
									</li>
									<li>
										<label>Ba&uacute;</label>
										<input name="textfield5" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="bau" class="camp_obj" ID="bau" value="0.44" />
									</li>
									<li>
										<label>Buffet</label>
										<input name="textfield13" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="buff" class="camp_obj" ID="buff" value="1.1" />
									</li>
									<li>
										<label>Cadeira c/ braço</label>
										<input name="textfield14" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="cadb" class="camp_obj" ID="cadb" value="0.33" />
									</li>
									<li>
										<label>Cadeira simples</label>
										<input name="textfield6" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="cads" class="camp_obj" ID="cads" value="0.22" />
									</li>
									<li>
										<label>Carrinho de chá</label>
										<input name="textfield15" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="carr" class="camp_obj" ID="carr" value="0.33" />
									</li>
									<li>
										<label>Console de parede</label>
										<input name="textfield16" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="cons" class="camp_obj" ID="cons" value="0.33" />
									</li>
									<li>
										<label>Cristaleira</label>
										<input name="textfield7" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="crist" class="camp_obj" ID="crist" value="0.88" />
									</li>
									<li>
										<label>Escrivaninha grande</label>
										<input name="textfield18" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="escrg" class="camp_obj" ID="escrg" value="1.1" />
									</li>
									<li>
										<label>Escrivaninha pq</label>
										<input name="textfield17" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="escrp" class="camp_obj" ID="escrp" value="0.66" />
									</li>
									<li>
										<label>Estante alta</label>
										<input name="textfield8" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="esta" class="camp_obj" ID="esta" value="0.66" />
									</li>
									<li>
										<label>Estante baixa</label>
										<input name="textfield19" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="estb" class="camp_obj" ID="estb" value="0.33" />
									</li>
									<li>
										<label>Mesa de centro</label>
										<input name="textfield20" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="mesc" class="camp_obj" ID="mesc" value="0.33" />
									</li>
									<li>
										<label>Mesa console</label>
										<input name="textfield9" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="mescon" class="camp_obj" ID="mescon" value="0.33" />
									</li>
									<li>
										<label>Mesa de jantar</label>
										<input name="textfield21" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="mesj" class="camp_obj" ID="mesj" value="0.88" />
									</li>
									<li>
										<label>Órgão</label>
										<input name="textfield22" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="org" class="camp_obj" ID="org" value="0.88" />
									</li>
									<li>
										<label>Piano armário</label>
										<input name="textfield10" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="pianoa" class="camp_obj" ID="pianoa" value="6.6" />
									</li>
									<li>
										<label>Poltrona simples</label>
										<input name="textfield23" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="pols" class="camp_obj" ID="pols" value="0.55" />
									</li>
									<li>
										<label>Sofá 2 lugares</label>
										<input name="textfield24" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="sofa2" class="camp_obj" ID="sofa2" value="1.1" />
									</li>
									<li>
										<label>Sofá 3 lugares</label>
										<input name="textfield11" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="sofa3" class="camp_obj" ID="sofa3" value="1.65" />
									</li>
									<li>
										<label>Sofá 4 lugares</label>
										<input name="textfield25" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="sofa4" class="camp_obj" ID="sofa4" value="2.2" />
									</li>
									<li>
										<label>TV</label>
										<input name="textfield26" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="tv" class="camp_obj" ID="tv" value="0.33" />
									</li>
									<li>
										<label>Som/Vídeo</label>
										<input name="textfield12" type="text" class="style3 camp_obj" placeholder="0" />
										<input type="hidden" name="som" class="camp_obj" ID="som" value="0.33" />
									</li>
									<li>
										<label>Piano cauda</label>
										<input name="textfield255" type="text" class="style3 camp_obj" id="Text2" placeholder="0" />
										<input type="hidden" name="pianoc" class="camp_obj" ID="pianoc" value="6.6" />
									</li>
								</ul>			
								<ul id="dormitorio" class="escondido">
									<li>
										<label>Arca</label>
										<input type="text" name="textfield122" placeholder="0" class="camp_obj" />
										<input type="hidden" name="arca" ID="arca" value="0.44" />
									</li>
									<li>
										<label>Arm. 2 pts. desmontado</label>
										<input type="text" name="textfield126" placeholder="0" class="camp_obj" />
										<input type="hidden" name="arm2" class="camp_obj" ID="arm2" value="1.1" />
									</li>
									<li>
										<label>Arm. 3 pts. desmontado</label>
										<input type="text" name="textfield1210" placeholder="0" class="camp_obj" />
										<input type="hidden" name="arm3" class="camp_obj" ID="arm3" value="1.65" />
									</li>
									<li>
										<label>Berço com colchão&nbsp;</label>
										<input type="text" name="textfield123" placeholder="0" class="camp_obj" />
										<input type="hidden" name="berco" class="camp_obj" ID="berco" value="0.33" />
									</li>
									<li>
										<label>Cama beliche</label>
										<input type="text" name="textfield127" placeholder="0" class="camp_obj" />
										<input type="hidden" name="bel" class="camp_obj" ID="bel" value="2.2" />
									</li>
									<li>
										<label>Cama casal</label>
										<input type="text" name="textfield1211" placeholder="0" class="camp_obj" />
										<input type="hidden" name="camac" class="camp_obj" ID="camac" value="1.43" />
									</li>
									<li>
										<label>Cama de solteiro</label>
										<input type="text" name="textfield124" placeholder="0" class="camp_obj" />
										<input type="hidden" name="camas" class="camp_obj" ID="camas" value="1.1" />
									</li>
									<li>
										<label>Cômoda</label>
										<input type="text" name="textfield128" placeholder="0" class="camp_obj" />
										<input type="hidden" name="como" class="camp_obj" ID="como" value="0.44" />
									</li>
									<li>
										<label>Penteadeira</label>
										<input type="text" name="textfield1212" placeholder="0" class="camp_obj" />
										<input type="hidden" name="pent" class="camp_obj" ID="pent" value="0.77" />
									</li>
									<li>
										<label>Criado-mudo</label>
										<input type="text" name="textfield125" placeholder="0" class="camp_obj" />
										<input type="hidden" name="cria" class="camp_obj" ID="cria" value="0.22" />
									</li>
									<li>
										<label>Quadros</label>
										<input type="text" name="textfield129" placeholder="0" class="camp_obj" />
										<input type="hidden" name="quad" class="camp_obj" ID="quad" value="0.11" />
									</li>
									<li>
										<label>Cabideiro</label>
										<input id="Text4" type="text" name="textfield12511" placeholder="0" class="camp_obj" />
										<input type="hidden" name="cab" ID="cab" value="0.33" />
									</li>
								</ul>			
								<ul id="cozinha" class="escondido">
									<li>
										<label>Armário paneleiro</label>
										<input type="text" name="textfield1252" placeholder="0" class="camp_obj" />
										<input type="hidden" name="panel" class="camp_obj" ID="panel" value="1.1" />
									</li>
									<li>
										<label>Arm. parede pequeno de 2 portas</label>
										<input type="text" name="textfield1256" placeholder="0" class="camp_obj" />
										<input type="hidden" name="armpp" class="camp_obj" ID="armpp" value="0.22" />
									</li>
									<li>
										<label>Cadeira</label>
										<input type="text" name="textfield1259" placeholder="0" class="camp_obj" />
										<input type="hidden" name="cadeira" class="camp_obj" ID="cadeira" value="0.66" />
									</li>
									<li>
										<label>Geladeira</label>
										<input type="text" name="textfield1253" placeholder="0" class="camp_obj" />
										<input type="hidden" name="gel" class="camp_obj" ID="gel" value="0.99" />
									</li>
									<li>
										<label>Freezer</label>
										<input type="text" name="textfield1257" placeholder="0" class="camp_obj" />
										<input type="hidden" name="frez" class="camp_obj" ID="frez" value="0.88" />
									</li>
									<li>
										<label>Exaustor</label>
										<input type="text" name="textfield12510" placeholder="0" class="camp_obj" />
										<input type="hidden" name="exa" class="camp_obj" ID="exa" value="0.11" />
									</li>
									<li>
										<label>Fogão(4 bocas)</label>
										<input type="text" name="textfield1254" placeholder="0" class="camp_obj" />
										<input type="hidden" name="fog4" class="camp_obj" ID="fog4" value="0.33" />
									</li>
									<li>
										<label>Máquina de lavar/secar</label>
										<input type="text" name="textfield1258" placeholder="0" class="camp_obj" />
										<input type="hidden" name="maql" class="camp_obj" ID="maql" value="0.55" />
									</li>
									<li>
										<label>Mesa cozinha</label>
										<input type="text" name="textfield125115" placeholder="0" class="camp_obj" />
										<input type="hidden" name="mescoz" class="camp_obj" ID="mescoz" value="0.33" />
									</li>
									<li>
										<label>Micro ondas</label>
										<input type="text" name="textfield1255" placeholder="0" class="camp_obj" />
										<input type="hidden" name="micond" class="camp_obj" ID="micond" value="0.11" />
									</li>
									<li>
										<label>Máquina	de lavar pratos</label>
										<input id="Text1" type="text" name="textfield12585" placeholder="0" class="camp_obj" />
										<input type="hidden" name="maqpra" class="camp_obj" ID="maqpra" value="0.55" />
									</li>
								</ul>
								<ul id="escritorio" class="escondido">
									<li>
										<label>Xerox</label>
										<input type="text" name="textfield12532" placeholder="0" class="camp_obj" />
										<input type="hidden" name="xer" class="camp_obj" ID="xer" value="0.55" />
									</li>
									<li>
										<label>Micro</label>
										<input type="text" name="textfield12537" placeholder="0" class="camp_obj" />
										<input type="hidden" name="micro" class="camp_obj" ID="micro" value="0.33" />
									</li>
									<li>
										<label>Impressora</label>
										<input type="text" name="textfield125312" placeholder="0" class="camp_obj" />
										<input type="hidden" name="imp" class="camp_obj" ID="imp" value="0.33" />
									</li>
									<li>
										<label>Fax</label>
										<input type="text" name="textfield12533" placeholder="0" class="camp_obj" />
										<input type="hidden" name="fax" class="camp_obj" ID="fax" value="0.11" />
									</li>
									<li>
										<label>Estante de aço</label>
										<input type="text" name="textfield12538" placeholder="0" class="camp_obj" />
										<input type="hidden" name="estantea" class="camp_obj" ID="estantea" value="1.1" />
									</li>
									<li>
										<label>Armário	de aço(alto de 2 portas)</label>
										<input type="text" name="textfield125313" placeholder="0" class="camp_obj" />
										<input type="hidden" name="arma2" class="camp_obj" ID="arma2" value="1.1" />
									</li>
									<li>
										<label>Arquivo de aço</label>
										<input type="text" name="textfield12534" placeholder="0" class="camp_obj" />
										<input type="hidden" name="arqa" class="camp_obj" ID="arqa" value="0.55" />
									</li>
									<li>
										<label>Escrivaninha</label>
										<input type="text" name="textfield12539" placeholder="0" class="camp_obj" />
										<input type="hidden" name="escriv" class="camp_obj" ID="escriv" value="0.44" />
									</li>
									<li>
										<label>Mesa</label>
										<input type="text" name="textfield125314" placeholder="0" class="camp_obj" />
										<input type="hidden" name="mesae" class="camp_obj" ID="mesae" value="0.55" />
									</li>
									<li>
										<label>Mapoteca</label>
										<input type="text" name="textfield12535" placeholder="0" class="camp_obj" />
										<input type="hidden" name="mapo" class="camp_obj" ID="mapo" value="0.55" />
									</li>
									<li>
										<label>Poltrona</label>
										<input type="text" name="textfield125310" placeholder="0" class="camp_obj" />
										<input type="hidden" name="polt" class="camp_obj" ID="polt" value="0.55" />
									</li>
									<li>
										<label>Cadeira</label>
										<input type="text" name="textfield125315" placeholder="0" class="camp_obj" />
										<input type="hidden" name="cades" class="camp_obj" ID="cades" value="0.22" />
									</li>
									<li>
										<label>Cofre grande</label>
										<input type="text" name="textfield12536" placeholder="0" class="camp_obj" />
										<input type="hidden" name="cofreg" class="camp_obj" ID="cofreg" value="0.55" />
									</li>
									<li>
										<label>Balcão</label>
										<input type="text" name="textfield125311" placeholder="0" class="camp_obj" />
										<input type="hidden" name="balc" class="camp_obj" ID="balc" value="0.55" />
									</li>
								</ul>
								<ul id="embalagem" class="escondido">
									<li>
										<label>Caixa</label>
										<input type="text" name="textfield125362" placeholder="0" class="camp_obj" />
										<input type="hidden" name="caixa" class="camp_obj" ID="caixa" value="0.22" />
									</li>
									<li>
										<label>Caixa plástica</label>
										<input type="text" name="textfield125366" placeholder="0" class="camp_obj" />
										<input type="hidden" name="cxplas" class="camp_obj" ID="cxplas" value="0.22" />
									</li>
									<li>
										<label>Máq. costura</label>
										<input type="text" name="textfield1253610" placeholder="0" class="camp_obj" />
										<input type="hidden" name="maqcos" class="camp_obj" ID="maqcos" value="0.44" />
									</li>
									<li>
										<label>Caixa p/ cristais</label>
										<input type="text" name="textfield125363" placeholder="0" class="camp_obj" />
										<input type="hidden" name="cxcris" class="camp_obj" ID="cxcris" value="0.11" />
									</li>
									<li>
										<label>Aquecedor</label>
										<input type="text" name="textfield125367" placeholder="0" class="camp_obj" />
										<input type="hidden" name="aquec" class="camp_obj" ID="aquec" value="0.22" />
									</li>
									<li>
										<label>Ar condicionado</label>
										<input type="text" name="textfield1253611" placeholder="0" class="camp_obj" />
										<input type="hidden" name="arcon" class="camp_obj" ID="arcon" value="0.33" />
									</li>
									<li>
										<label>Bicicleta</label>
										<input type="text" name="textfield125364" placeholder="0" class="camp_obj" />
										<input type="hidden" name="bike" class="camp_obj" ID="bike" value="0.33" />
									</li>
									<li>
										<label>Arquivo</label>
										<input type="text" name="textfield125368" placeholder="0" class="camp_obj" />
										<input type="hidden" name="arquivo" class="camp_obj" ID="arquivo" value="0.56" />
									</li>
									<li>
										<label>Bancada</label>
										<input type="text" name="textfield1253612" placeholder="0" class="camp_obj" />
										<input type="hidden" name="bancada" class="camp_obj" ID="bancada" value="0.33" />
									</li>
								</ul>
								<div id="outros" class="escondido">
									<ul>
										<li>
											<label>Altura</label>
											<input type="text" name="textfield28" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">+</li>
										<li>
											<label>Largura</label>
											<input type="text" name="textfield29" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">+</li>
										<li>
											<label>Comprimento</label>
											<input type="text" name="textfield30" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">=</li>
										<li>
											<label>Total</label>
											<input type="text" name="textfield31" class="camp_obj total"> M<sup>3</sup>
										</li>
									</ul>
									<ul>
										<li>
											<label>Altura</label>
											<input type="text" name="textfield282" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">+</li>
										<li>
											<label>Largura</label>
											<input type="text" name="textfield292" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">+</li>
										<li>
											<label>Comprimento</label>
											<input type="text" name="textfield302" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">=</li>
										<li>
											<label>Total</label>
											<input type="text" name="textfield312" class="camp_obj total"> M<sup>3</sup>
										</li>
									</ul>
									<ul>
										<li>
											<label>Altura</label>
											<input type="text" name="textfield283" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">+</li>
										<li>
											<label>Largura</label>
											<input type="text" name="textfield293" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">+</li>
										<li>
											<label>Comprimento</label>
											<input type="text" name="textfield303" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">=</li>
										<li>
											<label>Total</label>
											<input type="text" name="textfield313" class="camp_obj total"> M<sup>3</sup>
										</li>
									</ul>
									<ul>
										<li>
											<label>Altura</label>
											<input type="text" name="textfield284" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">+</li>
										<li>
											<label>Largura</label>
											<input type="text" name="textfield294" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">+</li>
										<li>
											<label>Comprimento</label>
											<input type="text" name="textfield304" placeholder="0" class="camp_obj">
										</li>
										<li class="conta">=</li>
										<li>
											<label>Total</label>
											<input type="text" name="textfield314" class="camp_obj total"> M<sup>3</sup>
										</li>
									</ul>
								</div>
							</div>
						</div><!--FIM CALCULO 1-->

						<ul class="cubagem">
							<li>
								<label>Cubagem</label>
								<input type="text" name="cubagem" class="camp_result" disabled>M<sup>3</sup>
							</li>
							<li>
								<label>Área Box</label>
								<input type="text" name="area" class="camp_result" disabled value="">M<sup>2</sup>
							</li>
							<li>
								<label>Valor R$</label>
								<input type="text" name="valor" ID="valor" class="camp_result" disabled>
							</li>
						</ul>
						<p class="obs"><strong>OBS.: O cálculo acima é uma estimativa já que os móveis variam de tamanho.</strong></p>

						</form>

						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php //comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>