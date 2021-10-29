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