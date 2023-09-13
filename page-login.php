<?php

use Laravel\Socialite\Facades\Socialite;

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
$oauth = Socialite::driver("google")->redirect()->getTargetUrl();

?>

<?php get_header(); ?>


<main id="main" class="<?php echo lumi_container("py-10 not-prose"); ?>">
    <form action="" method="post">
        <button type="button">
            <?php _e('Login', 'lumi'); ?>
        </button>
    </form>

    <a href="#"> <?php _e('Google', 'lumi'); ?></a>
</main>


<?php get_footer(); ?>