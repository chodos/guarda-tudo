<?php
/**
 * The initial page
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
		<?php show_sections_index(); ?>
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>