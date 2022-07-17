<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_About_Body_Section_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_about_body_section";
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
        return __("BN About Section", "banow");
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
        return ["bn-plugin", "bn-helpers", "bn-main", "bn-about"];
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
            "content_section",
            [
                "label" => __("Box Content", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "box_title",
            [
                "label" => __("Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default title", "banow"),
                "placeholder" => __("Type your title here", "banow"),
            ]
        );

        $this->add_control(
            "box_image",
            [
                "label" => __("Choose Box Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "box_sub_title",
            [
                "label" => __("Box Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Box title", "banow"),
                "placeholder" => __("Type your Box title here", "banow"),
            ]
        );

        $this->add_control(
            "box_content",
            [
                "label" => __("Box Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Default Box Content", "banow"),
                "placeholder" => __("Type your Box Content here", "banow"),
            ]
        );

        $this->end_controls_section();

        // For The Core Team

        $this->start_controls_section(
            "content_coreteam_section",
            [
                "label" => __("The Core Team Content", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "core_title",
            [
                "label" => __("Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default title", "banow"),
                "placeholder" => __("Type your title here", "banow"),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "team_image",
            [
                "label" => __("Choose Team Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "team_name",
            [
                "label" => __("Team Name", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Team Name", "banow"),
                "placeholder" => __("Type your Team Name here", "banow"),
            ]
        );

        $repeater->add_control(
            "team_title",
            [
                "label" => __("Team Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Team Title", "banow"),
                "placeholder" => __("Type your Team Title here", "banow"),
            ]
        );

        $this->add_control(
            "team_list",
            [
                "label" => __("Team List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "team_name" => __("Team #1", "banow"),
                        "team_title" => __("Change team text.", "banow"),
                    ],
                ],

                "title_field" => "{{{ team_name }}}",
            ]
        );

        $this->end_controls_section();

        // For The Press

        $this->start_controls_section(
            "content_press_section",
            [
                "label" => __("The Press Content", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "press_main_title",
            [
                "label" => __("Press Main Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Press Main Title", "banow"),
                "placeholder" => __("Type your Press Main Title here", "banow"),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "press_image",
            [
                "label" => __("Choose Press Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "press_title",
            [
                "label" => __("Press Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Press Title", "banow"),
                "placeholder" => __("Type your Press Title here", "banow"),
            ]
        );

        $repeater->add_control(
            "press_link",
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
            "press_list",

            [
                "label" => __("Press List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "press_title" => __("Press Title #1", "banow"),
                    ],
                ],

                "title_field" => "{{{ press_title }}}",
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
        echo '<div class="corset margin-top">';
	        echo '<div class="row">
	        	<div class="col col-6-lg col-5-xl ofs-1-xl about-col">
	        	<h1>' . $settings["box_title"] . '</h1>
			        <div>';

			        echo wp_get_attachment_image( $settings["box_image"]["id"], "full", false, ["class" => "w-100"] );

			        echo '</div> </div> 
			        <div class="col col-6-lg col-5-xl about-col"><h3>' . $settings["box_sub_title"] . '</h3> ' . $settings["box_content"] . ' </div></div></div>';

        // Team
        if ($settings["team_list"]) {
            
            echo '<div class="corset about_team">
            		<div class="row">
           			 <div class="col ofs-1-xl">
           			 <h2>' . $settings["core_title"] . '</h2>
           			 </div>
            	</div>
            	<div class="row">
	            <div class="col col-8-xl ofs-1-xl">
	            <div class="row">';

            foreach ($settings["team_list"] as $team_item) {
               
                echo '<div class="col-12 col-6-sm col-3-md">
                		<div class="team-card fd-c ai-c">';

	                echo wp_get_attachment_image(
	                    $team_item["team_image"]["id"],
	                    "full",
	                    false
	                );

                echo '<div class="team-name">' .  $team_item["team_name"] . '</div>';

                echo '<div class="team-title">' .
                    $team_item["team_title"] .
                    '</div>
                    </div>
                    </div>';
            }

         	   echo "</div>
          	 	 </div>
          	  </div>
            </div>";
        }

        // Press

        if ($settings["team_list"]) {
            
            echo '<div class="corset press">
	            <div class="row">
		            <div class="col ofs-1-xs ofs-0-md ofs-1-xl">
		           	 <h2>' . $settings["press_main_title"] . '</h2>
		            </div>
	            </div>

            <div class="row">
            <div class="col col-10-md col-12-lg col-10-xl ofs-1-xl"><!-- Outer container -->
            <div class="row">';

            foreach ($settings["press_list"] as $press_item) {
                echo '<div class="col-12 col-6-sm col-3-lg">';

                echo '<a target="_blank" href="' . $press_item["press_link"]["url"] . '">';

                echo wp_get_attachment_image( $press_item["press_image"]["id"], "full", false );

                echo '<div> '. $press_item["press_title"] . '</div>
                </a>
                </div>';
            }

            echo "</div>
            </div>
            </div>
            </div>";
        }
    }
}
