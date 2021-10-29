<div class="items popular-items">
    <div class="container">
        <?php if($args['heading']): ?>
        <div class="heading">
            <h2><?php echo $args['heading'] ?></h2>
            <?php if(is_front_page()): ?>
            <div class="more-link">
                <a href="<?php echo get_page_link(get_field('catalog_page','options')) ?>">Открыть весь каталог</a>
            </div>
            <?php endif ?>
        </div>
        <?php endif ?>

        <?php
        $query_args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $args['posts_per_page'],
        );
        if($args['kind'] == 'popular') {
            $query_args['meta_key'] = 'total_sales';
            $query_args['orderby'] = 'meta_value_num';
        }
        $query = new WP_Query($query_args);
        if($query->have_posts()):
        ?>
        <div class="items-container">
            <?php while($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/catalog-item', 'card');
            } ?>
        </div>
        <?php endif;
        wp_reset_postdata(); ?>
    </div>
</div>