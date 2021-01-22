<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Cron
 * @subpackage Cron/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cron
 * @subpackage Cron/admin
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Cron_Admin {

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
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook      The plugin page slug.
	 */
	public function c_admin_enqueue_styles( $hook ) {

		wp_enqueue_style( 'mwb-c-select2-css', CRON_DIR_URL . 'admin/css/cron-select2.css', array(), time(), 'all' );

		wp_enqueue_style( $this->plugin_name, CRON_DIR_URL . 'admin/css/cron-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook      The plugin page slug.
	 */
	public function c_admin_enqueue_scripts( $hook ) {

		wp_enqueue_script( 'mwb-c-select2', CRON_DIR_URL . 'admin/js/cron-select2.js', array( 'jquery' ), time(), false );

		wp_register_script( $this->plugin_name . 'admin-js', CRON_DIR_URL . 'admin/js/cron-admin.js', array( 'jquery', 'mwb-c-select2' ), $this->version, false );

		wp_localize_script(
			$this->plugin_name . 'admin-js',
			'c_admin_param',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'reloadurl' => admin_url( 'admin.php?page=cron_menu' ),
			)
		);

		wp_enqueue_script( $this->plugin_name . 'admin-js' );
	}

	/**
	 * Adding settings menu for cron.
	 *
	 * @since    1.0.0
	 */
	public function c_options_page() {
		global $submenu;
		if ( empty( $GLOBALS['admin_page_hooks']['mwb-plugins'] ) ) {
			add_menu_page( __( 'MakeWebBetter', 'cron' ), __( 'MakeWebBetter', 'cron' ), 'manage_options', 'mwb-plugins', array( $this, 'mwb_plugins_listing_page' ), CRON_DIR_URL . 'admin/images/mwb-logo.png', 15 );
			$c_menus = apply_filters( 'mwb_add_plugins_menus_array', array() );
			if ( is_array( $c_menus ) && ! empty( $c_menus ) ) {
				foreach ( $c_menus as $c_key => $c_value ) {
					add_submenu_page( 'mwb-plugins', $c_value['name'], $c_value['name'], 'manage_options', $c_value['menu_link'], array( $c_value['instance'], $c_value['function'] ) );
				}
			}
		}
	}


	/**
	 * cron c_admin_submenu_page.
	 *
	 * @since 1.0.0
	 * @param array $menus Marketplace menus.
	 */
	public function c_admin_submenu_page( $menus = array() ) {
		$menus[] = array(
			'name'            => __( 'cron', 'cron' ),
			'slug'            => 'cron_menu',
			'menu_link'       => 'cron_menu',
			'instance'        => $this,
			'function'        => 'c_options_menu_html',
		);
		return $menus;
	}


	/**
	 * cron mwb_plugins_listing_page.
	 *
	 * @since 1.0.0
	 */
	public function mwb_plugins_listing_page() {
		$active_marketplaces = apply_filters( 'mwb_add_plugins_menus_array', array() );
		if ( is_array( $active_marketplaces ) && ! empty( $active_marketplaces ) ) {
			require CRON_DIR_PATH . 'admin/partials/welcome.php';
		}
	}

	/**
	 * cron admin menu page.
	 *
	 * @since    1.0.0
	 */
	public function c_options_menu_html() {

		include_once CRON_DIR_PATH . 'admin/partials/cron-admin-display.php';
	}

	/**
	 * cron admin menu page.
	 *
	 * @since    1.0.0
	 * @param array $c_settings_general Settings fields.
	 */
	public function c_admin_general_settings_page( $c_settings_general ) {
		$c_settings_general = array(
			array(
				'title' => __( 'Text Field Demo', 'cron' ),
				'type'  => 'text',
				'description'  => __( 'This is text field demo follow same structure for further use.', 'cron' ),
				'id'    => 'c_text_demo',
				'value' => '',
				'class' => 'c-text-class',
				'placeholder' => __( 'Text Demo', 'cron' ),
			),
			array(
				'title' => __( 'Number Field Demo', 'cron' ),
				'type'  => 'number',
				'description'  => __( 'This is number field demo follow same structure for further use.', 'cron' ),
				'id'    => 'c_number_demo',
				'value' => '',
				'class' => 'c-number-class',
				'placeholder' => '',
			),
			array(
				'title' => __( 'Password Field Demo', 'cron' ),
				'type'  => 'password',
				'description'  => __( 'This is password field demo follow same structure for further use.', 'cron' ),
				'id'    => 'c_password_demo',
				'value' => '',
				'class' => 'c-password-class',
				'placeholder' => '',
			),
			array(
				'title' => __( 'Textarea Field Demo', 'cron' ),
				'type'  => 'textarea',
				'description'  => __( 'This is textarea field demo follow same structure for further use.', 'cron' ),
				'id'    => 'c_textarea_demo',
				'value' => '',
				'class' => 'c-textarea-class',
				'rows' => '5',
				'cols' => '10',
				'placeholder' => __( 'Textarea Demo', 'cron' ),
			),
			array(
				'title' => __( 'Select Field Demo', 'cron' ),
				'type'  => 'select',
				'description'  => __( 'This is select field demo follow same structure for further use.', 'cron' ),
				'id'    => 'c_select_demo',
				'value' => '',
				'class' => 'c-select-class',
				'placeholder' => __( 'Select Demo', 'cron' ),
				'options' => array(
					'INR' => __( 'Rs.', 'cron' ),
					'USD' => __( '$', 'cron' ),
				),
			),
			array(
				'title' => __( 'Multiselect Field Demo', 'cron' ),
				'type'  => 'multiselect',
				'description'  => __( 'This is multiselect field demo follow same structure for further use.', 'cron' ),
				'id'    => 'c_multiselect_demo',
				'value' => '',
				'class' => 'c-multiselect-class mwb-defaut-multiselect',
				'placeholder' => __( 'Multiselect Demo', 'cron' ),
				'options' => array(
					'INR' => __( 'Rs.', 'cron' ),
					'USD' => __( '$', 'cron' ),
				),
			),
			array(
				'title' => __( 'Checkbox Field Demo', 'cron' ),
				'type'  => 'checkbox',
				'description'  => __( 'This is checkbox field demo follow same structure for further use.', 'cron' ),
				'id'    => 'c_checkbox_demo',
				'value' => '',
				'class' => 'c-checkbox-class',
				'placeholder' => __( 'Checkbox Demo', 'cron' ),
			),

			array(
				'title' => __( 'Radio Field Demo', 'cron' ),
				'type'  => 'radio',
				'description'  => __( 'This is radio field demo follow same structure for further use.', 'cron' ),
				'id'    => 'c_radio_demo',
				'value' => '',
				'class' => 'c-radio-class',
				'placeholder' => __( 'Radio Demo', 'cron' ),
				'options' => array(
					'yes' => __( 'YES', 'cron' ),
					'no' => __( 'NO', 'cron' ),
				),
			),

			array(
				'type'  => 'button',
				'id'    => 'c_button_demo',
				'button_text' => __( 'Button Demo', 'cron' ),
				'class' => 'c-button-class',
			),
		);
		return $c_settings_general;
	}


	/**
	 * Wporg_add_custom_box()
	 *
	 * @return void
	 */
	public function add_custom_field() {

		add_meta_box(
			'cf_id',                 // Unique ID.
			'Feedback',      // Box title.
			array( $this, 'show_fields' ),  // Content callback, must be of type callable.
			'product_key'                            // Post type.
		);

	}

	/**
	 * Show_fields.
	 *
	 * @return void
	 */
	public function show_fields() {
		?>
		<label for=<?php esc_attr( 'price' ); ?>><?php esc_attr_e( 'Price :' ); ?></label>
<input type="text" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'price', true ) ); ?>" name=<?php esc_attr_e( 'price' ); ?> id=<?php esc_attr_e( 'price' ); ?> class=<?php esc_attr_e( 'price' ); ?>><br>
<label for="sku">SKU :</label>
<!-- <input type="hidden" name="mwb_nonce" value="<?php  //echo wp_create_nonce(); ?>"> -->
<input type="text" value="<?php echo esc_html( get_post_meta( get_the_ID(), 'sku', true ) ); ?>" name="sku" id="sku" class="sku"><br>



		<label for="review">Review     :   </label>
		<input type="text" value="<?php echo esc_html( get_post_meta( get_the_ID(), 'review', true ) ); ?>" name="review" id="review" class="review"><br>	
		<?php
	}

	/**
	 * Example_add_cron_interval.
	 *
	 * @param mixed $schedules Schedule a interval.
	 * @return mixed
	 */
	public function example_add_cron_interval( $schedules ) { 
		$schedules['five_seconds'] = array(
			'interval' => 5 );
		return $schedules;
	}


	public function new_cron() {
		if ( ! wp_next_scheduled( 'ppp' ) ) {
			wp_schedule_event( time(), 'five_seconds', 'ppp' );
		}
		if ( ! wp_next_scheduled( 'pppnew' ) ) {
			wp_schedule_event( time(), 'five_seconds', 'pppnew' );
		}
		// wp_unschedule_event( wp_next_scheduled( 'ppp' ), 'ppp' );
		// wp_unschedule_event( wp_next_scheduled( 'pppnew' ), 'pppnew' );
		// wp_schedule_event( time(), 'five_seconds', 'page_create' );
		// echo '<pre>'; print_r( _get_cron_array() ); echo '</pre>';
		// die;
	}

	/**
	 * Interval_display
	 *
	 * @return void
	 */
	public function interval_display() {

		$_SESSION['csv'] = array();
		$_SESSION['xml'] = array();
		$file = fopen( 'MOCK_DATA.csv', 'r' );
		while ( ! feof( $file ) ) {
			$csv = fgetcsv( $file );
			array_push( $_SESSION['csv'], $csv );
		}
		fclose( $file );

		$v = file_get_contents( 'dataset.xml' );

		$xml = simplexml_load_string( $v ) or die( "Error: Cannot create object" );
		$_SESSION['xml'] = $xml;

		$c = 1;
		$d = 10;
		if ( ! get_option( 'initial' ) ) {
			update_option( 'initial', $c );
		} else {
			$c = get_option( 'initial' );
		}
		if ( ! get_option( 'final' ) ) {
			update_option( 'final', $d );
		} else {
			$d = get_option( 'final' );
		}

		for ( $i = $c; $i <= $d; $i++ ) {
			$args = array(
				'post_type'    => 'product_key',
				'post_title'   => strval( $_SESSION['xml']->record[ $i - 1 ]->title ),
				'post_status'  => 'publish',
				'post_content' => strval( $_SESSION['xml']->record[ $i - 1 ]->content ),
			);
			$id_new   = wp_insert_post( $args, true );
			$content1 = get_post( $id_new );
			update_post_meta(
				$content1->ID,
				'price',
				$_SESSION['csv'][$i][0]
			);
			update_post_meta(
				$content1->ID,
				'sku',
				$_SESSION['csv'][$i][1]
			);
			update_post_meta(
				$content1->ID,
				'review',
				$_SESSION['csv'][$i][2]
			);
		}
		$c = $c + 10;
		$d = $d + 10;
		update_option( 'initial', $c );
		update_option( 'final', $d );

	}

	/**
	 * Interval_display_new
	 *
	 * @return void
	 */
	public function interval_display_new() {
		$postarray = array(
			'post_type'   => 'product_key',
			'post_status' => 'publish',
		);
		$postinfoarray = array();
		$postquery = new WP_Query( $postarray );
		if ( $postquery->have_posts() ) {
			while ( $postquery->have_posts() ) {
				$postinfo = array(
					'id'      => get_the_ID(),
					'title'   => get_the_title(),
					'content' => get_the_content(),
				);
				array_push( $postinfoarray, $postinfo );
			}
			$file = fopen( 'newcsv.csv', 'w', ',' );
			foreach ( $postinfoarray as $postinfoarraychild ) {
				fputcsv( $file, $postinfoarraychild );
			}
			fclose( $file );
		}
	}

}
?>
