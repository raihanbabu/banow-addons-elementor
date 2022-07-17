<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Artists_How_It_Works_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_artists_how_it_works";
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
        return __("BN Artists How It Works", "banow");
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

    // Script file add
    public function get_script_depends() {
        return ["bn-accordion", "bn-slider"];
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
            "bn-accordions",
            "bn-how-it-works",
            "bn-slider",
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
            "artist_how_it_work_section",
            [
                "label" => __("Artists How It Works", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "artist_how_it_works_title",
            [
                "label" => __("Artists How It Works Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artists  How It Works Title", "banow"),
                "placeholder" => __(
                    "Type your Artists  How It Works Title",
                    "banow"
                ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "artist_how_it_works_image",
            [
                "label" => __("Choose Artists How It Works Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "artist_how_it_works_tab_title",
            [
                "label" => __("Artists How It Works Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artists  How It Works Title", "banow"),
                "placeholder" => __(
                    "Type your Artists  How It Works Title",
                    "banow"
                ),
            ]
        );

        $repeater->add_control(
            "artist_how_it_works_tab_content",
            [
                "label" => __("Artists How It Works Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Artists  How It Works Content", "banow"),
                "placeholder" => __(
                    "Type your Artists  How It Works Content",
                    "banow"
                ),
            ]
        );

        $repeater->add_control(
            "artist_how_it_works_tab_link",
            [
                "label" => __("Learn Link", "banow"),
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
            "artist_how_it_works_tab_list",
            [
                "label" => __("Tab List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "artist_how_it_works_tab_title" => __(
                            "Partners Images",
                            "banow"
                        ),
                    ],
                ],
                "title_field" => "{{{ artist_how_it_works_tab_title }}}",
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

        echo '<div class="lp-full-block lp-how">
        <div class="corset pad-top lg-up">
        <div class="row">
        <div class="col-7 col-8-xl p-abs h-100">';

        if ($settings["artist_how_it_works_tab_list"]) {
            $count_img = 0;

            foreach ($settings["artist_how_it_works_tab_list"] as $artist_how_it_works ) {
            	echo '<img id="tab_item-' . $count_img++ . '" class="lp-how__aux" src="' . $artist_how_it_works["artist_how_it_works_image"]["url"] . '" alt="' . $artist_how_it_works["artist_how_it_works_image"]["alt"] . '" />';
            }
        }

        echo '</div>
        <div class="col-4-xl ofs-8-xl col-5-lg ofs-7-lg">
        <h2 class="no-wrap">How it works</h2>
        <div class="brand-block">
        <div class="lp-accordion js-accordion">';

        $count_tab = 0;

        foreach ($settings["artist_how_it_works_tab_list"] as $artist_how_it_works ) {

        	echo '<div class="lp-accordion__item js-accordion-item" data-aux-id="tab_item-' . $count_tab++ . '">
        	
        	<div class="lp-accordion__header js-accordion-header">
        	<img alt="" class="lp-accordion__chevron" src="' . get_home_url() . '/wp-content/uploads/2021/09/accordion_chevron.svg"/>';

            echo $artist_how_it_works["artist_how_it_works_tab_title"];

            echo '</div><div class="lp-accordion__body js-accordion-body">';

            echo $artist_how_it_works["artist_how_it_works_tab_content"];

            echo '<a href="' . $artist_how_it_works["artist_how_it_works_tab_link"]["url"] . '">Learn more &rarr;</a>
            </div></div>';
        }

        echo '</div>
        </div>
        </div>
        </div>
        </div>
        <div class="lg-down">
        <div class="corset">
        <div class="row">
        <h1>How it<br>works</h1>
        </div>
        <!-- <img class="lp-how__phone" src="/public/assets/images/asset 6.png" /> -->
        </div>
        <div class="js-slider">
        <div class="js-slider-track slider__track">';

        foreach ($settings["artist_how_it_works_tab_list"] as $artist_how_it_works ) {

        	echo '<div class="slider__item">
        	<div class="lp-how__mob-card brand-block sans-image">
        	<h4';

            echo $artist_how_it_works["artist_how_it_works_tab_title"];

            echo '</h4>';

            echo $artist_how_it_works["artist_how_it_works_tab_content"];

            echo '</div></div>';
        }

        echo '</div>
        <div class="lp-how__mob-nav fd-r jc-sb">
        <div class="js-slider-prev slider__prev">
        <img alt="" src="' . get_home_url() . '/wp-content/uploads/2021/09/chevron-prev.svg" />
        </div>
        <div class="lp-how__mob-nav-pips fd-r jc-sb ai-c">   ';

        foreach ( $settings["artist_how_it_works_tab_list"] as $artist_how_it_works ) {
            echo '<div class="lp-how__mob-nav-pip slider__pip js-slider-pip"></div>';
        }

        echo '</div>
        <div class="js-slider-next slider__next">
        <img alt="" src="' .
            get_home_url() .
            '/wp-content/uploads/2021/09/chevron-next.svg" />
            </div>
            </div>
            </div>
            </div>
            </div>';
    }
}
