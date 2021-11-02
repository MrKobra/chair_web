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