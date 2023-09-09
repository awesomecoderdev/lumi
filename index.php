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

// echo "<pre>";
// print_r($categories->posts);
// echo "</pre>";

// die;

?>

<?php get_header(); ?>

<main id="main" class="<?php echo lumi_container("py-10 not-prose"); ?>">
    <?php $the_categories_index = 0; ?>
    <?php if ($categories->have_posts()) : ?>
        <div class="relative grid grid-cols-10 gap-5">
            <a href="<?php echo get_the_permalink($categories->posts[0]->ID); ?>" class="relative col-span-6">
                <img class="h-full w-full  bg-gray-200 bg-contain bg-center bg-no-repeat rounded-xl aspect-[4/4]" src="<?php echo get_the_post_thumbnail_url($categories->posts[0]->ID); ?>)">
                </img>
                <h2 class="text-6xl text-white absolute bottom-[10%] left-1/2 transform translate-x-[-50%] font-semibold"><?php echo get_the_title($categories->posts[0]->ID) ?></h2>
            </a>
            <div class="relative col-span-4 h-full w-full">
                <div class="relative grid gap-5">
                    <a class="relative" href="<?php echo get_the_permalink($categories->posts[1]->ID); ?>">
                        <img class="h-full w-full bg-gray-200 bg-contain bg-center bg-no-repeat rounded-xl aspect-[4/3]" src="<?php echo get_the_post_thumbnail_url($categories->posts[1]->ID); ?>)">
                        </img>
                        <h2 class="text-6xl text-white absolute bottom-[10%] left-1/2 transform translate-x-[-50%] font-semibold"><?php echo get_the_title($categories->posts[1]->ID) ?></h2>

                    </a>
                    <a class="relative" href="<?php echo get_the_permalink($categories->posts[2]->ID); ?>">
                        <img class="h-full w-full bg-gray-200 bg-contain bg-center bg-no-repeat rounded-xl aspect-[4/3]" src="<?php echo get_the_post_thumbnail_url($categories->posts[2]->ID); ?>)">
                        </img>
                        <h2 class="text-6xl text-white absolute bottom-[10%] left-1/2 transform translate-x-[-50%] font-semibold"><?php echo get_the_title($categories->posts[2]->ID) ?></h2>
                    </a>

                </div>
            </div>
        </div>

        <!-- end of the loop -->
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</main>


<?php get_footer(); ?>