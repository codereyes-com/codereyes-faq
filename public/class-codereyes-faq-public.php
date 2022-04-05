<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/shahadul878
 * @since      1.0.0
 *
 * @package    Codereyes_Faq
 * @subpackage Codereyes_Faq/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Codereyes_Faq
 * @subpackage Codereyes_Faq/public
 * @author     H M SHAHADUL ISLAM <shahadul.islam1@gmail.com>
 */
class Codereyes_Faq_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->add_action_filter_hook();
		$this->make_shortcode();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Codereyes_Faq_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Codereyes_Faq_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/codereyes-faq-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Codereyes_Faq_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Codereyes_Faq_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/codereyes-faq-public.js', array( 'jquery' ), $this->version, false );

	}


	public function add_action_filter_hook() {
		add_action( 'init', array( $this, 'regsister_custom_post' ) );
		add_action( 'init', array( $this, 'make_taxonomy' ) );

		add_filter( 'enter_title_here', array( $this, 'custom_title_text' ) );
		add_filter( 'default_content', array( $this, 'custom_content_text' ) );



	}


	/**
	 * @return void
	 */
	public function regsister_custom_post() {
		$labels = array(
			'name'               => _x( 'FAQ', 'post type general name' ),
			'singular_name'      => _x( 'FAQ', 'post type singular name' ),
			'add_new'            => _x( 'Add New Question', 'faq' ),
			'add_new_item'       => __( 'Add New Question' ),
			'edit_item'          => __( 'Edit Question' ),
			'new_item'           => __( 'New Question' ),
			'all_items'          => __( 'All Questions' ),
			'view_item'          => __( 'View Question' ),
			'search_items'       => __( 'Search Questions' ),
			'not_found'          => __( 'No questions found' ),
			'not_found_in_trash' => __( 'No questions found in Trash' ),
			'parent_item_colon'  => '',
			'menu_name'          => 'FAQ'

		);
		$args   = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( "slug" => "faq" ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author' )
		);
		register_post_type( 'codereyes_faq', $args );
	}

	/**
	 * @return void
	 */
	public function make_taxonomy() {
		$labels = array(
			'name'                       => _x( 'FAQ Category', 'taxonomy general name' ),
			'singular_name'              => _x( 'FAQ Category', 'taxonomy singular name' ),
			'search_items'               => __( 'Search FAQ Categories' ),
			'popular_items'              => __( 'Popular FAQ Categories' ),
			'all_items'                  => __( 'All FAQ Categories' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit FAQ Category' ),
			'update_item'                => __( 'Update FAQ Category' ),
			'add_new_item'               => __( 'Add New FAQ Category' ),
			'new_item_name'              => __( 'New FAQ Category Name' ),
			'separate_items_with_commas' => __( 'Choose an appropriate FAQ Category for this question (one per question)' ),
			'add_or_remove_items'        => __( 'Add or remove FAQ Categories' ),
			'choose_from_most_used'      => __( 'Choose from the most used FAQ Categories' ),
			'menu_name'                  => __( 'FAQ Categories' ),
		);

		register_taxonomy( 'codereyes_faq_category', 'codereyes_faq', array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'faqs' ),
		) );

	}

	/**
	 * @param $title
	 *
	 * @return mixed|string|void
	 */
	public function custom_title_text( $title ) {
		if ( function_exists( 'get_current_screen' ) ) {
			$screen = get_current_screen();
			if ( 'codereyes_faq' == $screen->post_type ) {
				$title = 'Enter question here';
			}

			return $title;
		}
	}


	/**
	 * @param $content
	 *
	 * @return mixed|string|void
	 */
	function custom_content_text( $content ) {
		if ( function_exists( 'get_current_screen' ) ) {
			$screen = get_current_screen();
			if ( 'codereyes_faq' == $screen->post_type ) {
				$content = 'Enter answer here';
			}

			return $content;
		}
	}

	/**
	 * @param $atts
	 * [codereyes_faq]
	 * @return string
	 */
	public function make_shortcode() {
		add_shortcode( 'codereyes_faq',  'custom_shortcode'  );
		function custom_shortcode ( $atts ) {
			extract( shortcode_atts( array(
				'show_categories'        => false,
				'show_specific_category' => false,
			), $atts ) );

			// Counter for post IDs
			$codereyes_faq_i = 0;
			// Return String
			$returner = '';
			// Post Category Slug
			$post_category_slug = '';

			if ( $show_categories ) {
				// get the categories possible for 'codereyes_faq_category'
				$args  = array(
					'taxonomy' => 'codereyes_faq_category',
				);
				$terms = get_terms( 'codereyes_faq_category' );

				foreach ( $terms as $term ) {
					$returner           .= "<h2>" . $term->name . "</h2>";
					$post_category_slug = urldecode( $term->slug );
					// Custom Loop
					$codereyes_faq_query = new WP_Query( "taxonomy=codereyes_faq_category&term=$term->slug&posts_per_page=-1&showposts=-1" );
					// The Loop
					while ( $codereyes_faq_query->have_posts() ) : $codereyes_faq_query->the_post();
						$returner .= the_title( "<h4><a class='codereyes-faq-question-closed' id='codereyes-faq-question-$post_category_slug-$codereyes_faq_i' href='" . get_permalink() . "' title='" . the_title_attribute( 'echo=0' ) . "' rel='question'><span class='codereyes-faq-triangle'>&#9654;</span> ", '</a></h4>', false );

						$returner .= "<div class='codereyes-faq-answer' id='codereyes-faq-question-$post_category_slug-$codereyes_faq_i-answer' style=' zoom: 1;'>";
						$returner .= get_the_content();
						$returner .= "</div>";
						$codereyes_faq_i ++;
					endwhile;
				}
			} else {
				if ( $show_specific_category ) {
					$codereyes_faq_query = new WP_Query( "taxonomy=codereyes_faq_category&term=$show_specific_category&posts_per_page=-1&showposts=-1" );
				} else {
					$codereyes_faq_query = new WP_Query( 'post_type=codereyes_faq&posts_per_page=-1&showposts=-1' );
				}

				// The Loop
				while ( $codereyes_faq_query->have_posts() ) : $codereyes_faq_query->the_post();
					if ( $show_specific_category ) {
						$post_taxonomy      = wp_get_post_terms( get_the_ID(), 'codereyes_faq_category' );
						$post_category_slug = urldecode( $post_taxonomy[0]->slug );
					}
					$returner .= the_title( '<h4><a class="codereyes-faq-question-closed" id="codereyes-faq-question-' . $post_category_slug . '-' . $codereyes_faq_i . '" href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="question"><span class="codereyes-faq-triangle">&#9654;</span> ', '</a></h4>', false );

					$returner .= "<div class='codereyes-faq-answer' id='codereyes-faq-question-$post_category_slug-$codereyes_faq_i-answer' style='  zoom: 1;'>";
					$returner .= get_the_content();
					$returner .= "</div>";
					// Increase the count
					$codereyes_faq_i ++;
				endwhile;
			} //end if
			wp_reset_query();

			return $returner;
		}
}


}
