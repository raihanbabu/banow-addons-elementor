<?php

/**
 * Plugin Name: Banow Addons Elementor
 * Description: This is Banow Addons for Elementor Plugin Extention
 * Plugin URI: https://github.com/raihanbabu
 * Version:     0.0.3
 * Author:      Raihan
 * Author URI:  https://github.com/raihanbabu
 * Text Domain: banow
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

final class Elementor_Pms_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */

	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */

	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Pms_Extension The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Pms_Extension An instance of the class.
	 */

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function i18n() {
		load_plugin_textdomain( 'banow' );
	}

	/**
	 * On Plugins Loaded
	 *
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function on_plugins_loaded() {
		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function init() {
		$this->i18n();

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

		// add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );

		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		// Register Widget Scripts

		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
	}

	// Custom CSS for this plugin
	public function widget_styles() {
		wp_register_style( 'bn-plugin', plugins_url( 'assets/css/bn-plugin.css', __FILE__ ) );
		wp_register_style( 'bn-helpers', plugins_url( 'assets/css/helpers.css', __FILE__ ) );
		wp_register_style( 'bn-split', plugins_url( 'assets/css/split.css', __FILE__ ) );
		wp_register_style( 'bn-main', plugins_url( 'assets/css/main.css', __FILE__ ) );
		wp_register_style( 'bn-about', plugins_url( 'assets/css/about.css', __FILE__ ) );
		wp_register_style( 'bn-spacing', plugins_url( 'assets/css/spacing.css', __FILE__ ) );
		wp_register_style( 'bn-typography', plugins_url( 'assets/css/typography.css', __FILE__ ) );
		wp_register_style( 'bn-working-at-muso', plugins_url( 'assets/css/working-at-muso.css', __FILE__ ) );
		wp_register_style( 'bn-artis-hero', plugins_url( 'assets/css/hero.css', __FILE__ ) );
		wp_register_style( 'bn-artis-sign-up', plugins_url( 'assets/css/sign-up.css', __FILE__ ) );
		wp_register_style( 'bn-partners', plugins_url( 'assets/css/partners.css', __FILE__ ) );
		wp_register_style( 'bn-accordions', plugins_url( 'assets/css/accordions.css', __FILE__ ) );
		wp_register_style( 'bn-how-it-works', plugins_url( 'assets/css/how-it-works.css', __FILE__ ) );
		wp_register_style( 'bn-slider', plugins_url( 'assets/css/slider.css', __FILE__ ) );
		wp_register_style( 'bn-explosion', plugins_url( 'assets/css/explosion.css', __FILE__ ) );
		wp_register_style( 'bn-connecting', plugins_url( 'assets/css/connecting.css', __FILE__ ) );
		wp_register_style( 'bn-testimonials', plugins_url( 'assets/css/testimonials.css', __FILE__ ) );
		wp_register_style( 'bn-header-mobile', plugins_url( 'assets/css/header-mobile.css', __FILE__ ) );
		wp_register_style( 'bn-start-booking', plugins_url( 'assets/css/start-booking.css', __FILE__ ) );
		wp_register_style( 'bn-faqs', plugins_url( 'assets/css/faqs.css', __FILE__ ) );
		wp_register_style( 'bn-header', plugins_url( 'assets/css/header.css', __FILE__ ) );
		wp_register_style( 'bn-hiwa', plugins_url( 'assets/css/hiwa.css', __FILE__ ) );
		wp_register_style( 'bn-hiwh', plugins_url( 'assets/css/hiwh.css', __FILE__ ) );
		wp_register_style( 'bn-hiw', plugins_url( 'assets/css/hiw.css', __FILE__ ) );
		wp_register_style( 'bn-hero-venu', plugins_url( 'assets/css/hero-venu.css', __FILE__ ) );
		wp_register_style( 'bn-five-star-reviews', plugins_url( 'assets/css/five-star-reviews.css', __FILE__ ) );
		wp_register_style( 'bn-promo-widget', plugins_url( 'assets/css/lp-promo-widget.css', __FILE__ ) );
		wp_register_style( 'bn-buttons', plugins_url( 'assets/css/buttons.css', __FILE__ ) );
		wp_register_style( 'bn-made-for', plugins_url( 'assets/css/made-for.css', __FILE__ ) );
		wp_register_style( 'bn-community', plugins_url( 'assets/css/community.css', __FILE__ ) );
		wp_register_style( 'bn-rotpg-form', plugins_url( 'assets/css/rotpg-form.css', __FILE__ ) );
		wp_register_style( 'bn-inputs', plugins_url( 'assets/css/inputs.css', __FILE__ ) );

		// Form
		wp_register_style( 'bn-accordions', plugins_url( 'assets/css/form/accordions.css', __FILE__ ));
		wp_register_style( 'bn-annotations', plugins_url( 'assets/css/form/annotations.css', __FILE__ ));
		wp_register_style( 'bn-buttons', plugins_url( 'assets/css/form/buttons.css', __FILE__ ));
		wp_register_style( 'bn-cards', plugins_url( 'assets/css/form/cards.css', __FILE__ ));
		wp_register_style( 'bn-checklist', plugins_url( 'assets/css/form/checklist.css', __FILE__ ));
		wp_register_style( 'bn-chiplists', plugins_url( 'assets/css/form/chiplists.css', __FILE__ ));
		wp_register_style( 'bn-help', plugins_url( 'assets/css/form/help.css', __FILE__ ));
		wp_register_style( 'bn-image-uploaders', plugins_url( 'assets/css/form/image-uploaders.css', __FILE__ ));
		wp_register_style( 'bn-loaders', plugins_url( 'assets/css/form/loaders.css', __FILE__ ));
		wp_register_style( 'bn-modals', plugins_url( 'assets/css/form/modals.css', __FILE__ ));
		wp_register_style( 'bn-panels', plugins_url( 'assets/css/form/panels.css', __FILE__ ));
		wp_register_style( 'bn-range-input', plugins_url( 'assets/css/form/range-input.css', __FILE__ ));
		wp_register_style( 'bn-toast', plugins_url( 'assets/css/form/toast.css', __FILE__ ));
		wp_register_style( 'bn-toggles', plugins_url( 'assets/css/form/toggles.css', __FILE__ ));
		wp_register_style( 'bn-tooltip', plugins_url( 'assets/css/form/tooltip.css', __FILE__ ));
		wp_register_style( 'bn-popup', plugins_url( 'assets/css/form/popup.css', __FILE__ ));
	}

	// Custom JS for this plugin
	public function widget_scripts() {

		wp_register_script( 'bn-split', plugins_url( 'assets/js/split.js', __FILE__ ) );

		if (is_page( 'about' )) {
			wp_register_script( 'bn-career-showcases', plugins_url( 'assets/js/career-showcases.js', __FILE__ ) );
		}	

		wp_register_script( 'bn-accordion', plugins_url( 'assets/js/accordion.js', __FILE__ ) );
		wp_register_script( 'bn-slider', plugins_url( 'assets/js/slider.js', __FILE__ ) );
		wp_register_script( 'bn-explosion', plugins_url( 'assets/js/explosion.js', __FILE__ ) );
		wp_register_script( 'bn-testimonials', plugins_url( 'assets/js/testimonials.js', __FILE__ ) );

		if (is_page( 'faqs' )) {
			wp_register_script( 'bn-faqs', plugins_url( 'assets/js/faqs.js', __FILE__ ) );
		}

		wp_register_script( 'bn-hiw-lazy-load', plugins_url( 'assets/js/hiw-lazy-load.js', __FILE__ ) );
		wp_register_script( 'bn-community', plugins_url( 'assets/js/community.js', __FILE__ ) );

		// Form API

		wp_register_script( 'bn-autocomplete', plugins_url( 'assets/js/api/autocomplete.js', __FILE__ ) );
		wp_register_script( 'bn-lazyload', plugins_url( 'assets/js/api/lazyload.min.js', __FILE__ ) );
		wp_register_script( 'bn-public-app', plugins_url( 'assets/js/api/public-app.js', __FILE__ ) );

		if (is_page( 'venue' )) {
			wp_register_script( 'bn-popup', plugins_url( 'assets/js/api/popup.js', __FILE__ ) );
		}

		wp_register_script( 'bn-clamp', plugins_url( 'assets/js/api/clamp.min.js', __FILE__ ) );
		wp_register_script( 'bn-utils', plugins_url( 'assets/js/api/utils.js', __FILE__ ) );
		wp_register_script( 'bn-moment', plugins_url( 'assets/js/api/moment.min.js', __FILE__ ) );

		if (is_page( 'venue' )) {
      wp_register_script( 'bn-form-bottom', plugins_url( 'assets/js/form-bottom.js', __FILE__, '','0.0.2','' ));
		}

		wp_register_script( 'bn-accordions', plugins_url( 'assets/js/api/components/accordions.js', __FILE__));
		wp_register_script( 'bn-annotations', plugins_url( 'assets/js/api/components/annotations.js', __FILE__));
		wp_register_script( 'bn-chiplists', plugins_url( 'assets/js/api/components/chiplists.js', __FILE__));
		wp_register_script( 'bn-help', plugins_url( 'assets/js/api/components/help.js', __FILE__));
		wp_register_script( 'bn-imageUploaders', plugins_url( 'assets/js/api/components/imageUploaders.js', __FILE__));
		wp_register_script( 'bn-inputs', plugins_url( 'assets/js/api/components/inputs.js', __FILE__));
		wp_register_script( 'bn-modals', plugins_url( 'assets/js/api/components/modals.js', __FILE__));
		wp_register_script( 'bn-multis', plugins_url( 'assets/js/api/components/multis.js', __FILE__));
		wp_register_script( 'bn-toast', plugins_url( 'assets/js/api/components/toast.js', __FILE__));
		wp_register_script( 'bn-toggles', plugins_url( 'assets/js/api/components/toggles.js', __FILE__));
		wp_register_script( 'bn-tooltip', plugins_url( 'assets/js/api/components/tooltip.js', __FILE__));
		wp_register_script( 'bn-crypto', plugins_url( 'assets/js/api/crypto-js.min.js', __FILE__ ) );
		wp_register_script( 'bn-enc-base64', plugins_url( 'assets/js/api/enc-base64.min.js', __FILE__ ) );
		wp_register_script( 'bn-finger-print-2', plugins_url( 'assets/js/api/finger-print-2.min.js', __FILE__ ) );
		wp_register_script( 'bn-hmac-sha256', plugins_url( 'assets/js/api/hmac-sha256.min.js', __FILE__ ) );
		wp_register_script( 'bn-webservice', plugins_url( 'assets/js/api/webservice.js', __FILE__ ) );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function init_widgets() {

		// Default Function
		require_once( __DIR__ . '/default-functions.php' );

		// Include Widget files

		// Home
		require_once( __DIR__ . '/widgets/home/home-block-section.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Home_Block_Widget() );

		// About
		require_once( __DIR__ . '/widgets/about/about-body-section.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_About_Body_Section_Widget() );
		
		require_once( __DIR__ . '/widgets/about/about-career-top.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_About_Career_top_Section_Widget() );

		require_once( __DIR__ . '/widgets/about/about-career-team.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_About_Career_Team_Widget() );

		require_once( __DIR__ . '/widgets/about/about-career-showcases.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_About_Career_Showcases_Widget() );

		require_once( __DIR__ . '/widgets/about/about-career-space-images.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_About_Career_Space_Images_Widget() );

		// Artists
		require_once( __DIR__ . '/widgets/artists/artists-hero.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Artists_Hero_Widget() );		

		require_once( __DIR__ . '/widgets/artists/artists-partner.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Artists_Partners_Widget() );

		require_once( __DIR__ . '/widgets/artists/artists-how-it-works.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Artists_How_It_Works_Widget() );

		require_once( __DIR__ . '/widgets/artists/artists-connecting-join.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Artists_Join_Connecting_Widget() );

		require_once( __DIR__ . '/widgets/artists/artists-testimonials.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Artists_Testimonials_Widget() );

		require_once( __DIR__ . '/widgets/artists/artists-signup-free.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Artists_Signup_Free_Widget() );

		require_once( __DIR__ . '/widgets/artists-hiwa/artists-hiwa-hero.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Artists_HIWA_Hero_Widget() );

		require_once( __DIR__ . '/widgets/artists-hiwa/artists-hiwa-body-animation.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Artists_HIWA_Body_Animation_Widget() );

		// Venue Group
		require_once( __DIR__ . '/widgets/hirers/venue-group-hero.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Venue_Group_Widget() );

		// Hirers Hero
		require_once( __DIR__ . '/widgets/hirers/hirers-hero.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Hirers_Hero_Widget() );

		// Hirers Partners
		require_once( __DIR__ . '/widgets/hirers/hirers-partner.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Hirers_Partners_Widget() );

		// Hirers Five Star Review
		require_once( __DIR__ . '/widgets/hirers/hirers-fivestar-review.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_five_star_review_Widget() );

		// Hirers Promote
		require_once( __DIR__ . '/widgets/hirers/hirers-promote.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Hirers_Promote_Widget() );

		// Hirers Promote
		require_once( __DIR__ . '/widgets/hirers/hirers-mode-for-slider.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Hirers_MadeFor_Slider_Widget() );

		// Hirers HIWH Body Animation Section
		require_once( __DIR__ . '/widgets/hirers/hirers-hiwh-body-animation.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Hirers_HIWW_Body_Animation_Widget() );

		// Resource Community
		require_once( __DIR__ . '/widgets/resources/community-hero.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Community_Hero_Widget() );

		// Resource Initiatives
		require_once( __DIR__ . '/widgets/resources/community-initiatives.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Community_Initiatives_Widget() );

		// Resource Initiatives
		require_once( __DIR__ . '/widgets/resources/community-initiatives-ambassadors.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Community_Ambassadors_Widget() );

		// Resource Podcast
		require_once( __DIR__ . '/widgets/resources/podcast-hero.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Podcast_Hero_Widget() );

		// Blog Related Posts
		require_once( __DIR__ . '/widgets/blog/blog-related.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Blog_Related_Widget() );

		// Blog Posts Categories
		require_once( __DIR__ . '/widgets/blog/blog-posts-category.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Blog_Category_Widget() );

		// Rotpg Hero
		require_once( __DIR__ . '/widgets/rotpg/rotpg-hero.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Rotpg_Hero_Widget() );

		// Rotpg About
		require_once( __DIR__ . '/widgets/rotpg/rotpg-about.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Rotpg_About_Widget() );

		// Rotpg About
		require_once( __DIR__ . '/widgets/rotpg/rotpg-enter-and-support.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Rotpg_Enter_And_support_Widget() );

		// Venue Hero
		require_once( __DIR__ . '/widgets/rotpg/venue-hero.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Venue_Hero_Widget() );

		// Venue Form
		require_once( __DIR__ . '/widgets/rotpg/venue-form.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Venue_Form_Widget() );

		// Connecting join background animation
		require_once( __DIR__ . '/widgets/artists/connecting-join-background-image.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Connecting_join_background_image_Widget() );

		// FAQs
		require_once( __DIR__ . '/widgets/faq/faqs-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Faqs_Widget() );

		// Contact
		require_once( __DIR__ . '/widgets/contact/contact-page-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Contact_Page_Widget() );
	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'banow' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'banow' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'banow' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(

			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'banow' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'banow' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'banow' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'banow' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'banow' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'banow' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}
Elementor_Pms_Extension::instance();

