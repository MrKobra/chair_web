<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);

$parent_id = $product->get_parent_id();
$status = get_field('item_status', $parent_id);
?>

<div class="single-item-img">
    <div class="single-item-slider-big">
        <?php if($post_thumbnail_id):
            $src = wp_get_attachment_image_src($post_thumbnail_id, 'full'); ?>
            <div class="single-item-slide <?php echo $status['value']; ?>">
                <div class="single-item-slide-container" style="background: url(<?php echo $src[0]; ?>) no-repeat center center">
                    <div class="single-item-slide-info">
                        <span><?php echo $status['label']; ?></span>
                    </div>
                    <img src="<?php echo $src[0]; ?>" alt="">
                </div>
            </div>
        <?php endif;
        $attachment_ids = $product->get_gallery_image_ids();
        foreach($attachment_ids as $attachment_id) {
            $src = wp_get_attachment_image_src($attachment_id, 'full');
            ?>
            <div class="single-item-slide <?php echo $status['value']; ?>">
                <div class="single-item-slide-container" style="background: url(<?php echo $src[0]; ?>) no-repeat center center">
                    <div class="single-item-slide-info">
                        <span><?php echo $status['label']; ?></span>
                    </div>
                    <img src="<?php echo $src[0]; ?>" alt="">
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="single-item-slider-small">
        <?php if($post_thumbnail_id):
        $src = wp_get_attachment_image_src($post_thumbnail_id, 'full'); ?>
            <div class="single-item-slide">
                <div class="single-item-slide-container" style="background: url(<?php echo $src[0]; ?>) no-repeat center center">
                </div>
            </div>
        <?php endif;
        $attachment_ids = $product->get_gallery_image_ids();
        foreach($attachment_ids as $attachment_id) {
            $src = wp_get_attachment_image_src($attachment_id, 'full'); ?>
            <div class="single-item-slide">
                <div class="single-item-slide-container" style="background: url(<?php echo $src[0]; ?>) no-repeat center center">
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
