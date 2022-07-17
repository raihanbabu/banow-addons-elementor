<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Contact_Page_Widget extends \Elementor\Widget_Base {

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
        return "bn_contact_page";
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
        return __("BN Contact Page", "banow");
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
        return ["bn-main"];
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
            "content_page_section",
            [
                "label" => __("Contact Page", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "contact_page_title",
            [
                "label" => __("Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Contact", "banow"),
                "placeholder" => __("Title", "banow"),
            ]
        );

        $this->add_control(
            "contact_page_content",
            [
                "label" => __("Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Content", "banow"),
                "placeholder" => __("Type your Content", "banow"),
            ]
        );

        $this->add_control(
            "contact_page_email_text",
            [
                "label" => __("Email", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("admin@domain.com", "banow"),
                "placeholder" => __("Type Your Email Address", "banow"),
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
        // echo '<div class="lp lp--reverse-bg fd-c contact-page">';
        echo '<div class="corset margin-top fg-1 fd-c jc-c">
	        <div class="row">
		        <div class="col col-10-md col-8-lg col-6-xl about-col">
		        	<h1>' . $settings["contact_page_title"] . '</h1>';
			        echo $settings["contact_page_content"];
			        echo '<a href="mailto:'. $settings["contact_page_email_text"] . '"><h3> 
			        ' . $settings["contact_page_email_text"] .' </h3> </a>
			        </div>
	        </div>
        </div>';
    }
}
