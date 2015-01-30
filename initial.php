<?php
/**
 * The initial page
 * Template Name: Home
 * 
 *
 * @package InkID
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="line-block">
				<div class="block-image-guarda-home">
					<img src="<?php echo get_template_directory_uri(); ?>/images/image-guarda.jpg" />
					<p>Guarde Móveis</p>
				</div>
				<div class="block-image-guarda-home">
					<img src="<?php echo get_template_directory_uri(); ?>/images/image-guarda.jpg" />
					<p>Guarde Estoques</p>
				</div>
				<div class="block-image-guarda-home">
					<img src="<?php echo get_template_directory_uri(); ?>/images/image-guarda.jpg" />
					<p>Guarde Documentos</p>
				</div>
			</div>
			<div class="line-block">
				<?php show_main_what_video_home(); ?>
			</div>
			<div class="line-block table-row">
				<div class="box-icons-home" style="background-image: url('<?php echo get_template_directory_uri() . "/images/caixas/caixa" . rand(1,4); ?>.png');">
					<img src="<?php echo get_template_directory_uri(); ?>/images/icones/foot.png" />
					<h4>Passeio Virtual</h4>Conheça nossas instalações
				</div>
				<div class="box-icons-home" style="background-image: url('<?php echo get_template_directory_uri() . "/images/caixas/caixa" . rand(1,4); ?>.png');">
					<img src="<?php echo get_template_directory_uri(); ?>/images/icones/mark.png" />
					<h4>Localize</h4>A Unidade da sua região
				</div>
				<div class="box-icons-home" style="background-image: url('<?php echo get_template_directory_uri() . "/images/caixas/caixa" . rand(1,4); ?>.png');">
					<img src="<?php echo get_template_directory_uri(); ?>/images/icones/box.png" />
					<h4>Guia de Tamanhos</h4>O Espaço que você precisa
				</div>
				<div class="box-icons-home" style="background-image: url('<?php echo get_template_directory_uri() . "/images/caixas/caixa" . rand(1,4); ?>.png');">
					<a href="<?php echo return_booking_page(); ?>" title="Orçamento sem Compromisso para Armazenamento">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icones/phone.png" />
						<h4>Reserve</h4>O seu Box sem complicações
					</a>
				</div>
			</div>
			<div id="slider-promo" class="line-block">
				<?php inkid_show_promocao_selo(); ?>
			</div>
			<div class="line-block" style="margin-bottom:16px;text-align:center">
				<div class="unidade-desc-home"><?php inkid_show_info_units_index(); ?></div>
				<?php inkid_show_testimonial_button(); ?>
			</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>