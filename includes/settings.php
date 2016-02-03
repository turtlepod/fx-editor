<?php
/**
 * Settings: "Editor" under Settings
**/
/* Do not access this file directly */
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Create Settings Page
 * @since 0.1.0
 */
class fx_Editor_Settings{

	/**
	 * Settings Page Slug
	 * @since 0.1.0
	 */
	public $settings_slug = 'fx-editor';

	/**
	 * Settings Page Hook Name
	 * @since 0.1.0
	 */
	public $settings_id = 'settings_page_fx-editor';

	/**
	 * Options Group
	 * @since 0.1.0
	 */
	public $options_group = 'fx-editor';

	/**
	 * Option Name
	 * @since 0.1.0
	 */
	public $option_name = 'fx-editor';

	/**
	 * Start
	 * @since 0.1.0
	 */
	public function __construct(){

		/* Create Settings Page */
		add_action( 'admin_menu', array( $this, 'create_settings_page' ) );

		/* Register Settings and Fields */
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Create Settings Page
	 * @since 0.1.0
	 */
	public function create_settings_page(){

		/* Create Settings Sub-Menu */
		add_submenu_page( 
			'options-general.php', // parent slug
			_x( 'Editor Settings', 'settings page', 'fx-editor' ), // page title
			_x( 'Editor', 'settings page', 'fx-editor' ), // menu title
			'manage_options',  // capability
			$this->settings_slug, // page slug
			array( $this, 'settings_page' ) // callback functions
		);

	}

	/**
	 * Settings Page Output
	 * @since 0.1.0
	 */
	public function settings_page(){
	?>
		<div class="wrap">

			<h1><?php _ex( 'Editor Settings', 'settings page', 'fx-editor' ); ?></h1>

			<form method="post" action="options.php">
				<?php settings_fields( $this->options_group ); ?>
				<?php do_settings_sections( $this->settings_slug ); ?>
				<?php submit_button(); ?>
			</form>

		</div><!-- wrap -->
	<?php
	}

	/**
	 * Sanitize Options
	 * @since 0.1.0
	 */
	public function sanitize( $data ){

		/* New Data */
		$new_data = array();

		/* Boxes */
		$new_data['boxes'] = ( isset( $data['boxes'] ) && 1 == $data['boxes'] ) ? true : false ;

		/* Buttons */
		$new_data['buttons'] = ( isset( $data['buttons'] ) && 1 == $data['buttons'] ) ? true : false ;

		/* Columns */
		$new_data['columns'] = ( isset( $data['columns'] ) && 1 == $data['columns'] ) ? true : false ;

		/* Page Break */
		$new_data['wp_page'] = ( isset( $data['wp_page'] ) && 1 == $data['wp_page'] ) ? true : false ;

		/* Highlights */
		$new_data['backcolor'] = ( isset( $data['backcolor'] ) && 1 == $data['backcolor'] ) ? true : false ;

		/* P to BR */
		$new_data['p_to_br'] = ( isset( $data['p_to_br'] ) && 1 == $data['p_to_br'] ) ? true : false ;

		return $new_data;
	}

	/**
	 * Register Settings
	 * @since 0.1.0
	 */
	public function register_settings(){

		/* Register settings */
		register_setting(
			$this->options_group, // options group
			$this->option_name, // option name/database
			array( $this, 'sanitize' ) // sanitize callback function
		);

		/* Create settings section */
		add_settings_section(
			'fx_editor_section', // section ID
			'', // section title
			'__return_false', // section callback function
			$this->settings_slug // settings page slug
		);

		/* Create Setting Field: Boxes, Buttons, Columns */
		add_settings_field(
			'fx_editor_custom_features', // field ID
			_x( 'Custom features', 'settings page', 'fx-editor' ), // field title 
			array( $this, 'settings_field_custom_editor_features' ), // field callback function
			$this->settings_slug, // settings page slug
			'fx_editor_section' // section ID
		);

		/* Create Setting Field: Basic Default Features (?) */
		add_settings_field(
			'fx_editor_default_features', // field ID
			_x( 'Basic features', 'settings page', 'fx-editor' ), // field title 
			array( $this, 'settings_field_basic_editor_features' ), // field callback function
			$this->settings_slug, // settings page slug
			'fx_editor_section' // section ID
		);

	}

	/**
	 * Settings Field Callback : Boxes, Buttons, Columns
	 * @since 0.1.0
	 */
	public function settings_field_custom_editor_features(){
	?>

		<p><label for="fx_editor_boxes"><input type="checkbox" value="1" id="fx_editor_boxes" name="<?php echo esc_attr( $this->option_name . '[boxes]' );?>" <?php checked( fx_editor_get_option( 'boxes', false ) ); ?>> <?php _ex( 'Boxes.', 'settings page', 'fx-editor' );?></label></p>

		<p><label for="fx_editor_buttons"><input type="checkbox" value="1" id="fx_editor_buttons" name="<?php echo esc_attr( $this->option_name . '[buttons]' );?>" <?php checked( fx_editor_get_option( 'buttons', false ) ); ?>> <?php _ex( 'Buttons.', 'settings page', 'fx-editor' );?></label></p>

		<p><label for="fx_editor_columns"><input type="checkbox" value="1" id="fx_editor_columns" name="<?php echo esc_attr( $this->option_name . '[columns]' );?>" <?php checked( fx_editor_get_option( 'columns', false ) ); ?>> <?php _ex( 'Columns.', 'settings page', 'fx-editor' );?></label></p>

	<?php
	}

	/**
	 * Settings Field Callback : Editor Basic Features
	 * @since 0.1.0
	 */
	public function settings_field_basic_editor_features(){
	?>

		<p><label for="fx_editor_wp_page"><input type="checkbox" value="1" id="fx_editor_wp_page" name="<?php echo esc_attr( $this->option_name . '[wp_page]' );?>" <?php checked( fx_editor_get_option( 'wp_page', false ) ); ?>> <?php _ex( 'Page break button.', 'settings page', 'fx-editor' );?></label></p>

		<p><label for="fx_editor_backcolor"><input type="checkbox" value="1" id="fx_editor_backcolor" name="<?php echo esc_attr( $this->option_name . '[backcolor]' );?>" <?php checked( fx_editor_get_option( 'backcolor', false ) ); ?>> <?php _ex( 'Background color (text highlight).', 'settings page', 'fx-editor' );?></label></p>

		<p><label for="fx_editor_p_to_br"><input type="checkbox" value="1" id="fx_editor_p_to_br" name="<?php echo esc_attr( $this->option_name . '[p_to_br]' );?>" <?php checked( fx_editor_get_option( 'p_to_br', false ) ); ?>> <?php _ex( 'Switch paragraph to line break (not recommended).', 'settings page', 'fx-editor' );?></label></p>

	<?php
	}

}
