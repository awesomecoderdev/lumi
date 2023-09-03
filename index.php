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

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis blanditiis temporibus repellat! Molestiae, perferendis pariatur. Consequatur, minus provident voluptates eum maxime modi aperiam tempore? Nesciunt labore praesentium officiis qui voluptatum.</p>
<p class="text-4xl text-primary-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat nostrum quas aperiam molestias dicta placeat, debitis odio cum doloribus? Perferendis illo repellendus officiis consequatur. Consequuntur blanditiis veniam dolor beatae sequi!</p>

<?php get_footer(); ?>