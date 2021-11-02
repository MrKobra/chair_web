<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;
?>
<div class="items-card-hidden">
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
        if($product->get_attribute('pa_razmer') == $term->name) {
            $term_id = $term->term_id;
        }
    }
    if($term_id):
        ?>
        <div class="items-card-size">
            <p>Размеры</p>
            <div class="items-card-size-container">
                <div class="items-card-size-column">
                    <span>Ширина</span>
                    <p><?php echo get_field('width', 'pa_razmer_'.$term_id); ?></p>
                </div>
                <div class="items-card-size-column">
                    <span>Глубина</span>
                    <p><?php echo get_field('length', 'pa_razmer_'.$term_id); ?></p>
                </div>
                <div class="items-card-size-column">
                    <span>Высота</span>
                    <p><?php echo get_field('height', 'pa_razmer_'.$term_id); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="items-card-addToCart">
        <?php echo apply_filters(
            'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
            sprintf(
                '<a href="%s" data-quantity="%s" class="btn %s" %s>%s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
                isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
                esc_html('Добавить в корзину')
            ),
            $product,
            $args
        ); ?>
    </div>
</div>


