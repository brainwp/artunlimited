<?php
/**
 * artunlimited functions and definitions
 * @package artunlimited
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'artunlimited_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function artunlimited_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on artunlimited, use a find and replace
	 * to change 'artunlimited' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'artunlimited', get_template_directory() . '/languages' );
	
	/* Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	/**
	
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_image_size( 'thumb-premios', 120, 9999);
    add_image_size( 'thumb-projetos',370, 9999);
	add_image_size( 'thumb-outros-projetos', 300, 9999);
	add_image_size( 'projetos', 900, 500);
	
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */

	register_nav_menus( array(

		'primary' => __( 'Primary Menu', 'artunlimited' ),

	) );

}

endif; // artunlimited_setup

add_action( 'after_setup_theme', 'artunlimited_setup' );



/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */

function artunlimited_register_custom_background() {

	$args = array(

		'default-color' => 'ffffff',
		'default-image' => '',

	);

	$args = apply_filters( 'artunlimited_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {

		add_theme_support( 'custom-background', $args );

	} else {

		define( 'BACKGROUND_COLOR', $args['default-color'] );

		if ( ! empty( $args['default-image'] ) )

			define( 'BACKGROUND_IMAGE', $args['default-image'] );

		add_custom_background();

	}

}

add_action( 'after_setup_theme', 'artunlimited_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */

function artunlimited_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'artunlimited' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'artunlimited_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function artunlimited_scripts() {
	wp_enqueue_style( 'artunlimited-style', get_stylesheet_uri() );
	wp_enqueue_style( 'twentyeleven-style', get_template_directory_uri() . '/twentyeleven-style.css' );
	wp_enqueue_style( 'jquery.jscrollpane', get_template_directory_uri() . '/js/scroll/script/jquery.jscrollpane.css' );
	wp_enqueue_script( 'jquery' );
	// wp_enqueue_script( 'artunlimited-navigation', get_template_directory_uri() . '/js/navigation.js', array(), null, true );
	wp_enqueue_script( 'artunlimited-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), null, true );
    wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.1.0-packed.js', array('jquery') );
    wp_enqueue_script( 'caroufredsel_pre', get_template_directory_uri() . '/js/caroufredsel_pre.js', array('caroufredsel') );
	wp_enqueue_script( 'jquery.jscrollpane', get_template_directory_uri() . '/js/scroll/script/jquery.jscrollpane.js', array('jquery') );
	wp_enqueue_script( 'jquery-mousewheel', get_template_directory_uri() . '/js/scroll/script/jquery.mousewheel.js', array('jquery') );
	wp_enqueue_script( 'mwheelIntent', get_template_directory_uri() . '/js/scroll/script/mwheelIntent.js' );
	wp_enqueue_script( 'jquery.scroll_to', get_template_directory_uri() . '/js/scroll_to.js', array('jquery') );
	wp_enqueue_script( 'mobile-nav', get_stylesheet_directory_uri() . '/js/mobile_nav.js', array('jquery'));
	
    if(!is_admin()){
        wp_enqueue_script('thickbox',null,array('jquery'));
        wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'artunlimited-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'artunlimited_scripts' );

/**
 * Custom template tags for this theme.
 */

require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */

require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */

require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */

require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Metabox.
 */

require get_template_directory() . '/inc/metaboxes.php';

/**
 * Load CPT Portfolios.
 */

require get_template_directory() . '/custom-portfolio.php';

/**
 * Load CPT Novos Projetos
 */

// require get_template_directory() . '/custom-novos-projetos.php';



function id_por_slug( $slug ) {

    $page = get_page_by_path( $slug );
    if ( $page ) {
        return $page->ID;
    } else {
        return null;
    }

}

function wp_get_postcount($id)

{

//return count of post in category child of ID 15

$count = 0;
$taxonomy = 'category';
$tax_terms = get_terms($taxonomy);
foreach ($tax_terms as $tax_term) {
$count +=$tax_term->count;
}
return $count;
}

function count_posts( $slug ) {
	$args = array(
		'category_name' => $slug,
		'showposts' => -1,
		'caller_get_posts' => 1
	);

	$countposts = get_posts( $args );
return count($countposts);
}

function add_first_and_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
  $output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}

add_filter('wp_nav_menu', 'add_first_and_last');

function responsive_images($atts, $content = null) {
	return '<div class="image-resized">' . $content .'</div>';

}

add_shortcode('responsive', 'responsive_images');

/**
* Adiciona limite aos excerpts
*
*/
function limit_words($string, $word_limit) {

	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character

	$words = explode(' ', $string);

	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character

	echo implode(' ', array_slice($words, 0, $word_limit));

}

//Imprime todos os filtros correntes do wp inteiro
//add_action ('all', create_function ('', 'var_dump (current_filter ());')); 

//Adiciona as Minhas Opções
require_once (get_stylesheet_directory() . '/options/admin_options.php');
