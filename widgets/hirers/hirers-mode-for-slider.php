<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Hirers_MadeFor_Slider_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_madefor_slider";
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
        return __("BN Made For Slider", "banow");
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
        return ["general", "hirers"];
    }

    // Style file add
    public function get_style_depends() {
        return [
            "bn-plugin",
            "bn-helpers",
            "bn-main",
            "bn-typography",
            "bn-spacing",
            "bn-made-for",
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
            "hirers_madefor_slider_section",
            [
                "label" => __("Made for sliders", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hirers_madefor_slider_title",
            [
                "label" => __("Made for sliders", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Made for sliders", "banow"),
                "placeholder" => __("Type your Made for sliders", "banow"),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "hirers_madefor_slider_tab_title",
            [
                "label" => __("Tab Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Tab Title", "banow"),
                "placeholder" => __("Type your Tab Title", "banow"),
            ]
        );

        $repeater->add_control(
            "hirers_madefor_slider_box_title",
            [
                "label" => __("Box Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Box Title", "banow"),
                "placeholder" => __("Type your Box Title", "banow"),
            ]
        );

        $repeater->add_control(
            "hirers_madefor_slider_box_sub_title",
            [
                "label" => __("Box Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Box Sub Title", "banow"),
                "placeholder" => __("Type your Box Sub Title", "banow"),
            ]
        );

        $repeater->add_control(
            "hirers_madefor_slider_tab_content",
            [
                "label" => __("Tab Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Tab Content", "banow"),
                "placeholder" => __("Type your Tab Content", "banow"),
            ]
        );

        $repeater->add_control(
            "hirers_madefor_slider_image",
            [
                "label" => __("Choose MadeFor Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "hirers_madefor_slider_btn_title",
            [
                "label" => __("Box Button Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Box Button Title", "banow"),
                "placeholder" => __("Type your Box Button Title", "banow"),
            ]
        );

        $repeater->add_control(
            "hirers_madefor_slider_number",
            [
                "label" => __("Box Button Title", "banow"),
                "type" => \Elementor\Controls_Manager::NUMBER,
                "default" => 0,
            ]
        );

        $repeater->add_control(
            "hirers_madefor_slider_btn_link",
            [
                "label" => __("Box Button Link", "banow"),
                "type" => \Elementor\Controls_Manager::URL,
                "placeholder" => __("#", "banow"),
                "show_external" => true,
                "default" => [
                    "url" => "#",
                    "is_external" => true,
                    "nofollow" => true,
                ],
            ]
        );

        $this->add_control(
            "hirers_madefor_slider_image_list",
            [
                "label" => __("MadeFor Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "hirers_madefor_slider_tab_title" => __(
                            "MadeFor Images",
                            "banow"
                        ),
                    ],
                ],
                "title_field" => "{{{ hirers_madefor_slider_tab_title }}}",
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

        echo '<div class="lp-full-block lp-made-for lg-up margin-top">';

        echo '<div class="corset js-slider slider h-100">';

        echo '<div class="row lp-made-for__header">';

        echo '<div class="col-3 ofs-1 jc-c">';

        echo '<span class="lp-made-for__title">' .
            $settings["hirers_madefor_slider_title"] .
            "</span>";

        echo "</div>";

        echo '<div class="col-8">';

        echo '<div class="row jc-c h-100">';

        if ($settings["hirers_madefor_slider_image_list"]) {
            foreach (
                $settings["hirers_madefor_slider_image_list"]
                as $tab_title
            ) {
                echo '<div class="col lp-made-for__menu-item js-slider-pip" data-pos="<?= $index ?>">';

                echo $tab_title["hirers_madefor_slider_tab_title"];

                echo "</div>";
            }
        }

        echo "</div>";

        echo "</div>";

        echo "</div>";

        echo '<div class="lp-made-for__body">';

        echo '<div class="lp-made-for__slider js-slider-track">';

        echo '<?php foreach ($sliderItems as $item) echo $item; ?>';

        if ($settings["hirers_madefor_slider_image_list"]) {

        	foreach ($settings["hirers_madefor_slider_image_list"] as $tab_content ) {

        	echo '<div class="segment slider__item">
        	<div class="row h-100">
        	<div class="col-10 ofs-1 p-abs">
        	<div class="segment__title segment__title--fade">
        		'. implode("<br>", array_fill(0, 6, $tab_content["hirers_madefor_slider_tab_title"] ) ) .'
            </div>
			</div>
            <div class="col ofs-3 p-abs">
            <img alt="" src="' . $tab_content["hirers_madefor_slider_image"]["url"] . '" />
            </div>
            <div class="col-10 ofs-1 p-abs">
            <div class="segment__title">
            	'. implode("", array_fill(0, $tab_content["hirers_madefor_slider_number"] - 1, "<br>") ) . $tab_content["hirers_madefor_slider_tab_title"] .'
            </div>
            </div>
            <!-- <div class="col-4 ofs-7 p-abs pad-top"> -->
            <div class="segment__details brand-block">

            <h1> ' . $tab_content["hirers_madefor_slider_box_title"] . '</h1>
            <h2> ' . $tab_content["hirers_madefor_slider_box_sub_title"] . ' </h2>
            <p> ' . $tab_content["hirers_madefor_slider_tab_content"] . '</p>
            <p>
            <a href="' . $tab_content["hirers_madefor_slider_btn_link"]["url"] . '" class="w-100">' . $tab_content["hirers_madefor_slider_btn_title"] . '</a>
            </p>
            </div>
            <!-- </div> -->
            </div>
            </div>';
            }
        }

        echo '</div>
        </div>
        </div>
        </div>
        <div class="lp-made-for-mob lg-down margin-top">
        <div class="mob js-slider slider">
        <div class="corset">
        <div class="row lp-made-for__header">
        <span class="lp-made-for__title">' . $settings["hirers_madefor_slider_title"] . '</span>
        </div>
        </div>
        <div class="lp-made-for__body-mob">
        <div class="lp-made-for__slider js-slider-track">';

        if ($settings["hirers_madefor_slider_image_list"]) {

        	foreach ($settings["hirers_madefor_slider_image_list"] as $tab_content ) {

        	echo '<div class="segment slider__item">
        	<div class="corset">
        	<div class="segment__title segment__title--fade p-rel w-100">
        		'. implode("<br>", array_fill(0, 5, $tab_content["hirers_madefor_slider_tab_title"] ) ) .'
            <img alt="" class="p-abs r-0 t-0 h-100" src="' . $tab_content["hirers_madefor_slider_image"]["url"] . '" />
            </div>
            <div class="segment__title p-abs t-0">

            '. implode("", array_fill(0, $tab_content["hirers_madefor_slider_number"] - 2, "<br>") ) . $tab_content["hirers_madefor_slider_tab_title"] .'

            </div>
            </div>

            <div class="corset">
            <div class="segment__details-mob brand-block">

                <h1> ' . $tab_content["hirers_madefor_slider_box_title"] . '</h1>
                <h2> ' . $tab_content["hirers_madefor_slider_box_sub_title"] . '</h2>
                <p> ' . $tab_content["hirers_madefor_slider_tab_content"] . '</p>

                </div>
               </div>
              </div>';
            }
        }

        echo '</div>
        </div>
        <div class="col-12">
        <div class="row lp-made-for__mob-nav ai-c jc-sb ">
        <div class="js-slider-prev slider__prev">
        <img alt="" src="' . get_home_url() . '/wp-content/uploads/2021/09/chevron-prev.svg" />
        </div>
        <div class="lp-made-for__mob-nav-pips fd-r ai-c">';

        if ($settings["hirers_madefor_slider_image_list"]) {
            foreach ($settings["hirers_madefor_slider_image_list"] as $tab_content ) {
            	echo '<div class="lp-made-for__mob-nav-pip js-slider-pip"></div>';
            }
        }

        echo '</div>
        <div class="js-slider-next slider__next">
        <img alt="" src="' . get_home_url() . '/wp-content/uploads/2021/09/chevron-next.svg" />
        </div>
        </div>
        </div>
        </div>
        </div>';
    }
}
