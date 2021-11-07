<?php
// Template Name: Контакты
get_header();

if(have_posts()) :
    the_post();
    woocommerce_breadcrumb();
?>

    <div class="contact-page">
        <div class="container">
            <?php
            if(get_field('showroom')) {
                while(has_sub_field('showroom')) {
                    ?>
                    <div class="contact-page-block">
                        <div class="contact-page-info">
                            <?php if(get_sub_field('title')) { ?>
                                <h2><?php the_sub_field('title'); ?></h2>
                            <?php } ?>
                            <?php if(get_sub_field('address')): ?>
                            <div class="address">
                                <div class="contact-page-heading">
                                    Адрес:
                                </div>
                                <?php the_sub_field('address'); ?>
                            </div>
                            <?php endif;
                            if(get_sub_field('work_time')): ?>
                            <div class="work-time">
                                <div class="contact-page-heading">
                                    Часы работы
                                </div>
                                <?php the_sub_field('work_time'); ?>
                            </div>
                            <?php endif;
                            if(get_sub_field('telephone')): ?>
                            <div class="telephone">
                                <div class="contact-page-heading">
                                    Телефон:
                                </div>
                                <?php the_sub_field('telephone'); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if(get_sub_field('map')): ?>
                        <div class="contact-page-map">
                            <div class="contact-page-map-container">
                                <?php the_sub_field('map'); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="contact-page-container">
                <div class="contact-page-column">
                    <div class="contact-page-payment">
                        <h2>Оплата</h2>
                        <p>Оплата за наличный расчёт, картой любого банка с помощью терминала, с мобильного устройства по QR-коду.<br>
                            Для юридических лиц за безналичный расчёт.</p>
                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mastercard.png" alt=""></li>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/visa.png" alt=""></li>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mir.png" alt=""></li>
                        </ul>
                    </div>
                    <div class="contact-page-social">
                        <h2>Социальные сети</h2>
                        <p>Давайте дружить в социальных сетях! Вы будете одними из первых узнавать о новых поступлениях, получать промо-коды для участия в акциях и распродажах.</p>
                        <ul>
                            <?php if(get_field('telegram_link', 'options')): ?>
                                <li><a href="<?php the_field('telegram_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/telegram-red.png" alt=""></a></li>
                            <?php endif; ?>
                            <?php if(get_field('vk_link', 'options')): ?>
                                <li><a href="<?php the_field('vk_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/vk-red.png" alt=""></a></li>
                            <?php endif; ?>
                            <?php if(get_field('instagram_link', 'options')): ?>
                                <li><a href="<?php the_field('instagram_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/instagram-red.png" alt=""></a></li>
                            <?php endif; ?>
                            <?php if(get_field('youtube_link', 'options')): ?>
                                <li><a href="<?php the_field('youtube_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/youtube-red.png" alt=""></a></li>
                            <?php endif; ?>
                            <?php if(get_field('fb_link', 'options')): ?>
                                <li><a href="<?php the_field('fb_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/facebook-red.png" alt=""></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="contact-page-column">
                    <h2>Обратная связь</h2>
                    <p>Вы можете задать вопрос через форму, или <br> написать нам на почту <a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></p>
                    <?php echo do_shortcode('[contact-form-7 id="146" title="Обратная связь"]'); ?>
                </div>
            </div>
        </div>
    </div>

<?php

endif;
get_footer();

