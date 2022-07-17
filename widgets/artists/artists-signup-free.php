<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Artists_Signup_Free_Widget extends \Elementor\Widget_Base {

    /**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

    public function get_name() {
        return "bn_artists_singup_free";
    }

    /**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

    public function get_title() {
        return __("BN Artists Sign up", "banow");
    }

    /**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */

    public function get_icon() {
        return "fa fa-code";
    }

    /**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */

    public function get_categories() {
        return ["general"];
    }

    // Style file add
    public function get_style_depends() {
        return [
            "bn-plugin",
            "bn-helpers",
            "bn-main",
            "bn-typography",
            "bn-spacing",
            "bn-artis-sign-up",
            "bn-start-booking",
        ];
    }

    /**
	 * Retrieve the list of scripts the image carousel widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */

    /**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

    protected function register_controls() {
        $this->start_controls_section(
            "artist_signup_section",
            [
                "label" => __("Artists Sign up", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "artist_signup_bg_image",
            [
                "label" => __("Choose Sign up Background Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "artist_signup_left_bg_image",
            [
                "label" => __("Choose Sign up Left Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "artist_signup_title",
            [
                "label" => __("Artist Sign up Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artist Sign up Title", "banow"),
                "placeholder" => __("Type your Artist Sign up Title", "banow"),
            ]
        );

        $this->add_control(
            "artist_signup_button_text",
            [
                "label" => __("Artists Sign up Button", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Artists Sign up Button", "banow"),
                "placeholder" => __(
                    "Type your Artists Sign up Button",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "artist_signup_button_link",
            [
                "label" => __("Link", "banow"),
                "type" => \Elementor\Controls_Manager::URL,
                "placeholder" => __("#", "banow"),
                "show_external" => true,
                "default" => [
                    "url" => "",
                    "is_external" => true,
                    "nofollow" => true,
                ],
            ]
        );

        $this->add_control(
            "artist_app_signup_text",
            [
                "label" => __("Artists Sign up Get the app", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Get the app:", "banow"),
                "placeholder" => __("Get the app:", "banow"),
            ]
        );

        $this->add_control(
            "artist_app_apple_image",
            [
                "label" => __("Choose Artists Apple Phone Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "artist_app_apple_link",
            [
                "label" => __("Link", "banow"),
                "type" => \Elementor\Controls_Manager::URL,
                "placeholder" => __("#", "banow"),
                "show_external" => true,
                "default" => [
                    "url" => "",
                    "is_external" => true,
                    "nofollow" => true,
                ],
            ]
        );

        $this->add_control(
            "artist_app_google_image",
            [
                "label" => __("Choose Artists Google Phone Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "artist_app_google_link",
            [
                "label" => __("Link", "banow"),
                "type" => \Elementor\Controls_Manager::URL,
                "placeholder" => __("#", "banow"),
                "show_external" => true,
                "default" => [
                    "url" => "",
                    "is_external" => true,
                    "nofollow" => true,
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

    protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<div class="lp-start-booking">
        <div class="corset">
        	<div class="row lp-start-booking__image-bg" style="background-image: url(' . $settings["artist_signup_bg_image"]["url"] . ')">
        <div class="col-6 lg-up">
        <img src="' . $settings["artist_signup_left_bg_image"]["url"] . '" class="lp-start-booking__hanging-m" alt="Muso logo" />
        </div>
        <div class="col-12 col-6-lg jc-c fd-c">
        <h1>' . $settings["artist_signup_title"] . '</h1>
        <div class="sign-up md-up">
        <a class="sign-up__button button button--white" href="' . $settings["artist_signup_button_link"]["url"] . '" target="_blank">';

        echo $settings["artist_signup_button_text"];

        echo '</a>
        </div>
        <div class="get-app md-down">
        <p>Get the app:</p>
        <div class=" fd-r jc-c">

        <a class="get-app__button" href="' . $settings["artist_app_apple_link"]["url"] . '">

        <img src="' . $settings["artist_app_apple_image"]["url"] . '" alt="Apple App Store logo" />
        </a
        <a class="get-app__button" href="' . $settings["artist_app_google_link"]["url"] . '">

        <img src="' . $settings["artist_app_google_image"]["url"] . '" alt="Google Play Store logo" />

        </a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>';
    }
}
