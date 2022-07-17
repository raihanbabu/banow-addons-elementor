<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Hirers_HIWW_Body_Animation_Widget extends \Elementor\Widget_Base {

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
		return 'bn_hirers_hiwh_body';
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
		return __( 'BN Hirers How it works', 'banow' );
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
		return 'fa fa-code';
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
		return [ 'general' ];
	}

	// Script file add
	public function get_script_depends() {
		return [ 'bn-hiw-lazy-load', 'bn-explosion' ];
	}

	// Style file add
	public function get_style_depends() {
		return [ 'bn-plugin', 'bn-helpers', 'bn-main', 'bn-typography', 'bn-spacing', 'bn-hiw', 'bn-hiwh' ];
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
			'hiwh_create_section',
			[
				'label' => __( '#01 Create', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_create_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_create_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_create_image',
			[
				'label' => __( 'Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();
// End Create profile

// Find Artist
		$this->start_controls_section(
			'hiwh_find_section',
			[
				'label' => __( '#02 Find Artists', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_find_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_find_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_find_image_left',
			[
				'label' => __( 'Image Left', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'hiwh_find_image_right',
			[
				'label' => __( 'Image Right', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();
// Find Artist

// Create Roster 
		$this->start_controls_section(
			'hiwh_create_roster_section',
			[
				'label' => __( '#03 Create Roster', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_create_roster_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_create_roster_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_create_roster_middle_image',
			[
				'label' => __( 'Middle Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'hiwh_create_roster_image',
			[
				'label' => __( 'Choose Roster Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'hiwh_create_roster_image_list',
			[
				'label' => __( 'Images List', 'banow' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'hiwh_create_roster_image' => __( 'Images', 'banow' ),
					]
				],
				'image_field' => '{{{ hiwh_create_roster_image }}}',
			]
		);

		$this->end_controls_section();
// End Create Roster

// Calendar
		$this->start_controls_section(
			'hiwh_calendar_section',
			[
				'label' => __( '#04 Calendar', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_calendar_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_calendar_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_calendar_image',
			[
				'label' => __( 'Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
// End Calendar

// Book
		$this->start_controls_section(
			'hiwh_dad_book_section',
			[
				'label' => __( '#05 DAD Book', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_dad_book_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_dad_book_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your HIWW Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_dad_book_image',
			[
				'label' => __( 'Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
// End Book

// Communicate
		$this->start_controls_section(
			'hiwh_communicate_section',
			[
				'label' => __( '#06 Communicate', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_communicate_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_communicate_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your HIWW Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_communicate_image_left',
			[
				'label' => __( 'Image Left', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'hiwh_communicate_image_right',
			[
				'label' => __( 'Image Right', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
// End Communicate

// Promote
		$this->start_controls_section(
			'hiwh_promote_section',
			[
				'label' => __( '#07 Promote', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_promote_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);

		$this->add_control(
			'hiwh_promote_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your Sub Title', 'banow' ),
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'hiwh_promote_image',
			[
				'label' => __( 'Choose Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'hiwh_promote_image_list',
			[
				'label' => __( 'Images List', 'banow' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'hiwh_promote_image' => __('Images', 'banow')
					]
				],
				'image_field' => '{{{ hiwh_promote_image }}}',
			]
		);

		$this->end_controls_section();
// End Promote

// Payment
		$this->start_controls_section(
			'hiwh_payment_section',
			[
				'label' => __( '#08 Payment', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_payment_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_payment_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your HIWW Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_payment_image',
			[
				'label' => __( 'Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
// End Payment

// Manage
		$this->start_controls_section(
			'hiwh_manage_section',
			[
				'label' => __( '#09 Manage', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_manage_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_manage_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your HIWW Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_manage_image_left',
			[
				'label' => __( 'Image Left', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'hiwh_manage_image_middle',
			[
				'label' => __( 'Image Middle', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'hiwh_manage_image_right',
			[
				'label' => __( 'Image Right', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
// End Manage

// Support
		$this->start_controls_section(
			'hiwh_support_section',
			[
				'label' => __( '#10 Support', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwh_support_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$this->add_control(
			'hiwh_support_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your HIWW Sub Title', 'banow' ),
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'hiwh_support_image',
			[
				'label' => __( 'Choose Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'hiwh_support_image_list',
			[
				'label' => __( 'Support Images List', 'banow' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'hiwh_support_image' => __('Support Images', 'banow')
					]
				],
				'image_field' => '{{{ hiwh_support_image }}}',
			]
		);
		$this->end_controls_section();
// End Support
		
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

		echo '<div class="fd-c ai-c margin-top">';

		// Create Profile
		echo '<div class="hiw-step hiwh-s1">
		  <h2>'.$settings['hiwh_create_title'].'</h2>
		  <p>
		    '. $settings['hiwh_create_sub_title'] .'
		  </p>
		  <div class="hiw-content"> 
		     '. wp_get_attachment_image($settings['hiwh_create_image']['id'], 'full', false, array( "class" => "hiwh-s1-profile" )) .'
		  </div>
		</div>
		<div class="hiw-divider"></div>';
		// End Create Profile

		// Find Artist
		echo '<div class="hiw-step hiwh-s2">
		<h2>'.$settings['hiwh_find_title'].'</h2>
		  '. $settings['hiwh_find_sub_title'] .'
		  <div class="hiw-content">
		   '. wp_get_attachment_image($settings['hiwh_find_image_left']['id'], 'full', false, array( "class" => "hiwh-s2-search" )) .'
		   '. wp_get_attachment_image($settings['hiwh_find_image_right']['id'], 'full', false, array( "class" => "hiwh-s2-phone" )) .'
		  </div>
		</div>
		<div class="hiw-divider"></div>';
		// End Find Artist

		// Create Roster
		echo '<div class="hiw-step hiwh-s3">
		<h2>'. $settings['hiwh_create_roster_title'].'</h2>
	   		'. $settings['hiwh_create_roster_sub_title'] .'
	   	<div class="hiw-content fd-c jc-c ai-c">';
			if ($settings['hiwh_create_roster_image_list']) {

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

				echo '<div class="hiwh-s3-artist-container">';
				foreach($settings['hiwh_create_roster_image_list'] as $community_bg_img_item){
			        $layer = ceil($layoutIndex / count($coords));
			        if ($layer > 2) $layer = aRand(1,2);
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
			                if (!aRand(0,2)) $layoutIndex++;
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
			        $xOpen = ($x * 2) + 50;
			        $yOpen = ($y * 2) + 50;

			        $dimension = mt_rand(70, 120);

						echo '<img class="hiwh-s3-artist"
				            src="'.$community_bg_img_item['hiwh_create_roster_image']['url'].'" alt="" style="top:'.$yOpen.'%; left:'.$xOpen.'%; height:'.$dimension.'px; width:'.$dimension.'px;" />';
				      $count ++;
            	$layoutIndex ++;
						}

					echo '</div>';
			}
	    echo wp_get_attachment_image($settings['hiwh_create_roster_middle_image']['id'], 'full', false, array( "class" => "hiwh-s3-roster" )) .'
	    </div>
	    </div>
	    <div class="hiw-divider"></div>';
		// End Create Roster

		// Calendar
		echo '<div class="hiw-step hiwh-s4">
		<h2>'.$settings['hiwh_calendar_title'].'</h2>
		  '. $settings['hiwh_calendar_sub_title'] .'
		  <div class="hiw-content">
		    '. wp_get_attachment_image($settings['hiwh_calendar_image']['id'], 'full', false, array( "class" => "hiwh-s4-calendar" )) .'
		  </div>
		</div>
		<div class="hiw-divider"></div>';
		// End Calendar

		// DAD
		echo '<div class="hiw-step hiwh-s5">
		<h2>'.$settings['hiwh_dad_book_title'].'</h2>
		  '. $settings['hiwh_dad_book_sub_title'] .'
		  <div class="hiw-content">
		    '. wp_get_attachment_image($settings['hiwh_dad_book_image']['id'], 'full', false, array( "class" => "hiwh-s5-dnd" )) .'
		  </div>
		</div>
		<div class="hiw-divider"></div>';
		// End DAD

		// Communicate
		echo '<div class="hiw-step hiwh-s6">
		<h2>'.$settings['hiwh_communicate_title'].'</h2>
		  '. $settings['hiwh_communicate_sub_title'] .'
		  <div class="hiw-content">
		    '. wp_get_attachment_image($settings['hiwh_communicate_image_left']['id'], 'full', false, array( "class" => "hiwh-s6-chat" )) .'
		    '. wp_get_attachment_image($settings['hiwh_communicate_image_right']['id'], 'full', false, array( "class" => "hiwh-s6-phone" )) .'
		  </div>
		</div>
		<div class="hiw-divider"></div>';
		// End Communicate

		// Promote
		echo '<div class="hiw-step hiwh-s7">
		<h2>'.$settings['hiwh_promote_title'].'</h2>
		  '. $settings['hiwh_promote_sub_title'] .'
		  <div class="hiw-content">
		  	<div class="hiwh-s7-gig-container">';
		  	if ($settings['hiwh_promote_image_list']) {
		  		foreach ($settings['hiwh_promote_image_list'] as $promote_img) {
				    echo wp_get_attachment_image($promote_img['hiwh_promote_image']['id'], 'full', false, array( "class" => "hiwh-s7-gig" ));
		  		}
		  	}
		  	echo '</div>
		  	</div>
		  	</div>
		  	<div class="hiw-divider"></div>';
		// End Promote

		// Payment
		echo '<div class="hiw-step hiwh-s8">
		<h2>'.$settings['hiwh_payment_title'].'</h2>
		  '. $settings['hiwh_payment_sub_title'] .'
		  <div class="hiw-content">
		    '. wp_get_attachment_image($settings['hiwh_payment_image']['id'], 'full', false, array( "class" => "hiwh-s8-invoice" )) .'
		  </div>
		  </div>
		<div class="hiw-divider"></div>';
		// End Payment

		// Manage
		echo '<div class="hiw-step hiwh-s9">
		<h2>'.$settings['hiwh_manage_title'].'</h2>
		  '. $settings['hiwh_manage_sub_title'] .'
		  	<div class="hiw-content">
		 		<div class="hiwh-s9-phone-container fd-r">
		 			<div class="w-33">
			   	 '. wp_get_attachment_image($settings['hiwh_manage_image_left']['id'], 'full', false, array( "class" => "hiwh-s9-phone hiwh-s9-phone-1" )) .'
			    </div>
			 		<div class="w-33">
				  	'. wp_get_attachment_image($settings['hiwh_manage_image_middle']['id'], 'full', false, array( "class" => "hiwh-s9-phone hiwh-s9-phone-2" )) .'
				    </div>
		 		<div class="w-33">
			  	'. wp_get_attachment_image($settings['hiwh_manage_image_right']['id'], 'full', false, array( "class" => "hiwh-s9-phone hiwh-s9-phone-3" )) .'
			    </div>
			    </div>
		 		</div>
		  </div>
		<div class="hiw-divider"></div>';
		// End Manage

		// Support
		echo '<div class="hiw-step hiwh-s10">
		<h2>'.$settings['hiwh_support_title'].'</h2>
		  '. $settings['hiwh_support_sub_title'] .'
		  <div class="hiw-content">
		  	<div class="hiwh-s7-gig-container">';
		  	if ($settings['hiwh_support_image_list']) {
		  		foreach ($settings['hiwh_support_image_list'] as $support_img) {
				    echo wp_get_attachment_image($support_img['hiwh_support_image']['id'], 'full', false, array( "class" => "hiwh-s10-portrait" ));
		  		}
		  	}
		  	echo '</div>
		  	</div>
		  	</div>';
		// End Support
		echo '</div>';
	}
}
