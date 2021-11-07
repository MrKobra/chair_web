<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
woocommerce_breadcrumb();
?>

<div class="cart">
    <div class="container">
        <div class="cart-container">
            <div class="heading">
                <h2>Ваша корзина</h2>
            </div>
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <?php do_action( 'woocommerce_checkout_order_review' ); ?>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

                <?php if ( $checkout->get_checkout_fields() ) : ?>

                    <div class="cart-payment">
                        <div class="heading">
                            <h2>Оформление заказа</h2>
                        </div>
                        <div class="cart-payment-container">

                            <div class="cart-payment-data">

                            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>

                            <?php woocommerce_checkout_payment(); ?>

                            <?php do_action( 'woocommerce_checkout_billing' ); ?>

                            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                            </div>
                            <?php
                            $subtotal = 0;
                            $total = 0;
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $subtotal += $_product->get_regular_price();
                            $total  += $_product->get_price();
                            }
                            ?>

                            <div class="cart-payment-info">
                                <div class="cart-payment-info-container">
                                    <div class="total">
                                        <span>Итого</span>
                                        <span><?php echo format_price(WC()->cart->total); ?></span>
                                    </div>
                                    <div class="cart-payment-info-block">

                                        <span>Товаров, <?php echo WC()->cart->get_cart_contents_count(); ?> шт</span>
                                        <span><?php echo format_price($subtotal); ?></span>
                                    </div>
                                    <?php if($subtotal - $total > 0) : ?>
                                        <div class="cart-payment-info-block">
                                            <span>Скидка</span>
                                            <span class="discount-text"><?php echo format_price($subtotal - $total); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(WC()->session->get( 'delivery_radio' ) == 'delivery'): ?>
                                    <div class="cart-payment-info-block cart-payment-info-delivery_type">
                                        <span>Доставка</span>
                                        <span>
                                            <?php if($total <= (int)get_field('delivery_delimiter', 'options')) {
                                                echo format_price(get_field('delivery_cost', 'options'));
                                            } else {
                                                echo 'Бесплатно';
                                            }?>
                                        </span>
                                    </div>
                                    <div class="cart-payment-info-delivery">
                                        <p>Доставка</p>
                                        <span class="date"></span>
                                        <span class="time"></span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="cart-payment-btn">
                                        <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

                                        <a href="#" class="btn fake_btn">Оформить заказ</a>

                                        <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="order_btn button btn alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( 'Оформить заказ' ) . '" data-value="' . esc_attr( 'Оформить заказ' ) . '">' . esc_html( 'Оформить заказ' ) . '</button>' ); // @codingStandardsIgnoreLine ?>

                                        <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

                                        <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

            </form>

            <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
        </div>
    </div>
</div>
