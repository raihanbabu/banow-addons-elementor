<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Artists_Testimonials_Widget extends \Elementor\Widget_Base {

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
        return "bn_artists_testimonials";
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
        return __("BN Testimonials", "banow");
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
        return ["bn-testimonials", "bn-slider"];
    }

    // Style file add
    public function get_style_depends() {
        return [
            "bn-plugin",
            "bn-helpers",
            "bn-main",
            "bn-typography",
            "bn-spacing",
            "bn-slider",
            "bn-testimonials",
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
            "artist_testimonial_section",
            [
                "label" => __("Testimonials", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "artist_testimonial_bg_images",
            [
                "label" => __("Testimonials Background Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "artist_testimonial_title",
            [
                "label" => __("Testimonials Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __(" Testimonials Title", "banow"),
                "placeholder" => __("Type your Testimonials Title", "banow"),
            ]
        );

        $this->add_control(
            "artist_testimonial_sub_title",
            [
                "label" => __("Testimonials Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __(" Testimonials Sub Title", "banow"),
                "placeholder" => __(
                    "Type your Testimonials Sub Title",
                    "banow"
                ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "testimonial_author_name",
            [
                "label" => __("Testimonials Author Name", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Testimonials Author Name", "banow"),
                "placeholder" => __(
                    "Type your Testimonials Author Name",
                    "banow"
                ),
            ]
        );

        $repeater->add_control(
            "testimonial_author_title",
            [
                "label" => __("Testimonials Author Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Testimonials Author Title", "banow"),
                "placeholder" => __(
                    "Type your Testimonials Author Title",
                    "banow"
                ),
            ]
        );

        $repeater->add_control(
            "testimonial_author_image",
            [
                "label" => __("Testimonials Author Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "testimonial_author_content",
            [
                "label" => __("Testimonials Author Feedback", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Testimonials Author Feedback", "banow"),
                "placeholder" => __(
                    "Type your Testimonials Author Feedback",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "testimonial_author_tab_list",
            [
                "label" => __("Testimonials List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "testimonial_author_name" => __(
                            "Testimonials Author Name #1",
                            "banow"
                        ),

                        "testimonial_author_title" => __(
                            "Testimonials Author Title #1",
                            "banow"
                        ),
                    ],
                ],
                "title_field" => "{{{ testimonial_author_name }}}",
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

        echo '<div class="lp-they-say">
        <img src="' . $settings["artist_testimonial_bg_images"]["url"] . '" class="lp-they-say__sound-wave" alt="" />
        <div class="corset lg-up">
        <div class="row">
        <div class="col-8 ofs-1 ofs-2-xl">
        <h2>' . $settings["artist_testimonial_title"] . '</h2>
        </div>
        </div>
        <div class="row">
        <div class="col-1 ofs-1-xl jc-c ai-c js-testimonial-left">
        <div class="chevron chevron--left"></div>
        </div>
        <div class="col-10 col-8-xl">
        <h3>' . $settings["artist_testimonial_sub_title"] . '</h3>
        <div class="lp-they-say__testimonial-container">';

        if ($settings["testimonial_author_tab_list"]) {
            $counter = 0;

            foreach ($settings["testimonial_author_tab_list"] as $testimonial_item ) {
                echo '<div data-index="' . $counter++ . '" class="js-testimonial-body lp-they-say__testimonial">' . $testimonial_item["testimonial_author_content"] . "</div>";
            }
        }

        echo '<div class="js-callout-tick lp-they-say__callout-tick"></div>
        </div>
        <div class="fd-r">';

        if ($settings["testimonial_author_tab_list"]) {
            $num = 0;

            foreach ($settings["testimonial_author_tab_list"] as $testimonial_item ) {

                echo '<div data-index="' . $num++ . '" class="col-4 lp-they-say__by-line fd-r js-testimonial-byline">
                <img alt="Testimonial author" src="' . $testimonial_item["testimonial_author_image"]["url"] . '" />
                <div class="lp-they-say__by-line-detail fd-c jc-c">
                <div class="lp-they-say__by-line-title">' . $testimonial_item["testimonial_author_name"] . '</div>
                <div class="lp-they-say__by-line-subtitle">' . $testimonial_item["testimonial_author_title"] . '</div>
                </div>
                </div>';
            }
        }

        echo '</div>
        </div>
        <div class="col-1 jc-c ai-c js-testimonial-right">
        <div class="chevron chevron--right"></div>
        </div>
        </div>
        </div>
        <div class="lg-down lp-they-say__mobile">
        <div class="corset p-rel">
        <h2>What they say</h2
        <h3>Client Testimonials</h3>
        </div>
        <div class="js-slider slider">
        <div class="js-slider-track slider__track">';

        // foreach ($testimonials as $testimonial) echo $testimonial->getMobileHtml();

        if ($settings["testimonial_author_tab_list"]) {
            $num = 0;

            foreach ($settings["testimonial_author_tab_list"] as $testimonial_item ) {

                echo '<div>
                <div class="corset">
                <div class="lp-they-say__testimonial-mobile">';

                echo $testimonial_item["testimonial_author_content"];

                echo '<div class="lp-they-say__callout-tick middle"></div>
                </div>
                <div class="fd-r jc-c ai-c">

                <img class="lp-they-say__by-line-portrait-mobile" src="' . $testimonial_item["testimonial_author_image"]["url"] . '" alt="Testimonial author" />
                <div class="fd-c">
                <div class="lp-they-say__by-line-title">' . $testimonial_item["testimonial_author_name"] . '</div>
                <div class="lp-they-say__by-line-subtitle">' .
                    $testimonial_item["testimonial_author_title"] .
                    '</div>
                    </div>
                    </div>
                    </div>
                    </div>';
            }
        }

        echo '</div>
        <!-- <div class="corset"> -->
        <div class="p-abs b-0 w-100 fd-r jc-sb">
        <div class="js-slider-prev slider__prev">
        <img alt="" src="' . get_home_url() . '/wp-content/uploads/2021/09/chevron-prev.svg" />
        </div>
            <div class="js-slider-next slider__next">
            
        <img alt="" src="' . get_home_url() . '/wp-content/uploads/2021/09/chevron-next.svg" />
        </div>
        </div>
        <!-- </div> -->
        </div>
        </div>
        </div>';
    }
}
