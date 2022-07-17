<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Venue_Form_Widget extends \Elementor\Widget_Base {

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
   	return "bn_venue_form";
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
   	return __("BN Venue Form", "banow");
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
   	return ["general", "venue", "rotpg", "form"];
   }

    // Style file add

   public function get_style_depends() {
   	return [
   		"bn-helpers",
   		"bn-main",
   		"bn-typography",
   		"bn-spacing",
   		"bn-rotpg",
   		"bn-rotpg-form",
   		"bn-inputs",
   		"bn-accordions",
   		"bn-annotations",
   		"bn-buttons",
   		"bn-cards",
   		"bn-checklist",
   		"bn-chiplists",
   		"bn-help",
   		"bn-image-uploaders",
   		"bn-loaders",
   		"bn-modals",
   		"bn-panels",
   		"bn-range-input",
   		"bn-toast",
   		"bn-toggles",
   		"bn-tooltip",
   		"bn-popup",
   	];
   }

   public function get_script_depends() {
   	return [
   		"bn-autocomplete",
   		"bn-lazyload",
   		"bn-public-app",
   		"bn-finger-print-2",
   		"bn-crypto",
   		"bn-hmac-sha256",
   		"bn-enc-base64",
   		"bn-webservice",
   		"bn-popup",
   		"bn-clamp",
   		"bn-utils",
   		"bn-moment",
   		"bn-accordions",
   		"bn-annotations",
   		"bn-chiplists",
   		"bn-help",
   		"bn-imageUploaders",
   		"bn-inputs",
   		"bn-modals",
   		"bn-multis",
   		"bn-toast",
   		"bn-toggles",
   		"bn-tooltip",
   		"bn-form-bottom",
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
   		"venue_form_section",
   		[
   			"label" => __("Venue form", "banow"),
   			"tab" => \Elementor\Controls_Manager::TAB_CONTENT,
   		]
   	);

   	$this->add_control(
   		"venue_form_title",
   		[
   			"label" => __("Venue form Title", "banow"),
   			"type" => \Elementor\Controls_Manager::TEXT,
   			"default" => __("Venue form Title", "banow"),
   			"placeholder" => __("Type your form Title", "banow"),
   		]
   	);

   	$this->add_control(
   		"venue_form_left_top",
   		[
   			"label" => __("Choose Left Top", "banow"),
   			"type" => \Elementor\Controls_Manager::MEDIA,
   			"default" => [
   				"url" => \Elementor\Utils::get_placeholder_image_src(),
   			],
   		]
   	);

   	$this->add_control(
   		"venue_form_left_middle",
   		[
   			"label" => __("Choose Left Middle", "banow"),
   			"type" => \Elementor\Controls_Manager::MEDIA,
   			"default" => [
   				"url" => \Elementor\Utils::get_placeholder_image_src(),
   			],
   		]
   	);

   	$this->add_control(
   		"venue_form_left_bottom",
   		[
   			"label" => __("Choose Left Bottom", "banow"),
   			"type" => \Elementor\Controls_Manager::MEDIA,
   			"default" => [
   				"url" => \Elementor\Utils::get_placeholder_image_src(),
   			],
   		]
   	);

   	$this->add_control(
   		"venue_form_right_top",
   		[
   			"label" => __("Choose Right Top", "banow"),
   			"type" => \Elementor\Controls_Manager::MEDIA,
   			"default" => [
   				"url" => \Elementor\Utils::get_placeholder_image_src(),
   			],
   		]
   	);

   	$this->add_control(
   		"venue_form_right_middle",
   		[
   			"label" => __("Choose Right Middle", "banow"),
   			"type" => \Elementor\Controls_Manager::MEDIA,
   			"default" => [
   				"url" => \Elementor\Utils::get_placeholder_image_src(),
   			],
   		]
   	);

   	$this->add_control(
   		"venue_form_right_bottom",
   		[
   			"label" => __("Choose Right Bottom", "banow"),
   			"type" => \Elementor\Controls_Manager::MEDIA,
   			"default" => [
   				"url" => \Elementor\Utils::get_placeholder_image_src(),
   			],
   		]
   	);

   	$this->end_controls_section();
   	$this->start_controls_section(
   		"venue_form_bottom_section",
   		[
   			"label" => __("Venue form Bottom", "banow"),
   			"tab" => \Elementor\Controls_Manager::TAB_CONTENT,
   		]
   	);

   	$this->add_control(
   		"venue_form_bottom_image_1",
   		[
   			"label" => __("Choose Venue Bottom Image 1", "banow"),
   			"type" => \Elementor\Controls_Manager::MEDIA,
   			"default" => [
   				"url" => \Elementor\Utils::get_placeholder_image_src(),
   			],
   		]
   	);

   	$this->add_control(
   		"venue_form_bottom_image_2",
   		[
   			"label" => __("Choose Venue Bottom Image 2", "banow"),
   			"type" => \Elementor\Controls_Manager::MEDIA,
   			"default" => [
   				"url" => \Elementor\Utils::get_placeholder_image_src(),
   			],
   		]
   	);

   	$this->add_control(
   		"redirect_link",
   		[
   			"label" => __("Redirect Link", "banow"),
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

    	echo '<div class="rotpg__venue-form">
    	<div class="corset pt-md margin-top fg-1 p-rel">
    	<div id="rotpg-entry-form" class="my-xxl row">
    	<div class="col ofs-0 col-10-md ofs-1-md col-8-lg ofs-2-lg">
    	<div class="p-rel">
    	<div class="fd-r">
    	<input id="rotpg-venue-name" class="input fg-1" label="Venue name" required />

    	<!-- <input id="rotpg-abn" class="input fg-1" label="ABN" required /> -->

    	</div>
    	<div class="fd-r">
    	<input id="rotpg-first-name" class="input fg-1" label="First name" required />
    	<input id="rotpg-last-name" class="input fg-1" label="Last name" required />
    	</div>
    	<div class="fd-r">
    	<input id="rotpg-phone" class="input fg-1" label="Phone number" required />
    	<input id="rotpg-email" class="input fg-1" label="Email" required />
    	</div>
    	<div class="fd-r">
    	<select id="rotpg-state" class="input fg-1" label="State" required>
    	<option value="1">NSW</option>
    	<option value="2">VIC</option>
    	<option value="3">QLD</option>
    	<option value="4">ACT</option>
    	<option value="5">NT</option>
    	<option value="6">SA</option>
    	<option value="7">WA</option>
    	<option value="8">TAS</option>
    	</select>
    	</div>
    	<textarea id="rotpg-why" class="input" style="height:130px;"label="In 150 words of less, tell us about the live music offering you want to establish at your venue and why you want to establish it"></textarea>

    	<div class="b ml-sm">What kind of artists are you looking for?</div>
    	<div class="fd-r jc-s">
    	<div class="fg-1 fb-0">
    	<div class="chiplist fg-1" id="rotpg-artist-types" label="Artist types" max-values="3" required></div>
    	</div>
    	<div class="fg-1 fb-0">
    	<div class="chiplist fg-1" id="rotpg-genres" label="Genres" max-values="3" required></div>
    	</div>
    	</div>
    	<div class="fd-r">
    	<div class="fg-1 fd-c fb-0">
    	<div class="b pl-sm">Upload your venue\'s logo</div>
    	<input id="rotpg-logo" class="image-uploader" type="file" max-uploads="1"/>
    	</div>
    	<div class="fg-1 fd-c fb-0">
    	<div class="b pl-sm">Upload images of your venue (up to 3)</div>
    	<input id="rotpg-venue-images" class="image-uploader" type="file" max-uploads="3"/>
    	</div>
    	</div>
    	<div class="fd-r ai-c fw-b">
    	<div class="mr-md fd-c">
    	<div>
    	I have read and agree to the 
    	<a class="c-brand u" href="/rotpg/terms" target="_blank">Rise of the Pub Gig Terms and Conditions</a>
    	</div>
    	<div id="rotpg-terms-error" class="error-message">Please review the terms and conditions</div>
    	</div>
    	<input class="toggle" type="checkbox" id="rotpg-terms-toggle" />
    	</div>
    	<div id="redirection-url" class="redirection-url" redirection-url="' . $settings["redirect_link"]["url"] . '"></div>
    	<button id="rotpg-submit" class="btn">Submit</button>

    	<!-- WELCOME TO THE DOODAD ZONE -->
    	
    	<img src="' . $settings["venue_form_left_top"]["url"] . '" class="rotpg__doodad p-abs" style="top:0; left: -200px; transform: rotate(' . mt_rand(-8, 8) . 'deg)" />

    	<img src="' . $settings["venue_form_left_middle"]["url"] . '" class="rotpg__doodad p-abs" style="top:50%; left: -300px; transform: rotate(' . mt_rand(-50, 50) . 'deg)" />

    	<img src="' . $settings["venue_form_left_bottom"]["url"] . '" class="rotpg__doodad p-abs" style="bottom:0; left: -200px; transform: rotate(' . mt_rand(-8, 8) . 'deg)" />
    	<img src="' . $settings["venue_form_right_top"]["url"] . '" class="rotpg__doodad p-abs" style="top:0; right: -200px; transform: rotate(' . mt_rand(-8, 8) . 'deg)" />
    	<img src="' . $settings["venue_form_right_middle"]["url"] . '" class="rotpg__doodad p-abs" style="bottom:50%; right: -300px; transform: rotate(' . mt_rand(-10, 10) . 'deg)" />
    	<img src="' . $settings["venue_form_right_bottom"]["url"] . '" class="rotpg__doodad p-abs" style="bottom:0; right: -200px; transform: rotate(' . mt_rand(-15, 15) . 'deg)" />
    	</div>
    	</div>
    	</div>
    	<div id="rotpg-submitted" class="my-xxl row ta-c" style="display:none;">
    	<div class="col fd-c jc-c ai-c">
    	<div class="h1">
    	Thanks!
    	</div>
    	<p class="h3">
    	We\'ve received your submission and we\'ll let you know when successful applicants have been chosen.
    	</p>
    	</div>
    	</div>
    	<div id="rotpg-duplicate" class="my-xxl row ta-c">
    	<div class="col fd-c jc-c ai-c">
    	<div class="h1">
    	Already entered
    	</div>
    	<p class="h3">
    	This venue has already entered.
    	<br>We\'ll let you know when successful applicants have been chosen.
    	</p>
    	<button class="btn js-back-btn">Back</button>
    	</div>
    	</div>
    	<div id="rotpg-error" class="my-xxl row ta-c">
    	<div class="col fd-c jc-c ai-c">
    	<div class="h1">
    	Uh oh
    	</div>
    	<p class="h3">
    	Something went wrong and we weren\'t able to process your application.
    	<br>Please try again later.
    	</p>
    	<button class="btn js-back-btn">Back</button>
    	</div>
    	</div>
    	</div>
    	</div>

    	<!-- // Bottom -->

    	<div class="rotpg__sticker-bg p-rel" style="background-image: url(' . $settings["venue_form_bottom_image_1"]["url"] . ')">
    	<img class="rotpg__rip rotpg__rip--top" src="' . $settings["venue_form_bottom_image_2"]["url"] . '" />
    	</div>';
    }
}

// Venue Form footer Script

global $post;

if (is_page("55")) {
	add_action("wp_footer", function () {
		define("PRODUCTION_ENVIROMENT", true);

		if (PRODUCTION_ENVIROMENT) {
			define("API_HOST", "https://api.musoapp.com.au");
		} else {
			define(
				"API_HOST",
				!defined("DEV_API_ENDPOINT")
				? "https://devapi.musoapp.com.au"
				: DEV_API_ENDPOINT
			);
		}
		?>

		<script> const API_HOST = '<?= API_HOST ?>';</script>

		<script src="<?= API_HOST ?>/js/commonData.php" type="text/javascript"></script>

		<?php
	});
}
