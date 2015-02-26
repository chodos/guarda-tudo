<?php
/**
 * The template for displaying "Guia de Tamanhos"
 * Template Name: Guia de Tamanhos
 *
 * @package InkID
 *
 */

get_header(); ?>

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

						<p>Utilize o guia abaixo para uma estimativa do tamanho de seu Box.</p>
						
						<div id="box-precos">
							<div class="menu-medidas">
								<div class="itens" onclick="exibeBox('box1');">1 m²</div>
								<div class="itens" onclick="exibeBox('box2');">2 m²</div>
								<div class="itens" onclick="exibeBox('box5');">5 m²</div>
								<div class="itens" onclick="exibeBox('box75');">7,5 m²</div>
								<div class="itens" onclick="exibeBox('box15');">15 m²</div>
								<div class="itens" onclick="exibeBox('box21');">21 m²</div>
							</div>
							<div id="box1" class="conteudo-box">
								<div class="table-box">
									<div class="volume-box"><p>volume</p><p style="font-size:1.9rem;line-height:3.1rem;">2,25 m³</p></div>
									<div class="volume-box capacidade"><p>capacidade física</p><p style="font-size:1.5rem;line-height:1.8rem;">12 malas grandes ou 15 caixas médias (50 x 50 x 50)</p></div>
								</div>
								<img src="<?php echo get_template_directory_uri() ?>/images/tamanhos/box-1.jpg">
							</div>
							<div id="box2" class="conteudo-box" style="display:none">
								<div class="table-box">
									<div class="volume-box"><p>volume</p><p style="font-size:1.9rem;line-height:3.1rem;">6 m³</p></div>
									<div class="volume-box capacidade"><p>capacidade física</p><p style="font-size:1.5rem;line-height:1.8rem;">08 caxas médias, 1 geladeira, 1 sofá, 4 cadeiras e uma mesa</p></div>
								</div>
								<img src="<?php echo get_template_directory_uri() ?>/images/tamanhos/box-2.jpg">
							</div>
							<div id="box5" class="conteudo-box" style="display:none">
								<div class="table-box">
									<div class="volume-box"><p>volume</p><p style="font-size:1.9rem;line-height:4rem;">15 m³</p></div>
									<div class="volume-box capacidade"><p>capacidade física</p><p style="font-size:1.5rem;line-height:1.7rem;">Mobília completa de 1 apartamento de 1 dormitório com aproximadamente 70 m²</p></div>
								</div>
								<img src="<?php echo get_template_directory_uri() ?>/images/tamanhos/box-5.jpg">
							</div>
							<div id="box75" class="conteudo-box" style="display:none">
								<div class="table-box">
									<div class="volume-box"><p>volume</p><p style="font-size:1.9rem;line-height:4rem;">22,5 m³</p></div>
									<div class="volume-box capacidade"><p>capacidade física</p><p style="font-size:1.5rem;line-height:1.7rem;">Mobília completa de 1 apartamento de 2 dormitórios com aproximadamente 90 m²</p></div>
								</div>
								<img src="<?php echo get_template_directory_uri() ?>/images/tamanhos/box-75.jpg">
							</div>
							<div id="box15" class="conteudo-box" style="display:none">
								<div class="table-box">
									<div class="volume-box"><p>volume</p><p style="font-size:1.9rem;line-height:4rem;">45 m³</p></div>
									<div class="volume-box capacidade"><p>capacidade física</p><p style="font-size:1.5rem;line-height:1.7rem;">Conteúdo de um conteiner de 20 pés ou 1.440 caixas arquivo tipo box</p></div>
								</div>
								<img src="<?php echo get_template_directory_uri() ?>/images/tamanhos/box-15.jpg">
							</div>
							<div id="box21" class="conteudo-box" style="display:none">
								<div class="table-box">
									<div class="volume-box"><p>volume</p><p style="font-size:1.9rem;line-height:4rem;">63 m³</p></div>
									<div class="volume-box capacidade"><p>capacidade física</p><p style="font-size:1.5rem;line-height:1.7rem;">Mobilia completa de uma casa de 4 dormitórios com aproximadamente 300m²</p></div>
								</div>
								<img src="<?php echo get_template_directory_uri() ?>/images/tamanhos/box-21.jpg">
							</div>
						</div>

						<?php the_content(); ?>

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