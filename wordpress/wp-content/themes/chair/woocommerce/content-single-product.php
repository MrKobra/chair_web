<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
?>
<div class="container">
<?php
do_action( 'woocommerce_before_single_product' );
?>
</div>
<?php

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="container">
    <div class="single-item-container">

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

        <div class="single-item-info">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>
        </div>
    </div>
    <?php $attributes = $product->get_attributes();
    if($attributes): ?>
    <div class="single-item-property">
        <h3>Характеристики</h3>
        <ul>
            <?php
            foreach($attributes as $attribute) {
                if($attribute['name'] != 'pa_cvet') {
                    $value = wc_get_product_terms($product->get_id(), $attribute['name'], array('fields' => 'all'));
                    if($attribute['name'] == 'pa_razmer') {
                        if($product->is_type('variation')) {
                        ?>
                        <li class="width"><span>Ширина</span> </li>
                        <li class="length"><span>Глубина</span> </li>
                        <li class="height"><span>Высота</span> </li>
                        <?php
                        } else {
                            ?>
                            <li class="width"><span>Ширина</span> <?php the_field('width', 'pa_razmer_'.$value[0]->term_id); ?></li>
                            <li class="length"><span>Глубина</span> <?php the_field('length', 'pa_razmer_'.$value[0]->term_id); ?></li>
                            <li class="height"><span>Высота</span> <?php the_field('height', 'pa_razmer_'.$value[0]->term_id); ?></li>
                            <?php
                        }
                    } else {
                    ?>
                    <li><span><?php echo wc_attribute_label($attribute['name']); ?></span> <?php echo $value[0]->name; ?></li>
                    <?php
                    }
                }
            }
            ?>
        </ul>
    </div>
    <?php endif; ?>
</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );

    get_template_part('template-parts/catalog', 'items', ['heading' => 'Рекомендованные товары', 'posts_per_page' => 8, 'orderby' => 'rand', 'cat' => $product->get_category_ids()]);

    get_template_part('template-parts/our', 'showroom');

    get_template_part('template-parts/info', 'block');
    ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
