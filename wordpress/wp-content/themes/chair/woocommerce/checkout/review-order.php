<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
if(WC()->cart->get_cart()):
?>
<div class="cart-items">
    <?php
    do_action( 'woocommerce_review_order_before_cart_contents' );

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            if($_product->is_type('variation')) {
                $parent_id = $_product->get_parent_id();
            } else {
                $parent_id = $_product->get_id();
            }
            ?>
        <div class="cart-item">
            <div class="cart-item-img">
                <?php
                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                echo $thumbnail;
                ?>
            </div>
            <div class="cart-item-info">
                <h3><a href="<?php echo get_permalink($_product->get_id()); ?>"><?php echo get_the_title($parent_id).' - '.$_product->get_attribute('pa_cvet') ?></a></h3>
            <div class="cart-item-property">
                <?php
                $args = [
                    'taxonomy'      => 'pa_cvet',
                    'orderby'       => 'id',
                    'order'         => 'ASC',
                    'hide_empty'    => false,
                    'update_term_meta_cache' => true,
                    'meta_query'    => '',
                ];

                $terms = get_terms( $args );
                $term_id = false;
                foreach( $terms as $term ){
                    if($_product->get_attribute('pa_cvet') == $term->name) {
                        $term_id = $term->term_id;
                    }
                }
                if($term_id): ?>
                <div class="color">
                    <p>
                        Цвет:
                        <span><?php echo $_product->get_attribute('pa_cvet'); ?></span>
                        <span class="color-square" style="background: <?php the_field('color', 'pa_cvet_'.$term_id); ?>;"></span>
                    </p>
                </div>
                <?php endif; ?>
                <div class="count">
                    <p>
                        Количество:
                        <span><?php echo $cart_item['quantity']; ?></span>
                    </p>
                </div>
                <?php
                $args = [
                    'taxonomy'      => 'pa_razmer',
                    'orderby'       => 'id',
                    'order'         => 'ASC',
                    'hide_empty'    => false,
                    'update_term_meta_cache' => true,
                    'meta_query'    => '',
                ];

                $terms = get_terms( $args );
                $term_id = false;
                foreach( $terms as $term ){
                    if($_product->get_attribute('pa_razmer') == $term->name) {
                        $term_id = $term->term_id;
                    }
                }
                if($term_id): ?>
                <div class="size">
                    <p>
                        Размер(Ш×Д×В):
                        <span><?php echo get_field('width', 'pa_razmer_'.$term_id).' СМ x '.get_field('length', 'pa_razmer_'.$term_id).' СМ x'.get_field('height', 'pa_razmer_'.$term_id) ?></span>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
            <div class="cart-item-price <?php if($_product->is_on_sale()) { echo 'discount'; } ?>">
                <?php if($_product->is_on_sale()){ ?>
                <div class="old-price">
                    <?php
                    $discount = round(((int)$_product->get_regular_price() - (int)$_product->get_price()) / (int)$_product->get_regular_price() * 100, 0);
                    ?>
                    <span class="percent"><?php echo '-'.$discount.'%'; ?></span>
                    <strike><?php echo format_price($_product->get_regular_price()); ?></strike>
                </div>
                <div class="new-price">
                    <?php echo format_price($_product->get_price()); ?>
                </div>
                <?php } else {
                    echo format_price($_product->get_price());
                } ?>
            </div>
            <div class="cart-item-delete">
                <?php
                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><img src="'.get_template_directory_uri().'/assets/img/delete-icon.png" alt=""></a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        esc_html__( 'Remove this item', 'woocommerce' ),
                        esc_attr( $_product->get_id() ),
                        esc_attr( $_product->get_sku() )
                    ),
                    $cart_item_key
                );
                ?>
            </div>
        </div>
            <?php
        }
    }

    do_action( 'woocommerce_review_order_after_cart_contents' );
    ?>
</div>
<?php
endif;
