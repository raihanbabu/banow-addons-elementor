<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Connecting_join_background_image_Widget extends \Elementor\Widget_Base {

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
		return 'bn_connecting_background_image_join';
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
		return __( 'BN Connecting Join Background Images', 'banow' );
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
		return [ 'bn-explosion' ];
	}

	// Style file add
	public function get_style_depends() {
		return [ 'bn-plugin', 'bn-helpers', 'bn-main', 'bn-typography', 'bn-spacing', 'bn-explosion', 'bn-connecting', 'bn-how-it-works', ];
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
			'artist_connecting_join_section',
			[
				'label' => __( 'Artists Join', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'artist_connecting_join_title',
			[
				'label' => __( 'Artists Join Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Artists Join Title', 'banow' ),
				'placeholder' => __( 'Type your Artists Join Title', 'banow' ),
			]
		);

		$this->add_control(

			'artist_connecting_join_content',
				[
					'label' => __( 'Artists Join Content', 'banow' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => __( 'Artists Join Content', 'banow' ),
					'placeholder' => __( 'Type your Artists Join Content', 'banow' ),
				]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'artist_connecting_join_image',
				[
					'label' => __( 'Choose Artists How It Works Image', 'banow' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
		);

		$this->add_control(
			'artist_connecting_join_image_list',
				[
					'label' => __( 'Background Images List', 'banow' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'artist_connecting_join_image' => __('Join BG Images', 'banow')
						]
					],
					'image_field' => '{{{ artist_connecting_join_image }}}',
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

			if ($settings['artist_connecting_join_image_list']) {
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

				foreach($settings['artist_connecting_join_image_list'] as $bg_img_item){

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
					$dimension = mt_rand(100, 180);

					// echo '<img class="lp-explosion__artist-portrait js-explosion-portrait" src="'.$bg_img_item['artist_connecting_join_image']['url'].'" alt="" style="top:'.$yClosed.'%; left:'.$xClosed.'%; height:'.$dimension.'px; width:'.$dimension.'px;"  data-x-closed="'.$xClosed.'" data-y-closed="'.$yClosed.'" data-x-open="'.$xOpen.'" data-y-open="'.$yOpen.'" />';
					echo '<img class="lp-explosion__artist-portrait js-explosion-portrait" src="'.$bg_img_item['artist_connecting_join_image']['url'].'" alt="" style="top:'.$yClosed.'%; left:'.$xClosed.'%;"  data-x-closed="'.$xClosed.'" data-y-closed="'.$yClosed.'" data-x-open="'.$xOpen.'" data-y-open="'.$yOpen.'" />';
					$count ++;
					$layoutIndex ++;

				}
				echo '</div>';
			}

			echo '<div class="corset jc-c h-100">
			<div class="row style-2" style="text-align: center;">
					<div class="col-12 col-6-md ofs-3-md ai-c jc-c">
						<h2 class="no-wrap">'.$settings['artist_connecting_join_title'].'</h2>';
						echo $settings['artist_connecting_join_content'];
						echo '</div>
						</div>
					</div>
			</div>';

	}
}

