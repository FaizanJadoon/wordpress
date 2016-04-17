<?php

get_template_part('inc/customizer/customizer');

// Custom template functions for this theme.
require get_template_directory() . '/inc/template-functions.php';

/*-----------------------------------------------------------------------------------*/
/* Sets up the content width value based on the theme's design and stylesheet.
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
	$content_width = 713;
}

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers the various WordPress features that
/* PlusBlog supports.
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'liveblog_theme_setup' ) ) :
function liveblog_theme_setup() {
    
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
    
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
    
    // Add support for custom background
    $liveblog_bg_defaults = array(
        'default-color' => 'ffffff',
        'default-image' => get_template_directory_uri() . '/assets/images/bg.png',
    );
    add_theme_support( 'custom-background', $liveblog_bg_defaults );
    
    // Add support for custom header
    add_theme_support( 'custom-header' );
    
    // Remove Header Text Color Option from Customizer
    define( 'NO_HEADER_TEXT', true );
	
	// This theme supports the following post formats.
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'audio', 'video', 'image', 'status' ) );
	
	// Register WordPress Custom Menus
	register_nav_menu( 'main-menu', __( 'Main Menu', 'liveblog' ) );
	
	// Register Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'liveblog-featured', 723, 334, true );
	add_image_size( 'liveblog-slider', 1170, 470, true );
	add_image_size( 'liveblog-featured390', 390, 210, true );
	add_image_size( 'liveblog-related', 240, 185, true );
	add_image_size( 'liveblog-widgetthumb', 90, 90, true );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	
	// Load Localization Files
	$lang_dir = get_template_directory() . '/lang';
	load_theme_textdomain('liveblog', $lang_dir);

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}
endif;
add_action( 'after_setup_theme', 'liveblog_theme_setup' );

/*-----------------------------------------------------------------------------------*/
/*	Stylesheets and Scripts
/*-----------------------------------------------------------------------------------*/
function liveblog_stylesheets_scripts() {
	/*-----------------------------------------------------------------------------------*/
	/*	Add Stylesheets
	/*-----------------------------------------------------------------------------------*/
	
	// Default Stylesheet
	wp_enqueue_style( 'liveblog-style', get_stylesheet_uri() );
	
	// Font-Awesome CSS
	wp_register_style( 'liveblog-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'liveblog-font-awesome' );
	
    if ( get_theme_mod( 'responsive_layout', '1' ) ) {
		// Responsive
		wp_register_style( 'liveblog-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
		wp_enqueue_style( 'liveblog-responsive' );
	}
	/*-----------------------------------------------------------------------------------*/
	/*	Add JavaScripts
	/*-----------------------------------------------------------------------------------*/
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	// Sticky Menu
	$liveblog_sticky_menu = get_theme_mod( 'sticky_menu' );
	if ( $liveblog_sticky_menu == 'enable' ) {
		wp_register_script( 'liveblog-stickymenu', get_template_directory_uri() . '/assets/js/stickymenu.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'liveblog-stickymenu' );
	}
	
	// Masonry
	$liveblog_masonry_array = array(
		'clayout',
		'gslayout',
		'sglayout',
		'glayout',
	);
	if(in_array(get_theme_mod('main_layout'),$liveblog_masonry_array) || in_array(get_theme_mod('archive_layout'),$liveblog_masonry_array)) {
		wp_enqueue_script( 'masonry' );
		wp_register_script( 'liveblog-imagesLoaded', get_template_directory_uri() . '/assets/js/imagesLoaded.js', array( 'jquery' ), '3.1.4', true );
		wp_enqueue_script( 'liveblog-imagesLoaded' );
	}
	
	// Required jQuery Scripts
    wp_register_script( 'liveblog-theme-scripts', get_template_directory_uri() . '/assets/js/theme-scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'liveblog-theme-scripts' );
}
add_action( 'wp_enqueue_scripts', 'liveblog_stylesheets_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Add Admin Scripts
/*-----------------------------------------------------------------------------------*/
function liveblog_admin_scripts() {
    if ( is_customize_preview() ) {
	   wp_register_style( 'liveblog-admin-css', get_template_directory_uri() . '/assets/css/admin-styles.css' );
	   wp_enqueue_style( 'liveblog-admin-css' );
    }
}
add_action( 'admin_enqueue_scripts', 'liveblog_admin_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets
/*-----------------------------------------------------------------------------------*/
// Theme Functions
include trailingslashit( get_template_directory() ) . "inc/widgets/widget-ad300.php"; // 300x250 Ad Widget
include trailingslashit( get_template_directory() ) . "inc/widgets/widget-ad125.php"; // 125x125 Ad Widget
include trailingslashit( get_template_directory() ) . "inc/widgets/widget-popular-posts.php"; // Popular Posts
include trailingslashit( get_template_directory() ) . "inc/widgets/widget-cat-posts.php"; // Category Posts
include trailingslashit( get_template_directory() ) . "inc/widgets/widget-random-posts.php"; // Random Posts
include trailingslashit( get_template_directory() ) . "inc/widgets/widget-recent-posts.php"; // Recent Posts
include trailingslashit( get_template_directory() ) . "inc/widgets/widget-social.php"; // Social Widget
include trailingslashit( get_template_directory() ) . "inc/widgets/widget-tabs.php"; // Tabs Widget
/*-----------------------------------------------------------------------------------*/
/*	Exceprt Length
/*-----------------------------------------------------------------------------------*/
// Limit the Length of Excerpt
function liveblog_excerpt_length( $length ) {
	if ( get_theme_mod( 'liveblog_excerpt_length' ) ) {
		$excerpt_length = get_theme_mod( 'liveblog_excerpt_length', '40' );	
	} else {
		$excerpt_length = '40';
	}
	
	return intval($excerpt_length);
}
add_filter( 'excerpt_length', 'liveblog_excerpt_length', 999 );

function liveblog_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

// Remove […] string
function liveblog_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'liveblog_excerpt_more');

/*-----------------------------------------------------------------------------------*/
/*	Register Theme Widgets
/*-----------------------------------------------------------------------------------*/
function liveblog_widgets_init() {
	register_sidebar(array(
		'name'          => __('Primary Sidebar', 'liveblog'),
		'id'            => 'sidebar-1',
		'before_widget' => '<div class="widget sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	if ( get_theme_mod( 'footer_layout','f4c' ) == 'f4c' ) {
		$liveblog_sidebars = array( 1, 2, 3, 4 );
		foreach( $liveblog_sidebars as $number ) {
			register_sidebar( array(
				'name'          => sprintf( __( 'Footer %s','liveblog' ), $number ),
				'id'            => 'footer-' . $number,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
			));
		}
	} elseif (get_theme_mod( 'footer_layout') == 'f3c' ) {
		$liveblog_sidebars = array(1, 2, 3);
		foreach( $liveblog_sidebars as $number ) {
			register_sidebar( array(
				'name'          => sprintf( __( 'Footer %s','liveblog' ), $number ),
				'id'            => 'footer-' . $number,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
			));
		}
	} elseif (get_theme_mod( 'footer_layout') == 'f2c' ) {
		$liveblog_sidebars = array(1, 2);
		foreach( $liveblog_sidebars as $number) {
			register_sidebar( array(
				'name'          => sprintf( __( 'Footer %s','liveblog' ), $number ),
				'id'            => 'footer-' . $number,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
			));
		}
	} else {
		register_sidebar( array(
			'name'          => __('Footer', 'liveblog'),
			'id'            => 'footer-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
		));
	}
}
add_action( 'widgets_init', 'liveblog_widgets_init' );

/*-----------------------------------------------------------------------------------*/
/*	Breadcrumb
/*-----------------------------------------------------------------------------------*/
function liveblog_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo esc_url( home_url() );
		echo '"> <i class="fa fa-home"></i>';
		echo __( 'Home','liveblog' );
		echo "</a>";
		if (is_category() || is_single()) {
			echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
			the_category(' &bull; ');
			if (is_single()) {
				echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
				the_title();
			}
		} elseif (is_page()) {
			echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
			echo the_title();
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Comments Callback
/*-----------------------------------------------------------------------------------*/
function liveblog_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
?>
	<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment->comment_author_email, 60 ); ?>
		<?php printf(__('<cite class="fn">%s</cite>','liveblog'), get_comment_author_link()) ?>

		<span class="reply uppercase">
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('<i class="fa fa-share"></i> Reply','liveblog')))) ?>
		</span>
	</div>
	<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','liveblog') ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s','liveblog'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','liveblog'),'  ','' );
		?>
	</div>

	<div class="commentBody">
		<?php comment_text() ?>
	</div>
	</div>
<?php }
?>