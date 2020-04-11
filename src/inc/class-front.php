<?php
/**
 * Frontend class for the plugin.
 *
 * @package AkshitSethi\Plugins\WooCustomizer
 */

namespace AkshitSethi\Plugins\WooCustomizer;

use AkshitSethi\Plugins\WooCustomizer\Config;

/**
 * Frontend for the plugin.
 *
 * @package    AkshitSethi\Plugins\WooCustomizer
 * @since      1.0.0
 */
class Front {

	/**
	 * @var array
	 */
	public $filters;


	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_action( 'woocommerce_init', array( $this, 'init' ) );
	}


	/**
	 * Initialize the frontend for the plugin.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		// Get options
		$this->filters = get_option( Config::DB_OPTION );

		if ( $this->filters ) {
			foreach ( $this->filters as $filter => $value ) {
				// Add to cart text
				if ( false !== strpos( $filter, 'add_to_cart_text' ) ) {
					if ( 'single_add_to_cart_text' === $filter ) {
						add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'single_add_to_cart_text' ), 50 );
					}

					add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'add_to_cart_text' ), 50, 2 );
				} elseif ( 'loop_sale_flash_text' === $filter || 'single_sale_flash_text' === $filter ) {
					add_filter( 'woocommerce_sale_flash', array( $this, 'woocommerce_sale_flash' ), 50, 3 );
				} elseif ( 'single_out_of_stock_text' === $filter ) {
					add_filter( 'woocommerce_get_availability_text', array( $this, 'single_out_of_stock_text' ), 50, 2 );
				} elseif ( 'single_backorder_text' === $filter ) {
					add_filter( 'woocommerce_get_availability_text', array( $this, 'single_backorder_text' ), 50, 2 );
				} else {
					add_filter( $filter, array( $this, 'render_filter' ), 50 );
				}
			}
		}
	}


	/**
	 * Apply the shop loop add to cart button text customization.
	 *
	 * @param string      $text add to cart text
	 * @param \WC_Product $product product object
	 * @return string modified add to cart text
	 * @since 1.0.0
	 */
	public function add_to_cart_text( $text, $product ) {
		// Out of stock
		if ( $this->if_exists( $this->filters['out_of_stock_add_to_cart_text'] ) && ! $product->is_in_stock() ) {
			return $this->filters['out_of_stock_add_to_cart_text'];
		}

		if ( $this->if_exists( $this->filters['add_to_cart_text'] ) && $product->is_type( 'simple' ) ) {
			return $this->filters['add_to_cart_text'];
		} elseif ( $this->if_exists( $this->filters['variable_add_to_cart_text'] ) && $product->is_type( 'variable' ) ) {
			return $this->filters['variable_add_to_cart_text'];
		} elseif ( $this->if_exists( $this->filters['grouped_add_to_cart_text'] ) && $product->is_type( 'grouped' ) ) {
			return $this->filters['grouped_add_to_cart_text'];
		} elseif ( $this->if_exists( $this->filters['external_add_to_cart_text'] ) && $product->is_type( 'external' ) ) {
			return $this->filters['external_add_to_cart_text'];
		}

		return $text;
	}


	/**
	 * Apply the single add to cart button text customization.
	 *
	 * @since 1.0.0
	 */
	public function single_add_to_cart_text() {
		return $this->filters['single_add_to_cart_text'];
	}


	/**
	 * Apply the product page out of stock text customization
	 *
	 * @param string      $text out of stock text
	 * @param \WC_Product $product product object
	 * @return string modified out of stock text
	 * @since 1.0.0
	 */
	public function single_out_of_stock_text( $text, $product ) {
		if ( isset( $this->filters['single_out_of_stock_text'] ) && ! $product->is_in_stock() ) {
			return $this->filters['single_out_of_stock_text'];
		}

		return $text;
	}


	/**
	 * Apply the product page backorder text customization
	 *
	 * @param string      $text backorder text
	 * @param \WC_Product $product product object
	 * @return string modified backorder text
	 * @since 1.0.0
	 */
	public function single_backorder_text( $text, $product ) {
		if ( isset( $this->filters['single_backorder_text'] ) && $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
			return $this->filters['single_backorder_text'];
		}

		return $text;
	}


	/**
	 * Add hook to selected filters.
	 *
	 * @return void|string $filter Value to use for selected hook
	 * @since 1.0.0
	 */
	public function render_filter() {
		$current_filter = current_filter();

		if ( $this - if_exists( $this->filters[ $current_filter ] ) ) {
			return $this->filters[ $current_filter ];
		}
	}


	/**
	 * Checks if the option is set and is not empty.
	 *
	 * @param string|integer|boolean $option Option to check and verify
	 * @since 1.0.0
	 */
	private function if_exists( $option ) {
		if ( isset( $option ) ) {
			if ( ! empty( $option ) ) {
				return true;
			}
		}

		return false;
	}

}
