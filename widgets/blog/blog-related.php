<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Blog_Related_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_blog_related";
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
        return __("BN Blog Related", "banow");
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
            "blog_related_section",
            [
                "label" => __("Blog Hero", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "blog_related_title",
            [
                "label" => __("Read Related Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Related Content", "banow"),
                "placeholder" => __("Type your Related Content", "banow"),
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

        global $post;

        $categories = get_the_category($post->ID);

        if ($categories) {
            $category_ids = [];

            foreach ($categories as $individual_category) {
                $category_ids[] = $individual_category->term_id;
            }
        }

        $args = [
            "category__in" => $category_ids,
            "post__not_in" => [$post->ID],
            "posts_per_page" => 4,
        ];

        $post_query = new WP_Query($args);

        if ($post_query->have_posts()) {
            echo '<div class="bp-items related-post">';

            while ($post_query->have_posts()) {
                $post_query->the_post(); ?>
				<article class="bp-post">
					<figure>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("post-thumbnail"); ?></a>
						<figcaption>
							<div class="bp-title"><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></div>
							<div class="bp-content"><?php the_excerpt(); ?></div>
							<div class="bp-category">

								<?php
							        $get_cat = get_the_category();

							        $output = "";

							        if (!empty($get_cat)) {
							            echo '<ul class="post-categories">';

							            foreach ($get_cat as $category) {
							                if (0 < $category->category_parent) {
							                    $cat_link = get_site_url() . "/blog/" . $category->slug . "/" . $category->slugcategory_nicename;
							                } else {
							                    $cat_link = get_site_url() . "/blog/" . $category->slug;
							                }

							                echo '<li><a href="' . esc_url($cat_link) . '" alt="' . esc_html($category->name) . '">' . esc_html($category->name) . "</a></li>";
							            }

							            echo "</ul>";
							        }
							    ?>
							</div>
						</figcaption>
					</figure>
				</article>
			<?php
            }
            echo "</div>";
        }
        wp_reset_query();
    }
}
