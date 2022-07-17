<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Hirers_Hero_Widget extends \Elementor\Widget_Base {

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
        return "bn_hirers_hero";
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
        return __("BN Hirers Hero", "banow");
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
            "bn-header-mobile",
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
            "hirers_hero_section",
            [
                "label" => __("Hirers Hero", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hirers_hero_bg_image",
            [
                "label" => __("Choose Artist Background Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hirers_hero_image",
            [
                "label" => __("Choose Hirers Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hirers_sub_title",
            [
                "label" => __("Artist Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artist Sub Title", "banow"),
                "placeholder" => __("Type your Artist Sub Title", "banow"),
            ]
        );

        $this->add_control(
            "hirers_title",
            [
                "label" => __("Artist Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artist Title title", "banow"),
                "placeholder" => __("Type your Artist Title", "banow"),
            ]
        );

        $this->add_control(
            "hirers_content",
            [
                "label" => __("Hirers Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Default Hirers Content", "banow"),
                "placeholder" => __("Type your Hirers Content here", "banow"),
            ]
        );

        $this->add_control(
            "hirers_button_text",
            [
                "label" => __("Hirers Button", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Hirers Button", "banow"),
                "placeholder" => __("Type your Hirers Button", "banow"),
            ]
        );

        $this->add_control(
            "hirers_button_link",
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
            "hirers_app_text",
            [
                "label" => __("Hirers Button", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Hirers Button", "banow"),
                "placeholder" => __("Type your Hirers Button", "banow"),
            ]
        );

        $this->add_control(
            "hirers_app_apple_image",
            [
                "label" => __("Choose Hirers Apple Phone Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hirers_app_apple_link",
            [
                "label" => __("Apple Link", "banow"),
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
            "hirers_app_google_image",
            [
                "label" => __("Choose Hirers Google  Phone Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hirers_app_google_link",
            [
                "label" => __("Google Link", "banow"),
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
            "hirers_bottom_image",
            [
                "label" => __("Choose Hirers Bottom Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
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

        echo '<div class="lp-full-block hero margin-bottom margin-top hirers-hero">
        <div class="hero__hero-image-mobile lg-down as-fs" style="background-image: url(' . $settings["hirers_hero_image"]["url"] . ')">

        '. wp_get_attachment_image($settings["hirers_hero_bg_image"]["id"], "full", false, ["class" => "hero__sound-wave-mobile p-abs b-0 w-100"] ) .'

        </div>

        <div class="corset">

        <div class="row h-100">

        '. wp_get_attachment_image($settings["hirers_hero_image"]["id"], "full", false, ["class" => "hero__hero-image lg-up"] ) .'

        </div>

        </div>

        '. wp_get_attachment_image($settings["hirers_hero_bg_image"]["id"], "full", false, ["class" => "hero__sound-wave lg-up"] ) .'

        <div class="corset">
        <div class="row pad-top h-100">
        <div class="hero__info col-12 col-10-md ofs-1-md col-4-xl col-5-lg">
        <div class="pre-heading">' . $settings["hirers_sub_title"] . '</div>
        <h1 class="md-up hero-h1 no-wrap">
    	    '. $settings["hirers_title"].'
        </h1>
        <h1 class="md-down hero-h1">
      	  Get discovered, get gigs, get paid.
        </h1>
     	  '. $settings["hirers_content"] .'
        <p id="email-alert" class="email-alert"></p>
        <div class="sign-up md-up">
        <a class="sign-up__button button" href="' . $settings["hirers_button_link"]["url"] . '" target="_blank">
       
       	'. $settings["hirers_button_text"].'

        </a>

        </div>

        <div class="get-app md-down">

        <p>' . $settings["hirers_app_text"] . '</p>
        <div class=" fd-r">

        <a class="get-app__button" href="' . $settings["hirers_app_apple_link"]["url"] . '">
      	  '. wp_get_attachment_image($settings["hirers_app_apple_image"]["id"], "full", false, ["class" => ""] ) .'
        </a>

		<a class="get-app__button" href="' . $settings["hirers_app_google_link"]["url"] . '">

        '. wp_get_attachment_image($settings["hirers_app_google_image"]["id"], "full", false, ["class" => ""] ) .'

        </a>

        </div>

        </div>

        </div>

        <div class="col ofs-1-lg align-self-end lg-up">

        <img class="hero__interface" src="'. $settings["hirers_bottom_image"]["url"] .'" alt="A smartphone displaying an artist profile on the Muso app." />

        </div>
        </div>
        </div>
        </div>';
    }
}
