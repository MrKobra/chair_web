<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="back-link">
    <div class="container">
        <a href="<?php echo home_url(); ?>">На главную</a>
    </div>
</div>

<div class="woocommerce-order">

	<?php

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>
        <div class="container">
            <div class="woocommerce-order_container">
                <?php
                if ( $order ) :

                    if ( $order->has_status( 'failed' ) ) : ?>

                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                            <a class="btn" href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
                            <?php if ( is_user_logged_in() ) : ?>
                                <a class="btn" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
                            <?php endif; ?>
                        </p>

                    <?php else : ?>

                        <div class="woocommerce-order_success">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/success.png" alt="">
                        </div>
                        <h2>Спасибо! Ваш заказ отправлен</h2>
                        <p>В ближайшее время наш менеджер свяжется с вами для уточнения заказа.
                            Вся информация о заказе № <?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> была отправлена на указанный email: <?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <?php $link = get_field('shop_page', 'options'); ?>
                        <a class="btn" href="<?php echo $link['url']; ?>">Продолжить покупки</a>

                    <?php endif; ?>

                    <?php else : ?>

                        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

                <?php endif; ?>
            </div>
        </div>
</div>
