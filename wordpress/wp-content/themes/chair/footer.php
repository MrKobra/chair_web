<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Chair
 */

?>

<footer class="main-footer">
    <div class="container">
        <div class="main-footer-top">
            <?php $footer_logo = get_field('footer_logo', 'options');
            if($footer_logo): ?>
            <div class="logo">
                <a href="<?php echo home_url() ?>">
                    <img src="<?php echo $footer_logo['url'] ?>" alt="<?php echo $footer_logo['alt'] ?>">
                </a>
            </div>
            <?php endif; ?>
            <div class="main-footer-menu">
                <div class="main-footer-heading">
                    <h3>Покупателям</h3>
                </div>
                <?php
                wp_nav_menu( [
                    'theme_location'  => 'client_menu',
                    'container'       => '',
                    'items_wrap'      => '<ul>%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
                ] );
                ?>
            </div>
            <div class="main-footer-menu">
                <div class="main-footer-heading">
                    <h3>Помощь</h3>
                </div>
                <?php
                wp_nav_menu( [
                    'theme_location'  => 'support_menu',
                    'container'       => '',
                    'items_wrap'      => '<ul>%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
                ] );
                ?>
            </div>
            <?php if(get_field('footer_contact', 'options')): ?>
            <div class="main-footer-contact">
                <div class="main-footer-heading">
                    <h3>Контакты</h3>
                </div>
                <?php the_field('footer_contact', 'options'); ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="main-footer-bottom">
            <?php if(get_field('copy', 'options')): ?>
            <div class="copy">
                <?php the_field('copy', 'options'); ?>
            </div>
            <?php endif; ?>
            <ul class="payment">
                <li><img src="<?php echo get_template_directory_uri() ?>/assets/img/mir.png" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri() ?>/assets/img/visa.png" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri() ?>/assets/img/mastercard.png" alt=""></li>
                <li><img src="<?php echo get_template_directory_uri() ?>/assets/img/maestro.png" alt=""></li>
            </ul>
            <ul class="social">
                <?php if(get_field('telegram_link', 'options')): ?>
                <li><a href="<?php the_field('telegram_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/telegram.png" alt=""></a></li>
                <?php endif; ?>
                <?php if(get_field('vk_link', 'options')): ?>
                <li><a href="<?php the_field('vk_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/vk.png" alt=""></a></li>
                <?php endif; ?>
                <?php if(get_field('instagram_link', 'options')): ?>
                <li><a href="<?php the_field('instagram_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/instagram.png" alt=""></a></li>
                <?php endif; ?>
                <?php if(get_field('youtube_link', 'options')): ?>
                <li><a href="<?php the_field('youtube_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/youtube.png" alt=""></a></li>
                <?php endif; ?>
                <?php if(get_field('fb_link', 'options')): ?>
                <li><a href="<?php the_field('fb_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/facebook.png" alt=""></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
