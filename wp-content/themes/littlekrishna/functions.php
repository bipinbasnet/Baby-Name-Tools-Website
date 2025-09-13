<?php
add_action('init', function () {
    if (isset($_GET['test']) && $_GET['test'] === 'yes') {
        echo "✅ functions.php is executing";
        exit;
    }
});
// ✅ Register AJAX actions for both logged-in and public users
add_action('wp_ajax_get_nakshatra', 'fetch_nakshatra_data');
add_action('wp_ajax_nopriv_get_nakshatra', 'fetch_nakshatra_data');

// ✅ Define the callback function
function fetch_nakshatra_data() {
    $file_path = get_template_directory() . '/data/nakshatra.json';

    if (file_exists($file_path)) {
        $json = file_get_contents($file_path);
        wp_send_json_success(json_decode($json));
    } else {
        wp_send_json_error('File not found');
    }
}

//nakshatra_syllables
//nakshatra_syllables
function fetch_nakshatra_syllables() {
    $file_path = get_template_directory() . '/data/nakshatra_syllables.json';

    if (file_exists($file_path)) {
        $json = file_get_contents($file_path);
        wp_send_json_success(json_decode($json));
    } else {
        wp_send_json_error('Syllables file not found');
    }
}
add_action('wp_ajax_get_syllables', 'fetch_nakshatra_syllables');
add_action('wp_ajax_nopriv_get_syllables', 'fetch_nakshatra_syllables');
/**
 * LittleKrishna functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package LittleKrishna
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function littlekrishna_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on LittleKrishna, use a find and replace
		* to change 'littlekrishna' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'littlekrishna', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'THEMENAME' ),
	) );
	register_nav_menu('main-menu', 'Main menu');

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'littlekrishna_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'littlekrishna_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function littlekrishna_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'littlekrishna_content_width', 640 );
}
add_action( 'after_setup_theme', 'littlekrishna_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function littlekrishna_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'littlekrishna' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'littlekrishna' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'littlekrishna_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function littlekrishna_scripts() {
	wp_enqueue_style( 'littlekrishna-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'littlekrishna-style', 'rtl', 'replace' );

	wp_enqueue_script( 'littlekrishna-navigation', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );
	wp_enqueue_script( 'littlekrishna-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_localize_script( 'littlekrishna-navigation', 'ajaxObject', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
	wp_localize_script('nakshatra-script', 'nakshatra_data', array(
        'ajax_url' => get_template_directory_uri() . '/data/nakshatra_syllables.json'
    ));
    wp_localize_script('nakshatra-script', 'nakshatra_data', array(
        'ajax_url' => get_template_directory_uri() . '/data/baby_names_full.json'
    ));
    wp_localize_script('my-custom-js', 'ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'littlekrishna_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
function enqueue_my_scripts() {
    wp_enqueue_script('my-ajax-script', get_template_directory_uri() . '/js/my-ajax.js', ['jquery'], '1.0', true);

    wp_localize_script('my-ajax-script', 'my_ajax_obj', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');


//result page ajax with load more
// functions.php

// Load Baby Names based on filters (AJAX)
function fetch_baby_names() {
    // Get POST data
    $syllables = isset($_POST['syllables']) ? sanitize_text_field($_POST['syllables']) : '';
    $gender    = isset($_POST['gender']) ? sanitize_text_field($_POST['gender']) : '';
    $name_type = isset($_POST['name_type']) ? sanitize_text_field($_POST['name_type']) : '';
    $offset    = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit     = isset($_POST['limit']) ? intval($_POST['limit']) : 6;

    // Path to JSON file
    $file_path = get_template_directory() . '/data/baby_names_full.json';

    if (!file_exists($file_path)) {
        wp_send_json_error('Baby names JSON file not found.');
    }

    // Read and decode JSON
    $json = json_decode(file_get_contents($file_path), true);
    if (!$json) {
        wp_send_json_error('Error decoding JSON file.');
    }

    // Filter by criteria
    $filtered = array_filter($json, function ($item) use ($syllables, $gender, $name_type) {
        // Name starts with syllable (case-insensitive)
        $nameMatches = stripos($item['name'], $syllables) === 0;

        return $nameMatches &&
               ($gender === '' || strtolower($item['gender']) === strtolower($gender)) &&
               ($name_type === '' || strtolower($item['name_type']) === strtolower($name_type));
    });

    // Convert to array to support array_slice
    $filtered = array_values($filtered);

    // Slice for pagination (Load More)
    $pagedResults = array_slice($filtered, $offset, $limit);

    // Send data
    wp_send_json_success([
        'results' => $pagedResults,
        'has_more' => ($offset + $limit) < count($filtered)
    ]);
}
add_action('wp_ajax_fetch_baby_names', 'fetch_baby_names');
add_action('wp_ajax_nopriv_fetch_baby_names', 'fetch_baby_names');

//code to display names based on alphabet
function enqueue_baby_names_script() {
    wp_enqueue_script(
        'baby-names-js',
        get_template_directory_uri() . '/js/script.js',
        ['jquery'],
        '1.0.0',
        true
    );

    wp_localize_script('baby-names-js', 'baby_ajax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_baby_names_script');


// === AJAX handler ===
add_action('wp_ajax_get_filtered_names', 'wp_get_filtered_names');
add_action('wp_ajax_nopriv_get_filtered_names', 'wp_get_filtered_names');

function wp_get_filtered_names() {
	$gender = isset($_POST['gender']) ? sanitize_text_field($_POST['gender']) : '';
    $alphabet = isset($_POST['alphabet']) ? sanitize_text_field($_POST['alphabet']) : '';
    $name_type = isset($_POST['name_type']) ? sanitize_text_field($_POST['name_type']) : '';

    // ✅ Check required fields
    if (empty($gender) || empty($alphabet)) {
        wp_send_json_error('Gender and Alphabet are required.');
    }
    
    $json_file = get_template_directory() . '/data/baby_names_full.json';

    if (!file_exists($json_file)) {
        wp_send_json_error(['message' => 'JSON file not found']);
    }

    $json_data = file_get_contents($json_file);
    $names = json_decode($json_data, true);

    // Get filters from AJAX request
    $gender   = isset($_POST['gender']) ? sanitize_text_field($_POST['gender']) : '';
    $alphabet = isset($_POST['alphabet']) ? sanitize_text_field($_POST['alphabet']) : '';
    $nameType = isset($_POST['name_type']) ? sanitize_text_field($_POST['name_type']) : '';

    // Filter data
    $filtered = array_filter($names, function ($item) use ($gender, $alphabet, $nameType) {
        if ($gender && strcasecmp($item['gender'], $gender) !== 0) {
            return false;
        }
        if ($alphabet && stripos($item['name'], $alphabet) !== 0) {
            return false;
        }
        if ($nameType && strcasecmp($item['name_type'], $nameType) !== 0) {
            return false;
        }
        return true;
    });

    wp_send_json_success(array_values($filtered));
}
/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );
//register css bootstrap
function theme_enqueue_scripts() {
    // Bootstrap 4 CSS
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css');

    // Theme style
    wp_enqueue_style('theme-style', get_stylesheet_uri());

    // jQuery (already in WP)
    wp_enqueue_script('jquery');

    // Popper.js
    wp_enqueue_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js', array('jquery'), null, true);

    // Bootstrap 4 JS
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js', array('jquery', 'popper-js'), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
//footer widgets
function register_footer_menu() {
    register_nav_menus(array(
        'footer-menu' => __('Footer Menu', 'minimalaura'),
    ));
}
add_action('after_setup_theme', 'register_footer_menu');
//breadcrumb
function custom_breadcrumb() {
    // Home link
    echo '<nav aria-label="breadcrumb">';
    echo '<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">';

    // Home
    echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope 
          itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="' . home_url() . '">
              <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1" />
          </li>';

     // Category (for single posts)
    if (is_single()) {
        $categories = get_the_category();
        if ($categories) {
            $cat = $categories[0];
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope 
                  itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="' . get_category_link($cat->term_id) . '">
                      <span itemprop="name">' . esc_html($cat->name) . '</span>
                    </a>
                    <meta itemprop="position" content="3" />
                  </li>';
        }
        // Post title
        echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" 
              itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">' . get_the_title() . '</span>
                <meta itemprop="position" content="4" />
              </li>';
    }     
    

    // Category/Archive pages
    if (is_category() || is_archive()) {
        echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" 
              itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">' . single_cat_title('', false) . '</span>
                <meta itemprop="position" content="3" />
              </li>';
    }

    echo '</ol>';
    echo '</nav>';
}
?>