<?php
// Форматирование цены товара
function format_price($num) {
    $price = number_format((float)$num, 0, '', ' ');
    $price = $price.' ₽';
    return $price;
}

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
add_action('woocommerce_single_product_summary', 'custom_item_description', 40);
function custom_item_description(){
    ?>
    <div class="description">
        <span>Описание:</span>
        <?php the_content(); ?>
    </div>
    <?php
}
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'custom_loop_item_thumbnail', 10);
function custom_loop_item_thumbnail() {
    ?>
    <div class="items-card-img">
        <?php echo woocommerce_get_product_thumbnail(); ?>
    </div>
    <?php
}
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'custom_loop_item_title', 10);
function custom_loop_item_title() {
    global $product; ?>
    <h3>
        <?php woocommerce_template_loop_product_link_open();
        if ($product->is_type('variation')) {
            $parent_id = $product->get_parent_id();
            echo get_the_title($parent_id) . ' - ' . $product->get_attribute('pa_cvet');
        } else {
            the_title();
        }
        woocommerce_template_loop_product_link_close(); ?>
    </h3>
    <?php
}
add_action('woocommerce_shop_loop_item_title', 'custom_loop_item_category', 15);
function custom_loop_item_category() {
    global $product;
    if($product->is_type('variation')) {
        $parent_id = $product->get_parent_id();
    } else {
        $parent_id = $product->get_id();
    }
    $cat = get_the_terms($parent_id, 'product_cat');
    if($cat): ?>
    <div class="items-card-cat">
        <?php echo $cat[0]->name; ?>
    </div>
    <?php
    endif;
}
remove_action('woocommerce_template_loop_rating', 'woocommerce_after_shop_loop_item_title', 5);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function include_parent_categories_item($joins, $wp_query) {
    if(isset($wp_query->query['include_parent_cat'])) {
        if ($wp_query->query['include_parent_cat']) {
            global $wpdb;
            $find = "{$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id";
            $joins = str_replace($find, $find . " OR {$wpdb->prefix}posts.post_parent = {$wpdb->prefix}term_relationships.object_id", $joins);
        }
    }

    return $joins;
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices' );
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'woocommerce_cart_calculate_fees', 'delivery_set_cost', 25 );
function delivery_set_cost($cart) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    $value = WC()->session->get( 'delivery_radio' );

    $total = 0;
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $total  += $_product->get_price();
    }

    if($value == 'delivery' && $total <= (int)get_field('delivery_delimiter', 'options')) {
        $cart->add_fee('Доставка', (int)get_field('delivery_cost', 'options'));
    } else {
        $cart->add_fee('Доставка', 0);
    }
}

function get_boundary_price($query_args) {
    $max = 0;
    $min = 0;
    add_filter( 'posts_join' , "include_parent_categories_item", 99, 2);
    $query = new WP_Query($query_args);
    remove_filter( 'posts_join' , "include_parent_categories_item", 99, 2);
    if($query->have_posts()) {
        $i = 0;
        while($query->have_posts()) {
            $i++;
            $query->the_post();
            global $product;
            if($i == 1) {
                $max = (int)$product->get_price();
                $min = (int)$product->get_price();
            } else {
                if($max < (int)$product->get_price()) {
                    $max = (int)$product->get_price();
                }
                if($min > (int)$product->get_price()) {
                    $min = (int)$product->get_price();
                }
            }
        }
        return [$min, $max];
    } else {
        return [0, 0];
    }
}

function get_boundary_weight($query_args) {
    $query = new WP_Query($query_args);
    $weight = [];
    $result = [];
    if($query->have_posts()) {
        $i = 0;
        while($query->have_posts()) {
            $i++;
            $query->the_post();
            global $product;
            $weight[$product->get_attributes()['pa_maksimalnaya-nagruzka']['options'][0]] = (int)$product->get_attribute('pa_maksimalnaya-nagruzka');
        }
        $min = min($weight);
        $max = max($weight);
        foreach ($weight as $key => $value) {
            if($value <= $max && $value >= $min) {
                $result[$key] = $value;
            }
        }
        return [min($weight), max($weight), $result];
    } else {
        return [0, 0, [0]];
    }
}

add_filter( 'wc_add_to_cart_message_html', 'add_to_cart_msg', 10, 3 );
function add_to_cart_msg( $message, $products, $show_qty ) {
    return 'Вы успешно отложили товар в <a href="'.wc_get_checkout_url().'">корзину</a>';
}

add_action('woocommerce_before_checkout_form', 'change_notice_wrapper', 20);
function change_notice_wrapper() {
    ?>
    <script>
        if($('.notice-wrapper').length != 0) {
            var elem = $('.woocommerce-notices-wrapper').not('.notice-wrapper .woocommerce-notices-wrapper');
            $('.notice-wrapper .woocommerce-notices-wrapper').html(elem.html());
            elem.remove();
        }
    </script>
    <?php
}

function get_html_add_to_cart() {
    global $product;
    $result = '';
    if ( $product ) {
        $defaults = array(
            'quantity'   => 1,
            'class'      => implode(
                ' ',
                array_filter(
                    array(
                        'button',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                    )
                )
            ),
            'attributes' => array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            ),
        );

        $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $defaults ), $product );

        if ( isset( $args['attributes']['aria-label'] ) ) {
            $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
        }
        $result .= ' <div class="items-card-hidden">';
    ?>

    <?php
    $tax_args = [
        'taxonomy'      => 'pa_razmer',
        'orderby'       => 'id',
        'order'         => 'ASC',
        'hide_empty'    => false,
        'update_term_meta_cache' => true,
        'meta_query'    => '',
    ];

    $terms = get_terms( $tax_args );
    $term_id = false;
    foreach( $terms as $term ){
        if($product->get_attribute('pa_razmer') == $term->name) {
            $term_id = $term->term_id;
        }
    }
    if($term_id):
        $result .= ' <div class="items-card-size">
            <p>Размеры</p>
            <div class="items-card-size-container">
                <div class="items-card-size-column">
                    <span>Ширина</span>
                    <p>'.get_field('width', 'pa_razmer_'.$term_id).'</p>
                </div>';
        $result .= '<div class="items-card-size-column">
                    <span>Глубина</span>
                    <p>'.get_field('length', 'pa_razmer_'.$term_id).'</p>
                </div>';
        $result .= '<div class="items-card-size-column">
                    <span>Высота</span>
                    <p>'.get_field('height', 'pa_razmer_'.$term_id).'</p>
                </div>';
        $result .= '</div>
            </div>';
    endif;
    $class = isset( $args['class'] ) ? $args['class'] : 'button';
    $quantity = isset( $args['quantity'] ) ? $args['quantity'] : 1;
    $attributes = isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '';
    $result .= '<div class="items-card-addToCart">
        <a href="%s" data-quantity="'.$quantity.'" class="btn '.$class.'" '.$attributes.'>Добавить в корзину</a>
            </div>';
        $result .= '</div>';
    }
    return $result;
}

add_action('woocommerce_before_shop_loop','set_session_query');
function set_session_query(){
    global $wp_query;
    WC()->session->set('session_query', $wp_query->query);
}