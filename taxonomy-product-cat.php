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
    <div class="relative w-full grid grid-cols-10 gap-8 py-3">
        <!-- start:category sidebar -->
        <?php get_template_part("template/section/category/sidebar", null, [
            "class" => "relative col-span-2 space-y-3 font-normal"
        ]); ?>
        <!-- start:category sidebar -->

        <div class="relative col-span-8 py-4">
            <div class="relative w-full grid grid-cols-4 gap-8">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="relative">
                            <button class="absolute top-4 right-4 cursor-pointer" onclick="alert('hello')">
                                <div class="relative glass rounded-full flex justify-center items-center p-1 text-white">
                                    <svg class="" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 20.355C11.9013 20.3556 11.8034 20.3367 11.7121 20.2993C11.6207 20.262 11.5376 20.207 11.4675 20.1375L4.57499 13.245C3.78931 12.4583 3.25438 11.4565 3.03775 10.366C2.82111 9.27553 2.9325 8.1453 3.35783 7.11807C3.78317 6.09085 4.50338 5.21271 5.42749 4.59456C6.35161 3.97641 7.43819 3.64598 8.54999 3.645C9.79938 3.64019 11.0142 4.05483 12 4.8225C13.0833 3.98581 14.4339 3.57163 15.8 3.65718C17.1661 3.74274 18.4545 4.32219 19.425 5.2875C20.477 6.34444 21.0676 7.775 21.0676 9.26625C21.0676 10.7575 20.477 12.1881 19.425 13.245L12.5325 20.1375C12.4624 20.207 12.3793 20.262 12.2879 20.2993C12.1965 20.3367 12.0987 20.3556 12 20.355ZM8.54999 5.145C8.00797 5.14317 7.47099 5.24897 6.97017 5.45625C6.46936 5.66352 6.01467 5.96816 5.63249 6.3525C4.86214 7.12808 4.4298 8.17686 4.4298 9.27C4.4298 10.3631 4.86214 11.4119 5.63249 12.1875L12 18.5475L18.3675 12.1875C19.1378 11.4119 19.5702 10.3631 19.5702 9.27C19.5702 8.17686 19.1378 7.12808 18.3675 6.3525C17.9844 5.96925 17.5296 5.66523 17.029 5.45781C16.5284 5.25039 15.9919 5.14363 15.45 5.14363C14.9081 5.14363 14.3716 5.25039 13.871 5.45781C13.3704 5.66523 12.9156 5.96925 12.5325 6.3525C12.4628 6.4228 12.3798 6.47859 12.2884 6.51667C12.197 6.55474 12.099 6.57435 12 6.57435C11.901 6.57435 11.8029 6.55474 11.7116 6.51667C11.6202 6.47859 11.5372 6.4228 11.4675 6.3525C11.0853 5.96816 10.6306 5.66352 10.1298 5.45625C9.62898 5.24897 9.092 5.14317 8.54999 5.145Z" fill="currentColor" />
                                    </svg>
                                </div>
                            </button>
                            <img class="rounded-xl xl:aspect-[3/4] w-full bg-slate-100 dark:bg-slate-400 cursor-pointer" src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>">
                            <a href="<?php the_permalink() ?>" class="not-prose">
                                <h1 class="text-sm font-semibold"><?php the_title(); ?></h1>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>