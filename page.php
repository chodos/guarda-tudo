<?php
/**
 * The template for displaying pages
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
					<div class="page-topo">
						<?php if(!empty($chamada_topo)) { ?>
						<div class="capa-overflow">
							<p><?php echo $chamada_topo; ?></p>
							<?php if(!empty($botao_topo)) { ?> <a href="<?php echo $link_topo; ?>"><button><?php echo $botao_topo; ?></button></a> <?php } ?>
						</div>
						<?php } the_post_thumbnail('full'); ?>
					</div>
					<div class="page-title"><h1><?php the_title(); ?></h1></div>	
					<?php inkid_print_destaques_pages(get_post_meta(get_the_ID(), '_destaques_topo_page', true)); ?>
				</header>

					<div class="entry-content">
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