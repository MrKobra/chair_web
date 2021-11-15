<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Chair
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="top-header">
    <div class="container">
        <div class="top-header-menu">
            <?php
            wp_nav_menu( [
                'theme_location'  => 'header_menu',
                'container'       => '',
                'items_wrap'      => '<ul>%3$s</ul>',
                'depth'           => 0,
                'walker'          => '',
            ] );
            ?>
        </div>
        <?php if(get_field('telephone', 'options')): ?>
        <div class="top-header-phone">
            <?php the_field('telephone', 'options'); ?>
        </div>
        <?php endif; ?>
    </div>
</header>

<header class="bottom-header">
    <div class="container">
        <?php $header_logo = get_field('header_logo', 'options');
        if($header_logo): ?>
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo $header_logo['url']; ?>" alt="<?php echo $header_logo['alt']; ?>">
            </a>
        </div>
        <?php endif; ?>
        <div class="bottom-header-search">
            <form action="<?php bloginfo( 'url' ); ?>" method="get">
                <input name="s" value="<?php if(!empty($_GET['s'])){ echo $_GET['s']; } ?>" type="text" placeholder="Вы ищите, мы находим">
                <button><img src="<?php echo get_template_directory_uri(); ?>/assets/img/search.png" alt="Поиск"></button>
            </form>
        </div>
        <?php chair_woocommerce_cart_link() ?>
    </div>
</header>

<?php
$args = [
    'taxonomy'      => 'product_cat',
    'orderby'       => 'id',
    'order'         => 'DESC',
    'parent'        => 0,
    'number'        => count(get_field('cat_menu', 'options')),
    'include'       => get_field('cat_menu', 'options'),
    'hide_empty'    => false,
    'exclude'       => array(15),
    'update_term_meta_cache' => true,
];

$terms = get_terms( $args );

if($terms):
?>
<nav class="cat-nav">
    <div class="container">
        <div class="cat-nav-container">
            <ul>
                <?php
                foreach( $terms as $term ):
                    $img = get_term_meta($term->term_id, 'thumbnail_id');
                    $img_url = wp_get_attachment_url($img[0]); ?>
                    <li><a href="<?php echo get_term_link($term->term_id) ?>"><img src="<?php echo $img_url ?>" alt=""><span><?php echo $term->name ?></span></a></li>
                <?php endforeach;
                ?>
                <li class="stocks"><a href="<?php echo get_field('shop_page', 'options')['url'].'?status=37'; ?>"><span>Акции</span> <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cat-icon-7.png" alt=""></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="mobile-nav">
    <div class="container">
        <div class="mobile-cat-btn">
            <span></span><span></span><span></span>
        </div>
        <?php chair_woocommerce_cart_link() ?>
    </div>
</div>
<?php endif ?>