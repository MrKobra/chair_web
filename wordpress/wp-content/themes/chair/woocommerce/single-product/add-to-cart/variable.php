<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

    <form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
        <?php do_action( 'woocommerce_before_variations_form' ); ?>

        <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
            <p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
        <?php endif; ?>

        <?php
        /**
         * Hook: woocommerce_before_single_variation.
         */
        do_action( 'woocommerce_before_single_variation' );

        /**
         * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
         *
         * @since 2.4.0
         * @hooked woocommerce_single_variation - 10 Empty div for variation data.
         * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
         */
        ?>
        <div class="single-item-price">
        <?php
        do_action( 'woocommerce_single_variation' );
        ?>
        </div>
        <?php
        /**
         * Hook: woocommerce_after_single_variation.
         */
        do_action( 'woocommerce_after_single_variation' );
        ?>

        <div class="single-item-var">
            <?php
            do_action( 'woocommerce_before_add_to_cart_quantity' );

            woocommerce_quantity_input(
                array(
                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                )
            );

            do_action( 'woocommerce_after_add_to_cart_quantity' );
            ?>
            <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                <div class="variations <?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                    <select id="<?php echo $attribute_name; ?>" data-attribute_name="attribute_<?php echo $attribute_name; ?>" name="attribute_<?php echo $attribute_name; ?>">
                        <?php
                        $terms = wc_get_product_terms($product->get_id(), $attribute_name, array('fields' => 'all'));
                        $selected = $_GET['attribute_'.$attribute_name];
                        $i = 0;
                        foreach($terms as $term) {
                            $i++;
                            ?>
                            <option
                                <?php if($attribute_name == 'pa_cvet') { ?> data-color="<?php echo get_field('color', 'pa_cvet_'.$term->term_id); ?>" <?php } ?>
                                    class="attached enabled"
                                    value="<?php echo $term->slug; ?>" <?php if($selected) { if($selected == $term->slug) { echo ''; } } else { if($i == 1) { echo ''; } } ?>
                                    <?php if($attribute_name == 'pa_razmer') {
                                        echo 'data-width="'.get_field('width', 'pa_razmer_'.$term->term_id).'"';
                                        echo 'data-length="'.get_field('length', 'pa_razmer_'.$term->term_id).'"';
                                        echo 'data-height="'.get_field('height', 'pa_razmer_'.$term->term_id).'"';
                                    } ?>>
                                <? if($attribute_name != 'pa_cvet') { echo $term->name; } ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            <?php endforeach; ?>
        </div>

        <?php do_action( 'woocommerce_after_variations_form' ); ?>
    </form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
