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
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="about__container bd-grid">
                <div class="about__data">
                    <h2 class="section-title about__initial"><?php the_title(); ?></h2>
                    <p class="about__description">
                        <?php
                        $content = strip_tags(get_the_content());
                        $content = substr($content, 0, 250) . "...";
                        echo $content;
                        ?>
                    </p>
                    <a href="<?php the_permalink(); ?>" class="button">Explore history</a>
                </div>
                <img src="<?php echo (!empty(get_the_post_thumbnail_url())) ? get_the_post_thumbnail_url() : url("assets/img/undraw_eating_together_tjhx.svg"); ?>" alt="" class="about__img">
            </div>
        <?php
        endwhile; ?>
    <?php else : ?>
        <main id="main" class="relative container flex justify-center items-center <?php echo wp_is_mobile() ? "pb-20" : "" ?>">
            <div class="relative w-full h-full max-w-4xl flex lg:flex-row flex-col justify-between lg:items-center py-10">
                <div class="relative">
                    <h1 class="xl:text-8xl lg:text-6xl text-4xl font-semibold uppercase"><?php _e("Error", "lumi"); ?></h1>
                    <h1 class="xl:text-5xl lg:text-4xl text-3xl font-semibold"><?php _e("Page Not Found.", "lumi"); ?></h1>
                </div>
                <img class="h-auto w-full lg:max-w-xl md:max-w-sm" src="<?php echo url("img/404.svg") ?>" alt="<?php echo bloginfo("title") ?>">
            </div>
        </main>
    <?php endif; ?>
</main>



<?php get_footer(); ?>