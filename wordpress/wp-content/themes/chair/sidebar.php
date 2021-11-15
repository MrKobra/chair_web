<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Chair
 */
$boundary_price = get_boundary_price($args['query']);
$boundary_weight = get_boundary_weight($args['query']);
?>

<aside class="catalog-sidebar">
    <div class="catalog-sidebar-block catalog-sidebar-slider">
        <div class="catalog-sidebar-header">
            Цена, ₽
        </div>
        <div class="catalog-sidebar-body">
            <p>
                        <span>
                            <input type="number" name="min_price" value="<?php if(isset($_GET['min_price'])) { echo $_GET['min_price']; } else { echo $boundary_price[0]; } ?>">
                        </span>
                <span>
                            <input type="number" name="max_price" value="<?php if(isset($_GET['max_price'])) { echo $_GET['max_price']; } else { echo $boundary_price[1]; } ?>">
                        </span>
            </p>
            <div class="catalog-slider" data-max="<?php echo $boundary_price[1]; ?>" data-min="<?php echo $boundary_price[0]; ?>" id="price-slider"></div>
        </div>
    </div>
    <div class="catalog-sidebar-block catalog-sidebar-slider">
        <div class="catalog-sidebar-header">
            Мак. нагрузка (кг)
        </div>
        <div class="catalog-sidebar-body">
            <select name="weight_range" id="weight_range">
                <?php
                foreach($boundary_weight[2] as $key => $value) {
                    ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                }
                ?>
            </select>
            <p>
                <?php
                if(isset($_GET['weight'])) {
                    $cur = explode(',', $_GET['weight']);
                    $max = (int)$boundary_weight[2][$cur[0]];
                    $min = (int)$boundary_weight[2][$cur[0]];
                    foreach($cur as $item) {
                        if($max < (int)$boundary_weight[2][$item]) {
                            $max = (int)$boundary_weight[2][$item];
                        }
                        if($min > (int)$boundary_weight[2][$item]) {
                            $max = (int)$boundary_weight[2][$item];
                        }
                    }
                }
                ?>
                        <span>
                            <input type="number" data-id="<?php echo get_key($boundary_weight[2], $boundary_weight[0]); ?>" name="min_weight" value="<?php if(isset($_GET['weight'])) { echo $min; } else { echo $boundary_weight[0]; } ?>">
                        </span>
                <span>
                            <input type="number" data-id="<?php echo get_key($boundary_weight[2], $boundary_weight[1]); ?>" name="max_weight" value="<?php if(isset($_GET['max_weight'])) { echo $max; } else { echo $boundary_weight[1]; } ?>">
                        </span>
            </p>
            <div class="catalog-slider" data-max="<?php echo $boundary_weight[1]; ?>" data-min="<?php echo $boundary_weight[0]; ?>" id="weight-slider"></div>
        </div>
    </div>
    <?php
    if(get_field('filter_attribute', 'options')) {
        while(has_sub_field('filter_attribute', 'options')) {
            $slug = get_sub_field('slug');
            $args = [
                'taxonomy'      => 'pa_'.$slug,
                'orderby'       => 'id',
                'order'         => 'ASC',
                'hide_empty'    => false,
                'update_term_meta_cache' => true,
                'meta_query'    => '',
            ];

            $terms = get_terms( $args );
            if($terms):
                $i = 0; ?>
                <div class="catalog-sidebar-block catalog-sidebar-checkbox <?php if(isset($_GET[$slug])) { echo 'active'; } ?>">
                    <div class="catalog-sidebar-header">
                        <?php $label = get_taxonomy_labels(get_taxonomy('pa_'.$slug)); ?>
                        <span><?php echo $label->singular_name; ?></span>
                    </div>
                    <div class="catalog-sidebar-body" <?php if(isset($_GET[$slug])) { echo 'style="display: block"'; } ?>>
                        <?php foreach($terms as $term) :
                            $i++; ?>
                             <div class="catalog-sidebar-row">
                                <label for="<?php echo $slug.'_'.$i; ?>"><?php echo $term->name; ?></label>
                                <input <?php if(isset($_GET[$slug]) && $_GET[$slug] == $term->term_id) { echo 'checked="checked"'; } ?> type="checkbox" name="<?php echo $slug; ?>" value="<?php echo $term->term_id; ?>" id="<?php echo $slug.'_'.$i; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif;
        }
    }
    ?>
    <div class="catalog-sidebar-block catalog-sidebar-btn">
        <div class="catalog-sidebar-body">
            <a href="#" class="btn filter_btn">Показать</a>
            <a href="#" class="btn reset_btn">Очистить</a>
        </div>
    </div>
</aside>