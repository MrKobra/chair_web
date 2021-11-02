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