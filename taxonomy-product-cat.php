<?php

/**
 * The page template file.
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

?>

<?php get_header(); ?>

<!-- start:category header -->
<?php get_template_part("template/section/category/header"); ?>
<!-- start:category header -->

<main id="main" class="<?php echo lumi_container("not-prose"); ?>">
    <div class="relative w-full grid xl:grid-cols-10 lg:grid-cols-8 gap-8">
        <!-- start:category sidebar -->
        <?php get_template_part("template/section/category/sidebar", null, [
            "class" => "relative xl:col-span-2 lg:col-span-2 space-y-3 p-3 pl-0 font-normal lg:border-r"
        ]); ?>
        <!-- start:category sidebar -->

        <div class="relative xl:col-span-8 lg:col-span-6 py-4">
            <div class="relative w-full grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-8">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <form class="relative add-to-cart" method="POST">
                            <button class="absolute top-4 right-4 cursor-pointer" id="add-to-wishlist" data-product="<?php the_ID() ?>">
                                <div class="relative glass rounded-full flex justify-center items-center p-1 text-white">
                                    <?php if (!in_array(get_the_ID(), lumi_get_wishlist())) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 product-wishlist-item product-wishlist-<?php the_ID() ?>">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    <?php else : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 product-wishlist-item product-wishlist-<?php the_ID() ?> text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    <?php endif ?>
                                </div>
                            </button>
                            <img class="rounded-xl xl:aspect-[3/4] lg:aspect-[3/4] md:aspect-[3/4] w-full  bg-slate-100 dark:bg-slate-400 cursor-pointer" src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>">
                            <div class="relative w-full flex justify-between items-center py-2 ">
                                <a href="<?php the_permalink() ?>" class="not-prose text-sm font-semibold">
                                    <?php the_title(); ?>
                                </a>
                                <button class="text-slate-600 dark:text-white" type="submit">
                                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.651 5.5984C14.651 3.21232 12.7167 1.27799 10.3307 1.27799C9.18168 1.27316 8.07806 1.72619 7.26387 2.53695C6.44968 3.3477 5.992 4.44939 5.992 5.5984M14.5137 20.5H6.16592C3.09955 20.5 0.747152 19.3924 1.41534 14.9348L2.19338 8.89359C2.60528 6.66934 4.02404 5.81808 5.26889 5.81808H15.4474C16.7105 5.81808 18.0469 6.73341 18.5229 8.89359L19.3009 14.9348C19.8684 18.889 17.5801 20.5 14.5137 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.296 10.102H13.251" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.46601 10.102H7.42001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>