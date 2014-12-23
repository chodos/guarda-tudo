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

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="line-block">
					<div class="page-topo">
						<div class="capa-overflow">
							<p>Alugue box individual, do tamanho que você precisa, são 15 opções de 1 a 40 m². Soluções para famílias e empresas.</p>
							<button>Fale Conosco</button>
						</div>
						<?php the_post_thumbnail('full'); ?>
					</div>
					<div class="page-title"><h1><?php the_title(); ?></h1></div>	
					<div style="background:#F5FBFB; width:100%">aaa</div>
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