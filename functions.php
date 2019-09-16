<?php
/**
 * CubeLoft MD functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CubeLoft MD
 */

if ( ! function_exists( 'cubeloftmd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cubeloftmd_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CubeLoft MD, use a find and replace
		 * to change 'cubeloftmd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cubeloftmd', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'cubeloftmd' ),
			'drawer' => esc_html__( 'Drawer', 'cubeloftmd' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'cubeloftmd_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'cubeloftmd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cubeloftmd_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'cubeloftmd_content_width', 640 );
}
add_action( 'after_setup_theme', 'cubeloftmd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cubeloftmd_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cubeloftmd' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cubeloftmd' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s mdl-card mdl-shadow--2dp">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="mdl-card__title mdl-card--expand"><h2 class="widget-title mdl-card__title-text">',
		'after_title'   => '</h2></div>',
	) );
}
add_action( 'widgets_init', 'cubeloftmd_widgets_init' );

/**
 * Customizer Settings
 */
function cubeloftmd_customizer( $wp_customize ) {

	// add "Content Options" section
	// $wp_customize->add_section( 'cubeloftmd_content_options_section' , array(
	// 	'title'      => __( 'Content Options', 'cubeloftmd' ),
	// 	'priority'   => 100,
	// ) );
	
	// add setting for page comment toggle checkbox
	// $wp_customize->add_setting( 'cubeloftmd_page_comment_toggle', array( 
	// 	'default' => 1 
	// ) );
	
	// add control for page comment toggle checkbox
	// $wp_customize->add_control( 'cubeloftmd_page_comment_toggle', array(
	// 	'label'     => __( 'Show comments on pages?', 'cubeloftmd' ),
	// 	'section'   => 'cubeloftmd_content_options_section',
	// 	'priority'  => 10,
	// 	'type'      => 'checkbox'
    // ) );
    
    // add link color picker setting
    $wp_customize->add_setting( 'link_color', array(
        'default' => '#ff4081'
    ) );

    // add link color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
        'label' => 'Link Color',
        'section' => 'colors',
        'settings' => 'link_color',
    ) ) );
    
    // add navbar section
    $wp_customize->add_section( 'cubeloftmd_navbar_section', array(
        'title' => __( 'Navigation Bar', 'cubeloftmd' ),
        'priority' => 100,
    ) );

    // add navbar color picker setting
    $wp_customize->add_setting( 'navbar_color', array(
        'default' => '#3f51b5'
    ) );

    // add navbar color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navbar_color', array(
        'label' => 'NavBar Color',
        'section' => 'cubeloftmd_navbar_section',
        'settings' => 'navbar_color',
    ) ) );

    // add navbar transparency setting
    $wp_customize->add_setting( 'navbar_transparency', array(
        'default' => 0
    ) );

    // add navbar transparency control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navbar_transparency', array(
        'label'     => __( 'Make NavBar transparent?', 'cubeloftmd' ),
        'section' => 'cubeloftmd_navbar_section',
		'priority'  => 10,
		'type'      => 'checkbox'
    ) ) );

    // add drawer background setting
    $wp_customize->add_setting( 'drawer_bg_color', array(
        'default' => '#FAFAFA'
    ) );

    // add navbar transparency control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'drawer_bg_color', array(
        'label' => 'Drawer Background Color',
        'section' => 'cubeloftmd_navbar_section',
        'settings' => 'drawer_bg_color',
    ) ) );

    // add drawer link setting
    $wp_customize->add_setting( 'drawer_link_color', array(
        'default' => '#757575'
    ) );

    // add navbar transparency control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'drawer_link_color', array(
        'label' => 'Drawer Link Color',
        'section' => 'cubeloftmd_navbar_section',
        'settings' => 'drawer_link_color',
    ) ) );
}
add_action( 'customize_register', 'cubeloftmd_customizer' );

function cubeloftmd_customizer_head_styles() {
    ?>
    <style>
        .mdl-layout__header-row {
            padding-left: 20px;
        }
        .mdl-layout__drawer-button, .mdl-layout__drawer{
            left: initial;
            right: 0;
        }

        .mdl-layout__drawer{    
            transform:translateX(250px);
        }
    </style>
    <?php
	$link_color = get_theme_mod( 'link_color' ); 
	
	if ( $link_color != '#ff4081' ) :
	?>
		<style type="text/css">
			a, .entry-title {
				color: <?php echo $link_color; ?>;
			}
		</style>
	<?php
    endif;
    
	$navbar_color = get_theme_mod( 'navbar_color' ); 
	
	if ( $navbar_color != '#3f51b5' ) :
	?>
		<style type="text/css">
			.mdl-layout__header {
				background-color: <?php echo $navbar_color; ?>;
			}
		</style>
	<?php
    endif;
    
    if ( get_theme_mod( 'navbar_transparency' ) == 1 ) :
    ?>
        <style type="text/css">
            .mdl-layout__header {
                background-color: rgba(255, 255, 255, 0);
                -webkit-box-shadow: 0 0 0 0 rgba(0,0,0,0),0 0 0 0 rgba(0,0,0,0),0 0 0 0 rgba(0,0,0,0);
                box-shadow: 0 0 0 0 rgba(0,0,0,0),0 0 0 0 rgba(0,0,0,0),0 0 0 0 rgba(0,0,0,0);
            }
        </style>
    <?php
    endif;
    
	$drawer_bg_color = get_theme_mod( 'drawer_bg_color' ); 
	
	if ( $drawer_bg_color != '#FAFAFA' ) :
	?>
		<style type="text/css">
			.mdl-layout__drawer {
				background-color: <?php echo $drawer_bg_color; ?>;
			}
		</style>
	<?php
    endif;
    
	$drawer_link_color = get_theme_mod( 'drawer_link_color' ); 
	
	if ( $drawer_link_color != '#757575' ) :
	?>
		<style type="text/css">
			.mdl-navigation__link {
				background-color: <?php echo $drawer_link_color; ?>;
			}
		</style>
	<?php
    endif;
}
add_action( 'wp_head', 'cubeloftmd_customizer_head_styles' );

/**
 * Enqueue scripts and styles.
 */
function cubeloftmd_scripts() {
    wp_enqueue_style( 'cubeloftmd-style', get_stylesheet_uri() );

    wp_enqueue_style( 'material-icons', '//fonts.googleapis.com/icon?family=Material+Icons' );

	wp_enqueue_script( 'cubeloftmd-js', get_template_directory_uri() . '/js/dist/scripts.min.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cubeloftmd_scripts' );

/**
 * Custom Walker Menu for Material Design Lite.
 */
require get_template_directory() . '/inc/nav-walker.php';

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

