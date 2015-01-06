<?php
/**
 * The template for displaying the footer
 *
 *
 * @package InkID
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php //get_sidebar( 'main' ); ?>

			<div class="footer-container">
				<div class="line-block">
					<div class="blog-box">
						<p class="title">BLOG GUARDA-TUDO</p>
						<?php
							$args = array( 'numberposts' => '3' );
							$recent_posts = wp_get_recent_posts( $args );
							foreach( $recent_posts as $recent ){
								echo '<p><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a></p> ';
							}
						?>
						<p style="text-align:right;font-weight:bold">+ mais</p>
						<p>Receba novidades e promoções</p>
					</div>
					<div class="menu-box">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'nav-footer', 'depth' => 2 ) ); ?>
					</div>
				</div>
				<div class="site-info">
					Desenvolvido por <b>InkID</b> com Wordpress
				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>