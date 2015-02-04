<?php
/**
 * The sidebar containing the secondary widget area
 *
 * Displays on posts and pages.
 *
 * @package InkID
 *
 */

if ( ( is_page() ) && ( is_active_sidebar( 'sidebar-2' ) ) ) : ?>
	<div id="tertiary" class="sidebar-container" <?php inkid_sidebar_class(); ?> role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; 

if ( ( is_singular('post') ) && ( is_active_sidebar( 'sidebar-3' ) ) ) : ?>
	<div id="tertiary" class="sidebar-container" <?php inkid_sidebar_class(); ?> role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>