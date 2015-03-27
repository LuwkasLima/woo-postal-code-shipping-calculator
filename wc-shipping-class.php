<?php
class WC_Shipping_UK_Postcodes extends WC_Shipping_Method {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->id                 = 'uk_postcodes_shipping';
		$this->method_title       = __( 'UK Postcode Shipping', 'uk-postcodes-shipping' );
		$this->method_description = '';
		$this->init();
	}
	/**
	 * init function.
	 */
	public function init() {
		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();
		// Define user set variables
		$this->enabled		= $this->get_option( 'enabled' );
		$this->title		= $this->get_option( 'title' );
		$this->codes		= $this->get_option( 'codes' );
		$this->codes_array  = json_decode($this->codes, true);

  		// Actions
		add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
	}
	/**
	 * calculate_shipping function.
	 */
	public function calculate_shipping($package = array()) {
		if(array_key_exists($package['destination']['postcode'], $this->codes_array)){
			$rate = array(
				'id' 		=> $this->id,
				'label' 	=> $this->title,
				'cost'      => intval($this->codes_array[$package['destination']['postcode']])
			);
			$this->add_rate( $rate );
		}
	}
	/**
	 * init_form_fields function.
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title'   => __( 'Enable', 'uk-postcodes-shipping' ),
				'type'    => 'checkbox',
				'label'   => '',
				'default' => 'no'
			),
			'title' => array(
				'title'       => __( 'Title', 'uk-postcodes-shipping' ),
				'type'        => 'text',
				//'description' => __( 'This controls the title which the user sees during checkout.', 'uk-postcodes-shipping' ),
				'desc_tip'    => true,
			),
			'codes' => array(
				'title'       => __( 'Put postcodes & price in JSON format', 'uk-postcodes-shipping' ),
				'type'        => 'textarea',
				'default'     => '',
				'description' => __('Read documentation for more information: <a href="http://docs.brasa.art.br">docs.brasa.art.br</a>')
			),
		);
	}
	/**
	 * Get postcodes for this method
	 * @return array
	 */
}
