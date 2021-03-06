<?php
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Add support for a custom header image.
 */
//require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/admin/admin-init.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2014-06-08', true );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.03' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widgets do Rodapé', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Widgets das Páginas', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Aparece na barra lateral das páginas.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

function inkid_create_widget_area() {
	register_sidebar( array(
		'name'          => __( 'Widgets das Postagens', 'inkid' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Aparece na barra lateral das postagens do blog.', 'inkid' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'inkid_create_widget_area' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*/
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Twenty thirteen 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );


/**************
*
* SLIDER
*
***************/

function inkid_frontscripts() {

     /* Add jQuery library. */
     //wp_enqueue_script('jquery');


     // Add ThinkUpSlider scripts
     if ( is_front_page() ) {
          wp_enqueue_script( 'thinkupslider', get_template_directory_uri() . '/admin/plugins/ResponsiveSlides/responsiveslides.min.js', array( 'jquery' ), '1.54' );
          wp_enqueue_script( 'thinkupslider-call', get_template_directory_uri() . '/admin/plugins/ResponsiveSlides/responsiveslides-call.js', array( 'jquery' ) );
     }
}
add_action( 'wp_enqueue_scripts', 'inkid_frontscripts', 10 );

function inkid_shortcodescripts() {

     // Register shortcode scripts
     wp_register_script( 'thinkupslider', get_template_directory_uri() . '/admin/plugins/ResponsiveSlides/responsiveslides.min.js', array( 'jquery' ), '1.54', 'true' );
     wp_register_script( 'thinkupslider-call', get_template_directory_uri() . '/admin/plugins/ResponsiveSlides/responsiveslides-call.js', array( 'jquery' ), '', 'true' );

     // Add shortcode scripts
     wp_enqueue_script( 'thinkupslider' );
     wp_enqueue_script( 'thinkupslider-call' );
}
add_action( 'wp_enqueue_scripts', 'inkid_shortcodescripts', 10 );

add_action( 'wp_enqueue_scripts', 'inkid_load_calculadorascript' );

function inkid_load_calculadorascript() {

  wp_register_script( 'calculadora-script', get_template_directory_uri() . '/js/calculadora.js', array(), '1.0.0', true);

}

/************
*
* Including new version JQuery
*
***********/

function modify_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-1.11.1.min.js', false, '1.11.1');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'modify_jquery');

/************
*
* Promotions Custom Type
*
************/

add_action('init', 'type_post_promocoes');
 
function type_post_promocoes() { 
	$labels = array(
		'name' => _x('Promoções', 'post type general name'),
		'singular_name' => _x('Promoção', 'post type singular name'),
		'all_itens' => _x('Todas as Promoções', 'list all itens'),
		'add_new' => _x('Adicionar Promoção', 'Novo item'),
		'add_new_item' => __('Novo Item'),
		'edit_item' => __('Editar Item'),
		'new_item' => __('Novo Item'),
		'view_item' => __('Ver Item'),
		'search_items' => __('Procurar Itens'),
		'not_found' =>  __('Nenhum registro encontrado'),
		'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
		'parent_item_colon' => '',
		'menu_name' => 'Promoções'
	);

	$args = array(
		'labels' => $labels,
		'description' => 'Painel para registro e controle de promoções',
		'public' => true,
		'public_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,			
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-tag',
		'register_meta_box_cb' => 'promocao_meta_box',		
		'supports' => array('title','thumbnail', 'revisions')
    );
 
	register_post_type( 'promocoes' , $args );
	flush_rewrite_rules();
}

function promocao_meta_box() {        
       add_meta_box('info_desconto_promocao', __('Informações de Desconto'), 'meta_boxes_promocao', 'promocoes', 'normal', 'core');
       add_meta_box('descricao_desconto_promocao', __('Descrição da Promoção'), 'meta_boxes_desc_promocao', 'promocoes', 'normal', 'high');
       add_meta_box('exibicao_desconto_promocao', __('Exibição'), 'meta_exibicao_desconto_promocao', 'promocoes', 'side', 'default');
}

function meta_boxes_promocao() {
    global $post;
    $metaBoxValor = get_post_meta($post->ID, 'valor_desconto_promocao', true);
    $metaBoxUnidade = get_post_meta($post->ID, 'unidade_responsavel_promocao', true);
    ?>
     
    <label for="inputValorMeta">Valor em R$ ou %: </label>
    <input style="width:30%;margin-right:10%" type="text" name="valor_desconto_promocao" id="inputValorMeta" value="<?php echo $metaBoxValor; ?>" />

    <label for="inputUnidadeMeta">Unidade Responsável: </label>
    <select name="unidade_responsavel_promocao" id="inputUnidadeMeta">
    	<option value="São Paulo" <?php selected( $metaBoxUnidade, "São Paulo" ); ?>>São Paulo</option>
    	<option value="Campinas" <?php selected( $metaBoxUnidade, "Campinas" ); ?>>Campinas</option>
    	<option value="Rio de Janeiro" <?php selected( $metaBoxUnidade, "Rio de Janeiro" ); ?>>Rio de Janeiro</option>
    </select>
    <?php
}

function meta_boxes_desc_promocao() {
	global $post;
	$metaBoxDescricao = get_post_meta($post->ID, 'descricao_promocao', true);

	echo '<textarea style="width:100%" name="descricao_promocao">' . $metaBoxDescricao . '</textarea>';
}

function meta_exibicao_desconto_promocao() {
	global $post;
    $metaBoxExibicao = get_post_meta($post->ID, 'exibicao_desconto_promocao', true);
	?>
	<p style="width:100%;color:#990000;font-size:0.9rem">Para destacar a promoção escolha entre as opções "Cabeçalho" e "Home".</p>
	<select name="exibicao_desconto_promocao" style="width:100%">
		<option value="" <?php selected( $metaBoxExibicao, "" ); ?>></option>
    	<option value="Cabeçalho" <?php selected( $metaBoxExibicao, "Cabeçalho" ); ?>>Cabeçalho</option>
    	<option value="Home" <?php selected( $metaBoxExibicao, "Home" ); ?>>Home</option>
    </select>
	<?php
}

add_action('save_post', 'save_promocoes_post');
    
function save_promocoes_post(){
    global $post;        
    update_post_meta($post->ID, 'valor_desconto_promocao', $_POST['valor_desconto_promocao']);
    update_post_meta($post->ID, 'unidade_responsavel_promocao', $_POST['unidade_responsavel_promocao']);
    update_post_meta($post->ID, 'descricao_promocao', $_POST['descricao_promocao']);
    update_post_meta($post->ID, 'exibicao_desconto_promocao', $_POST['exibicao_desconto_promocao']);
}

function inkid_metabox_page_callaction() {
	global $post;
	$metaCallAction = get_post_meta($post->ID, 'call_action_page', true);
	$metaButtonAction = get_post_meta($post->ID, 'button_action_page', true);
	$metaLinkAction = get_post_meta($post->ID, 'link_action_page', true);
	?>

	<p><label for="inputTextCall">Texto do Topo: </label>
    <input style="width:80%;" type="text" name="call_action_page" id="inputTextCall" value="<?php echo $metaCallAction; ?>" /></p>
    <p><label for="inputButtonCall">Texto do Botão: </label>
    <input style="width:30%;" type="text" name="button_action_page" id="inputButtonCall" value="<?php echo $metaButtonAction; ?>" />
    <label for="inputLinkCall">Link do Botão: </label>
    <input style="width:30%;" type="text" name="link_action_page" id="inputLinkCall" value="<?php echo $metaLinkAction; ?>" /></p>
	
	<?php
}

function inkid_metas_destaque_page() {
	global $post;
	$metaDestaquePage = get_post_meta($post->ID, '_destaques_topo_page', true);
	?>
		<div style="width:31%;min-width:250px;display:inline-block">
			<input type="checkbox" id="chechCameraDestaque" name="destaques_topo_page[]" value="camera" <?php if ( is_array($metaDestaquePage) && count($metaDestaquePage) > 0) { if (in_array('camera', $metaDestaquePage)) echo 'checked="checked"'; } ?>>
			<label for="chechCameraDestaque">Acesso monitorado 24 horas</label>
		</div>
		<div style="width:31%;min-width:250px;display:inline-block">
			<input type="checkbox" id="chechCaixaDestaque" name="destaques_topo_page[]" value="caixa" <?php if ( is_array($metaDestaquePage) && count($metaDestaquePage) > 0) { if (in_array('caixa', $metaDestaquePage)) echo 'checked="checked"'; } ?>>
			<label for="chechCaixaDestaque">Armazene conforme sua preferência</label>
		</div>
		<div style="width:31%;min-width:250px;display:inline-block">
			<input type="checkbox" id="chechCadeadoDestaque" name="destaques_topo_page[]" value="cadeado" <?php if ( is_array($metaDestaquePage) && count($metaDestaquePage) > 0) { if (in_array('cadeado', $metaDestaquePage)) echo 'checked="checked"'; } ?>>
			<label for="chechCadeadoDestaque">Tranque o box e leve a chave com você</label>
		</div>
		<div style="width:31%;min-width:250px;display:inline-block">
			<input type="checkbox" id="chechInsetoDestaque" name="destaques_topo_page[]" value="inseto" <?php if ( is_array($metaDestaquePage) && count($metaDestaquePage) > 0) { if (in_array('inseto', $metaDestaquePage)) echo 'checked="checked"'; } ?>>
			<label for="chechInsetoDestaque">Dedetização e limpeza permanentes</label>
		</div>
		<div style="width:31%;min-width:250px;display:inline-block">
			<input type="checkbox" id="chechContratoDestaque" name="destaques_topo_page[]" value="contrato" <?php if ( is_array($metaDestaquePage) && count($metaDestaquePage) > 0) { if (in_array('contrato', $metaDestaquePage)) echo 'checked="checked"'; } ?>>
			<label for="chechContratoDestaque">Contrato sem fiador e sem burocracia</label>
		</div>
		<div style="width:31%;min-width:250px;display:inline-block">
			<input type="checkbox" id="chechAreasDestaque" name="destaques_topo_page[]" value="areas" <?php if ( is_array($metaDestaquePage) && count($metaDestaquePage) > 0) { if (in_array('areas', $metaDestaquePage)) echo 'checked="checked"'; } ?>>
			<label for="chechAreasDestaque">Amplas áreas para carga e descarga</label>
		</div>

	<?php
}

function inkid_metas_add_pages() {        
       add_meta_box('inkid_meta_topo_pages', __('Topo da Página'), 'inkid_metabox_page_callaction', 'page', 'normal', 'high');
       add_meta_box('inkid_meta_destaques_pages', __('Destaques'), 'inkid_metas_destaque_page', 'page', 'normal', 'high');
}
add_action( 'add_meta_boxes', 'inkid_metas_add_pages' );

function inkid_save_metas_add_pages() {
    global $post;        
    update_post_meta($post->ID, 'call_action_page', $_POST['call_action_page']);
    update_post_meta($post->ID, 'button_action_page', $_POST['button_action_page']);
    update_post_meta($post->ID, 'link_action_page', $_POST['link_action_page']);
    update_post_meta($post->ID, '_destaques_topo_page', $_POST['destaques_topo_page']);
}
add_action('save_post', 'inkid_save_metas_add_pages');

function inkid_print_destaques_pages($destaques) {
	if (isset($destaques)) {
		echo '<div class="destaques-pagina">';
		for ($i = 0; $i <= 3; $i++) {
			if ($destaques[$i] == "camera") { ?>
				<div><p><img src='<?php echo get_template_directory_uri() ?>/images/camera-icon.png' />Acesso monitorado 24 horas</p></div>
			<?php
			}
			if ($destaques[$i] == "caixa") { ?>
				<div><p><img src='<?php echo get_template_directory_uri() ?>/images/caixas-icon.png' />Armazene conforme sua preferência</p></div>
			<?php
			}
			if ($destaques[$i] == "cadeado") { ?>
				<div><p><img src='<?php echo get_template_directory_uri() ?>/images/cadeado-icon.png' />Tranque o box e leve a chave com você</p></div>
			<?php
			}
			if ($destaques[$i] == "inseto") { ?>
				<div><p><img src='<?php echo get_template_directory_uri() ?>/images/inseto-icon.png' />Dedetização e limpeza permanentes</p></div>
			<?php
			}
			if ($destaques[$i] == "contrato") { ?>
				<div><p><img src='<?php echo get_template_directory_uri() ?>/images/contrato-icon.png' />Contrato sem fiador e sem burocracia</p></div>
			<?php
			}
			if ($destaques[$i] == "areas") { ?>
				<div><p><img src='<?php echo get_template_directory_uri() ?>/images/caixas-icon.png' />Amplas áreas para carga e descarga</p></div>
			<?php
			}
		}
		echo "</div>";
	}
}

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'footer-menu', 'Menu do Rodapé' );
}

function return_unidade_page($unidade) {
	global $opt_select_saopaulo_page;
	global $opt_select_rio_page;
	global $opt_select_campinas_page;

	if ($unidade == "SP") {
		if (!empty($opt_select_saopaulo_page)) {
			$pag_unidade = get_permalink($opt_select_saopaulo_page);
			return $pag_unidade;
		} else {
			return "#";
		}
	}
	else {
		if ($unidade == "RJ") {
			if (!empty($opt_select_rio_page)) {
				$pag_unidade = get_permalink($opt_select_rio_page);
				return $pag_unidade;
			} else {
				return "#";
			}
		}
		else {
			if ($unidade == "CA") {
				if (!empty($opt_select_campinas_page)) {
					$pag_unidade = get_permalink($opt_select_campinas_page);
					return $pag_unidade;
				} else {
					return "#";
				}
			}
			else {
				return "#";
			}
		}
	}
}

function return_solucao_page($solucao) {
	global $opt_select_moveis_page;
	global $opt_select_documentos_page;
	global $opt_select_estoques_page;

	if ($solucao == "moveis") {
		if (!empty($opt_select_moveis_page)) {
			$pag_solucao = get_permalink($opt_select_moveis_page);
			return $pag_solucao;
		} else {
			return "#";
		}
	}
	else {
		if ($solucao == "documentos") {
			if (!empty($opt_select_documentos_page)) {
				$pag_solucao = get_permalink($opt_select_documentos_page);
				return $pag_solucao;
			} else {
				return "#";
			}
		}
		else {
			if ($solucao == "estoques") {
				if (!empty($opt_select_estoques_page)) {
					$pag_solucao = get_permalink($opt_select_estoques_page);
					return $pag_solucao;
				} else {
					return "#";
				}
			}
			else {
				return "#";
			}
		}
	}
}

function return_contact_page() {
	global $opt_select_contact_page;

	if (!empty($opt_select_contact_page)) {
		$pag_contact = get_permalink($opt_select_contact_page);
		return $pag_contact;
	} else {
		return "#";
	}
}

function return_booking_page() {
	global $opt_select_booking_page;

	if (!empty($opt_select_booking_page)) {
		$pag_booking = get_permalink($opt_select_booking_page);
		return $pag_booking;
	} else {
		return null;
	}
}

function return_testimonial_page() {
	global $opt_select_testimonial_page;

	if (!empty($opt_select_testimonial_page)) {
		$pag_booking = get_permalink($opt_select_testimonial_page);
		return $pag_booking;
	} else {
		return null;
	}
}

function inkid_sidebar_class() {
	global $chx_top_sidebar;
    do_action('inkid_sidebar_hook', $chx_top_sidebar);
}

function inkid_top_sidebar($tamanho) {
		echo    'style="top:' . $tamanho . 'px"';
}
function inkid_top_sidebar_change( $postid ) {
	global $chx_top_sidebar;

	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'full' );
	$height = $img[2];
	if ( $height > 350 ) {		
		$height = 350 + 165;
	} 
	else {
		$height = $height + 165;
	}

	$chx_top_sidebar = $height;
	add_action( 'inkid_sidebar_hook', 'inkid_top_sidebar', 1, 1);
}

function chx_shortcode_reserva( $atts ) {
	$vars = shortcode_atts(
				array(
					'texto' => 'Guarda Móveis em São Paulo, Rio de Janeiro ou Campinas do tamanho da sua necessidade, com toda a segurança e pelo tempo que precisar.',
					'botao' => 'Contrate Agora',
				), $atts, 'reserva-shortcode' 
			);
	$pag_booking = return_booking_page();


	return "<div class='shortcode-contrate'>
				<div class='texto'>{$vars['texto']}</div>
				<div class='botao'><a href='" . $pag_booking . "' title='Consulte valores de Armazenagem'>{$vars['botao']}</a></div>
			</div>";
}
add_shortcode( 'reserva-shortcode', 'chx_shortcode_reserva' );

function chx_shortcode_unidades( $atts ) {
	$vars = shortcode_atts(
				array(
					'texto' => 'Unidades:',
					'unidade' => '',
				), $atts, 'unidades-shortcode' 
			);

	if ( $vars['unidade'] == "SP") {
		return "<div class='shortcode-unidades'>
					<div class='texto'>{$vars['texto']}</div>
					<div class='botao'><a href='" . return_unidade_page("RJ") . "' title='Conheça nossa Unidade no Rio de Janeiro'>Rio de Janeiro</a></div>
					<div class='botao'><a href='" . return_unidade_page("CA") . "' title='Conheça nossa Unidade em Campinas'>Campinas</a></div>
				</div>";
	}
	else {
		if ( $vars['unidade'] == "RJ") {
			return "<div class='shortcode-unidades'>
						<div class='texto'>{$vars['texto']}</div>
						<div class='botao'><a href='" . return_unidade_page("SP") . "' title='Conheça nossa Unidade em São Paulo'>São Paulo</a></div>
						<div class='botao'><a href='" . return_unidade_page("CA") . "' title='Conheça nossa Unidade em Campinas'>Campinas</a></div>
					</div>";
		}
		else {
			if ( $vars['unidade'] == "CA") {
				return "<div class='shortcode-unidades'>
							<div class='texto'>{$vars['texto']}</div>
							<div class='botao'><a href='" . return_unidade_page("SP") . "' title='Conheça nossa Unidade em São Paulo'>São Paulo</a></div>
							<div class='botao'><a href='" . return_unidade_page("RJ") . "' title='Conheça nossa Unidade no Rio de Janeiro'>Rio de Janeiro</a></div>
						</div>";
			}
			else {
				return "<div class='shortcode-unidades'>
							<div class='texto'>{$vars['texto']}</div>
							<div class='botao'><a href='" . return_unidade_page("SP") . "' title='Conheça nossa Unidade em São Paulo'>São Paulo</a></div>
							<div class='botao'><a href='" . return_unidade_page("RJ") . "' title='Conheça nossa Unidade no Rio de Janeiro'>Rio de Janeiro</a></div>
							<div class='botao'><a href='" . return_unidade_page("CA") . "' title='Conheça nossa Unidade em Campinas'>Campinas</a></div>
						</div>";
			}
		}
	}

}
add_shortcode( 'unidades-shortcode', 'chx_shortcode_unidades' );

function chx_shortcode_guarda( $atts ) {
	$vars = shortcode_atts(
				array(
					'texto' => 'Guarde também:',
					'pagina' => '',
				), $atts, 'guarda-shortcode' 
			);

	if ( $vars['pagina'] == "moveis") {
		return "<div class='shortcode-unidades'>
					<div class='texto'>{$vars['texto']}</div>
					<div class='botao'><a href='" . return_solucao_page("documentos") . "' title='Saiba mais sobre como armazenar seu arquivo'>Documentos</a></div>
					<div class='botao'><a href='" . return_solucao_page("estoques") . "' title='Veja como centralizar seu estoque em galpão modular'>Estoques</a></div>
					<div class='botao'><a href='" . return_solucao_page("tudo") . "' title='Não tenha dúvida, aqui você pode armazenar de tudo'>Tudo</a></div>
				</div>";
	}
	else {
		if ( $vars['pagina'] == "documentos") {
			return "<div class='shortcode-unidades'>
						<div class='texto'>{$vars['texto']}</div>
						<div class='botao'><a href='" . return_solucao_page("moveis") . "' title='Móveis, eletrodomésticos e todos seus bens você guarda conosco'>Móveis</a></div>
						<div class='botao'><a href='" . return_solucao_page("estoques") . "' title='Veja como centralizar seu estoque em galpão modular'>Estoques</a></div>
						<div class='botao'><a href='" . return_solucao_page("tudo") . "' title='Não tenha dúvida, aqui você pode armazenar de tudo'>Tudo</a></div>
					</div>";
		}
		else {
			if ( $vars['pagina'] == "estoques") {
				return "<div class='shortcode-unidades'>
							<div class='texto'>{$vars['texto']}</div>
							<div class='botao'><a href='" . return_solucao_page("moveis") . "' title='Móveis, eletrodomésticos e todos seus bens você guarda conosco'>Móveis</a></div>
							<div class='botao'><a href='" . return_solucao_page("documentos") . "' title='Saiba mais sobre como armazenar seu arquivo'>Documentos</a></div>
							<div class='botao'><a href='" . return_solucao_page("tudo") . "' title='Não tenha dúvida, aqui você pode armazenar de tudo'>Tudo</a></div>
						</div>";
			}
			else {
				return "<div class='shortcode-unidades'>
							<div class='texto'>{$vars['texto']}</div>
							<div class='botao'><a href='" . return_solucao_page("moveis") . "' title='Móveis, eletrodomésticos e todos seus bens você guarda conosco'>Móveis</a></div>
							<div class='botao'><a href='" . return_solucao_page("documentos") . "' title='Saiba mais sobre como armazenar seu arquivo'>Documentos</a></div>
							<div class='botao'><a href='" . return_solucao_page("estoques") . "' title='Veja como centralizar seu estoque em galpão modular'>Estoques</a></div>
						</div>";
			}
		}
	}

}
add_shortcode( 'guarda-shortcode', 'chx_shortcode_guarda' );

function chx_input_contact_destiny( $unidade ) {
	global $opt_mailcontato_saopaulo;
	global $opt_mailcontato_campinas;
	global $opt_mailcontato_rio;

	if ( $unidade == "SP" ) {
		if ( ! isset( $opt_mailcontato_saopaulo ) ) {	
			return 'site@storageguardatudo.com.br';
		} else {
			return $opt_mailcontato_saopaulo;
		}
	}

	if ( $unidade == "CA" ) {
		if ( ! isset( $opt_mailcontato_campinas ) ) {	
			return 'site@storageguardatudo.com.br';
		} else {
			return $opt_mailcontato_campinas;
		}
	}

	if ( $unidade == "RJ" ) {
		if ( ! isset( $opt_mailcontato_rio ) ) {	
			return 'site@storageguardatudo.com.br';
		} else {
			return $opt_mailcontato_rio;
		}
	}
}

// Add Fields - Contact
function chx_newinput_contact() {
	global $opt_contact_add_fields;
	$i = 0;

	if ( ! isset( $opt_contact_add_fields )  ) {
		return '';
	}
	else {
		foreach ($opt_contact_add_fields as $field) {
			echo '<p><label>' . $field . '</label>
			<input type="text" name="' . $field . '_' . $i . '"></p>';
			$i++;
		}
	}
}

function chx_write_extra_fields($post) {
	$extra_fields = '';
	foreach ( $post as $nome_campo => $valor ){
		if ( strcspn($nome_campo, '0123456789' ) != strlen( $nome_campo) ) {
			$extra_fields .= "<p>" . $nome_campo . ": " . $valor . "</p>";
		}
	} 
	return $extra_fields;
}

//função irá verificar a qual unidade a pagina da calculadora está relacionada para repassar ao JS e fazer o calculo conforme os valores da unidade
function chx_return_page_calculdora($page_id) {
	global $opt_select_calculadora_saopaulo;
	global $opt_select_calculadora_campinas;
	global $opt_select_calculadora_riojaneiro;

	if ($page_id == $opt_select_calculadora_saopaulo) {
		return "SP";
	}
	else {
		if ($page_id == $opt_select_calculadora_campinas) {
			return "CA";
		}
		else {
			if ($page_id == $opt_select_calculadora_riojaneiro) {
				return "RJ";
			}
		}
	}
}

//add_filter('show_admin_bar', '__return_false');