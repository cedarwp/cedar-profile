<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://studiocedar.com
 * @since      1.0.0
 *
 * @package    CWP_Profile
 * @subpackage CWP_Profile/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    CWP_Profile
 * @subpackage CWP_Profile/public
 * @author     Stephan Smith <stephan@stuciocedar.com>
 */
class CWP_Profile_Public {

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

		$this->options = $options = get_option( 'cwp-profile' );

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
		 * defined in CWP_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CWP_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cwp-profile_public.css', array(), $this->version, 'all' );

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
		 * defined in CWP_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CWP_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cwp-profile_public.js', array( 'jquery' ), $this->version, false );

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

		add_shortcode('profile_telephone',		array($this, 'get_telephone'));
		add_shortcode('profile_telephone_link',	array($this, 'get_telephone_link'));
	}

	public function get_street_address()
	{
		return $this->options['street_address'];
	}
	public function get_post_office_box_number()
	{
		return $this->options['post_office_box_number'];
	}
	public function get_address_locality()
	{
		return $this->options['address_locality'];
	}
	public function get_address_region()
	{
		return $this->options['address_region'];
	}
	public function get_postal_code()
	{
		return $this->options['postal_code'];
	}

	public function get_address() {
		$html = '';
		if ( ! empty($this->options['street_address']) ) {
			$html .= $this->options['street_address'] . '<br>';
		}
		if ( ! empty($this->options['post_office_box_number']) ) {
			$html .= 'PO Box ' . $this->options['post_office_box_number'] . '<br>';
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

	public function get_telephone()
	{
		return $this->options['telephone'];
	}
	public function get_telephone_link()
	{
		if ( $this->options['telephone'] ) {
			return '<a href="tel:' . esc_attr( $this->options['telephone'] ) . '">' . $this->options['telephone'] . '</a>';
		}
		return;
	}
}
