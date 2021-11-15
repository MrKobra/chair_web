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

add_action('wp_ajax_show_more_post', 'show_more_post');
add_action('wp_ajax_nopriv_show_more_post', 'show_more_post');

// Вывод дополнительных постов
function show_more_post(){
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );

    $result = '';
    $query_args = WC()->session->get('session_query');

    $query_args['offset'] = $query_args['offset'] + $_POST['post_count'];

    $query = new WP_Query($query_args);
    if($query->have_posts()) {
        while($query->have_posts()) {
            $query->the_post();
            global $product;
            if($product->is_type('variation')) {
                $parent_id = $product->get_parent_id();
            } else {
                $parent_id = $product->get_id();
            }
            $status = get_field('item_status', $parent_id);
            if($status['value'] != 'none') {
                $result .= '<div class="items-card '.$status['value'].'">';
                $result .= '<div class="items-card-info"><span>'.$status['label'].'</span></div>';
            } else {
                $result .= '<div class="items-card">';
            }
            $result .= '<div class="items-card-container">
                            <div class="items-card-img">';
            $result .= get_the_post_thumbnail();
            $result .= '</div>';
            $result .= '<h3><a href="'.get_permalink().'">'.get_the_title($parent_id).' - '.$product->get_attribute('pa_cvet').'</a></h3>';
            $cat = get_the_terms($parent_id, 'product_cat');
            if($cat):
                $result .= '<div class="items-card-cat">
                                '.$cat[0]->name.'
                           </div>';
            endif;
            $result .= '<div class="items-card-price">';
            if($product->is_on_sale()) {
                $args = array(
                    'post_type'     => 'product_variation',
                    'post_status'   => array( 'private', 'publish' ),
                    'numberposts'   => -1,
                    'orderby'       => 'menu_order',
                    'order'         => 'ASC',
                    'post_parent'   => get_the_ID()
                );
                $variations = get_posts( $args );
                if($variations) {
                    foreach($variations as $variation) {
                        $product_variation = new WC_Product_Variation( $variation->ID );
                        if($product_variation->is_on_sale()) {
                            $result .= '<p>'.format_price($product_variation->get_price()).' <strike>'.format_price($product_variation->get_regular_price()).'</strike></p>';
                            break;
                        }
                    }
                } else {
                    $result .= '<p>'.format_price($product->get_price()).'<strike>'.format_price($product->get_regular_price()).'</strike></p>';
                }
            } else {
                $result .= '<p>'.format_price($product->get_price()).'</p>';
            }
            $result .= '</div>';
            $result .= get_html_add_to_cart();
            $result .= '</div></div>';
        }
    }

    WC()->session->set('session_query', $query_args);
    echo json_encode($result);
    wp_die();
}
