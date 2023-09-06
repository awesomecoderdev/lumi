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

<main id="main" class="relative prose dark:prose-invert min-h-[calc(60vh-112px)] lg:px-8 sm:px-7 xs:px-5 px-4 xl:overflow-visible overflow-hidden">
    <p class="text-4xl text-primary-50">Lorem ipsum dolor </p>
    <p class="text-4xl text-primary-100">Lorem ipsum dolor</p>
    <p class="text-4xl text-primary-200">Lorem ipsum dolor</p>
    <p class="text-4xl text-primary-300">Lorem ipsum dolor</p>
    <p class="text-4xl text-primary-400">Lorem ipsum dolor</p>
    <p class="text-4xl text-primary-500">Lorem ipsum dolor</p>
    <p class="text-4xl text-primary-600">Lorem ipsum dolor</p>
    <p class="text-4xl text-primary-700">Lorem ipsum dolor</p>
    <p class="text-4xl text-primary-800">Lorem ipsum dolor</p>
    <p class="text-4xl text-primary-900">Lorem ipsum dolor</p>
</main>


<?php get_footer(); ?>