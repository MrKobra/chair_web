<?php
global $product;
if($product->is_type('variation')) {
    $parent_id = $product->get_parent_id();
} else {
    $parent_id = $product->get_id();
}
$status = get_field('item_status', $parent_id);
?>
<div class="items-card <?php if($status['value'] != 'none') { echo $status['value']; } ?>">
    <?php if($status['value'] != 'none'): ?>
    <div class="items-card-info">
        <span><?php echo $status['label'] ?></span>
    </div>
    <?php endif ?>
    <div class="items-card-container">
        <div class="items-card-img">
            <?php the_post_thumbnail(); ?>
        </div>
        <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title($parent_id).' - '.$product->get_attribute('pa_cvet') ?></a></h3>
        <?php $cat = get_the_terms($parent_id, 'product_cat');
        if($cat): ?>
        <div class="items-card-cat">
            <?php echo $cat[0]->name; ?>
        </div>
        <?php endif ?>
        <div class="items-card-price">
            <?php if($product->is_on_sale() && $product->is_type('variation') || $product->is_type('simple')) { ?>
                <p><?php echo format_price($product->get_price())?> <strike><?php echo format_price($product->get_regular_price()) ?></strike></p>
            <?php } else { ?>
                <p><?php echo format_price($product->get_price()) ?></p>
            <?php }
            ?>
        </div>
        <?php woocommerce_template_loop_add_to_cart() ?>
    </div>
</div>