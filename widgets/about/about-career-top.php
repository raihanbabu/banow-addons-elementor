<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_About_Career_top_Section_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_career_top";
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
        return __("BN Career Top", "banow");
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

    public function get_categories()  {
        return ["general"];
    }

    // Style file add
    public function get_style_depends() {
        return [
            "bn-plugin",
            "bn-helpers",
            "bn-main",
            "bn-career",
            "bn-typography",
            "bn-spacing",
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
            "career_top_content_section",
            [
                "label" => __("Career Top Content", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "career_title",
            [
                "label" => __("Career Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Career title", "banow"),
                "placeholder" => __("Type your Career title here", "banow"),
            ]
        );

        $this->add_control(
            "career_content",
            [
                "label" => __("Career Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Default Career Content", "banow"),
                "placeholder" => __("Type your Career Content here", "banow"),
            ]
        );

        $this->add_control(
            "career_sub_title",
            [
                "label" => __("Career Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Career Sub title", "banow"),
                "placeholder" => __("Type your Career Sub title here", "banow"),
            ]
        );

        $this->add_control(
            "career_bottom_content",
            [
                "label" => __("Career Bottom Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Default Career Bottom Content", "banow"),
                "placeholder" => __(
                    "Type your Career Bottom Content here",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "career_box_image",
            [
                "label" => __("Choose Career Image", "banow"),
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

        echo '<div class="corset career-top">
                <div class="row margin-top">
                 <div class="col-5-lg">
                 <h1 class="h1">' . $settings["career_title"] . '</h1>';

        echo $settings["career_content"];

        echo '<div class="my-sm">
            <div style="font-size:1.5em" class="b mb-xs">';

        echo $settings["career_sub_title"];

        echo '</div>';

        echo $settings["career_bottom_content"];

        echo '</div></div> <div class="col-6-lg ofs-1-lg">';

        echo wp_get_attachment_image( $settings["career_box_image"]["id"], "full", false, ["class" => "w-100"] );

        echo "</div> </div> </div>"; }
}
