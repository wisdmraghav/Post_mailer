<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://raghav.com
 * @since      1.0.0
 *
 * @package    Post_Mailer
 * @subpackage Post_Mailer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Post_Mailer
 * @subpackage Post_Mailer/admin
 * @author     Raghav Sharma <raghavsharma0411@gmail.com>
 */
class Post_Mailer_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Post_Mailer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Mailer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/post-mailer-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Post_Mailer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Mailer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/post-mailer-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function daily_post_email()
	{

		
		$headers = array(
			'From:  raghav.sharma@wisdmlabs.com',
			'Content-Type: text/html'
		);
		$wp_admin_email = get_option('admin_email');
		$mail_subject = 'Todays Post:';

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'date_query' => array(
				array(
					'after' => '1 day ago',
					'inclusive' => true,
				),
			),
		);
		$query = new WP_Query($args);

		$message = 'Post that are published yesterday:' . "\n";
		while ($query->have_posts()) {
			$query->the_post();
			$message .= '----------' . "\n";
			$message .= 'The Title: ' . get_the_title() . "\n";
			$message .= 'The URL: ' . get_permalink() . "\n";
			$message .= 'The Meta Title: ' . get_post_meta(get_the_ID(), '_yoast_wpseo_title', true) . "\n";
			$message .= 'The Meta Description: ' . get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) . "\n";
			$message .= 'The Meta Keywords: ' . get_post_meta(get_the_ID(), '_yoast_wpseo_focuskw', true) . "\n";
			$message .= 'The Page Load Time: ' . $this->page_speed_score(get_permalink()) . "\n";
		}

		// send email
		echo wp_mail($wp_admin_email, $mail_subject, $message, $headers);
	}

	public function page_speed_score($page_url)
	{
		$api_key = "416ca0ef-63e4-4caa-a047-ead672ecc874";
		$api_url = "http://www.webpagetest.org/runtest.php?url=" . $page_url . "&runs=1&f=xml&k=" . $api_key;

		// API request
		$response = simplexml_load_file($api_url);
		
		$test_result = simplexml_load_file($response->data->xmlUrl);
		$load_time = (float) ($test_result->data->average->firstView->loadTime) / 1000;
		return $load_time;
	}

}
