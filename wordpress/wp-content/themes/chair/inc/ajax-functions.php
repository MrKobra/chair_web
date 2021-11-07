<?php
// Вывод списка дат
add_action('wp_ajax_delivery_data', 'delivery_date_list');
add_action('wp_ajax_nopriv_delivery_data', 'delivery_date_list');

function delivery_date_list(){
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );
    $count = 10;
    $result = array();
    $months = array( 1 => 'января' , 'февраля' , 'марта' , 'апреля' , 'мая' , 'июня' , 'июля' , 'августа' , 'сентября' , 'октября' , 'ноября' , 'декабря' );
    for ($i = 0; $i < $count; $i++) {
        $offset = 3 + $i;
        $date = (new DateTime('+'.$offset.' Day'));
        array_push($result, $date->format('d ').$months[$date->format('m')]);
    }
    echo json_encode($result);
    wp_die();
}

// Вывод времени
add_action('wp_ajax_delivery_time', 'delivery_time_list');
add_action('wp_ajax_nopriv_delivery_time', 'delivery_time_list');

function delivery_time_list(){
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );
    $result = array();
    if(get_field('delivery_interval', 'options')) {
        while(has_sub_field('delivery_interval', 'options')) {
            array_push($result, get_sub_field('time'));
        }
    }
    echo json_encode($result);
    wp_die();
}

// Установка цены за доставку
add_action('wp_ajax_set_delivery_cost', 'set_delivery_cost');
add_action('wp_ajax_nopriv_set_delivery_cost', 'set_delivery_cost');

function set_delivery_cost(){
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );
    WC()->session->set( 'delivery_radio', $_POST['delivery'] );
    wp_die();
}