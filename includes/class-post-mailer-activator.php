<?php

/**
 * Fired during plugin activation
 *
 * @link       https://raghav.com
 * @since      1.0.0
 *
 * @package    Post_Mailer
 * @subpackage Post_Mailer/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Post_Mailer
 * @subpackage Post_Mailer/includes
 * @author     Raghav Sharma <raghavsharma0411@gmail.com>
 */
class Post_Mailer_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// wp_mail('raghavsharma0411@gmail.com','todays post','test email',array(
		// 	'From:  raghav.sharma@wisdmlabs.com',
		// 	'Content-Type: text/html'
		// ));

		if (!wp_next_scheduled('daily_post_email_cron')) {
			
			wp_schedule_event(time(), 'daily', 'daily_post_email_cron');
		}
	}

}
