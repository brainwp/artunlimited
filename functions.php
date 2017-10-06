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

	register_sidebar( array(
		'name'          => __( 'Widget de Contato na Home', 'artunlimited' ),
		'id'            => 'contact-home',
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
        wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery') );
        wp_enqueue_script( 'caroufredsel_pre', get_template_directory_uri() . '/js/caroufredsel_pre.js', array('caroufredsel') );
	wp_enqueue_script( 'jquery.jscrollpane', get_template_directory_uri() . '/js/scroll/script/jquery.jscrollpane.js', array('jquery') );
	wp_enqueue_script( 'jquery-mousewheel', get_template_directory_uri() . '/js/scroll/script/jquery.mousewheel.js', array('jquery') );
	wp_enqueue_script( 'mwheelIntent', get_template_directory_uri() . '/js/scroll/script/mwheelIntent.js' );
	//wp_enqueue_script( 'jquery.preloader', get_template_directory_uri() . '/js/jquery.preloader.js' );
	wp_enqueue_script( 'jquery.scroll_to', get_template_directory_uri() . '/js/scroll_to.js', array('jquery') );
	wp_enqueue_script( 'mobile-nav', get_stylesheet_directory_uri() . '/js/mobile_nav.js', array('jquery'));
	wp_enqueue_script( 'portfolio-js', get_stylesheet_directory_uri() . '/js/portfolio.js', array('jquery'));
	wp_localize_script( 'portfolio-js', 'portfolio', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

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
require get_template_directory() . '/inc/metaboxes-portfolio.php';
require get_template_directory() . '/inc/metaboxes-novosprojetos.php';
/**
 * Load CPT Portfolios.
 */
require get_template_directory() . '/custom-portfolio.php';
/**
 * Load CPT Novos Projetos
 */
require get_template_directory() . '/custom-novos-projetos.php';
/**
 * Load CPT Novos Projetos
 */
require get_template_directory() . '/inc/area-restrita.php';


/**
 * Custom logo login.
 */
add_action('login_head', 'custom_logo_login');
function custom_logo_login()
{
    echo '
	<style type="text/css">
		body.login div#login {
			padding: 8% 0 0;
		}
		body.login div#login h1 {
			text-align: center;
			margin: 0 auto;
		}
		body.login div#login h1, body.login div#login h1 a {
			width: 260px;
			height: 75px;
		}
		body.login div#login h1 a {
			background: url( ' . get_template_directory_uri() . '/images/logo-artunlimited.png) no-repeat center top !important;
			padding: 0;
		}
	</style>
	';
}


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

//Imprime todos os filtros correntes do wp inteiro - para uso no desenvolvimento
//add_action ('all', create_function ('', 'var_dump (current_filter ());'));

//Adiciona o Minhas Opcoes
require_once (get_stylesheet_directory() . '/options/admin_options.php');


// funcao para obter páginas através da slug
function get_page_by_slug( $page_slug, $output = OBJECT, $post_type = 'page' ) {
	global $wpdb;

	if ( is_array( $post_type ) ) {
		$post_type = esc_sql( $post_type );
		$post_type_in_string = "'" . implode( "','", $post_type ) . "'";
		$sql = $wpdb->prepare( "
			SELECT ID
			FROM $wpdb->posts
			WHERE post_name = %s
			AND post_type IN ($post_type_in_string)
		", $page_slug );
	} else {
		$sql = $wpdb->prepare( "
			SELECT ID
			FROM $wpdb->posts
			WHERE post_name = %s
			AND post_type = %s
		", $page_slug, $post_type );
	}

	$page = $wpdb->get_var( $sql );

	if ( $page )
		return get_post( $page, $output );

	return 'null';
}
// Adds a widget area to house qtranslate flags. See also accompanying css.
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Widget no menu',
		'id' => 'extra-widget',
		'description' => 'Widget Menu',
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
}

/**
 *
 * Odin Metabox
 *
 */
 require_once (get_template_directory() . '/inc/class-odin-metabox.php' );
 $portfolio_metabox = new Odin_Metabox(
    'portfolio_metabox', // Slug/ID do Metabox (obrigatório)
    'Configurações de portfolio', // Nome do Metabox  (obrigatório)
    array( 'portfolio', 'novosprojetos'), // Slug do Post Type, sendo possível enviar apenas um valor ou um array com vários (opcional)
    'normal', // Contexto (opções: normal, advanced, ou side) (opcional)
    'high' // Prioridade (opções: high, core, default ou low) (opcional)
);
$portfolio_metabox->set_fields(
    array(
        array(
            'id'          => 'portfolio_slider',
            'label'       => 'Slider de imagens no topo',
            'type'        => 'image_plupload',
            'description' => ''
        ),
        array(
            'id'          => 'portfolio_graphic_content',
            'label'       => 'Area de Material gráfico - Texto',
            'type'        => 'editor',
            'description' => ''
        ),
        array(
            'id'          => 'portfolio_graphic',
            'label'       => 'Area de Material gráfico - Imagens',
            'type'        => 'image_plupload',
            'description' => ''
        ),

        array(
            'id'          => 'portfolio_clipping',
            'label'       => 'Area de clipping',
            'type'        => 'image_plupload',
            'description' => ''
        ),

    )
);

/**
 *
 * CMB2 Metabox
 * https://github.com/CMB2/CMB2/wiki/Field-Types#group
 *
 */
function artunlimited_add_cmb2_fields(){
	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}
	/*
	* Initiate the metabox
	*/
	$videos = new_cmb2_box( array(
		'id'            => '__portfolio_sections',
		'title'         => 'Area de audivisual (videos)',
		'object_types'  => array( 'portfolio', 'novosprojetos' ), // Post type
		'context'       => 'advanced',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	$videos->add_field( array(
		'name' => 'Preencha com o URL do vídeo no YouTube, Vimeo, etc.',
		'id'   => '_portfolio_videos',
		'type' => 'oembed',
		'repeatable' => true,
		'options' => array(
 			'add_row_text' => 'Adicionar Vídeo'
		)
	) );
}
add_action( 'cmb2_admin_init','artunlimited_add_cmb2_fields' );
