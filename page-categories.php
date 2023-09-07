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

        <div class="relative col-span-8">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque cupiditate quae, totam vitae exercitationem optio ducimus quis debitis non nobis est soluta porro delectus velit hic voluptas quod ipsam quasi?
        </div>
    </div>
</main>

<?php get_footer(); ?>