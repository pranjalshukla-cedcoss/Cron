<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Cron
 * @subpackage Cron/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 * namespace cron_public.
 *
 * @package    Cron
 * @subpackage Cron/public
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Cron_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function c_public_enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, CRON_DIR_URL . 'public/css/cron-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function c_public_enqueue_scripts() {

		wp_register_script( $this->plugin_name, CRON_DIR_URL . 'public/js/cron-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'c_public_param', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( $this->plugin_name );

	}

	/**
	 * Add_new_custom_post.
	 *
	 * @return void
	 */
	public function add_new_custom_post() {

		register_post_type(
			'product_key',
			array(
				'labels'             => array(
					'name'          => __( 'Products', 'convert-text' ),
					'singular_name' => __( 'Product', 'convert-text' ),
				),
				'description'        => 'All products list here.',
				'public'             => true,
				'show_ui'            => true,
				'capability_type'    => 'post',
				'menu_position'      => 5,
				'supports'           => array( 'title', 'excerpt', 'thumbnail', 'editor', 'page-attributes' ),
				'has_archive'        => true,
				'rewrite'            => true,
				'rewrite'            => array( 'slug' => 'products' ),
				'add_new'            => _x( 'Add New', 'Events' ),
				'add_new_item'       => __( 'Add New Events' ),
				'edit_item'          => __( 'Edit Events' ),
				'new_item'           => __( 'New Events' ),
				'all_items'          => __( 'All Events' ),
				'view_item'          => __( 'View Events' ),
				'search_items'       => __( 'Search Events' ),
				'not_found'          => __( 'No Events found' ),
				'not_found_in_trash' => __( 'No Events found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Products',
				'menu_icon'          => 'dashicons-admin-users',
			)
		);

	}

	/**
	 * Save_postdata
	 *
	 * @param mixed $post_id update or create metadata.
	 * @return void
	 */
	public function save_postdata( $post_id ) {
		if ( array_key_exists( 'price', $_POST ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			update_post_meta(
				$post_id,
				'price',
				sanitize_text_field( wp_unslash( $_POST['price'] ) ) // phpcs:ignore WordPress.Security.NonceVerification
			);
		}
		if ( array_key_exists( 'sku', $_POST ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			update_post_meta(
				$post_id,
				'sku',
				sanitize_text_field( wp_unslash( $_POST['sku'] ) ) // phpcs:ignore WordPress.Security.NonceVerification
			);
		}
		if ( array_key_exists( 'review', $_POST ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			update_post_meta(
				$post_id,
				'review',
				sanitize_text_field( wp_unslash( $_POST['review'] ) ) // phpcs:ignore WordPress.Security.NonceVerification
			);
		}
	}

	/**
	 * Apply_template.
	 *
	 * @param mixed $template it will apply template accordingly.
	 * @return mixed
	 */
	public function apply_template( $template ) {
		if ( is_page( 'Data' ) ) {
			$new_template = CRON_DIR_PATH . 'public/template/custom-template.php';
			if ( '' !== $new_template ) {
				return $new_template;
			}
		}
		if ( is_page( 'Info' ) ) {
			$new_template = CRON_DIR_PATH . 'public/template/listing-template.php';
			if ( '' !== $new_template ) {
				return $new_template;
			}
		}
		if ( is_singular( 'product_key' ) ) {
			$new_template = CRON_DIR_PATH . 'public/template/single-template.php';
			if ( '' !== $new_template ) {
				return $new_template;
			}
		}
		return $template;
	}

	/**
	 * Add_new_shortcodes.
	 *
	 * @return void
	 */
	public function add_new_shortcodes() {
		add_shortcode( 'listing', array( $this, 'products_listing' ) );
	}

	/**
	 * Products_listing.
	 *
	 * @param object $atts Listing of product.
	 * @return void
	 */
	public function products_listing( $atts ) {

		$args      = array(
			'post_type'   => 'product_key',
			'post_status' => 'publish',
		);
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) :

			$the_query->the_post();
			//get_template_part( 'template-parts/content/content-excerpt' );

		endwhile;

	}

	/**
	 * Show Content
	 *
	 * @return void
	 */
	public function show_form_content() {

		if ( isset( $_POST['addinfo'] ) ) {
			if ( wp_verify_nonce( $_POST['datanonce'] ) ) {

				$title   = isset( $_POST['title'] ) ? sanitize_text_field( wp_unslash( $_POST['title'] ) ) : '';
				$content = isset( $_POST['content'] ) ? sanitize_text_field( wp_unslash( $_POST['content'] ) ) : '';
				$price = isset( $_POST['price'] ) ? sanitize_text_field( wp_unslash( $_POST['price'] ) ) : '';
				$sku = isset( $_POST['sku'] ) ? sanitize_text_field( wp_unslash( $_POST['sku'] ) ) : '';
				$review = isset( $_POST['review'] ) ? sanitize_text_field( wp_unslash( $_POST['review'] ) ) : '';
				$arr     = array(
					'post_type'    => 'product_key',
					'post_status'  => 'publish',
					'post_title'   => $title,
					'post_content' => $content,
				);

				$insert = wp_insert_post( $arr );

				if ( ! is_wp_error( $insert ) ) {

					echo '<script>alert("Info Added Successfull!!");</script>';

				}

				if ( '' !== $price ) {

					update_post_meta(
						$post_id,
						'price',
						$price
					);

				}

				if ( '' !== $sku ) {
					update_post_meta(
						$post_id,
						'sku',
						$sku
					);
				}

				if ( '' !== $review ) {
					update_post_meta(
						$post_id,
						'review',
						$review
					);
				}
			} else {
				echo esc_attr( 'nonce not verified' );
			}
		}
	}

	/**
	 * Add_style.
	 *
	 * @return void
	 */
	public function add_style() {
		wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css', false, '5.15.2', 'all' );

	}

}
