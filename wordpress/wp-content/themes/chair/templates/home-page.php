<?php
// Template Name: Главная
get_header();
?>

    <?php if(get_field('home_slider')): ?>
    <div class="home-main">
        <div class="container">
            <div class="home-slider">
                <?php while(has_sub_field('home_slider')): ?>
                <div class="home-slide">
                    <div class="home-slide-container">
                        <div class="home-slide-text">
                            <?php the_sub_field('text');
                            $link = get_sub_field('link'); ?>
                            <a href="<?php echo $link['url'] ?>" class="btn"><?php echo $link['title'] ?></a>
                        </div>
                        <?php $img = get_sub_field('img');
                        if($img): ?>
                        <div class="home-slide-img">
                            <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>">
                        </div>
                        <?php endif ?>
                    </div>
                </div>
                <?php endwhile ?>
            </div>
        </div>
    </div>
    <?php endif ?>

    <?php get_template_part('template-parts/catalog', 'items', ['heading' => 'Популярные товары', 'kind' => 'popular', 'posts_per_page' => 8]) ?>

    <?php if(get_field('advantages')): ?>
    <div class="advantages">
        <div class="container">
            <div class="heading">
                <h2>Как мы сохраняем высокий уровень сервиса?</h2>
            </div>
            <div class="advantages-container">
                <?php while(has_sub_field('advantages')): ?>
                <div class="advantages-card">
                    <div class="advantages-card-header">
                        <?php $img = get_sub_field('img');
                        if($img): ?>
                        <div class="advantages-card-img">
                            <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>">
                        </div>
                        <?php endif; ?>
                        <?php if(get_sub_field('title')): ?>
                            <h3><?php the_sub_field('title') ?></h3>
                        <?php endif; ?>
                    </div>
                    <?php the_sub_field('content') ?>
                </div>
                <?php endwhile ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="contact-form">
        <div class="container">
            <div class="contact-form-container">
                <div class="contact-form-heading">
                    <h2>МЫ всегда готовы помочь с выбором мебели</h2>
                    <p>Оставьте заявку на звонок. Мы перезвоним и поможем подобрать оптимальный вариант.</p>
                </div>
                <?php echo do_shortcode('[contact-form-7 id="5" title="Заявка"]'); ?>
            </div>
        </div>
    </div>

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

    <?php $contact = get_field('contact_page', 'options');
    if(get_field('showroom', $contact)): ?>
    <div class="our-location">
        <div class="container">
            <div class="heading">
                <h2>Наши шоурумы</h2>
                <p>В наших шоурумах вы сможете подобрать и купить мебель и кресло, а наши консультанты вам помогут</p>
            </div>
            <div class="our-location-container">
                <?php $i = 0;
                while(has_sub_field('showroom', $contact)):
                    $i++;
                    if($i < 3):
                    ?>
                    <div class="our-location-column">
                        <?php $img = get_sub_field('img');
                        if($img): ?>
                        <div class="our-location-img" style="background: url(<?php echo $img['url']; ?>) no-repeat center center">
                            <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>">
                        </div>
                        <?php endif; ?>
                        <div class="our-location-contact">
                            <?php if(get_sub_field('address')): ?>
                            <div class="our-location-block map">
                                <p><strong>Адрес</strong></p>
                                <?php the_sub_field('address'); ?>
                            </div>
                            <?php endif;
                            if(get_sub_field('work_time')): ?>
                            <div class="our-location-block work-time">
                                <p><strong>Часы работы</strong></p>
                                <?php the_sub_field('work_time'); ?>
                            </div>
                            <?php endif;
                            if(get_sub_field('telephone')): ?>
                            <div class="our-location-block phone">
                                <p><strong>Телефон</strong></p>
                                <?php the_sub_field('telephone') ?>
                            </div>
                            <?php endif; ?>
                            <div class="our-location-block more">
                                <a href="<?php echo get_page_link($contact) ?>" class="btn">Подробнее</a>
                            </div>
                        </div>
                    </div>
                <?php endif;
                endwhile; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

<?php
get_footer();
