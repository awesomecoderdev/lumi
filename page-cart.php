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

<main id="main" class="<?php echo lumi_container("py-10 not-prose"); ?>">
    <div class="relative w-full grid grid-cols-10 gap-8 py-3">
        <!-- start:cart body -->

        <div class="relative col-span-8">
            <div class="relative py-4 grid gap-4">
                <!-- start for large device -->
                <?php foreach (lumi_get_cart() as $key => $item) : ?>
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
                        <div class="relative h-full w-full grid lg:grid-cols-3 gap-4">
                            <div class="relative flex items-center gap-4">
                                <?php echo str_replace("<img", "<img class=\"rounded-xl xl:aspect-[4/3] lg:aspect-[4/3] md:aspect-[4/3] w-36 bg-slate-100 dark:bg-slate-400 cursor-pointer\" alt=\"$product_name\"", $product->get_image()); ?>
                                <div class="relative">
                                    <h2 class="text-lg font-semibold"><?php echo $product_name; ?></h2>
                                </div>
                            </div>
                            <div class="relative flex justify-center items-center flex-col space-y-2 cursor-pointer">
                                <div class="relative flex items-center pointer-events-none">
                                    <button class="h-5 w-5 border flex justify-center items-center" id="wishlist-quantity-decrement">-</button>
                                    <input name="quantity" id="wishlist-quantity" class="p-0 m-0 w-10 h-5 leading-none text-xs px-2 border placeholder:text-primary-300 text-primary-500 font-semibold outline-none border-none border-transparent outline-transparent focus:outline-none focus-visible:outline-none focus:ring-transparent text-center" type="number" min="1" value="1">
                                    <button class="h-5 w-5 border flex justify-center items-center" id="wishlist-quantity-increment">+</button>
                                </div>

                                <div class="relative flex items-center space-x-2" id="remove-from-wishlist" data-product="<?php echo $product_id; ?>">
                                    <svg class="h-4 w-4" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.6001 18H5.31008C3.82508 18 2.65508 16.785 2.65508 15.345V7.2C2.65508 6.93 2.83508 6.75 3.10508 6.75C3.37508 6.75 3.55508 6.93 3.55508 7.2V15.345C3.55508 16.335 4.36508 17.1 5.31008 17.1H12.6001C13.5901 17.1 14.3551 16.29 14.3551 15.345V7.2C14.3551 6.93 14.5351 6.75 14.8051 6.75C15.0751 6.75 15.2551 6.93 15.2551 7.2V15.345C15.2551 16.785 14.0401 18 12.6001 18ZM14.9851 2.205H11.5651C11.3401 0.945 10.2601 0 8.95508 0C7.65008 0 6.57008 0.945 6.34508 2.205H2.92508C1.89008 2.205 1.08008 3.015 1.08008 4.05C1.08008 5.085 1.89008 5.85 2.92508 5.85H15.0301C16.0651 5.85 16.8751 5.04 16.8751 4.005C16.8751 2.97 16.0201 2.205 14.9851 2.205ZM8.95508 0.9C9.76508 0.9 10.4401 1.44 10.6201 2.205H7.24508C7.47008 1.44 8.14508 0.9 8.95508 0.9ZM14.9851 4.95H2.92508C2.43008 4.95 1.98008 4.545 1.98008 4.005C1.98008 3.51 2.38508 3.06 2.92508 3.06H15.0301C15.5251 3.06 15.9751 3.465 15.9751 4.005C15.9301 4.545 15.5251 4.95 14.9851 4.95Z" fill="currentColor" />
                                        <path d="M5.80498 15.7949C5.53498 15.7949 5.35498 15.6149 5.35498 15.3449V7.82988C5.35498 7.55988 5.53498 7.37988 5.80498 7.37988C6.07498 7.37988 6.25498 7.55988 6.25498 7.82988V15.3449C6.25498 15.5699 6.02998 15.7949 5.80498 15.7949ZM12.105 15.7949C11.835 15.7949 11.655 15.6149 11.655 15.3449V7.82988C11.655 7.55988 11.835 7.37988 12.105 7.37988C12.375 7.37988 12.555 7.55988 12.555 7.82988V15.3449C12.555 15.5699 12.33 15.7949 12.105 15.7949ZM8.95498 15.7949C8.68498 15.7949 8.50498 15.6149 8.50498 15.3449V7.82988C8.50498 7.55988 8.68498 7.37988 8.95498 7.37988C9.22498 7.37988 9.40498 7.55988 9.40498 7.82988V15.3449C9.40498 15.5699 9.17998 15.7949 8.95498 15.7949Z" fill="currentColor" />
                                    </svg>
                                    <span>
                                        <?php _e("Remove", "lumi") ?>
                                    </span>
                                </div>
                            </div>
                            <div class="relative flex  items-center">
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
        <div class="relative col-span-2 space-y-3 font-normal">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus qui in sed architecto velit labore porro quo repellat, obcaecati deleniti molestiae nihil nulla nam maiores odio non, animi quibusdam? Porro!</p>
        </div>
        <!-- start:category sidebar -->

    </div>
</main>

<?php get_footer(); ?>