<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://raghav.com
 * @since      1.0.0
 *
 * @package    Post_Mailer
 * @subpackage Post_Mailer/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Post_Mailer
 * @subpackage Post_Mailer/includes
 * @author     Raghav Sharma <raghavsharma0411@gmail.com>
 */
class Post_Mailer_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		$timestamp = wp_next_scheduled('daily_post_email_cron');
		if ($timestamp) {
			
			wp_unschedule_event($timestamp, 'daily_post_email_cron');
		}

	}

}
