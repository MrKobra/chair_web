<?php
// Template Name: Страница Woocommerce
get_header();

    if(have_posts()) {
        the_post();
    }

get_footer();
