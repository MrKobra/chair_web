<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
if (!(WC()->session->get('delivery_radio'))) {
    WC()->session->set( 'delivery_radio', 'pickup' );
}
?>
        <input style="display: none" id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />

<div class="woocommerce-shipping-fields">

    <h3>Доставка</h3>

    <div class="delivery-type_container">
        <?php
        $months = array( 1 => 'января' , 'февраля' , 'марта' , 'апреля' , 'мая' , 'июня' , 'июля' , 'августа' , 'сентября' , 'октября' , 'ноября' , 'декабря' );
        $date = (new DateTime('+3 Day'));
        $date_str = $date->format('d ').$months[$date->format('m')]; ?>
        <div class="delivery-type">
            <div class="delivery-type_checkbox">
                <label>
                    <input <?php if(WC()->session->get( 'delivery_radio' ) == 'pickup') { echo 'checked="checked"'; } ?> type="radio" value="pickup" name="ship_type">
                    <span>Самовывоз из магазина</span>
                </label>
                <div class="delivery-type_info">
                    <span>Забрать <?php echo $date_str; ?></span>
                    <span><strong>Бесплатно</strong></span>
                </div>
            </div>
        </div>
        <div class="delivery-type">
            <div class="delivery-type_checkbox">
                <label>
                    <input <?php if(WC()->session->get( 'delivery_radio' ) == 'delivery') { echo 'checked="checked"'; } ?> type="radio" value="delivery" name="ship_type">
                    <span>Доставка</span>
                </label>
                <div class="delivery-type_info">
                    <span>Забрать <?php echo $date_str; ?></span>
                    <span><strong>Бесплатно от <?php echo format_price((int)get_field('delivery_delimiter', 'options') + 1); ?></strong></span>
                    <span>до <?php echo format_price((int)get_field('delivery_delimiter', 'options')); ?> - <?php echo format_price(get_field('delivery_cost', 'options')); ?></span>
                </div>
            </div>
        </div>
    </div>



        <div class="shipping_address shipping-block" id="delivery">

            <?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

            <div class="woocommerce-shipping-fields__field-wrapper">
                <?php
                $fields = $checkout->get_checkout_fields( 'shipping' );

                foreach ( $fields as $key => $field ) {
                    woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                }
                ?>
            </div>

            <?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

            <div class="shipping-delivery_cost">
                <strong>Доставка - <span><?php if(WC()->cart->total > (int)get_field('delivery_delimiter', 'options')) { echo 'Бесплатно'; } else { echo format_price(get_field('delivery_cost', 'options')); } ?></span></strong>
            </div>

        </div>

        <div class="shipping_shop shipping-block" id="pickup">
            <div class="shipping_shop-wrapper">
                <?php if(get_field('shop_list', 'options')) {
                    $i = 0;
                    while(has_sub_field('shop_list', 'options')) {
                        $i++;
                        ?>
                        <div class="shipping_shop-card">
                            <label>
                                <input <?php if($i == 1) { echo 'checked="checked"'; } ?> type="radio" name="shipping_shop_title" value="<?php the_sub_field('shop_title'); ?>">
                                <span><?php the_sub_field('shop_title'); ?></span>
                            </label>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>

</div>
<div class="woocommerce-additional-fields">
    <?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

    <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

        <?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

            <h3><?php esc_html_e( 'Additional information', 'woocommerce' ); ?></h3>

        <?php endif; ?>

        <div class="woocommerce-additional-fields__field-wrapper">
            <?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

    <?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>
