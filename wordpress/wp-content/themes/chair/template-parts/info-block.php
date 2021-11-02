<?php if(get_field('info_heading') || get_field('info_text')): ?>
    <div class="text-block">
        <div class="container">
            <div class="heading">
                <h2><?php the_field('info_heading') ?></h2>
            </div>
            <?php the_field('info_text') ?>
            <?php $link = get_field('info_link') ?>
            <a href="<?php echo $link['url'] ?>"><?php echo $link['title'] ?></a>
        </div>
    </div>
<?php endif ?>