<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Artists_Hero_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_artists_hero";
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
        return __("BN Artists Hero", "banow");
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
            "bn-artis-hero",
            "bn-artis-sign-up",
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
            "artist_hero_section",
            [
                "label" => __("Artists Hero", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "artist_hero_bg_image",
            [
                "label" => __("Choose Artist Background Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "artist_hero_image",
            [
                "label" => __("Choose Artists Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "artist_sub_title",
            [
                "label" => __("Artist Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artist Sub Title", "banow"),
                "placeholder" => __("Type your Artist Sub Title", "banow"),
            ]
        );

        $this->add_control(
            "artist_title",
            [
                "label" => __("Artist Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artist Title title", "banow"),
                "placeholder" => __("Type your Artist Title", "banow"),
            ]
        );

        $this->add_control(
            "artist_content",
            [
                "label" => __("Artists Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Default Artists Content", "banow"),
                "placeholder" => __("Type your Artists Content here", "banow"),
            ]
        );

        $this->add_control(
            "artist_button_text",
            [
                "label" => __("Artists Button", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Artists Button", "banow"),
                "placeholder" => __("Type your Artists Button", "banow"),
            ]
        );

        $this->add_control(
            "artist_button_link",
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
            "artist_app_text",
            [
                "label" => __("Artists Button", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Artists Button", "banow"),
                "placeholder" => __("Type your Artists Button", "banow"),
            ]
        );

        $this->add_control(
            "artist_app_apple_image",
            [
                "label" => __("Choose Artists Phone Image", "banow"),
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
                "label" => __("Choose Artists Phone Image", "banow"),
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            "artist_phone_image",
            [
                "label" => __("Choose Artists Phone Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "phone_image_list",
            [
                "label" => __("Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "artist_phone_image" => ["test" => "test"],
                    ],
                ],
                "image_field" => "{{{ artist_phone_image }}}",
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

        echo '<div class="lp-full-block hero margin-bottom margin-top">

        	<div class="hero__hero-image-mobile lg-down as-fs" style="background-image: url(' . $settings["artist_hero_image"]["url"] . ')">';

        	echo wp_get_attachment_image( $settings["artist_hero_bg_image"]["id"], "full", false, ["class" => "hero__sound-wave-mobile p-abs b-0 w-100"] );

        echo '</div>
        <div class="corset">
        <div class="row h-100">';

        echo wp_get_attachment_image($settings["artist_hero_image"]["id"], "full", false, ["class" => "hero__hero-image lg-up"] );

        echo '</div>
        </div>
        <div class="hero__sound-wave-repeat lg-up"></div>
        <div class="corset">
        <div class="row pad-top h-100">
        <div class="hero__info col-12 col-10-md ofs-1-md col-4-xl col-5-lg">
        <div class="pre-heading">' .
            $settings["artist_sub_title"] .
            '</div>
        <h1 class="md-up hero-h1 no-wrap">';

        echo $settings["artist_title"];

        echo '</h1>
        <h1 class="md-down hero-h1">Get discovered, get gigs, get paid.</h1>';

        echo $settings["artist_content"];

        echo '<p id="email-alert" class="email-alert"></p>
        	<div class="sign-up md-up">';

        echo '<a class="sign-up__button button" href="' . $settings["artist_button_link"]["url"] . '" target="_blank">';

        echo $settings["artist_button_text"];

        echo '</a>
        </div>
        <div class="get-app md-down">';

        echo '<p>' . $settings["artist_app_text"] . '</p>
        	<div class=" fd-r">';

        echo '<a class="get-app__button" href="' . $settings["artist_app_apple_link"]["url"] . '">';

        echo wp_get_attachment_image( $settings["artist_app_apple_image"]["id"], "full", false, ["class" => ""] );

        echo '</a>
        <a class="get-app__button" href="' . $settings["artist_app_google_link"]["url"] . '">';

        echo wp_get_attachment_image($settings["artist_app_google_image"]["id"], "full", false, ["class" => ""] );

        echo '</a>
        </div>
        </div>
        </div>
        <div class="col align-self-end lg-up">';

        if ($settings["phone_image_list"]) {
            $url =
                $settings["phone_image_list"][mt_rand(0, 4)]["artist_phone_image"];

            echo '<img class="hero__interface p-abs r-0" src="' . $url["url"] . '" alt="A smartphone displaying an artist profile on the Muso app." />';
        }

        echo '</div>
        </div>
        </div>
        </div>';
    }
}
