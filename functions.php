<?php
/**
 * Addomas functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Addomas
 */


class AddomasTheme{
	
	// Version
	public static function get_version(){
		return current_time('timestamp');
	}

	public function __construct(){
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ));
		//add_action( 'after_setup_theme', array( $this, 'content_width' ));
		add_action( 'widgets_init', array( $this, 'sidebar_registration'));
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));


		// Includes Required files
		$this->includes();
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Addomas, use a find and replace
		 * to change 'addomas' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'addomas', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Set content-width.
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = apply_filters( 'addomas_content_width', 640 );
		}

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
			'menu-1' => esc_html__( 'Primary', 'addomas' ),
			'footer' => esc_html__( 'Footer Menu', 'addomas' ),
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
		add_theme_support( 'custom-background', apply_filters( 'addomas_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

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

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'addomas-style', get_stylesheet_uri() );

		wp_enqueue_style( 'addomas-main', get_template_directory_uri() . '/assets/css/main.css', null, self::get_version() );


		wp_enqueue_script( 'addomas-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), self::get_version(), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}


	/**
	 * Register widget areas.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function sidebar_registration() {

		// Arguments used in all register_sidebar() calls.
		$shared_args = array(
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
		);

		// Footer #1.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #1', 'addomas' ),
					'id'          => 'sidebar-1',
					'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'addomas' ),
				)
			)
		);

		// Footer #2.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #2', 'addomas' ),
					'id'          => 'sidebar-2',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'addomas' ),
				)
			)
		);

	}


	/**
	 * Including Template Files
	 */
	public function includes(){
		/**
		 * Implement the Custom Header feature.
		 */
		require get_template_directory() . '/inc/helper-class.php';

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
	}
}
new AddomasTheme();