<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Chair
 */

get_header();
?>
<div class="container">
    <?php
    get_template_part('template-parts/content', 'none');
    ?>
</div>
<?php
get_footer();
