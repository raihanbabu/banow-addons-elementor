<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Home_Block_Widget extends \Elementor\Widget_Base
{
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

    public function get_name()
    {
        return "bn_home_block_section";
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

    public function get_title()
    {
        return __("BN Home Block", "banow");
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

    public function get_icon()
    {
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

    public function get_categories()
    {
        return ["general", "home"];
    }

    // Style file add
    public function get_script_depends()
    {
        return ["bn-split"];
    }

    // Style file add
    public function get_style_depends()
    {
        return ["bn-plugin", "bn-helpers", "bn-split"];
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

    protected function register_controls()
    {
        $this->start_controls_section(
            "content_section",
            [
                "label" => __("Box Content", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "box_title",
            [
                "label" => __("Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default title", "banow"),
                "placeholder" => __("Type your title here", "banow"),
            ]
        );

        $repeater->add_control(
            "box_link",
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

        $repeater->add_control(
            "box_button_title",
            [
                "label" => __("Button Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Button title", "banow"),
                "placeholder" => __("Type your Button title here", "banow"),
            ]
        );

        $repeater->add_control(
            "box_image",
            [
                "label" => __("Choose Box Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "box_hover_image",
            [
                "label" => __("Choose Box Hover Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "box_class",
            [
                "label" => __("Box Class", "banow"),
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => "artist",
                "options" => [
                    "artist" => __("Artist", "banow"),
                    "hirer" => __("Hirer", "banow"),
                ],
            ]
        );

        $this->add_control(
            "list",
            [
                "label" => __("Box List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "box_title" => __("Title #1", "banow"),
                        "box_button_title" => __(
                            "Change this button text.",
                            "banow"
                        ),
                    ],
                ],

                "title_field" => "{{{ box_title }}}",
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ($settings["list"]) {

            echo '<div class="lp-split">
            		<div class="corset">
            			<div class="row">';

	            foreach ($settings["list"] as $item) {

	                if ($item["box_class"] == "artist") {
	                    $item["box_artist_class"] = "left";
	                    $item["box_artist_class_container"] = "r-0";
	                    $item["box_artist_class_title_repeat"] = "t-0";
	                } else {
	                    $item["box_artist_class"] = "right";
	                    $item["box_artist_class_container"] = "l-0";
	                    $item["box_artist_class_title_repeat"] = "b-0";
	                }

	                echo '<a href="' . $item["box_link"]["url"] . '" class="lp-split__option lp-split__option--' . $item["box_class"] . " col-12 col-10-md ofs-1-md col-6-lg ofs-0-lg " . $item["box_artist_class"] . '">

                    <div class="lp-split__card-container p-abs h-100 ' . $item["box_artist_class_container"] . '">

                    <div class="p-rel lp-split__card lp-split__card-1">

                    <div class="lp-split__title lp-split__title--repeater p-abs ' . $item["box_artist_class_title_repeat"] . ' fd-c jc-sa">

                    <div>' . $item["box_title"] . '</div>
    	                <div>' . $item["box_title"] . '</div>
    	                <div>' . $item["box_title"] . '</div>
    	                <div>' . $item["box_title"] . '</div>
    	                <div>' . $item["box_title"] . '</div>
    	                <div>' . $item["box_title"] . '</div>
    	                </div>

                    <img src="' . $item["box_image"]["url"] . '" class="lp-split__hero p-abs t-0 r-0" alt="A vocalist musician doing a live performance." />

                    <div class="lp-split__title lp-split__title--front p-abs">' . $item["box_title"] . '</div> </div>

	                <div class="p-abs lp-split__card lp-split__card-2">
	                <div class="lp-split__title lp-split__title--repeater p-abs l-0 b-0 fd-c jc-sa">
                    <div>' . $item["box_title"] . '</div>
                    <div>' . $item["box_title"] . '</div>
                    <div>' . $item["box_title"] . '</div>
                    <div>' . $item["box_title"] . '</div>
                    <div>' . $item["box_title"] . '</div>
                    <div>' . $item["box_title"] . '</div>
                    </div>

                    <img src="' . $item["box_hover_image"]["url"] . '" class="lp-split__hero p-abs t-0 r-0" alt="A vocalist musician doing a live performance." />
                    <div class="lp-split__title lp-split__title--front p-abs">' . $item["box_title"] . '</div></div>
                    <div class="lp-split__title lp-split__title--white p-abs">' . $item["box_title"] . '</div><div class="lp-split__button">' . $item["box_button_title"] . '</div></div></a>';

                }

            echo '</div></div></div>';
        }
    }
}
