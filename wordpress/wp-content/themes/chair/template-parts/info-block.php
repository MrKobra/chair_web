<?php
$taxonomy = '';
if(isset($args['taxonomy'])) {
    $taxonomy = $args['taxonomy'].'_'.$args['term_id'];
}
if(get_field('info_heading', $taxonomy) || get_field('info_text', $taxonomy)): ?>
    <div class="text-block">
        <div class="container">
            <div class="heading">
                <h2><?php the_field('info_heading', $taxonomy) ?></h2>
            </div>
            <?php the_field('info_text', $taxonomy) ?>
            <?php $link = get_field('info_link', $taxonomy) ?>
            <a href="<?php echo $link['url'] ?>"><?php echo $link['title'] ?></a>
        </div>
    </div>
<?php endif ?>