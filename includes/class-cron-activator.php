<?php
/**
 * Fired during plugin activation
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Cron
 * @subpackage Cron/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cron
 * @subpackage Cron/includes
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Cron_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function cron_activate() {

		$args  = array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => 'Data',
		);
		$args1 = array(
			'post_type'   => 'page',
			'post_status' => 'trash',
			'post_title'  => 'Data',
		);

		$a  = get_page_by_title( $args['post_title'] );
		$a1 = get_page_by_title( $args1['post_title'] );
		if ( null === $a ) {
			$args = array(
				'post_type'   => 'page',
				'post_title'  => 'Data',
				'post_status' => 'publish',
			);
			wp_insert_post( $args, true );
		} elseif ( null !== $a1 ) {
			$args = array(
				'ID'          => $a1->ID,
				'post_type'   => 'page',
				'post_title'  => 'Data',
				'post_status' => 'publish',
			);
			wp_update_post( $args, true );
		}

		$args2 = array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => 'Info',
		);
		$args3 = array(
			'post_type'   => 'page',
			'post_status' => 'trash',
			'post_title'  => 'Info',
		);

		$a2 = get_page_by_title( $args2['post_title'] );
		$a3 = get_page_by_title( $args3['post_title'] );
		if ( null === $a2 ) {
			$args2 = array(
				'post_type'   => 'page',
				'post_title'  => 'Info',
				'post_status' => 'publish',
			);
			wp_insert_post( $args2, true );
		} elseif ( null !== $a3 ) {
			$args2 = array(
				'ID'          => $a3->ID,
				'post_type'   => 'page',
				'post_title'  => 'Info',
				'post_status' => 'publish',
			);
			wp_update_post( $args2, true );
		}

	}

}
