<?php
// Форматирование цены товара
function format_price($num) {
    $price = number_format((float)$num, 0, '', ' ');
    $price = $price.' ₽';
    return $price;
}
