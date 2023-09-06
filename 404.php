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

?>

<?php get_header(); ?>

<main id="main" class="<?php echo lumi_container(); ?>">
    <div class="relative w-full h-full max-w-4xl flex lg:flex-row flex-col justify-between lg:items-center py-10">
        <div class="relative">
            <h1 class="xl:text-8xl lg:text-6xl text-4xl font-semibold uppercase"><?php _e("Error", "lumi"); ?></h1>
            <h1 class="xl:text-5xl lg:text-4xl text-3xl font-semibold"><?php _e("Page Not Found.", "lumi"); ?></h1>
        </div>
        <img class="h-auto w-full lg:max-w-xl md:max-w-sm" src="<?php echo url("img/404.svg") ?>" alt="<?php echo bloginfo("title") ?>">
    </div>
</main>

<?php get_footer(); ?>