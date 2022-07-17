<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Artists_Join_Connecting_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_artists_connecting_join";
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
        return __("BN Artists Join Connecting", "banow");
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
        return ["bn-accordion", "bn-slider", "bn-explosion"];
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
            "bn-explosion",
            "bn-connecting",
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
            "artist_connecting_join_section",
            [
                "label" => __("Artists Join", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "artist_connecting_join_style",
            [
                "label" => __("Style Class", "banow"),
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => "style-1",
                "options" => [
                    "style-1" => __("Style 1", "banow"),
                    "style-2" => __("Style 2", "banow"),
                ],
            ]
        );

        $this->add_control(
            "artist_connecting_join_title",
            [
                "label" => __("Artists Join Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artists Join Title", "banow"),
                "placeholder" => __("Type your Artists Join Title", "banow"),
            ]
        );

        $this->add_control(
            "artist_connecting_join_content",
            [
                "label" => __("Artists Join Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Artists Join Content", "banow"),
                "placeholder" => __("Type your Artists Join Content", "banow"),
            ]
        );

        $this->add_control(
            "artist_connecting_join_button",
            [
                "label" => __("Artists Join Button Text", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artists Join Button Text", "banow"),
                "placeholder" => __(
                    "Type your Artists Join Button Text",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "artist_connecting_join_button_link",
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
            "artist_connecting_join_image",
            [
                "label" => __("Choose Artists How It Works Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "artist_connecting_join_image_title",
            [
                "label" => __("BG Image Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("BG Image Title", "banow"),
                "placeholder" => __("Type BG Image Title", "banow"),
            ]
        );

        $this->add_control(
            "artist_connecting_join_image_list",
            [
                "label" => __("Background Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "artist_connecting_join_image" => __(
                            "Join BG Images",
                            "banow"
                        ),
                    ],
                ],
                "image_field" => "{{{ artist_connecting_join_image }}}",
            ]
        );

        $this->add_control(
            "artist_connecting_get_app",
            [
                "label" => __("Artists Join Get The App", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artists Join Get The app:", "banow"),
                "placeholder" => __(
                    "Type your Artists Join Get The app:",
                    "banow"
                ),
            ]
        );

        $this->add_control(
            "artist_app_apple_image",
            [
                "label" => __("Choose Apple Phone Image", "banow"),
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
                "label" => __("Choose Google Phone Image", "banow"),
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

        echo '<div class="lp-full-block lp-lineup js-explode">';

        if ($settings["artist_connecting_join_image_list"]) {
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

            echo '<div class="lp-explosion closed">';

            foreach ( $settings["artist_connecting_join_image_list"] as $bg_img_item ) {

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

                $dimension = mt_rand(100, 180);

                echo '<img class="lp-explosion__artist-portrait js-explosion-portrait"src="' . $bg_img_item["artist_connecting_join_image"]["url"] . '" alt="" style="top:' . $yClosed . "%; left:" . $xClosed . "%; height:" . $dimension . "px; width:" . $dimension . 'px;"  data-x-closed="' . $xClosed . '" data-y-closed="' . $yClosed . '" data-x-open="' . $xOpen . '" data-y-open="' . $yOpen . '" />';

                $count++;

                $layoutIndex++;
            }

            echo '</div>';
        }

        echo '<div class="corset jc-c h-100">';

        // Style 1

        if ($settings["artist_connecting_join_style"] == "style-1") {
            echo '<div class="row jc-c ai-c style-1">
            <div class="col-6-lg ord-2-lg">
            <h1 class="lp-lineup__heading">' .
                $settings["artist_connecting_join_title"] .
                '</h1>
                </div>
                <div class="col-4-xl ofs-1-xl col-6-lg col-10-md col-12">
                <div class="brand-block brand-block--fade">';

            echo $settings["artist_connecting_join_content"];

            echo '<div class="sign-up as-c md-up">
            <a class="sign-up__button button" href="' .
                $settings["artist_connecting_join_button_link"]["url"] .
                '" target="_blank">';

            echo $settings["artist_connecting_join_button"];

            echo '</a>
            </div>
            <div class="get-app md-down">
            <p>' . $settings["artist_connecting_get_app"] . '</p>
            <div class=" fd-r">

            <a class="get-app__button" href="' . $settings["artist_app_apple_link"]["url"] . '">
           	 <img src="' . $settings["artist_app_apple_image"]["url"] . '" alt="Apple App Store logo" />
            </a>
             <a class="get-app__button" href="' . $settings["artist_app_google_link"]["url"] . '">

             <img src="'.$settings["artist_app_google_image"]["url"].'" alt="Google Play Store logo" />
             </a>
            </div>
            </div>
            </div>
            </div>
            </div>';
        }

        // Style 1

        // Style 2

        if ($settings["artist_connecting_join_style"] == "style-2") {
            echo '<div class="row style-2">
            <div class="col-12 col-6-md ofs-3-md ai-c jc-c">
            <h1 class="no-wrap">' . $settings["artist_connecting_join_title"] . '</h1>';

            echo $settings["artist_connecting_join_content"];

            echo '<div class="sign-up md-up">
            <a class="sign-up__button button" href="' . $settings["artist_connecting_join_button_link"]["url"] . '" target="_blank">';

            echo $settings["artist_connecting_join_button"];

            echo '</a>
            </div>
            <div class="get-app md-down">
            <p>' . $settings["artist_connecting_get_app"] . '</p>
            <div class="fd-r jc-c">
            
            <a class="get-app__button" href="' . $settings["artist_app_apple_link"]["url"] . '">
            <img src="' . $settings["artist_app_apple_image"]["url"] . '" alt="Apple App Store logo" />
            </a>
            <a class="get-app__button" href="' . $settings["artist_app_google_link"]["url"] . '">

            <img src="' . $settings["artist_app_google_image"]["url"] . '" alt="Google Play Store logo" />
            </a>
            </div>
            </div>
            </div>
            </div>';
        }

        // Style 2

        echo '</div>
        </div>';
    }
}
