<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Artists_HIWA_Body_Animation_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_artists_hiwa_body";
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
        return __("BN Artists HIWA Body", "pms");
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
        return ["bn-hiw-lazy-load", "bn-explosion"];
    }

    // Style file add
    public function get_style_depends() {
        return [
            "bn-plugin",
            "bn-helpers",
            "bn-main",
            "bn-typography",
            "bn-spacing",
            "bn-hiw",
            "bn-hiwa",
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
        // Create profile

        $this->start_controls_section(
            "hiwa_create_section",
            [
                "label" => __("HIWA Create", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_create_title",
            [
                "label" => __("HIWA Create Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Create Title", "banow"),
                "placeholder" => __("Type your Create Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_create_sub_title",
            [
                "label" => __("HIWA Create Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("HIWA Create Sub Title", "banow"),
                "placeholder" => __("Type your HIWA Create Sub Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_create_image_left",
            [
                "label" => __("HIWA Create Image Left", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_create_image_middle",
            [
                "label" => __("HIWA Create Image Middle", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_create_image_right",
            [
                "label" => __("HIWA Create Image Right", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
        // End Create profile

        // upload
        $this->start_controls_section(
            "hiwa_upload_section",
            [
                "label" => __("HIWA Upload", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_upload_title",
            [
                "label" => __("HIWA Upload Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Upload Title", "banow"),
                "placeholder" => __("Type your Upload Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_upload_sub_title",
            [
                "label" => __("HIWA Upload Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("HIWA Upload Sub Title", "banow"),
                "placeholder" => __("Type your HIWA Upload Sub Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_upload_image_top",
            [
                "label" => __("HIWA Upload Image Top", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_upload_image_middle",
            [
                "label" => __("HIWA Upload Image Middle", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_upload_image_bottom",
            [
                "label" => __("HIWA Upload Image Bottom", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
        // End Upload profile

        // Share profile
        $this->start_controls_section(
            "hiwa_share_section",
            [
                "label" => __("HIWA Share", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_share_title",
            [
                "label" => __("HIWA Share Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Share Title", "banow"),
                "placeholder" => __("Type your Share Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_share_sub_title",
            [
                "label" => __("HIWA Share Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("HIWA Share Sub Title", "banow"),
                "placeholder" => __("Type your HIWA Share Sub Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_share_image_left",
            [
                "label" => __("HIWA Share Image Left", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_share_image_middle",
            [
                "label" => __("HIWA Share Image Middle", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_share_image_right",
            [
                "label" => __("HIWA Share Image Right", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();
        // End Share profile

        // Get Booked
        $this->start_controls_section(
            "hiwa_get_booked_section",
            [
                "label" => __("HIWA Get Booked", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_get_booked_title",
            [
                "label" => __("HIWA Get Booked Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Get Booked Title", "banow"),
                "placeholder" => __("Type your Get Booked Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_get_booked_sub_title",
            [
                "label" => __("HIWA Get Booked Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("HIWA Get Booked Sub Title", "banow"),
                "placeholder" => __(
                    "Type your HIWA Get Booked Sub Title",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "hiwa_book_me",
            [
                "label" => __("HIWA Booked Me Button", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("HIWA Booked Me Button", "banow"),
                "placeholder" => __("Type your HIWA Booked Me Button", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_get_booked_image",
            [
                "label" => __("HIWA Get Booked Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
        // End Get Booked

        // Manage Booking
        $this->start_controls_section(
            "hiwa_booking_section",
            [
                "label" => __("HIWA Manage Booking", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_booking_title",
            [
                "label" => __("Manage Booking Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Manage Booking Title", "banow"),
                "placeholder" => __("Type your Manage Booking Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_booking_sub_title",
            [
                "label" => __("Manage Booking Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Manage Booking Sub Title", "banow"),
                "placeholder" => __(
                    "Type your Manage Booking Sub Title",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "hiwa_booking_image_left",
            [
                "label" => __("Manage Booking Image Left", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_booking_image_right",
            [
                "label" => __("Booking Manage Booking Right", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
        // End Manage Booking

        // Automate Payments
        $this->start_controls_section(
            "hiwa_payments_section",
            [
                "label" => __("HIWA Payments", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_payments_title",
            [
                "label" => __("HIWA Payments Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Payments Title", "banow"),
                "placeholder" => __("Type your Payments Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_payments_sub_title",
            [
                "label" => __("HIWA Payments Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("HIWA Payments Sub Title", "banow"),
                "placeholder" => __(
                    "Type your HIWA Payments Sub Title",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "hiwa_payments_image_left",
            [
                "label" => __("HIWA Payments Image Left", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_payments_image_right",
            [
                "label" => __("HIWA Payments Image Right", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
        // End Automate Payments

        // Gig Feed
        $this->start_controls_section(
            "hiwagig_feeds_section",
            [
                "label" => __("HIWA Gig Feed", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_title",
            [
                "label" => __("HIWA Gig Feed Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Gig Feed Title", "banow"),
                "placeholder" => __("Type your Gig Feed Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_sub_title",
            [
                "label" => __("HIWA Gig Feed Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("HIWA Gig Feed Sub Title", "banow"),
                "placeholder" => __(
                    "Type your HIWA Gig Feed Sub Title",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_image_left_1",
            [
                "label" => __("HIWA Gig Feed Left Image 1", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_image_left_2",
            [
                "label" => __("HIWA Gig Feed Left Image 2", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_image_left_3",
            [
                "label" => __("HIWA Gig Feed Left Image 3", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_image_left_4",
            [
                "label" => __("HIWA Gig Feed Left Image 4", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_middle_image",
            [
                "label" => __("HIWA Gig Feed Middle Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_image_right_1",
            [
                "label" => __("HIWA Gig Feed Right Image 1", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_image_right_2",
            [
                "label" => __("HIWA Gig Feed Right Image 2", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_gig_feed_image_right_3",
            [
                "label" => __("HIWA Gig Feed Right Image 3", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
        // End Gig Feed

        // Get Community
        $this->start_controls_section(
            "hiwa_community_section",
            [
                "label" => __("HIWA Community", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_community_title",
            [
                "label" => __("HIWA Community Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Community Title", "banow"),
                "placeholder" => __("Type your Community Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_community_sub_title",
            [
                "label" => __("HIWA Community Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("HIWA Community Sub Title", "banow"),
                "placeholder" => __(
                    "Type your HIWA Community Sub Title",
                    "banow"
                ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "hiwa_community_image",
            [
                "label" => __("Choose Community Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_community_image_list",
            [
                "label" => __("Community Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "hiwa_community_image" => __(
                            "Community Images",
                            "banow"
                        ),
                    ],
                ],
                "image_field" => "{{{ hiwa_community_image }}}",
            ]
        );
        $this->end_controls_section();
        // End Get Community

        // Get Support
        $this->start_controls_section(
            "hiwa_support_section",
            [
                "label" => __("HIWA Support", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hiwa_support_title",
            [
                "label" => __("HIWA Support Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Support Title", "banow"),
                "placeholder" => __("Type your Support Title", "banow"),
            ]
        );

        $this->add_control(
            "hiwa_support_sub_title",
            [
                "label" => __("HIWA Support Sub Title", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("HIWA Support Sub Title", "banow"),
                "placeholder" => __(
                    "Type your HIWA Support Sub Title",
                    "banow"
                ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "hiwa_support_image",
            [
                "label" => __("Choose Support Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hiwa_support_image_list",
            [
                "label" => __("Support Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "hiwa_support_image" => __("Support Images", "banow"),
                    ],
                ],
                "image_field" => "{{{ hiwa_support_image }}}",
            ]
        );
        $this->end_controls_section();
        // End Get Support
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

        echo '<div class="fd-c ai-c margin-top">

        // Create profile

        <div class="hiw-step hiwa-s1">
        <h2>' . $settings["hiwa_create_title"] . '</h2>';

        echo $settings["hiwa_create_sub_title"];

        echo '<div class="hiw-content">
        <div class="hiwa-s1-phone-container fd-r">
        <div class="w-33">';

        echo wp_get_attachment_image( $settings["hiwa_create_image_left"]["id"], "full", false, ["class" => "hiwa-s1-phone hiwa-s1-phone-1"] );

        echo '</div>
        <div class="w-33">';

        echo wp_get_attachment_image( $settings["hiwa_create_image_middle"]["id"], "full", false, ["class" => "hiwa-s1-phone hiwa-s1-phone-2"] );

        echo '</div>
        <div class="w-33">';

        echo wp_get_attachment_image($settings["hiwa_create_image_right"]["id"], "full", false, ["class" => "hiwa-s1-phone hiwa-s1-phone-3"] );

        echo '</div>
        </div>
        </div>
        </div>
        <div class="hiw-divider"></div>';
        // End Create profile

        // Upload profile
        echo '<div class="hiw-step hiwa-s2">
        <h2>' . $settings["hiwa_upload_title"] . '</h2>';

        echo $settings["hiwa_upload_sub_title"];

        echo '<div class="hiw-content">
        <div class="p-rel">';

        echo wp_get_attachment_image($settings["hiwa_upload_image_top"]["id"], "full", false, ["class" => "hiwa-s2-profile hiwa-s2-placeholder"] );

        echo wp_get_attachment_image($settings["hiwa_upload_image_middle"]["id"], "full", false, ["class" => "hiwa-s2-profile hiwa-s2-profile-1"] );

        echo wp_get_attachment_image($settings["hiwa_upload_image_bottom"]["id"], "full", false, ["class" => "hiwa-s2-profile hiwa-s2-profile-2"] );

        echo '</div
        </div>
        </div>
        <div class="hiw-divider"></div>';

        // End Upload profile

        // Share profile

        echo '<div class="hiw-step hiwa-s3">
        <h2>' . $settings["hiwa_share_title"] . "</h2>";

        echo $settings["hiwa_share_sub_title"];

        echo '<div class="hiw-content">
        <div class="hiwa-s1-phone-container fd-r">
        <div class="w-33">';

        echo wp_get_attachment_image($settings["hiwa_share_image_left"]["id"], "full", false, ["class" => "hiwa-s1-phone hiwa-s1-phone-1"] );

        echo '</div>
        <div class="w-33">';

        echo wp_get_attachment_image($settings["hiwa_share_image_middle"]["id"], "full", false, ["class" => "hiwa-s1-phone hiwa-s1-phone-2"] );

        echo '</div>
        <div class="w-33">';

        echo wp_get_attachment_image($settings["hiwa_share_image_right"]["id"], "full", false, ["class" => "hiwa-s1-phone hiwa-s1-phone-3"] );

        echo '</div>
        </div>
        </div>
        </div>
        <div class="hiw-divider"></div>';
        // End Share profile

        // End Get Booked
        echo '<div class="hiw-step hiwa-s4">
        <h2>' . $settings["hiwa_get_booked_title"] . '</h2>';

        echo $settings["hiwa_get_booked_sub_title"];

        echo '<div class="hiw-content">
        <div class="p-rel">
        <div class="hiwa-s4-book-me">
        <div>' . $settings["hiwa_book_me"] . '</div>
        </div>';

        echo wp_get_attachment_image($settings["hiwa_get_booked_image"]["id"], "full", false, ["class" => "hiwa-s4-click"] );

        echo '</div>
        </div>
        </div>
        <div class="hiw-divider"></div>';
        // End Get Booked

        // End Booking
        echo '<div class="hiw-step hiwa-s5">
        <h2>' . $settings["hiwa_booking_title"] . '</h2>';

        echo $settings["hiwa_booking_sub_title"];

        echo '<div class="hiw-content p-rel">';

        echo wp_get_attachment_image($settings["hiwa_booking_image_left"]["id"], "full", false, ["class" => "hiwa-s5-phone-chat"] );

        echo wp_get_attachment_image($settings["hiwa_booking_image_right"]["id"], "full", false, ["class" => "hiwa-s5-phone-events"] );

        echo '</div>
        </div>
        <div class="hiw-divider"></div>';
        // End Booking

        // End Payments
        echo '<div class="hiw-step hiwa-s6">
        <h2>' . $settings["hiwa_payments_title"] . '</h2>';

        echo $settings["hiwa_payments_sub_title"];

        echo '<div class="hiw-content">';

        echo wp_get_attachment_image($settings["hiwa_payments_image_left"]["id"], "full", false, ["class" => "hiwa-s6-invoice"] );

        echo wp_get_attachment_image($settings["hiwa_payments_image_right"]["id"], "full", false, ["class" => "hiwa-s6-phone"] );

        echo '</div>
        </div>
        <div class="hiw-divider"></div>';
        // End Payments

        // End Gig Feed
        echo '<div class="hiw-step hiwa-s7">
        <h2>' . $settings["hiwa_gig_feed_title"] . '</h2>';

        echo $settings["hiwa_gig_feed_sub_title"];

        echo '<div class="hiw-content fd-c jc-c ai-c p-rel">
        <div class="hiwa-s7-event-container">
        <img class="hiwa-s7-event" src="' . $settings["hiwa_gig_feed_image_left_1"]["url"] . '" alt="" style="top:0; left:-5%;" />
        <img class="hiwa-s7-event" src="' . $settings["hiwa_gig_feed_image_left_2"]["url"] . '" alt="" style="top:25%; left:10%;" />
        <img class="hiwa-s7-event" src="' . $settings["hiwa_gig_feed_image_left_3"]["url"] . '" alt="" style="bottom:25%; left:-10%;" />
        <img class="hiwa-s7-event" src="' . $settings["hiwa_gig_feed_image_left_4"]["url"] . '" alt="" style="bottom:0; left:5%;" />
        <img class="hiwa-s7-event" src="' . $settings["hiwa_gig_feed_image_right_1"]["url"] . '" alt="" style="top:20%; right:-5%;" />
        <img class="hiwa-s7-event" src="' . $settings["hiwa_gig_feed_image_right_2"]["url"] . '" alt="" style="top:50%; right:5%;" />
        <img class="hiwa-s7-event" src="' . $settings["hiwa_gig_feed_image_right_3"]["url"] . '" alt="" style="bottom:5%; right:-10%;" />
        </div>';

        echo wp_get_attachment_image($settings["hiwa_gig_feed_middle_image"]["id"], "full", false, ["class" => "hiwa-s7-phone"] );

        echo '</div>
        </div>
        <div class="hiw-divider"></div>';
        // End Gig Feed

        // End Community
        echo '<div class="hiw-step hiwa-s8">
        <h2>' . $settings["hiwa_community_title"] . '</h2>';

        echo $settings["hiwa_community_sub_title"];

        echo '<div class="hiw-content fd-c jc-c ai-c p-rel">';

        if ($settings["hiwa_community_image_list"]) {
            $count = 0;

            $layoutIndex = 0;

            $coords = [
                [-8, -8],
                [-9, -5],
                [-10, 0],
                [-9, 5],
                [-8, 8],
                [-5, 9],
                [0, 10],
                [5, 9],
                [8, 8],
                [9, 5],
                [10, 0],
                [9, -5],
                [8, -8],
                [5, -9],
                [0, -10],
                [-5, -9],
            ];

            $coordsShuffled = false;

            echo '<div class="hiwa-s8-artist-container">';

            foreach ($settings["hiwa_community_image_list"] as $community_bg_img_item ) {

            	$layer = ceil($layoutIndex / count($coords));

                if ($layer > 2) {
                    $layer = aRand(1, 2);
                }

                $artistCoords = $coords[$layoutIndex % count($coords)];

                $x = $artistCoords[0] * ($layer * 0.99);

                $y = $artistCoords[1] * ($layer * 0.99);

                $xAdjustment = 0;

                $yAdjustment = 0;

                // This isn't pretty but it's tweaked so that the inside is

                // more chaotic that the outisde to increase inner spread

                // while maintaing a relatively circular overall shape.

                switch ($layer) {
                    case 0:

                    case 1:
                        if (!aRand(0, 2)) {
                            $layoutIndex++;
                        }

                        $xAdjustment += aRand(0, 4);

                        $yAdjustment += aRand(0, 4);

                        break;

                    case 2:
                        if (!$coordsShuffled) {
                            shuffle($coords);

                            $coordsShuffled = true;
                        }

                        $xAdjustment += aRand(0, 1);

                        $yAdjustment += aRand(0, 1);

                        break;
                }

                if ($count % 2) {
                    $xAdjustment = 0 - $xAdjustment;

                    $yAdjustment = 0 - $yAdjustment;
                }

                $x += $xAdjustment;

                $y += $yAdjustment;

                $xClosed = $x + 50;

                $yClosed = $y + 50;

                $xOpen = $x * 2 + 50;

                $yOpen = $y * 2 + 50;

                $dimension = mt_rand(70, 120);

                echo '<img class="hiwa-s8-artist"src="' . $community_bg_img_item["hiwa_community_image"]["url"] . '" alt="" style="top:' . $yOpen . "%; left:" . $xOpen . "%; height:" . $dimension . "px; width:" . $dimension . 'px;" />';

                $count++;

                $layoutIndex++;
            }

            echo '</div>';
        }

        echo '</div>
        </div>
        <div class="hiw-divider"></div>';
        // End Community

        // End Support
        echo '<div class="hiw-step hiwh-s9">
        <h2>' . $settings["hiwa_support_title"] . '</h2>';

        echo $settings["hiwa_support_sub_title"];

        echo '<div class="hiw-content">
        <div class="hiwh-s9-team-container">';

        if ($settings["hiwa_support_image_list"]) {
            foreach ($settings["hiwa_support_image_list"] as $support_images) {
                echo wp_get_attachment_image($support_images["hiwa_support_image"]["id"], "full", false, ["class" => "hiwh-s9-portrait"] );
            }
        }

        echo '</div>
        </div>
        </div>';

        // End Support

        echo '</div>';
    }
}
