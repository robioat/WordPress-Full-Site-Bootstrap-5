<?php
/**
 * Minimal Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Minimal_Theme
 * @since Minimal Theme 1.0
 */


if ( ! function_exists( 'minimaltheme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Minimal Theme 1.0
	 *
	 * @return void
	 */
	function minimaltheme_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'minimaltheme_support' );

if ( ! function_exists( 'minimaltheme_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Minimal Theme 1.0
	 *
	 * @return void
	 */
	function minimaltheme_styles() {
		// Register theme stylesheets.
		$theme_version = wp_get_theme()->get( 'Version' );

		//default stylesheet
		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'minimaltheme-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		//bootstrap styles
		wp_register_style(
			'bootstrap',
			get_template_directory_uri() . '/sass/bootstrap-5.css',
			array(),
			$version_string
		);

		// Add styles inline.
		wp_add_inline_style( 'minimaltheme-style', minimaltheme_get_font_face_styles() );

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'minimaltheme-style' );

		// Enqueue bootstrap stylesheet.
		wp_enqueue_style( 'bootstrap' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'minimaltheme_styles' );

if ( ! function_exists( 'minimaltheme_editor_styles' ) ) :

	/**
	 * Enqueue editor styles.
	 *
	 * @since Minimal Theme 1.0
	 *
	 * @return void
	 */
	function minimaltheme_editor_styles() {

		// Add styles inline.
		wp_add_inline_style( 'wp-block-library', minimaltheme_get_font_face_styles() );

	}

endif;

add_action( 'admin_init', 'minimaltheme_editor_styles' );


if ( ! function_exists( 'minimaltheme_get_font_face_styles' ) ) :

	/**
	 * Get font face styles.
	 * Called by functions minimaltheme_styles() and minimaltheme_editor_styles() above.
	 *
	 * @since Minimal Theme 1.0
	 *
	 * @return string
	 */
	function minimaltheme_get_font_face_styles() {

		return "
		@font-face{
			font-family: 'Source Serif Pro';
			font-weight: 200 900;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Roman.ttf.woff2' ) . "') format('woff2');
		}

		@font-face{
			font-family: 'Source Serif Pro';
			font-weight: 200 900;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Italic.ttf.woff2' ) . "') format('woff2');
		}
		";

	}

endif;

if ( ! function_exists( 'minimaltheme_preload_webfonts' ) ) :

	/**
	 * Preloads the main web font to improve performance.
	 *
	 * Only the main web font (font-style: normal) is preloaded here since that font is always relevant (it is used
	 * on every heading, for example). The other font is only needed if there is any applicable content in italic style,
	 * and therefore preloading it would in most cases regress performance when that font would otherwise not be loaded
	 * at all.
	 *
	 * @since Minimal Theme 1.0
	 *
	 * @return void
	 */
	function minimaltheme_preload_webfonts() {
		?>
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Roman.ttf.woff2' ) ); ?>" as="font" type="font/woff2" crossorigin>
		<?php
	}

endif;

add_action( 'wp_head', 'minimaltheme_preload_webfonts' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';
