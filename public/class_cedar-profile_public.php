<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://studiocedar.com
 * @since      1.0.0
 *
 * @package    Cedar_Profile
 * @subpackage Cedar_Profile/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cedar_Profile
 * @subpackage Cedar_Profile/public
 * @author     Stephan Smith <stephan@stuciocedar.com>
 */
class Cedar_Profile_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->options = $options = get_option( 'Cedar_Profile' );

		$this->add_shortcodes();

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
		 * defined in Cedar_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cedar_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cedar-profile_public.css', array(), $this->version, 'all' );

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
		 * defined in Cedar_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cedar_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cedar-profile_public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function add_shortcodes()
	{

		add_shortcode('profile_street_address',			array($this, 'get_street_address'));
		add_shortcode('profile_post_office_box_number',	array($this, 'get_post_office_box_number'));
		add_shortcode('profile_address_locality',		array($this, 'get_address_locality'));
		add_shortcode('profile_address_region',			array($this, 'get_address_region'));
		add_shortcode('profile_postal_code',			array($this, 'get_postal_code'));

		add_shortcode('profile_address',				array($this, 'get_address'));
		add_shortcode('profile_address_inline',			array($this, 'get_address_inline'));

		add_shortcode('profile_telephone',		array($this, 'get_telephone'));
		add_shortcode('profile_telephone_link',	array($this, 'get_telephone_link'));

		add_shortcode('profile_email',		array($this, 'get_email'));
		add_shortcode('profile_email_link',	array($this, 'get_email_link'));

		add_shortcode('profile_url',		array($this, 'get_url'));
		add_shortcode('profile_url_link',	array($this, 'get_url_link'));

		add_shortcode('profile_social_list',	array($this, 'get_social_list'));
	}

	public function get_street_address($atts)
	{
		return $this->options['street_address'];
	}
	public function get_post_office_box_number($atts)
	{
		return $this->options['post_office_box_number'];
	}
	public function get_address_locality($atts)
	{
		return $this->options['address_locality'];
	}
	public function get_address_region($atts)
	{
		return $this->options['address_region'];
	}
	public function get_postal_code($atts)
	{
		return $this->options['postal_code'];
	}

	public function get_address($atts)
	{
		$atts = shortcode_atts( array(
			'inline' => false,
		), $atts);
		$html = '';
		if ( ! empty($this->options['street_address']) ) {
			$html .= $this->options['street_address'];

			$html .= $atts['inline'] ? ' ' : '<br>';
		}
		if ( ! empty($this->options['post_office_box_number']) ) {
			$html .= 'PO Box ' . $this->options['post_office_box_number'];

			$html .= $atts['inline'] ? ' ' : '<br>';
		}
		if ( ! empty($this->options['address_locality']) ) {
			$html .= $this->options['address_locality'];
			if ( ! empty($this->options['address_locality']) || ! empty($this->options['postal_code']) ) {
				$html .= ', ';
			}
		}
		if ( ! empty($this->options['address_region']) ) {
			$html .= $this->options['address_region'];
			if ( ! empty($this->options['postal_code']) ) {
				$html .= ' ';
			}
		}
		if ( ! empty($this->options['postal_code']) ) {
			$html .= $this->options['postal_code'];
		}
		return $html;
	}

	public function get_address_inline($atts)
	{
		$atts = shortcode_atts( array(
			'inline' => true,
		), $atts);
		return $this->get_address($atts);
	}

	public function get_telephone($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="tel:' . esc_attr( preg_replace('/\D/', '', $this->options['telephone']) ) . '" title="Call">' . $this->options['telephone'] . '</a>';
		}
		return $this->options['telephone'];
	}
	public function get_telephone_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_telephone($atts);
	}
	public function get_email($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="mailto:' . esc_attr( $this->options['email'] ) . '" title="Email">' . $this->options['email'] . '</a>';
		}
		return $this->options['email'];
	}
	public function get_email_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_email($atts);
	}

	public function get_url($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="' . esc_attr( $this->options['url'] ) . '" title="Visit">' . $this->options['url'] . '</a>';
		}
		return $this->options['url'];
	}
	public function get_url_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_url($atts);
	}

	public function get_facebook($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="' . esc_attr( $this->options['facebook'] ) . '">Facebook</a>';
		}
		return $this->options['facebook'];
	}
	public function get_facebook_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_facebook($atts);
	}

	public function get_twitter($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="' . esc_attr( $this->options['twitter'] ) . '">Twitter</a>';
		}
		return $this->options['twitter'];
	}
	public function get_twitter_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_twitter($atts);
	}

	public function get_instagram($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="' . esc_attr( $this->options['instagram'] ) . '">Instagram</a>';
		}
		return $this->options['instagram'];
	}
	public function get_instagram_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_instagram($atts);
	}

	public function get_linkedin($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="' . esc_attr( $this->options['linkedin'] ) . '">LinkedIn</a>';
		}
		return $this->options['linkedin'];
	}
	public function get_linkedin_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_linkedin($atts);
	}

	public function get_youtube($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="' . esc_attr( $this->options['youtube'] ) . '">YouTube</a>';
		}
		return $this->options['youtube'];
	}
	public function get_youtube_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_youtube($atts);
	}

	public function get_googleplus($atts)
	{
		$atts = shortcode_atts( array(
			'link' => false,
		), $atts);
		if ( $atts['link'] ) {
			return '<a href="' . esc_attr( $this->options['googleplus'] ) . '">Google+</a>';
		}
		return $this->options['googleplus'];
	}
	public function get_googleplus_link($atts)
	{
		$atts = shortcode_atts( array(
			'link' => true,
		), $atts);
		return $this->get_googleplus($atts);
	}

	public function get_social_list($atts) {
		$socials = array(
			array(
				'slug'	=> 'facebook',
				'name'	=> 'Facebook',
			),
			array(
				'slug'	=> 'twitter',
				'name'	=> 'Twitter',
			),
			array(
				'slug'	=> 'instagram',
				'name'	=> 'Instagram',
			),
			array(
				'slug'	=> 'linkedin',
				'name'	=> 'LinkedIn',
			),
			array(
				'slug'	=> 'youtube',
				'name'	=> 'YouTube',
			),
			array(
				'slug'	=> 'googleplus',
				'name'	=> 'Google Plus',
			),
		);
		$html .= '<ul>';
		foreach ( $socials as $social ) {
			//$html .= '<li>' . call_user_func( array( $this, 'get_' . $social['slug'] . '_link' ) ) . '</li>';
			if ( $this->options[$social['slug']] != '' ) {
				$html .= '<li><a href="' . $this->options[$social['slug']] . '" title="' . $social['name'] . '" target="_blank">' . $social['name'] . '</a></li>';
			}
		}
		$html .= '</ul>';
		return $html;
	}
}
