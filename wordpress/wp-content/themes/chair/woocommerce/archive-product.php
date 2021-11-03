<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<div class="catalog">
    <div class="container">
        <div class="catalog-container">
<?php
$offset = 0;
$post_count = 12;
if(isset($_GET['count'])) {
    $post_count = $_GET['count'];
}
if(isset($_GET['page'])) {
    $offset = $_GET['page'] * $post_count - $post_count;
}
$query_args = array(
    'post_type' => array('product', 'product_variation'),
    'post_status' => 'publish',
    'posts_per_page' => $post_count,
    'offset' => $offset,
    'tax_query' => array()
);

add_filter( 'posts_join' , "include_parent_categories_item", 99, 2);
$query = new WP_Query($query_args);
remove_filter( 'posts_join' , "include_parent_categories_item", 99, 2);
if ($query->have_posts()) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

    woocommerce_product_loop_start();
	while($query->have_posts()) {
	    $query->the_post();
	    get_template_part('template-parts/catalog', 'item-card');
    }

    woocommerce_product_loop_end();

	?>
    <div class="catalog-page-nav">
        <?php get_template_part('template-parts/post', 'count'); ?>
        <?php get_template_part('template-parts/post', 'nav', ['count' => $post_count, 'max_page' => $query->found_posts]); ?>
    </div>
    <?php

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

?>
        </div>
        <?php
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

?>
    </div>
</div>
<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
