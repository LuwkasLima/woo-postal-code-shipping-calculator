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
		if(!$this->codes_array || empty($this->codes_array) || !is_array($this->codes_array))
			return;

		if(array_key_exists($package['destination']['postcode'], $this->codes_array) && $package['destination']['country'] == 'GB' ){
			$rate = array(
				'id' 		=> $this->id,
				'label' 	=> $this->title,
				'cost'      => intval($this->codes_array[$package['destination']['postcode']])
			);
			$this->add_rate( $rate );
			return true;
		}
		$multiple = explode(' ', $package['destination']['postcode']);
		$multiple = $multiple[0] . ' *';
		if(array_key_exists($multiple, $this->codes_array) && $package['destination']['country'] == 'GB'){
			$rate = array(
				'id' 		=> $this->id,
				'label' 	=> $this->title,
				'cost'      => intval($this->codes_array[$multiple])
			);
			$this->add_rate( $rate );
			return true;
		}
		$multiple = explode(' ', $package['destination']['postcode']);
		$multiple = $multiple[0] . ' *';
		if(array_key_exists($multiple, $this->codes_array) && $package['destination']['country'] == 'GB'){
			$rate = array(
				'id' 		=> $this->id,
				'label' 	=> $this->title,
				'cost'      => intval($this->codes_array[$multiple])
			);
			$this->add_rate( $rate );
			return true;
		}
		$postcode = $package['destination']['postcode'];
		for ($i = 1; $i < strlen( $postcode ) ; $i++) {
			$postcode = substr_replace( $postcode, '', -1 );
			$multiple = $postcode . '*';
			if(array_key_exists($multiple, $this->codes_array) && $package['destination']['country'] == 'GB'){
				$rate = array(
					'id' 		=> $this->id,
					'label' 	=> $this->title,
					'cost'      => intval($this->codes_array[$multiple])
				);
				$this->add_rate( $rate );
				return true;
			}
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

	public function is_available( $package ) {
        if ( 'no' == $this->enabled ) {
            return false;
        }

       if(array_key_exists($package['destination']['postcode'], $this->codes_array) && $package['destination']['country'] == 'GB' ){
			return true;
		}
		$multiple = explode(' ', $package['destination']['postcode']);
		$multiple = $multiple[0] . ' *';
		if(array_key_exists($multiple, $this->codes_array) && $package['destination']['country'] == 'GB'){
			return true;
		}
		$postcode = $package['destination']['postcode'];
		for ($i = 1; $i < strlen( $postcode ); $i++) {
			$postcode = substr_replace( $postcode, '', -1 );
			$multiple = $postcode . '*';
			if(array_key_exists($multiple, $this->codes_array) && $package['destination']['country'] == 'GB'){
				$rate = array(
					'id' 		=> $this->id,
					'label' 	=> $this->title,
					'cost'      => intval($this->codes_array[$multiple])
				);
				$this->add_rate( $rate );
				return true;
			}
		}
        return apply_filters( 'woocommerce_shipping_' . $this->id . '_is_available', true, $package );
    }
}
