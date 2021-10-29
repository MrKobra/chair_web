<?php
global $product;
$parent_id = $product->get_parent_id();
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
        <?php $cat = get_the_terms(get_the_ID(), 'product_cat');
        if($cat): ?>
        <div class="items-card-cat">
            <?php echo $cat[0]->name; ?>
        </div>
        <?php endif ?>
        <div class="items-card-price">
            <?php if($product->is_on_sale()) { ?>
            <p><?php echo format_price($product->get_price())?> <strike><?php echo format_price($product->get_regular_price()) ?></strike></p>
            <?php } else { ?>
                <p><?php echo format_price($product->get_price()) ?></p>
            <?php } ?>
        </div>
        <div class="items-card-hidden">
            <?php
            $args = [
                'taxonomy'      => 'pa_razmer',
                'orderby'       => 'id',
                'order'         => 'ASC',
                'hide_empty'    => false,
                'update_term_meta_cache' => true,
                'meta_query'    => '',
            ];

            $terms = get_terms( $args );
            $term_id = false;
            foreach( $terms as $term ){
                if($product->get_attribute('pa_razmer') == $term->name) {
                    $term_id = $term->term_id;
                }
            }
            if($term_id):
            ?>
            <div class="items-card-size">
                <p>Размеры</p>
                <div class="items-card-size-container">
                    <div class="items-card-size-column">
                        <span>Ширина</span>
                        <p><?php echo get_field('width', 'pa_razmer_'.$term_id); ?></p>
                    </div>
                    <div class="items-card-size-column">
                        <span>Глубина</span>
                        <p><?php echo get_field('length', 'pa_razmer_'.$term_id); ?></p>
                    </div>
                    <div class="items-card-size-column">
                        <span>Высота</span>
                        <p><?php echo get_field('height', 'pa_razmer_'.$term_id); ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="items-card-addToCart">
                <?php woocommerce_template_loop_add_to_cart() ?>
            </div>
        </div>
    </div>
</div>