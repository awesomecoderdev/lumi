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
global $woocommerce;
$products = $woocommerce->cart->get_cart();


?>

<?php get_header(); ?>

<main id="main" class="<?php echo lumi_container("py-10 not-prose"); ?>">
    <div class="relative w-full grid grid-cols-10 gap-8 py-3">
        <!-- start:cart body -->

        <div class="relative col-span-8">
            <div class="relative py-4 grid gap-4">
                <!-- start for large device -->
                <?php foreach ($products as $key => $item) : ?>
                    <?php
                    // Get product details
                    $product = wc_get_product($item["product_id"]);

                    // You can access product data like this:
                    $product_id = $product->get_id();
                    $product_name = $product->get_name();
                    $product_price = $product->get_price();
                    $product_sku = $product->get_sku();

                    ?>
                    <div class="relative add-to-cart-from-wishlist md:flex hidden justify-between items-end rounded-lg ">
                        <div class="relative h-full w-full flex justify-between items-center gap-4">
                            <div class="relative flex justify-between items-center">
                                <?php echo str_replace("<img", "<img class=\"rounded-xl xl:aspect-[4/3] lg:aspect-[4/3] md:aspect-[4/3] w-36 bg-slate-100 dark:bg-slate-400 cursor-pointer\" alt=\"$product_name\"", $product->get_image()); ?>
                                <div class="relative">
                                    <h2 class="text-lg font-semibold"><?php echo $product_name; ?></h2>
                                </div>
                            </div>
                            <div class="relative flex">
                                <button class="h-5 w-5 border flex justify-center items-center" id="wishlist-quantity-decrement">-</button>
                                <input name="quantity" id="wishlist-quantity" class="p-0 m-0 w-10 h-5 leading-none text-xs px-2 border placeholder:text-primary-300 text-primary-500 font-semibold outline-none border-none border-transparent outline-transparent focus:outline-none focus-visible:outline-none focus:ring-transparent text-center" type="number" min="1" value="1">
                                <button class="h-5 w-5 border flex justify-center items-center" id="wishlist-quantity-increment">+</button>
                            </div>
                            <div class="relative flex">
                                <span class="text-primary-600 text-xl font-medium">
                                    <?php echo wc_price($product_price);
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


                <!-- end for large device -->
            </div>
            <!-- end:cart body -->
        </div>



        <!-- start:category sidebar -->
        <?php get_template_part("template/section/category/sidebar", null, [
            "class" => "relative col-span-2 space-y-3 font-normal"
        ]); ?>
        <!-- start:category sidebar -->

    </div>
</main>

<?php get_footer(); ?>