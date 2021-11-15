<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Chair
 */

get_header();
?>

    <div class="items search-result">
        <div class="container">
            <div class="heading">
                <h2><?php echo 'Результаты поиска по: '.$_GET['s']; ?></h2>
            </div>
        <?php
        global $wp_query;
        $args = array_merge( $wp_query->query, array( 'post_type' => 'product') );
        query_posts($args);
        ?>
		<?php if ( have_posts() ) : ?>
            <div class="items-container">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/catalog', 'item-card' );

			endwhile;
			?>
            </div>
        <?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
        </div>
    </div>

<?php
get_footer();
