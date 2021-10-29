<?php
// Форматирование цены товара
function format_price($num) {
    $price = number_format($num, 0, '', ' ');
    $price = $price.' ₽';
    return $price;
}