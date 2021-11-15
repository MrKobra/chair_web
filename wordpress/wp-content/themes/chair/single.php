<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Chair
 */

get_header();
woocommerce_breadcrumb();
?>

<div class="page-wrapper">
    <div class="container">
        <div class="heading">
            <h1><?php the_title(); ?></h1>
        </div>
        <?php if(have_posts()) {
            the_post();
            the_content();
        } else {
            get_template_part('template-parts/content', 'none');
        } ?>
    </div>
</div>
<?php
get_footer();
