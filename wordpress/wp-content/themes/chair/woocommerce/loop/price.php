<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<div class="items-card-price">
    <?php if($product->is_on_sale() && $product->is_type('variation') || $product->is_type('simple')) { ?>
        <p><?php echo format_price($product->get_price())?> <strike><?php echo format_price($product->get_regular_price()) ?></strike></p>
    <?php } else { ?>
        <p><?php echo format_price($product->get_price()) ?></p>
    <?php }
    ?>
</div>
