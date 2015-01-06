<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php if ( get_post_type() == "promocoes") : ?>

					<?php get_template_part( 'content-promocao', get_post_format() ); ?>

				<?php endif; ?>

				<?php if ( get_post_type() != "promocoes") : ?>

					<?php get_template_part( 'content', get_post_format() ); ?>
					<?php twentythirteen_post_nav(); ?>
					<?php comments_template(); ?>

				<?php endif; ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php if ( get_post_type() != "promocoes") : ?>
	<?php get_sidebar(); ?>
<?php endif; ?>
<?php get_footer(); ?>