<?php
/**
 * Frontend class for the plugin.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

namespace AkshitSethi\Plugins\CustomizeWoo;

use AkshitSethi\Plugins\CustomizeWoo\Config;

/**
 * Frontend for the plugin.
 */
class Front {

	/**
	 * WooCommerce filters.
	 *
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
	 * @return void
	 */
	public function init() : void {
		$this->filters = get_option( Config::DB_OPTION );

		if ( $this->filters ) {
			foreach ( $this->filters as $filter => $value ) {
				if ( false !== strpos( $filter, 'add_to_cart_text' ) ) {
					if ( 'single_add_to_cart_text' === $filter ) {
						add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'single_add_to_cart_text' ), 50 );
					}

					add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'add_to_cart_text' ), 50, 2 );
				} elseif ( 'loop_sale_flash_text' === $filter || 'single_sale_flash_text' === $filter ) {
					add_filter( 'woocommerce_sale_flash', array( $this, 'sale_flash' ), 50, 3 );
				} elseif ( 'single_out_of_stock_text' === $filter ) {
					add_filter( 'woocommerce_get_availability_text', array( $this, 'single_out_of_stock_text' ), 50, 2 );
				} elseif ( 'single_backorder_text' === $filter ) {
					add_filter( 'woocommerce_get_availability_text', array( $this, 'single_backorder_text' ), 50, 2 );
				} elseif ( 'show_terms' === $filter ) {
					if ( ! $value ) {
						add_filter( 'show_terms', '__return_false' );
					}
				} elseif ( 'order_notes_field' === $filter ) {
					if ( ! $value ) {
						add_filter( 'order_notes_field', '__return_false' );
					}
				} else {
					add_filter( $filter, array( $this, 'render_filter' ), 50 );
				}
			}
		}
	}

	/**
	 * Apply the shop loop add to cart button text customization.
	 *
	 * @param string      $text     Add-to-cart text.
	 * @param \WC_Product $product  WC_Product instance.
	 *
	 * @return string
	 */
	public function add_to_cart_text( string $text, \WC_Product $product ) : string {
		// Out of stock.
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
	 */
	public function single_add_to_cart_text() {
		if ( $this->if_exists( $this->filters['single_add_to_cart_text'] ) ) {
			return $this->filters['single_add_to_cart_text'];
		}
	}

	/**
	 * Apply the product page out of stock text customization.
	 *
	 * @param string      $text    out of stock text.
	 * @param \WC_Product $product product object.
	 *
	 * @return string
	 */
	public function single_out_of_stock_text( string $text, \WC_Product $product ) : string {
		if ( isset( $this->filters['single_out_of_stock_text'] ) && ! $product->is_in_stock() ) {
			return $this->filters['single_out_of_stock_text'];
		}

		return $text;
	}

	/**
	 * Apply the product page backorder text customization.
	 *
	 * @param string      $text      Backorder text.
	 * @param \WC_Product $product   WC_Product instance.
	 *
	 * @return string modified backorder text
	 */
	public function single_backorder_text( $text, $product ) {
		if ( isset( $this->filters['single_backorder_text'] ) && $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
			return $this->filters['single_backorder_text'];
		}

		return $text;
	}

	/**
	 * Apply the shop loop sale flash text customization.
	 *
	 * @param string      $html       Add to cart flash text.
	 * @param \WP_Post    $post       WP_Post instance.
	 * @param \WC_Product $product    WP_Product instance.
	 *
	 * @return string
	 */
	public function sale_flash( $html, $post, $product ) {
		$text = '';

		if ( is_product() && isset( $this->filters['single_sale_flash_text'] ) ) {
			$text = $this->filters['single_sale_flash_text'];
		} elseif ( ! is_product() && isset( $this->filters['loop_sale_flash_text'] ) ) {
			$text = $this->filters['loop_sale_flash_text'];
		}

		// Only get sales percentages when we should be replacing text.
		// Check "false" specifically since the position could be 0.
		if ( false !== strpos( $text, '{percent}' ) ) {
			$percent = $this->get_sale_percentage( $product );
			$text    = str_replace( '{percent}', "{$percent}%", $text );
		}

		return ! empty( $text ) ? '<span class="onsale">' . $text . '</span>' : $html;
	}

	/**
	 * Add hook to selected filters.
	 *
	 * @return void|string $filter Value to use for selected hook
	 */
	public function render_filter() {
		$current_filter = current_filter();

		if ( $this->if_exists( $this->filters[ $current_filter ] ) ) {
			if ( 'create_account_default_checked' === $current_filter ) {
				return 'checked' === $this->filters[ $current_filter ];
			}

			return $this->filters[ $current_filter ];
		}
	}

	/**
	 * Checks if the option is set and is not empty.
	 *
	 * @param string|integer|boolean $option Option to check and verify.
	 *
	 * @return boolean
	 */
	private function if_exists( $option ) : bool {
		if ( ! isset( $option ) ) {
			return false;
		}

		if ( empty( $option ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Helper to get the percent discount for a product on sale.
	 *
	 * @param \WC_Product $product WC_Product instance.
	 *
	 * @return string
	 */
	private function get_sale_percentage( \WC_Product $product ) : string {
		$child_sale_percents = array();
		$percentage          = '0';

		if ( $product->is_type( 'grouped' ) || $product->is_type( 'variable' ) ) {
			foreach ( $product->get_children() as $child_id ) {
				$child = wc_get_product( $child_id );

				if ( $child->is_on_sale() ) {
					$regular_price         = $child->get_regular_price();
					$sale_price            = $child->get_sale_price();
					$child_sale_percents[] = $this->calculate_sale_percentage( $regular_price, $sale_price );
				}
			}

			// Filter out duplicate values.
			$child_sale_percents = array_unique( $child_sale_percents );

			// Only add "up to" if there's > 1 percentage possible.
			if ( ! empty( $child_sale_percents ) ) {
				/* translators: Placeholder: %s - sale percentage */
				$percentage = count( $child_sale_percents ) > 1 ? sprintf( esc_html__( 'up to %s', 'customize-woo' ), max( $child_sale_percents ) ) : current( $child_sale_percents );
			}
		} else {
			$percentage = $this->calculate_sale_percentage( $product->get_regular_price(), $product->get_sale_price() );
		}

		return $percentage;
	}

	/**
	 * Calculates a sales percentage difference given regular and sale prices for a product.
	 *
	 * @param string $regular_price   Product regular price.
	 * @param string $sale_price      Product sale price.
	 *
	 * @return float
	 */
	private function calculate_sale_percentage( string $regular_price, string $sale_price ) : float {
		$percent = 0;
		$regular = (float) $regular_price;
		$sale    = (float) $sale_price;

		// In case of free products so we don't divide by 0.
		if ( $regular ) {
			$percent = round( ( ( $regular - $sale ) / $regular ) * 100 );
		}

		return $percent;
	}

}
