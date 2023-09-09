<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           lumi
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.

}


// global $woocommerce;
// $products = $woocommerce->cart->get_cart();

$categories = lumi_get_products([
    'post_type' => 'page',
    'post_status' => 'publish',
    'post_name__in' => ['man', 'woman', 'kids'], // Replace with your slugs
    'orderby' => 'title', // Order by post title (name)
    'order' => 'DESC',     // Order in ascending order
]);

?>

<?php get_header(); ?>

<main id="main" class="<?php echo lumi_container("py-10 not-prose"); ?>">
    <?php $the_categories_index = 0; ?>
    <?php if ($categories->have_posts()) : ?>
        <div class="relative grid grid-cols-2 gap-4">
            <?php while ($categories->have_posts()) : $categories->the_post(); ?>
                <div class="relative grid">
                    <div class="h-full w-full bg-gray-200 bg-contain bg-center bg-no-repeat rounded-xl aspect-[1/1]" style="background:url(<?php echo get_the_post_thumbnail_url(); ?>)">
                    </div>
                </div>

                <?php $the_categories_index++; ?>
            <?php endwhile; ?>
        </div>
        <!-- end of the loop -->
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</main>


<?php get_footer(); ?>