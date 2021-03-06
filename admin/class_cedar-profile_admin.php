<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://studiocedar.com
 * @since      1.0.0
 *
 * @package    Cedar_Profile
 * @subpackage Cedar_Profile/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cedar_Profile
 * @subpackage Cedar_Profile/admin
 * @author     Stephan Smith <stephan@stuciocedar.com>
 */
class Cedar_Profile_Admin {

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


	public $sections = array(
		array(
			'slug'		=> 'address',
			'name'		=> 'Address',
			'fields'	=> array(
				array(
					'slug'	=> 'street_address',
					'name'	=> 'Street Address',
					'type'	=> 'text',
				),
				array(
					'slug'	=> 'post_office_box_number',
					'name'	=> 'PO Box',
					'type'	=> 'text',
				),
				array(
					'slug'	=> 'address_locality',
					'name'	=> 'City',
					'type'	=> 'text',
				),
				array(
					'slug'	=> 'address_region',
					'name'	=> 'State',
					'type'	=> 'text',
				),
				array(
					'slug'	=> 'postal_code',
					'name'	=> 'Postal Code',
					'type'	=> 'text',
				)
			),
		),
		array(
			'slug'		=> 'contact',
			'name'		=> 'Contact',
			'fields'	=> array(
				array(
					'slug'	=> 'telephone',
					'name'	=> 'Telephone',
					'type'	=> 'tel',
				),
				array(
					'slug'	=> 'fax',
					'name'	=> 'Fax Number',
					'type'	=> 'tel',
				),
				array(
					'slug'	=> 'email',
					'name'	=> 'Email',
					'type'	=> 'email',
				),
				array(
					'slug'	=> 'url',
					'name'	=> 'URL',
					'type'	=> 'url',
				)
			),
		),
		array(
			'slug'		=> 'social',
			'name'		=> 'Social',
			'fields'	=> array(
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
			)
		)
	);

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

		$this->load_dependencies();

		add_action( 'admin_menu',	array($this, 'plugin_menu') );
		add_action( 'admin_init',	array($this, 'register_settings' ) );

		include_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class_cedar-updater.php';

		$updater = new Cedar_Updater( plugin_dir_path( dirname( __FILE__ ) ) . 'cedar-profile.php' );
		$updater->set_username( 'cedarwp' );
		$updater->set_repository( 'cedar-profile' );
		$updater->initialize();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Cedar_Profile_Loader. Orchestrates the hooks of the plugin.
	 * - Cedar_Profile_i18n. Defines internationalization functionality.
	 * - Cedar_Profile_Admin. Defines all hooks for the admin area.
	 * - Cedar_Profile_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 *
		 */

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
		 * defined in Cedar_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cedar_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cedar-profile_admin.css', array(), $this->version, 'all' );

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
		 * defined in Cedar_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cedar_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cedar-profile_admin.js', array( 'jquery', 'jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable' ), $this->version, false );

	}

	/**
	 * Register the plugin menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public static function plugin_menu()
    {
        add_options_page( 'Site Profile', 'Site Profile', 'manage_options', 'Cedar_Profile_settings', array( $this, 'plugin_options' ) );
    }

	/**
	 * Register the plugin settings page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function plugin_options()
    {
        if ( ! current_user_can('manage_options') )
            wp_die( 'Sorry, you do not have sufficient permissions to access this page.' );

		?>
		<div class="wrap">
	    	<form action='options.php' method='post'>

	    		<h1>Site Profile</h1>

	    		<?php
	    		settings_fields( 'Cedar_Profile_option_group' );
	    		do_settings_sections( 'Cedar_Profile_option_group' );
	    		submit_button();
	    		?>

	    	</form>
	    </div>
		<?php

    }

	/**
	 * Register the plugin settings for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_settings()
    {
		$options = get_option( 'Cedar_Profile' );

		register_setting( 'Cedar_Profile_option_group', 'Cedar_Profile' );

		foreach ( $this->sections as $section ) {

			add_settings_section(
				'Cedar_Profile_option_group_section_' . $section['slug'],
				__( $section['name'], 'cedar-profile' ),
				null,
				'Cedar_Profile_option_group'
			);

			foreach ( $section['fields'] as $field ) {

				add_settings_field(
					$field['slug'],
					__( $field['name'], 'cedar-profile' ),
					array( $this, 'render_field'),
					'Cedar_Profile_option_group',
					'Cedar_Profile_option_group_section_' . $section['slug'],
					array(
						'slug'	=> $field['slug'],
						'name'	=> $field['name'],
						'type'	=> $field['type'],
						'value'	=> $options[$field['slug']],
					)
				);
			}
		}
	}

	function render_field( $args ) {

		?>
		<input type="<?php echo $args['type']; ?>" name="Cedar_Profile[<?php echo $args['slug']; ?>]" value="<?php echo sanitize_text_field( $args['value'] ); ?>"> [profile_<?php echo $args['slug']; ?>]

		<?php

	}

}
