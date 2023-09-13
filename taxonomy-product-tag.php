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

        <div class="relative xl:col-span-2 lg:col-span-2 space-y-3 lg:p-4 lg:pb-0 lg:pl-0 font-normal lg:border-r">
            <!-- start:category sidebar -->
            <?php get_template_part("template/section/category/sidebar", null, [
                "class" => "relative"
            ]); ?>
            <!-- start:category sidebar -->

            <!-- start:tags sidebar -->
            <?php get_template_part("template/section/tags/sidebar", null, [
                "class" => "relative"
            ]); ?>
            <!-- start:tags sidebar -->

            <!-- start:colors sidebar -->
            <?php get_template_part("template/section/colors/sidebar", null, [
                "class" => "relative"
            ]); ?>
            <!-- start:colors sidebar -->
        </div>


        <div class="relative xl:col-span-8 lg:col-span-6 py-4">
            <?php
            $query = get_queried_object();
            $paged = isset($_GET["page"]) ? intval($_GET["page"]) : 1;


            $props = [
                // "post__in" => lumi_get_wishlist()
                'posts_per_page' => 12, // Adjust the number of posts per page as needed
                'paged' => $paged, // Use the current page number
            ];
            $colors = isset($_GET["colors"]) && !empty($_GET["colors"]) ? sanitize_text_field(strtolower($_GET["colors"])) : null;

            if ($colors) {
                $colors = explode(",", $colors);

                $props['tax_query'] = [
                    // 'relation' => 'OR', // Use 'AND' if you want posts that have all specified terms.
                    'relation' => 'AND', // Change to 'OR' if you want posts that match either taxonomy term.
                    [
                        'taxonomy' => $query->taxonomy,
                        'field'    => 'slug',
                        'terms'    => $query->slug, // Custom taxonomy terms
                    ],
                    [
                        'taxonomy' => 'product_color',
                        'field'    => 'slug',
                        'terms'    => $colors ?? ["lumi"],
                    ],
                ];
            } else {
                $props['tax_query'] = [
                    'relation' => 'OR', // Use 'AND' if you want posts that have all specified terms.
                    [
                        'taxonomy' => $query->taxonomy,
                        'field'    => 'slug',
                        'terms'    => $query->slug, // Custom taxonomy terms
                    ]
                ];
            }

            // get products
            $products = lumi_get_products($props);

            ?>

            <?php if ($products->have_posts()) : ?>
                <div class="relative w-full grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-8 pb-10">

                    <?php while ($products->have_posts()) : $products->the_post(); ?>
                        <?php
                        // Get product details
                        $product = wc_get_product(get_the_ID());

                        // You can access product data like this:
                        $product_id = $product->get_id();
                        $product_name = $product->get_name();
                        $product_price = $product->get_price();
                        $product_sku = $product->get_sku();

                        ?>

                        <form class="relative add-to-cart" method="POST">
                            <input type="hidden" name="product_sku" value="<?php echo $product_sku; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <input type="hidden" name="quantity" value="1">
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
                                <button class="text-slate-600 dark:text-white flex justify-center items-center" type="submit">
                                    <svg id="add-to-bag" class="" width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.651 5.5984C14.651 3.21232 12.7167 1.27799 10.3307 1.27799C9.18168 1.27316 8.07806 1.72619 7.26387 2.53695C6.44968 3.3477 5.992 4.44939 5.992 5.5984M14.5137 20.5H6.16592C3.09955 20.5 0.747152 19.3924 1.41534 14.9348L2.19338 8.89359C2.60528 6.66934 4.02404 5.81808 5.26889 5.81808H15.4474C16.7105 5.81808 18.0469 6.73341 18.5229 8.89359L19.3009 14.9348C19.8684 18.889 17.5801 20.5 14.5137 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.296 10.102H13.251" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.46601 10.102H7.42001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <svg id="add-to-cart-loading" class="hidden h-6 w-6 p-1 animate-spin fill-slate-600 text-slate-100" aria-hidden="true" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="absolute bottom-0 w-full">

                    <!-- start:Pagination header -->
                    <div class="relative w-full flex items-center justify-center gap-3 pt-10">
                        <?php echo paginate_links(array(
                            'base'         => '%_%',
                            'format'       => '?page=%#%',
                            'current'            => isset($_GET["page"]) ? intval($_GET["page"]) : 1,
                            'total'              => $products->max_num_pages,
                            'prev_text'          => __('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>'),
                            'next_text'          => __('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>'),
                        ));
                        ?>
                    </div>
                    <!-- start:Pagination header -->

                </div>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <div class="relative w-full flex justify-center items-center h-full">

                    <div class="relative">
                        <div class="relative h-80 w-8h-80 rounded-full bg-primary-50/15 overflow-hidden p-20">
                            <svg class="h-full w-full text-primary-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
                                <g id="freepik--background-complete--inject-23">
                                    <rect x="40.58" y="329.22" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="25.81" y="343.33" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="79.19" y="34.79" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="64.41" y="48.9" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="49.7" y="34.79" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="449.24" y="316.65" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="290.32" y="34.79" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="436" y="208.5" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="418.41" y="33.33" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="433.18" y="47.44" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="23.22" y="128.6" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                    <rect x="53.58" y="186" width="26.48" height="11.19" style="fill:currentColor"></rect>
                                </g>
                                <g id="freepik--Shadow--inject-23">
                                    <ellipse cx="243.91" cy="453.03" rx="213.84" ry="10.25" style="fill:currentColor"></ellipse>
                                </g>
                                <g id="freepik--Floor--inject-23">
                                    <polygon points="17.99 418.48 75.99 418.24 134 418.15 250 417.98 366 418.15 424.01 418.23 482.01 418.48 424.01 418.72 366 418.81 250 418.98 134 418.81 75.99 418.72 17.99 418.48" style="fill:#263238"></polygon>
                                </g>
                                <g id="freepik--Shelf--inject-23">
                                    <rect x="114.81" y="75.71" width="334.43" height="334.43" style="fill:#455a64"></rect>
                                    <rect x="130.61" y="93.97" width="302.84" height="297.44" style="fill:#dbdbdb"></rect>
                                    <rect x="130.61" y="316.96" width="302.84" height="10.57" style="fill:#455a64"></rect>
                                    <rect x="130.61" y="238" width="302.84" height="10.57" style="fill:#455a64"></rect>
                                    <rect x="130.61" y="159.02" width="302.84" height="10.57" style="fill:#455a64"></rect>
                                    <rect x="138.09" y="129.53" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="168.53" y="129.53" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="138.09" y="99.37" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="168.53" y="99.37" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="198.93" y="129.53" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="198.93" y="99.37" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="136.13" y="120.88" width="93.65" height="23.4" style="fill:#c7c7c7"></rect>
                                    <rect x="234.48" y="129.53" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="264.93" y="129.53" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="234.48" y="99.37" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="264.93" y="99.37" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="295.33" y="129.53" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="295.33" y="99.37" width="29.5" height="29.5" rx="3.09" style="fill:#fff"></rect>
                                    <rect x="232.53" y="120.88" width="93.65" height="23.4" style="fill:currentColor"></rect>
                                    <path d="M161.61,222v16H136.13V222c0-7.28,4-11.72,4-14s-3-5.8-3-10.24,5.8-8.13,5.8-11.44V177h11.82v9.32c0,3.31,5.81,7,5.81,11.44s-3,8-3,10.24S161.61,214.76,161.61,222Z" style="fill:#c7c7c7"></path>
                                    <rect x="141.13" y="173.85" width="15.47" height="5.23" style="fill:currentColor"></rect>
                                    <rect x="136.13" y="223.02" width="25.48" height="9.27" style="fill:#fff"></rect>
                                    <path d="M189.92,222v16H164.45V222c0-7.28,4-11.72,4-14s-2.95-5.8-2.95-10.24,5.8-8.13,5.8-11.44V177H183.1v9.32c0,3.31,5.8,7,5.8,11.44s-3,8-3,10.24S189.92,214.76,189.92,222Z" style="fill:#c7c7c7"></path>
                                    <rect x="169.45" y="173.85" width="15.47" height="5.23" style="fill:currentColor"></rect>
                                    <rect x="164.45" y="223.02" width="25.48" height="9.27" style="fill:#fff"></rect>
                                    <path d="M317.89,190.92v40.66a5.14,5.14,0,0,1-5.14,5.14H289.39a5.14,5.14,0,0,1-5.14-5.14V190.92a5.13,5.13,0,0,1,5.14-5.12h.15v-2.45H312.6v2.45h.15A5.13,5.13,0,0,1,317.89,190.92Z" style="fill:#fff"></path>
                                    <rect x="286.39" y="193.55" width="29.36" height="41.1" rx="4.2" style="fill:#a6a6a6"></rect>
                                    <rect x="286.14" y="178.32" width="29.73" height="4.89" style="fill:#c7c7c7"></rect>
                                    <rect x="292.34" y="210.03" width="17.46" height="17.62" style="fill:currentColor"></rect>
                                    <path d="M152.41,290.91V314a2.93,2.93,0,0,1-2.93,2.92H136.19a2.92,2.92,0,0,1-2.92-2.92V290.91a2.92,2.92,0,0,1,2.92-2.92h.09V286.6h13.11V288h.09A2.93,2.93,0,0,1,152.41,290.91Z" style="fill:#fff"></path>
                                    <rect x="134.48" y="292.4" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="134.34" y="283.74" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M152.32,257.72v23.13a2.93,2.93,0,0,1-2.92,2.93H136.1a2.93,2.93,0,0,1-2.92-2.93V257.72a2.91,2.91,0,0,1,2.92-2.91h.09v-1.4h13.12v1.4h.09A2.91,2.91,0,0,1,152.32,257.72Z" style="fill:#fff"></path>
                                    <rect x="134.4" y="259.22" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="134.26" y="250.55" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M172.66,290.91V314a2.93,2.93,0,0,1-2.93,2.92H156.44a2.93,2.93,0,0,1-2.93-2.92V290.91a2.93,2.93,0,0,1,2.93-2.92h.09V286.6h13.11V288h.09A2.93,2.93,0,0,1,172.66,290.91Z" style="fill:#fff"></path>
                                    <rect x="154.73" y="292.4" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="154.59" y="283.74" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M172.57,257.72v23.13a2.93,2.93,0,0,1-2.92,2.93h-13.3a2.93,2.93,0,0,1-2.92-2.93V257.72a2.91,2.91,0,0,1,2.92-2.91h.09v-1.4h13.12v1.4h.09A2.91,2.91,0,0,1,172.57,257.72Z" style="fill:#fff"></path>
                                    <rect x="154.65" y="259.22" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="154.51" y="250.55" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M192.91,290.91V314A2.93,2.93,0,0,1,190,317H176.69a2.93,2.93,0,0,1-2.93-2.92V290.91a2.93,2.93,0,0,1,2.93-2.92h.09V286.6h13.11V288H190A2.93,2.93,0,0,1,192.91,290.91Z" style="fill:#fff"></path>
                                    <rect x="174.98" y="292.4" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="174.84" y="283.74" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M192.82,257.72v23.13a2.93,2.93,0,0,1-2.92,2.93H176.6a2.93,2.93,0,0,1-2.92-2.93V257.72a2.91,2.91,0,0,1,2.92-2.91h.09v-1.4h13.12v1.4h.09A2.91,2.91,0,0,1,192.82,257.72Z" style="fill:#fff"></path>
                                    <rect x="174.9" y="259.22" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="174.76" y="250.55" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M213.16,290.91V314a2.93,2.93,0,0,1-2.93,2.92H196.94A2.93,2.93,0,0,1,194,314V290.91a2.93,2.93,0,0,1,2.93-2.92H197V286.6h13.11V288h.09A2.93,2.93,0,0,1,213.16,290.91Z" style="fill:#fff"></path>
                                    <rect x="195.23" y="292.4" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="195.09" y="283.74" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M213.07,257.72v23.13a2.93,2.93,0,0,1-2.92,2.93h-13.3a2.93,2.93,0,0,1-2.92-2.93V257.72a2.91,2.91,0,0,1,2.92-2.91h.09v-1.4h13.12v1.4h.09A2.91,2.91,0,0,1,213.07,257.72Z" style="fill:#fff"></path>
                                    <rect x="195.15" y="259.22" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="195.01" y="250.55" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M233.41,290.91V314a2.93,2.93,0,0,1-2.93,2.92H217.19a2.93,2.93,0,0,1-2.93-2.92V290.91a2.93,2.93,0,0,1,2.93-2.92h.09V286.6h13.11V288h.09A2.93,2.93,0,0,1,233.41,290.91Z" style="fill:#fff"></path>
                                    <rect x="215.48" y="292.4" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="215.34" y="283.74" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M233.32,257.72v23.13a2.93,2.93,0,0,1-2.92,2.93H217.1a2.93,2.93,0,0,1-2.92-2.93V257.72a2.91,2.91,0,0,1,2.92-2.91h.09v-1.4h13.12v1.4h.09A2.91,2.91,0,0,1,233.32,257.72Z" style="fill:#fff"></path>
                                    <rect x="215.4" y="259.22" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="215.26" y="250.55" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M253.66,290.91V314a2.93,2.93,0,0,1-2.93,2.92H237.44a2.93,2.93,0,0,1-2.93-2.92V290.91a2.93,2.93,0,0,1,2.93-2.92h.09V286.6h13.11V288h.09A2.93,2.93,0,0,1,253.66,290.91Z" style="fill:#fff"></path>
                                    <rect x="235.73" y="292.4" width="16.71" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="235.59" y="283.74" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M253.57,257.72v23.13a2.93,2.93,0,0,1-2.92,2.93h-13.3a2.93,2.93,0,0,1-2.92-2.93V257.72a2.91,2.91,0,0,1,2.92-2.91h.09v-1.4h13.12v1.4h.09A2.91,2.91,0,0,1,253.57,257.72Z" style="fill:#fff"></path>
                                    <rect x="235.65" y="259.22" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="235.51" y="250.55" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M273.9,290.91V314A2.92,2.92,0,0,1,271,317H257.69a2.93,2.93,0,0,1-2.93-2.92V290.91a2.93,2.93,0,0,1,2.93-2.92h.09V286.6h13.11V288H271A2.92,2.92,0,0,1,273.9,290.91Z" style="fill:#fff"></path>
                                    <rect x="255.98" y="292.4" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="255.84" y="283.74" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M273.82,257.72v23.13a2.93,2.93,0,0,1-2.92,2.93H257.6a2.93,2.93,0,0,1-2.92-2.93V257.72a2.91,2.91,0,0,1,2.92-2.91h.09v-1.4h13.12v1.4h.09A2.91,2.91,0,0,1,273.82,257.72Z" style="fill:#fff"></path>
                                    <rect x="255.9" y="259.22" width="16.7" height="23.38" rx="1.68" style="fill:currentColor"></rect>
                                    <rect x="255.76" y="250.55" width="16.91" height="2.78" style="fill:#a6a6a6"></rect>
                                    <path d="M355.15,190.92v40.66a5.14,5.14,0,0,1-5.14,5.14H326.64a5.14,5.14,0,0,1-5.14-5.14V190.92a5.13,5.13,0,0,1,5.14-5.12h.16v-2.45h23.05v2.45H350A5.13,5.13,0,0,1,355.15,190.92Z" style="fill:#fff"></path>
                                    <rect x="323.64" y="193.55" width="29.36" height="41.1" rx="4.2" style="fill:#a6a6a6"></rect>
                                    <rect x="323.39" y="178.32" width="29.73" height="4.89" style="fill:#c7c7c7"></rect>
                                    <rect x="329.6" y="210.03" width="17.46" height="17.62" style="fill:currentColor"></rect>
                                    <path d="M392.4,190.92v40.66a5.14,5.14,0,0,1-5.14,5.14H363.9a5.14,5.14,0,0,1-5.14-5.14V190.92a5.13,5.13,0,0,1,5.14-5.12h.15v-2.45h23.06v2.45h.15A5.13,5.13,0,0,1,392.4,190.92Z" style="fill:#fff"></path>
                                    <rect x="360.9" y="193.55" width="29.36" height="41.1" rx="4.2" style="fill:#a6a6a6"></rect>
                                    <rect x="360.65" y="178.32" width="29.73" height="4.89" style="fill:#c7c7c7"></rect>
                                    <rect x="366.85" y="210.03" width="17.46" height="17.62" style="fill:currentColor"></rect>
                                    <path d="M429.66,190.92v40.66a5.14,5.14,0,0,1-5.14,5.14H401.15a5.14,5.14,0,0,1-5.14-5.14V190.92a5.13,5.13,0,0,1,5.14-5.12h.16v-2.45h23.05v2.45h.16A5.13,5.13,0,0,1,429.66,190.92Z" style="fill:#fff"></path>
                                    <rect x="398.15" y="193.55" width="29.36" height="41.1" rx="4.2" style="fill:#a6a6a6"></rect>
                                    <rect x="397.9" y="178.32" width="29.73" height="4.89" style="fill:#c7c7c7"></rect>
                                    <rect x="404.11" y="210.03" width="17.46" height="17.62" style="fill:currentColor"></rect>
                                    <rect x="277.5" y="251.89" width="46.14" height="64.97" style="fill:#c7c7c7"></rect>
                                    <rect x="284.08" y="270.96" width="32.99" height="2.85" style="fill:#a6a6a6"></rect>
                                    <rect x="287.46" y="276.38" width="26.23" height="2.85" style="fill:#a6a6a6"></rect>
                                    <rect x="287.46" y="261.01" width="26.23" height="2.85" style="fill:currentColor"></rect>
                                    <ellipse cx="300.57" cy="297.38" rx="17.93" ry="10" style="fill:#fff"></ellipse>
                                    <rect x="328.48" y="251.89" width="46.14" height="64.97" style="fill:#c7c7c7"></rect>
                                    <rect x="335.05" y="270.96" width="32.99" height="2.85" style="fill:#a6a6a6"></rect>
                                    <rect x="338.43" y="276.38" width="26.23" height="2.85" style="fill:#a6a6a6"></rect>
                                    <rect x="338.43" y="261.01" width="26.23" height="2.85" style="fill:currentColor"></rect>
                                    <ellipse cx="351.55" cy="297.38" rx="17.93" ry="10" style="fill:#fff"></ellipse>
                                    <rect x="379.45" y="251.89" width="46.14" height="64.97" style="fill:#c7c7c7"></rect>
                                    <rect x="386.02" y="270.96" width="32.99" height="2.85" style="fill:#a6a6a6"></rect>
                                    <rect x="389.4" y="276.38" width="26.23" height="2.85" style="fill:#a6a6a6"></rect>
                                    <rect x="389.4" y="261.01" width="26.23" height="2.85" style="fill:currentColor"></rect>
                                    <ellipse cx="402.52" cy="297.38" rx="17.93" ry="10" style="fill:#fff"></ellipse>
                                    <rect x="214.01" y="349.59" width="32.55" height="41.81" transform="translate(460.56 740.99) rotate(180)" style="fill:currentColor"></rect>
                                    <rect x="218.56" y="361.38" width="23.9" height="8.91" transform="translate(461.03 731.67) rotate(180)" style="fill:#fff"></rect>
                                    <rect x="218.56" y="374.53" width="23.9" height="13.54" transform="translate(461.03 762.61) rotate(180)" style="fill:#fff"></rect>
                                    <rect x="212.11" y="349.59" width="36.35" height="6.52" transform="translate(460.56 705.7) rotate(180)" style="fill:#c7c7c7"></rect>
                                    <rect x="175.86" y="349.59" width="32.55" height="41.81" transform="translate(384.26 740.99) rotate(180)" style="fill:currentColor"></rect>
                                    <rect x="180.42" y="361.38" width="23.9" height="8.91" transform="translate(384.73 731.67) rotate(180)" style="fill:#fff"></rect>
                                    <rect x="180.42" y="374.53" width="23.9" height="13.54" transform="translate(384.73 762.61) rotate(180)" style="fill:#fff"></rect>
                                    <rect x="173.96" y="349.59" width="36.35" height="6.52" transform="translate(384.26 705.7) rotate(180)" style="fill:#c7c7c7"></rect>
                                    <rect x="252.16" y="349.59" width="32.55" height="41.81" transform="translate(536.86 740.99) rotate(180)" style="fill:currentColor"></rect>
                                    <rect x="256.71" y="361.38" width="23.9" height="8.91" transform="translate(537.32 731.67) rotate(180)" style="fill:#fff"></rect>
                                    <rect x="256.71" y="374.53" width="23.9" height="13.54" transform="translate(537.32 762.61) rotate(180)" style="fill:#fff"></rect>
                                    <rect x="250.25" y="349.59" width="36.35" height="6.52" transform="translate(536.86 705.7) rotate(180)" style="fill:#c7c7c7"></rect>
                                    <rect x="137.71" y="349.59" width="32.55" height="41.81" transform="translate(307.97 740.99) rotate(180)" style="fill:currentColor"></rect>
                                    <rect x="142.27" y="361.38" width="23.9" height="8.91" transform="translate(308.44 731.67) rotate(180)" style="fill:#fff"></rect>
                                    <rect x="142.27" y="374.53" width="23.9" height="13.54" transform="translate(308.44 762.61) rotate(180)" style="fill:#fff"></rect>
                                    <rect x="135.81" y="349.59" width="36.35" height="6.52" transform="translate(307.97 705.7) rotate(180)" style="fill:#c7c7c7"></rect>
                                    <rect x="130.61" y="410.13" width="302.84" height="8.09" style="fill:#263238"></rect>
                                    <path d="M332.65,159s-5.35-15.06-3.12-22.34c1.49-4.89,8.84-8.15,8.84-13.34v-5.65h6.35s11,23,1.86,41.33Z" style="fill:currentColor"></path>
                                    <rect x="336.97" y="118.65" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <rect x="336.97" y="120.56" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <rect x="336.97" y="122.47" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <path d="M333.87,109.45a4.7,4.7,0,0,1,.95,2.86c-.14,1.45-.81,2.81-.58,2.89a4.46,4.46,0,0,0,2.44-3,4.63,4.63,0,0,0-.19-2.7Z" style="fill:currentColor"></path>
                                    <path d="M345.35,116.67v-3.91a2.15,2.15,0,0,1,2.12-1.8c2.35,0,5.2,2.79,5.34,1.84s-1.47-8-7-8H332.67v4.67h2.67c.59,0,2.54.36,2.54,3.21v4Z" style="fill:#fff"></path>
                                    <rect x="337.09" y="114.27" width="9.04" height="4.23" rx="0.49" style="fill:#c7c7c7"></rect>
                                    <polygon points="332.67 104.13 332.67 110.1 330.23 109.57 330.23 104.66 332.67 104.13" style="fill:#c7c7c7"></polygon>
                                    <path d="M341.62,127.51c4,0,6.35,5.69,6.35,13.4a51.28,51.28,0,0,1-1.36,11.46,2.63,2.63,0,0,1-2.57,2h-8.5a2.63,2.63,0,0,1-2.54-2c-1.06-4-3.06-13-.63-16.39,3.27-4.6,6.05-5.71,7.24-8.55Z" style="fill:#fff"></path>
                                    <path d="M383.34,159S378,144,380.22,136.68c1.5-4.89,8.84-8.15,8.84-13.34v-5.65h6.36s11,23,1.86,41.33Z" style="fill:currentColor"></path>
                                    <rect x="387.67" y="118.65" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <rect x="387.67" y="120.56" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <rect x="387.67" y="122.47" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <path d="M384.57,109.45a4.7,4.7,0,0,1,.95,2.86c-.14,1.45-.81,2.81-.59,2.89a4.43,4.43,0,0,0,2.44-3,4.69,4.69,0,0,0-.18-2.7Z" style="fill:currentColor"></path>
                                    <path d="M396,116.67v-3.91a2.16,2.16,0,0,1,2.12-1.8c2.35,0,5.21,2.79,5.34,1.84s-1.46-8-7-8H383.37v4.67H386c.59,0,2.53.36,2.53,3.21v4Z" style="fill:#fff"></path>
                                    <rect x="387.79" y="114.27" width="9.04" height="4.23" rx="0.49" style="fill:#c7c7c7"></rect>
                                    <polygon points="383.37 104.13 383.37 110.1 380.93 109.57 380.93 104.66 383.37 104.13" style="fill:#c7c7c7"></polygon>
                                    <path d="M392.31,127.51c4,0,6.35,5.69,6.35,13.4a50.68,50.68,0,0,1-1.36,11.46,2.63,2.63,0,0,1-2.56,2h-8.5a2.61,2.61,0,0,1-2.54-2c-1.06-4-3.07-13-.63-16.39,3.26-4.6,6.05-5.71,7.23-8.55Z" style="fill:#fff"></path>
                                    <path d="M408.69,159s-5.34-15.06-3.12-22.34c1.5-4.89,8.84-8.15,8.84-13.34v-5.65h6.36s11,23,1.86,41.33Z" style="fill:currentColor"></path>
                                    <rect x="413.02" y="118.65" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <rect x="413.02" y="120.56" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <rect x="413.02" y="122.47" width="7.93" height="1.91" rx="0.47" style="fill:currentColor"></rect>
                                    <path d="M409.92,109.45a4.72,4.72,0,0,1,.94,2.86c-.13,1.45-.8,2.81-.58,2.89a4.43,4.43,0,0,0,2.44-3,4.69,4.69,0,0,0-.18-2.7Z" style="fill:currentColor"></path>
                                    <path d="M421.39,116.67v-3.91a2.15,2.15,0,0,1,2.12-1.8c2.35,0,5.2,2.79,5.34,1.84s-1.47-8-7-8H408.72v4.67h2.67c.59,0,2.53.36,2.53,3.21v4Z" style="fill:#fff"></path>
                                    <rect x="413.14" y="114.27" width="9.04" height="4.23" rx="0.49" style="fill:#c7c7c7"></rect>
                                    <polygon points="408.72 104.13 408.72 110.1 406.27 109.57 406.27 104.66 408.72 104.13" style="fill:#c7c7c7"></polygon>
                                    <path d="M417.66,127.51c4,0,6.35,5.69,6.35,13.4a50.68,50.68,0,0,1-1.36,11.46,2.63,2.63,0,0,1-2.56,2h-8.51a2.63,2.63,0,0,1-2.54-2c-1.06-4-3.06-13-.63-16.39,3.27-4.6,6.06-5.71,7.24-8.55Z" style="fill:#fff"></path>
                                    <rect x="193.88" y="213.85" width="27.19" height="24.15" rx="4.56" style="fill:#fff"></rect>
                                    <rect x="196.96" y="210.82" width="21.03" height="3.02" style="fill:#a6a6a6"></rect>
                                    <rect x="193.88" y="219.71" width="27.37" height="12.44" style="fill:currentColor"></rect>
                                    <path d="M215.77,225.92c0,2.89-3.72,5.24-8.3,5.24s-8.29-2.35-8.29-5.24,3.71-5.23,8.29-5.23S215.77,223,215.77,225.92Z" style="fill:#fff"></path>
                                    <rect x="223.71" y="213.85" width="27.19" height="24.15" rx="4.56" style="fill:#fff"></rect>
                                    <rect x="226.79" y="210.82" width="21.03" height="3.02" style="fill:#a6a6a6"></rect>
                                    <rect x="223.71" y="219.71" width="27.37" height="12.44" style="fill:currentColor"></rect>
                                    <path d="M245.6,225.92c0,2.89-3.71,5.24-8.29,5.24s-8.3-2.35-8.3-5.24,3.72-5.23,8.3-5.23S245.6,223,245.6,225.92Z" style="fill:#fff"></path>
                                    <rect x="253.55" y="213.85" width="27.19" height="24.15" rx="4.56" style="fill:#fff"></rect>
                                    <rect x="256.63" y="210.82" width="21.03" height="3.02" style="fill:#a6a6a6"></rect>
                                    <rect x="253.55" y="219.71" width="27.37" height="12.44" style="fill:currentColor"></rect>
                                    <path d="M275.44,225.92c0,2.89-3.72,5.24-8.3,5.24s-8.29-2.35-8.29-5.24,3.71-5.23,8.29-5.23S275.44,223,275.44,225.92Z" style="fill:#fff"></path>
                                    <rect x="193.88" y="186.04" width="27.19" height="24.15" rx="4.56" style="fill:#fff"></rect>
                                    <rect x="196.96" y="183.01" width="21.03" height="3.02" style="fill:#a6a6a6"></rect>
                                    <rect x="193.88" y="191.89" width="27.37" height="12.44" style="fill:currentColor"></rect>
                                    <path d="M215.77,198.11c0,2.89-3.72,5.23-8.3,5.23s-8.29-2.34-8.29-5.23,3.71-5.23,8.29-5.23S215.77,195.22,215.77,198.11Z" style="fill:#fff"></path>
                                    <rect x="253.55" y="186.04" width="27.19" height="24.15" rx="4.56" style="fill:#fff"></rect>
                                    <rect x="256.63" y="183.01" width="21.03" height="3.02" style="fill:#a6a6a6"></rect>
                                    <rect x="253.55" y="191.89" width="27.37" height="12.44" style="fill:currentColor"></rect>
                                    <path d="M275.44,198.11c0,2.89-3.72,5.23-8.3,5.23s-8.29-2.34-8.29-5.23,3.71-5.23,8.29-5.23S275.44,195.22,275.44,198.11Z" style="fill:#fff"></path>
                                    <rect x="400.38" y="332.5" width="10.2" height="12.28" style="fill:currentColor"></rect>
                                    <path d="M427.94,386l-7.67-36.47a11.82,11.82,0,0,0-9.69-9.21,11.61,11.61,0,0,0-1.87-.16h-6.64a4.58,4.58,0,0,0-1.69.33,4.48,4.48,0,0,0-2.75,4.14V387a4.45,4.45,0,0,0,4.44,4.46h21.5A4.45,4.45,0,0,0,427.94,386Zm-13.31-33.42a2.56,2.56,0,0,1,.66-.07,3.13,3.13,0,0,1,3.06,2.46l3.22,14.59a3.13,3.13,0,0,1-6.12,1.32l-3.21-14.58A3.15,3.15,0,0,1,414.63,352.61Z" style="fill:#c7c7c7"></path>
                                    <path d="M403.5,346.22h3.93a2.44,2.44,0,0,1,2.37,3.14,15.63,15.63,0,0,0-.31,7.55c1.33,7.53,3.16,16.9,3.77,18.13.51,1,2.92,2.94,6.65,1.92a2.48,2.48,0,0,1,3.09,1.77l.83,3.45a2.46,2.46,0,0,1-2.39,3H403.5a2.46,2.46,0,0,1-2.46-2.46V348.68A2.46,2.46,0,0,1,403.5,346.22Z" style="fill:#fff"></path>
                                    <rect x="331.59" y="332.5" width="10.2" height="12.28" style="fill:currentColor"></rect>
                                    <path d="M359.15,386l-7.67-36.47a11.82,11.82,0,0,0-9.69-9.21,11.61,11.61,0,0,0-1.87-.16h-6.63a4.59,4.59,0,0,0-1.7.33,4.5,4.5,0,0,0-2.75,4.14V387a4.45,4.45,0,0,0,4.45,4.46h21.5A4.45,4.45,0,0,0,359.15,386Zm-13.31-33.42a2.63,2.63,0,0,1,.67-.07,3.12,3.12,0,0,1,3.05,2.46l3.22,14.59a3.13,3.13,0,1,1-6.12,1.32l-3.21-14.58A3.15,3.15,0,0,1,345.84,352.61Z" style="fill:#c7c7c7"></path>
                                    <path d="M334.71,346.22h3.94a2.44,2.44,0,0,1,2.36,3.14,15.63,15.63,0,0,0-.31,7.55c1.33,7.53,3.16,16.9,3.77,18.13.51,1,2.92,2.94,6.65,1.92a2.48,2.48,0,0,1,3.09,1.77l.83,3.45a2.46,2.46,0,0,1-2.39,3H334.71a2.46,2.46,0,0,1-2.46-2.46V348.68A2.46,2.46,0,0,1,334.71,346.22Z" style="fill:#fff"></path>
                                    <rect x="297.19" y="332.5" width="10.2" height="12.28" style="fill:currentColor"></rect>
                                    <path d="M324.76,386l-7.67-36.47a11.82,11.82,0,0,0-9.69-9.21,11.61,11.61,0,0,0-1.87-.16h-6.64a4.68,4.68,0,0,0-1.7.33,4.49,4.49,0,0,0-2.74,4.14V387a4.45,4.45,0,0,0,4.44,4.46h21.5A4.46,4.46,0,0,0,324.76,386Zm-13.32-33.42a2.63,2.63,0,0,1,.67-.07,3.11,3.11,0,0,1,3.05,2.46l3.23,14.59a3.14,3.14,0,0,1-6.13,1.32l-3.2-14.58A3.14,3.14,0,0,1,311.44,352.61Z" style="fill:#c7c7c7"></path>
                                    <path d="M300.32,346.22h3.93a2.44,2.44,0,0,1,2.36,3.14,15.66,15.66,0,0,0-.3,7.55c1.32,7.53,3.16,16.9,3.77,18.13.51,1,2.92,2.94,6.65,1.92a2.47,2.47,0,0,1,3.08,1.77l.84,3.45a2.46,2.46,0,0,1-2.39,3H300.32a2.46,2.46,0,0,1-2.46-2.46V348.68A2.46,2.46,0,0,1,300.32,346.22Z" style="fill:#fff"></path>
                                </g>
                                <g id="freepik--product-3--inject-23">
                                    <rect x="365.98" y="332.5" width="10.2" height="12.28" style="fill:#92B193"></rect>
                                    <path d="M393.55,386l-7.67-36.47a11.82,11.82,0,0,0-9.69-9.21,11.61,11.61,0,0,0-1.87-.16h-6.64a4.68,4.68,0,0,0-1.7.33,4.5,4.5,0,0,0-2.75,4.14V387a4.46,4.46,0,0,0,4.45,4.46h21.5A4.46,4.46,0,0,0,393.55,386Zm-13.32-33.42a2.63,2.63,0,0,1,.67-.07A3.11,3.11,0,0,1,384,355l3.23,14.59a3.14,3.14,0,0,1-6.13,1.32l-3.2-14.58A3.14,3.14,0,0,1,380.23,352.61Z" style="fill:#37474f"></path>
                                    <path d="M369.11,346.22H373a2.44,2.44,0,0,1,2.36,3.14,15.66,15.66,0,0,0-.3,7.55c1.32,7.53,3.16,16.9,3.77,18.13.51,1,2.92,2.94,6.64,1.92a2.48,2.48,0,0,1,3.09,1.77l.84,3.45a2.46,2.46,0,0,1-2.39,3H369.11a2.46,2.46,0,0,1-2.46-2.46V348.68A2.46,2.46,0,0,1,369.11,346.22Z" style="fill:#fff"></path>
                                    <path d="M378.44,405A43.06,43.06,0,1,1,421.5,362,43.11,43.11,0,0,1,378.44,405Zm0-84.12A41.06,41.06,0,1,0,419.5,362,41.11,41.11,0,0,0,378.44,320.9Z" style="fill:#263238"></path>
                                    <path d="M378.44,390.83A28.88,28.88,0,1,1,407.32,362,28.91,28.91,0,0,1,378.44,390.83Zm0-56.75A27.88,27.88,0,1,0,406.32,362,27.92,27.92,0,0,0,378.44,334.08Z" style="fill:#263238"></path>
                                    <rect x="377.44" y="319.9" width="2" height="8.24" style="fill:#263238"></rect>
                                    <rect x="336.38" y="360.96" width="8.24" height="2" style="fill:#263238"></rect>
                                    <rect x="377.44" y="395.78" width="2" height="8.24" style="fill:#263238"></rect>
                                    <rect x="412.26" y="360.96" width="8.24" height="2" style="fill:#263238"></rect>
                                    <rect x="374.32" y="361.46" width="8.24" height="1" style="fill:#263238"></rect>
                                    <rect x="377.94" y="357.84" width="1" height="8.24" style="fill:#263238"></rect>
                                </g>
                                <g id="freepik--product-2--inject-23">
                                    <rect x="223.71" y="186.04" width="27.19" height="24.15" rx="4.56" style="fill:#92B193"></rect>
                                    <rect x="223.71" y="186.04" width="27.19" height="24.15" rx="4.56" style="fill:#fff;opacity:0.7000000000000001"></rect>
                                    <rect x="226.79" y="183.01" width="21.03" height="3.02" style="fill:#37474f"></rect>
                                    <rect x="223.71" y="191.89" width="27.37" height="12.44" style="fill:#92B193"></rect>
                                    <path d="M245.6,198.11c0,2.89-3.71,5.23-8.29,5.23S229,201,229,198.11s3.72-5.23,8.3-5.23S245.6,195.22,245.6,198.11Z" style="fill:#fff"></path>
                                    <path d="M237.4,239.66a43.07,43.07,0,1,1,43.06-43.06A43.12,43.12,0,0,1,237.4,239.66Zm0-84.13a41.07,41.07,0,1,0,41.06,41.07A41.12,41.12,0,0,0,237.4,155.53Z" style="fill:#263238"></path>
                                    <path d="M237.4,225.47a28.88,28.88,0,1,1,28.87-28.87A28.9,28.9,0,0,1,237.4,225.47Zm0-56.75a27.88,27.88,0,1,0,27.87,27.88A27.91,27.91,0,0,0,237.4,168.72Z" style="fill:#263238"></path>
                                    <rect x="236.4" y="154.53" width="2" height="8.24" style="fill:#263238"></rect>
                                    <rect x="195.33" y="195.6" width="8.24" height="2" style="fill:#263238"></rect>
                                    <rect x="236.4" y="230.42" width="2" height="8.24" style="fill:#263238"></rect>
                                    <rect x="271.22" y="195.6" width="8.24" height="2" style="fill:#263238"></rect>
                                    <rect x="233.28" y="196.1" width="8.24" height="1" style="fill:#263238"></rect>
                                    <rect x="236.9" y="192.48" width="1" height="8.24" style="fill:#263238"></rect>
                                </g>
                                <g id="freepik--product-1--inject-23">
                                    <path d="M358,159s-5.35-15.06-3.12-22.34c1.49-4.89,8.84-8.15,8.84-13.34v-5.65h6.35s11,23,1.86,41.33Z" style="fill:#92B193"></path>
                                    <rect x="362.32" y="118.65" width="7.93" height="1.91" rx="0.47" style="fill:#92B193"></rect>
                                    <rect x="362.32" y="120.56" width="7.93" height="1.91" rx="0.47" style="fill:#92B193"></rect>
                                    <rect x="362.32" y="122.47" width="7.93" height="1.91" rx="0.47" style="fill:#92B193"></rect>
                                    <path d="M359.22,109.45a4.7,4.7,0,0,1,.95,2.86c-.14,1.45-.81,2.81-.59,2.89a4.41,4.41,0,0,0,2.44-3,4.69,4.69,0,0,0-.18-2.7Z" style="fill:#92B193"></path>
                                    <path d="M370.69,116.67v-3.91a2.16,2.16,0,0,1,2.12-1.8c2.35,0,5.21,2.79,5.34,1.84s-1.46-8-7-8H358v4.67h2.67c.59,0,2.53.36,2.53,3.21v4Z" style="fill:#fff"></path>
                                    <rect x="362.44" y="114.27" width="9.04" height="4.23" rx="0.49" style="fill:#263238"></rect>
                                    <polygon points="358.02 104.13 358.02 110.1 355.58 109.57 355.58 104.66 358.02 104.13" style="fill:#263238"></polygon>
                                    <path d="M367,127.51c4,0,6.36,5.69,6.36,13.4A50.57,50.57,0,0,1,372,152.37a2.61,2.61,0,0,1-2.56,2h-8.5a2.62,2.62,0,0,1-2.54-2c-1.06-4-3.07-13-.63-16.39,3.26-4.6,6-5.71,7.23-8.55Z" style="fill:#fff"></path>
                                    <path d="M366.25,174.64a43.07,43.07,0,1,1,43.06-43.06A43.12,43.12,0,0,1,366.25,174.64Zm0-84.13a41.07,41.07,0,1,0,41.06,41.07A41.12,41.12,0,0,0,366.25,90.51Z" style="fill:#263238"></path>
                                    <path d="M366.25,160.45a28.88,28.88,0,1,1,28.87-28.87A28.91,28.91,0,0,1,366.25,160.45Zm0-56.75a27.88,27.88,0,1,0,27.87,27.88A27.92,27.92,0,0,0,366.25,103.7Z" style="fill:#263238"></path>
                                    <rect x="365.25" y="89.51" width="2" height="8.24" style="fill:#263238"></rect>
                                    <rect x="324.18" y="130.58" width="8.24" height="2" style="fill:#263238"></rect>
                                    <rect x="365.25" y="165.4" width="2" height="8.24" style="fill:#263238"></rect>
                                    <rect x="400.07" y="130.58" width="8.24" height="2" style="fill:#263238"></rect>
                                    <rect x="362.13" y="131.08" width="8.24" height="1" style="fill:#263238"></rect>
                                    <rect x="365.75" y="127.46" width="1" height="8.24" style="fill:#263238"></rect>
                                </g>
                                <g id="freepik--shopping-cart--inject-23">
                                    <path d="M329.82,442.88H208.87a2.42,2.42,0,0,1-2.42-2.42V426h0s0-.09,0-.13a2,2,0,0,1,0-.26l14.62-53.7-19-117.4-26.45-8.95a2.41,2.41,0,1,1,1.36-4.63L205,250.34a2.4,2.4,0,0,1,1.71,1.95L226,371.63a2.46,2.46,0,0,1,0,.81l-14.19,51.45,112.67,8a2.51,2.51,0,0,1,1.64.79l5.55,6.15a2.42,2.42,0,0,1-1.79,4ZM211.28,438h113.1l-1.25-1.38-111.85-8Z" style="fill:#a6a6a6"></path>
                                    <path d="M196.92,244.31l-28.45-9.53c-6.88-2.3-9.83,8.56-3,10.85l28.45,9.52c6.88,2.31,9.83-8.55,3-10.84Z" style="fill:#92B193"></path>
                                    <path d="M348.71,354.14H221.33a.81.81,0,1,1,0-1.61H348.71a.81.81,0,1,1,0,1.61Z" style="fill:#a6a6a6"></path>
                                    <path d="M352,344.35H219.83a.81.81,0,1,1,0-1.61H352a.81.81,0,0,1,0,1.61Z" style="fill:#a6a6a6"></path>
                                    <path d="M355,334.55H218.33a.81.81,0,1,1,0-1.61H355a.81.81,0,0,1,0,1.61Z" style="fill:#a6a6a6"></path>
                                    <path d="M358.19,324.75H216.83a.81.81,0,1,1,0-1.61H358.19a.81.81,0,1,1,0,1.61Z" style="fill:#a6a6a6"></path>
                                    <path d="M361.29,315h-146a.81.81,0,1,1,0-1.61h146a.81.81,0,1,1,0,1.61Z" style="fill:#a6a6a6"></path>
                                    <path d="M364.61,305.16H213.83a.81.81,0,0,1,0-1.62H364.61a.81.81,0,0,1,0,1.62Z" style="fill:#a6a6a6"></path>
                                    <path d="M367.78,295.36H212.33a.81.81,0,1,1,0-1.61H367.78a.81.81,0,1,1,0,1.61Z" style="fill:#a6a6a6"></path>
                                    <path d="M234.56,366.43a.8.8,0,0,1-.8-.74L227.59,285a.8.8,0,0,1,.74-.86.84.84,0,0,1,.87.74l6.17,80.7a.82.82,0,0,1-.75.87Z" style="fill:#a6a6a6"></path>
                                    <path d="M334.44,361.17a.76.76,0,0,1-.21,0,.81.81,0,0,1-.57-1l20.51-75.44a.81.81,0,0,1,1.56.42l-20.52,75.44A.8.8,0,0,1,334.44,361.17Z" style="fill:#a6a6a6"></path>
                                    <path d="M247.43,365.83a.81.81,0,0,1-.8-.78l-2-80.11a.8.8,0,0,1,.79-.82h0a.81.81,0,0,1,.8.78l2,80.1a.81.81,0,0,1-.79.83Z" style="fill:#a6a6a6"></path>
                                    <path d="M260.64,365.12h0a.81.81,0,0,1-.79-.82l1.48-79.39a.81.81,0,0,1,.81-.79h0a.8.8,0,0,1,.79.82l-1.48,79.39A.8.8,0,0,1,260.64,365.12Z" style="fill:#a6a6a6"></path>
                                    <path d="M320.38,361.8l-.17,0a.8.8,0,0,1-.62-.95l15.58-76.07a.81.81,0,1,1,1.58.33l-15.58,76.07A.81.81,0,0,1,320.38,361.8Z" style="fill:#a6a6a6"></path>
                                    <path d="M304.36,362.76h-.13a.81.81,0,0,1-.66-.93l12.62-77a.8.8,0,0,1,1.58.26l-12.61,77A.81.81,0,0,1,304.36,362.76Z" style="fill:#a6a6a6"></path>
                                    <path d="M274.16,364.35h-.06a.81.81,0,0,1-.75-.86l5.89-78.63a.8.8,0,0,1,1.6.12L275,363.61A.8.8,0,0,1,274.16,364.35Z" style="fill:#a6a6a6"></path>
                                    <path d="M290,363.32h-.09a.81.81,0,0,1-.71-.89l8.63-77.6a.8.8,0,0,1,.89-.71.81.81,0,0,1,.71.89l-8.63,77.6A.79.79,0,0,1,290,363.32Z" style="fill:#a6a6a6"></path>
                                    <path d="M374.11,287.34h-163a2.42,2.42,0,1,1,0-4.83H374.11a2.42,2.42,0,1,1,0,4.83Z" style="fill:#a6a6a6"></path>
                                    <path d="M223.57,367.46a.82.82,0,0,1-.81-.77.8.8,0,0,1,.76-.84L346,359.29l24.12-74.61a.8.8,0,0,1,1.53.49l-24.29,75.15a.81.81,0,0,1-.72.55l-123,6.59Z" style="fill:#a6a6a6"></path>
                                    <circle cx="224.03" cy="445.25" r="9.51" style="fill:#263238"></circle>
                                    <path d="M228.35,445.25a4.32,4.32,0,1,1-4.32-4.32A4.32,4.32,0,0,1,228.35,445.25Z" style="fill:#a6a6a6"></path>
                                    <path d="M318.58,445.25a9.51,9.51,0,1,1-9.5-9.51A9.5,9.5,0,0,1,318.58,445.25Z" style="fill:#263238"></path>
                                    <path d="M313.4,445.25a4.32,4.32,0,1,1-4.32-4.32A4.32,4.32,0,0,1,313.4,445.25Z" style="fill:#a6a6a6"></path>
                                </g>
                                <g id="freepik--Character--inject-23">
                                    <path d="M51.14,387.49s-1.07,42.32-1.07,42.34c0,7.83.19,14.68.6,18.22a.13.13,0,0,0,0,.06,5.43,5.43,0,0,0,.58,2.42l.05,0c2.33,1.57,64.85,3.2,67.05,2.52s.44-7-1.94-9-26-13.32-26-13.32l.68-42.3Z" style="fill:#d3766a"></path>
                                    <path d="M50,421.44s.07,8.37.07,8.39c0,7.83.19,14.68.6,18.22a.13.13,0,0,0,0,.06,11.12,11.12,0,0,0,.58,2.42l.05,0c2.33,1.57,64.85,3.2,67.05,2.52s.44-7-1.94-9-26-13.32-26-13.32l.05-8.53Z" style="fill:#fff"></path>
                                    <path d="M94.21,430.79c-4.16-.69-9.22.06-12.33,3.08-.12.12.05.29.18.24a59.36,59.36,0,0,1,12.15-2.8A.26.26,0,0,0,94.21,430.79Z" style="fill:#263238"></path>
                                    <path d="M97.24,432.53c-4.16-.69-9.22.06-12.33,3.08-.12.12,0,.29.19.24a59.11,59.11,0,0,1,12.14-2.8A.26.26,0,0,0,97.24,432.53Z" style="fill:#263238"></path>
                                    <path d="M100.27,434.27c-4.16-.69-9.22.06-12.32,3.08-.12.12,0,.29.18.24a59.11,59.11,0,0,1,12.14-2.8A.26.26,0,0,0,100.27,434.27Z" style="fill:#263238"></path>
                                    <path d="M118.36,453.09c-2.2.68-64.72-.94-67-2.52-.9-.58-1.2-9.7-1.24-20.73v-.35l40.35.6,0,.68s23.65,11.32,26,13.33S120.56,452.42,118.36,453.09Z" style="fill:#37474f"></path>
                                    <path d="M50.07,429.48v.36c0,11,.33,20.15,1.24,20.73s14.6,1.44,29.25,2c17.52.62,36.6.93,37.8.56,2.2-.68.43-7-1.94-9s-26-13.32-26-13.32l0-.68L77,429.89Z" style="fill:#92B193"></path>
                                    <path d="M117.71,450.65c-10.53-.53-53-1.69-63.5-1.41-.09,0-.09.06,0,.06,10.42.76,53,1.57,63.5,1.52C117.93,450.82,117.94,450.66,117.71,450.65Z" style="fill:#263238"></path>
                                    <path d="M77,429.89c1,6.76,2.49,16.71,3.6,22.65,17.52.62,36.6.93,37.8.56,2.2-.68.43-7-1.94-9s-26-13.32-26-13.32l0-.68Z" style="opacity:0.1"></path>
                                    <path d="M46.43,430.07l45.24.43s2.57-73.66,2.76-98.22c.23-28.06-1.36-112.22-1.36-112.22H59.24s-9.07,18.55-3.89,39.42l1.44,75.09Z" style="fill:#263238"></path>
                                    <path d="M49.79,422.14a33.16,33.16,0,0,1,3.6-.28c1.34-.1,2.67-.2,4-.25,2.57-.11,5.15-.16,7.72-.17,5.2,0,10.39,0,15.58.19,3,.09,5.91.2,8.86.37a.1.1,0,0,1,0,.19c-5.15.19-10.31.27-15.46.37s-10.3.2-15.44.1c-1.48,0-2.95,0-4.43-.13s-3,0-4.42-.21C49.72,422.31,49.68,422.16,49.79,422.14Z" style="fill:#37474f"></path>
                                    <path d="M88.41,381.49c.53-12.18.92-24.37,1.25-36.55q1-36.57.53-73.14c-.17-13.68-.54-27.35-.94-41,0-.15.23-.14.24,0,1.29,24.48,1.78,49,1.81,73.51s-.48,48.77-1.68,73.13c-.68,13.66-1.51,27.34-2.8,41,0,.11-.19.11-.18,0C87.19,406.08,87.88,393.79,88.41,381.49Z" style="fill:#37474f"></path>
                                    <path d="M99.53,394.21s.35,40.9.35,40.93c0,7.82.19,14.68.6,18.22a.13.13,0,0,0,0,.06,5.37,5.37,0,0,0,.58,2.41l.05.05c2.33,1.57,64.85,3.19,67,2.52s.44-7-1.94-9-26-13.33-26-13.33l-.73-40.88Z" style="fill:#d3766a"></path>
                                    <path d="M99.81,426.74s.07,8.37.07,8.4c0,7.82.19,14.68.6,18.22a.13.13,0,0,0,0,.06,10.78,10.78,0,0,0,.58,2.41l.05.05c2.33,1.57,64.85,3.19,67,2.52s.44-7-1.94-9-26-13.33-26-13.33l0-8.52Z" style="fill:#fff"></path>
                                    <path d="M144,436.1c-4.16-.69-9.22.06-12.33,3.08-.12.11.05.28.18.24a58.07,58.07,0,0,1,12.15-2.8A.26.26,0,0,0,144,436.1Z" style="fill:#263238"></path>
                                    <path d="M147.05,437.84c-4.16-.69-9.22.06-12.33,3.08-.12.11.05.28.19.24a57.84,57.84,0,0,1,12.14-2.8A.26.26,0,0,0,147.05,437.84Z" style="fill:#263238"></path>
                                    <path d="M150.08,439.58c-4.16-.69-9.22.06-12.32,3.08-.12.11,0,.28.18.24a57.84,57.84,0,0,1,12.14-2.8A.26.26,0,0,0,150.08,439.58Z" style="fill:#263238"></path>
                                    <path d="M168.17,458.4c-2.2.68-64.72-.95-67-2.52-.9-.58-1.2-9.71-1.24-20.74v-.34l40.35.59,0,.69s23.65,11.32,26,13.32S170.37,457.73,168.17,458.4Z" style="fill:#92B193"></path>
                                    <path d="M167.52,456c-10.53-.54-53.05-1.69-63.5-1.42-.09,0-.09.06,0,.07,10.42.76,53,1.56,63.5,1.52C167.74,456.13,167.75,456,167.52,456Z" style="fill:#263238"></path>
                                    <path d="M78.87,263.36s18.55,58.49,18.89,69.24c.29,9.17-.89,103.22-.89,103.22l47,.28s-4-95.91-4.7-105.47c-1.37-17.86-17-66.89-28.21-110.57H60.29s.45,22.88,10.85,39.42C71.14,259.48,75.85,261.66,78.87,263.36Z" style="fill:#263238"></path>
                                    <path d="M99.37,427.16c5.43-.16,11-.32,16.48-.19s10.78.22,16.16.54c3.05.18,6.09.28,9.14.59a.08.08,0,0,1,0,.16c-5.42.31-10.87.25-16.3.2s-10.77-.1-16.16-.35c-3.05-.14-6.09-.3-9.14-.51C99.21,427.58,99,427.17,99.37,427.16Z" style="fill:#37474f"></path>
                                    <path d="M109.64,247.62c1.68,5.59,3.09,11.26,4.59,16.9s3,11.37,4.51,17.06c2.9,11,5.76,22,7.93,33.2a200.49,200.49,0,0,1,3.76,34c.25,11.65,0,23.31-.08,35s-.17,23.42-.38,35.12c0,1.46-.05,2.92-.11,4.37a.1.1,0,0,1-.21,0c-.32-11.65-.15-23.32-.11-35s.19-23.31.09-35a208.82,208.82,0,0,0-3-34.5c-2-11.21-4.72-22.26-7.59-33.27-1.63-6.28-3.28-12.56-4.91-18.84s-3.39-12.63-4.84-19A.18.18,0,0,1,109.64,247.62Z" style="fill:#37474f"></path>
                                    <path d="M90.48,264.49a41.72,41.72,0,0,1-7-.63A68.32,68.32,0,0,1,76.75,262a52.94,52.94,0,0,0-6.63-1.08A23.27,23.27,0,0,1,63.63,259c-.1,0-.18.1-.09.15a41.87,41.87,0,0,0,6.23,2.7c2.23.7,4.56.8,6.82,1.35a56.89,56.89,0,0,0,7,1.6,25,25,0,0,0,7-.12C90.6,264.63,90.57,264.49,90.48,264.49Z" style="fill:#37474f"></path>
                                    <path d="M93.45,311c-.45-1.73-.87-3.47-1.34-5.2-1-3.49-1.91-7-3-10.45-2.09-6.88-4.07-13.8-6.29-20.64-1.26-3.88-2.39-7.81-3.86-11.62a.08.08,0,0,0-.15.05c.74,3.55,1.79,7,2.73,10.52s1.94,7,3,10.45c2,6.91,4,13.83,6.16,20.69.61,1.92,1.24,3.84,1.9,5.74s1.21,4,2,5.85a.08.08,0,1,0,.16-.05C94.46,314.56,93.9,312.79,93.45,311Z" style="fill:#37474f"></path>
                                    <path d="M97.33,162.36c7.71,4.65,37,20.44,49.29,18.37,8.27-1.39,28.71-21,32.46-27.61,1.53-2.7-18-18.79-20.77-16.93-3,2-16.46,20.51-18.83,21.23s-24.47-2.79-37.27-3.26C94.55,153.89,93,159.74,97.33,162.36Z" style="fill:#d3766a"></path>
                                    <path d="M174.58,158.7c4.28-3.76,15.48-20,17-23.65s5-14.59,2.32-16-4,1.68-4,1.68.91-5.28-2.09-6c-2.39-.6-4.44,3.69-4.44,3.69s.7-5.85-2.37-6.21c-2.8-.33-3.84,4.85-3.84,4.85s.08-5-2.67-4.75c-3.32.24-3.47,8.81-5.42,12.76-.45.89-16.93,18.21-16.93,18.21Z" style="fill:#d3766a"></path>
                                    <path d="M177,116.83c-.77,6.4-1.27,9-4.69,14.21-.06.1.07.23.15.13,3.81-4.77,4.63-7.85,4.84-14.35C177.26,116.5,177,116.53,177,116.83Z" style="fill:#263238"></path>
                                    <path d="M183.29,118.38c-.7,6.54-2,9.4-5.2,15.09,0,.08.09.17.14.09,3.59-5.32,5.44-8.58,5.28-15.2C183.5,118.06,183.33,118.09,183.29,118.38Z" style="fill:#263238"></path>
                                    <path d="M189.73,121c-1.14,6.27-2.33,9.6-6.12,14.72a.12.12,0,1,0,.18.15c4.37-4.85,5.89-9,6.12-14.82C189.93,120.65,189.8,120.6,189.73,121Z" style="fill:#263238"></path>
                                    <path d="M152.12,143.23s3-6.83,4.33-10.14,3.62-13.17,6.55-14c3.28-1,4.05,8.22,1.81,14.15,0,0,8.24,6.35,6.35,12.15-.41,1.25-4.86,6.38-6.36,6.62Z" style="fill:#d3766a"></path>
                                    <path d="M164.79,133.88c3.3,2.36,6.55,6.6,6.31,10.64a.09.09,0,0,0,.18,0c.85-4.29-2.87-9.23-5.94-11.16C164.75,133,163.94,133.27,164.79,133.88Z" style="fill:#263238"></path>
                                    <path d="M152.11,143.07l22.83,15.61s.53,3.21-3,6.61-18.6,16.1-26.35,16.32S111.93,172.17,99.29,164s.72-10.52,3.5-10.33,35.7,3,36.69,2.64,5.68-7.74,8.18-10.41S152.11,143.07,152.11,143.07Z" style="fill:#92B193"></path>
                                    <path d="M94.45,156.61l0,0a2.26,2.26,0,0,0-.28.5l.05,0a7.9,7.9,0,0,0,2.1.78A7.89,7.89,0,0,0,94.45,156.61Zm53,2.57a8.47,8.47,0,0,0-2.11-.78,7.93,7.93,0,0,0,1.83,1.3,8.47,8.47,0,0,0,2.11.78A7.93,7.93,0,0,0,147.46,159.18Zm-20.67,16.26a7.57,7.57,0,0,0-2.1-.78,8.69,8.69,0,0,0,3.93,2.07A7.89,7.89,0,0,0,126.79,175.44Zm18.43,2.61a8.26,8.26,0,0,0-2.1-.78,7.93,7.93,0,0,0,1.83,1.3,8.26,8.26,0,0,0,2.1.78A7.93,7.93,0,0,0,145.22,178.05Zm-8-9.83a7.57,7.57,0,0,0-.78,2.1,7.6,7.6,0,0,0,1.29-1.83,7.51,7.51,0,0,0,.78-2.11A8.26,8.26,0,0,0,137.26,168.22Zm-20.11-11.63a8,8,0,0,0-2,.93,7.76,7.76,0,0,0,2.21-.38,8.3,8.3,0,0,0,2-.93A7.7,7.7,0,0,0,117.15,156.59Zm36.07-9.05a7.68,7.68,0,0,0-.94-2,8.61,8.61,0,0,0,1.32,4.25A8.06,8.06,0,0,0,153.22,147.54Zm.73,22.69a8.3,8.3,0,0,0-.93-2,7.83,7.83,0,0,0,.38,2.22,8.07,8.07,0,0,0,.93,2A7.82,7.82,0,0,0,154,170.23Zm-49-16.35-.58,0a6.63,6.63,0,0,0,.79,1.63A6.84,6.84,0,0,0,105,153.88Zm29.68,3.39a7.51,7.51,0,0,0-2.11-.78,8.79,8.79,0,0,0,3.94,2.07A7.6,7.6,0,0,0,134.67,157.27Zm-25.24,5.14a7.57,7.57,0,0,0-2.1-.78,7.89,7.89,0,0,0,1.83,1.29,7.57,7.57,0,0,0,2.1.78A7.89,7.89,0,0,0,109.43,162.41Zm51.55-2a8.26,8.26,0,0,0-.78,2.1,7.72,7.72,0,0,0,1.3-1.83,8.26,8.26,0,0,0,.78-2.1A7.93,7.93,0,0,0,161,160.39Zm6.49,8.32a4.49,4.49,0,0,0,.64,0l.8-.68A7.18,7.18,0,0,0,167.47,168.71Zm4.37-10.9a7.81,7.81,0,0,0-.79-1.78h0a1.2,1.2,0,0,0-.15-.24.76.76,0,0,0,0,.15,8.24,8.24,0,0,0,.37,2.06,8,8,0,0,0,.94,2A7.83,7.83,0,0,0,171.84,157.81Zm-48.9,7.72a7.75,7.75,0,0,0-.78,2.11,7.46,7.46,0,0,0,1.29-1.84,7.57,7.57,0,0,0,.78-2.1A8.2,8.2,0,0,0,122.94,165.53Z" style="fill:#fff"></path>
                                    <g style="opacity:0.1">
                                        <path d="M152.11,143.07l22.83,15.61s.53,3.21-3,6.61-18.6,16.1-26.35,16.32S111.93,172.17,99.29,164s.72-10.52,3.5-10.33,35.7,3,36.69,2.64,5.68-7.74,8.18-10.41S152.11,143.07,152.11,143.07Z"></path>
                                    </g>
                                    <path d="M50.68,234.69c.14.18,67.33,4.3,68,3.65.91-.92-11.34-71.34-15.33-82-1.69-4.53-12.38-6.54-17.16-3.09-12,8.63-23.61,40.07-26.43,49.58C55.06,218.53,50.16,234,50.68,234.69Z" style="fill:#92B193"></path>
                                    <path d="M94.45,156.61a7.57,7.57,0,0,0-2.1-.78,8.69,8.69,0,0,0,3.93,2.07A7.89,7.89,0,0,0,94.45,156.61Zm-7.36,38.27a7.57,7.57,0,0,0-2.1-.78,8.69,8.69,0,0,0,3.93,2.07A8.2,8.2,0,0,0,87.09,194.88Zm6.47,28.61a7.9,7.9,0,0,0-2.1-.78,8.69,8.69,0,0,0,3.93,2.07A8.2,8.2,0,0,0,93.56,223.49ZM70.68,179.67A8.22,8.22,0,0,0,69,179a1.3,1.3,0,0,0-.08.17,8,8,0,0,0,1.55,1,7.57,7.57,0,0,0,2.1.78A7.74,7.74,0,0,0,70.68,179.67Zm40,26.93a7.84,7.84,0,0,0-2.11-.78,7.65,7.65,0,0,0,1.84,1.29,7.57,7.57,0,0,0,2.1.78A8.2,8.2,0,0,0,110.69,206.6ZM72.88,220.8a7.57,7.57,0,0,0-2.1-.78,8.69,8.69,0,0,0,3.93,2.07A7.6,7.6,0,0,0,72.88,220.8Zm32.57-40.36a7.57,7.57,0,0,0-2.1-.78,8.69,8.69,0,0,0,3.93,2.07A8.2,8.2,0,0,0,105.45,180.44Zm-6.31-12.63a7.57,7.57,0,0,0-.78,2.1,8.69,8.69,0,0,0,2.07-3.93A7.6,7.6,0,0,0,99.14,167.81Zm10.46,59.27a7.57,7.57,0,0,0-.78,2.1,8.66,8.66,0,0,0,2.07-3.94A7.85,7.85,0,0,0,109.6,227.08Zm-25-13.7a8.19,8.19,0,0,0-.78,2.11,8,8,0,0,0,1.3-1.84,8.26,8.26,0,0,0,.78-2.1A7.93,7.93,0,0,0,84.57,213.38Zm13-23.89a7.57,7.57,0,0,0-.78,2.1,8.69,8.69,0,0,0,2.07-3.93A7.89,7.89,0,0,0,97.56,189.49Zm-37.05,37a8.26,8.26,0,0,0-.78,2.1,7.93,7.93,0,0,0,1.3-1.83,8.26,8.26,0,0,0,.78-2.1A7.93,7.93,0,0,0,60.51,226.51Zm2.89-28.1a7.57,7.57,0,0,0-.78,2.1,7.89,7.89,0,0,0,1.29-1.83,7.75,7.75,0,0,0,.78-2.11A7.74,7.74,0,0,0,63.4,198.41Zm13-29.94a8.26,8.26,0,0,0-.78,2.1,7.93,7.93,0,0,0,1.3-1.83,8.26,8.26,0,0,0,.78-2.1A7.93,7.93,0,0,0,76.38,168.47Zm9.76-5.53a7.83,7.83,0,0,0-2,.94,8.45,8.45,0,0,0,2.21-.38,7.68,7.68,0,0,0,2-.94A7.76,7.76,0,0,0,86.14,162.94Zm15.59,52.47a7.83,7.83,0,0,0-2,.94,8.45,8.45,0,0,0,2.21-.38,7.68,7.68,0,0,0,2-.94A7.76,7.76,0,0,0,101.73,215.41ZM73.3,235.46a8.65,8.65,0,0,0-1.49.61l.42,0,.77.05h0c.16-.05.28-.1.44-.14a8,8,0,0,0,2-.94A7.77,7.77,0,0,0,73.3,235.46Zm.88-27.92a8,8,0,0,0-2,.93,8.61,8.61,0,0,0,4.25-1.32A8.07,8.07,0,0,0,74.18,207.54ZM83.4,184a7.68,7.68,0,0,0-2,.94,8.07,8.07,0,0,0,2.21-.39,7.35,7.35,0,0,0,2-.93A7.7,7.7,0,0,0,83.4,184Zm27.06,10.22a8.14,8.14,0,0,0-.93-2,7.7,7.7,0,0,0,.38,2.21,8,8,0,0,0,.93,2A7.76,7.76,0,0,0,110.46,194.2ZM84.17,229.57a7.77,7.77,0,0,0-.94-2,8.6,8.6,0,0,0,.38,2.21,7.77,7.77,0,0,0,.94,2A7.82,7.82,0,0,0,84.17,229.57ZM61.28,212.8a8,8,0,0,0-.93-2,7.76,7.76,0,0,0,.38,2.21,8,8,0,0,0,.93,2A7.7,7.7,0,0,0,61.28,212.8Zm12.25-18.28a7.83,7.83,0,0,0-.94-2,8.45,8.45,0,0,0,.38,2.21,7.68,7.68,0,0,0,.94,2A7.76,7.76,0,0,0,73.53,194.52Zm26,40.55a8.17,8.17,0,0,0-.94-2,8.61,8.61,0,0,0,1.32,4.25A8.53,8.53,0,0,0,99.56,235.07Zm-3.65-30.94a8.54,8.54,0,0,0-.94-2,8.61,8.61,0,0,0,1.32,4.25A8.53,8.53,0,0,0,95.91,204.13Zm-4-28.52a7.68,7.68,0,0,0-.94-2,8.45,8.45,0,0,0,.38,2.21,7.68,7.68,0,0,0,.94,2A7.7,7.7,0,0,0,91.87,175.61Z" style="fill:#fff"></path>
                                    <path d="M103.6,157.51a0,0,0,0,0,0,0c0,3.06-.19,10.14-5,9.42a10.21,10.21,0,0,1-5-2.87,27.2,27.2,0,0,1-3.8-4.36,39.45,39.45,0,0,1-3.46-5.51c0-.09-.16,0-.12.07,1,1.93,1.85,3.93,3,5.76a23.37,23.37,0,0,0,4.1,4.82,10.16,10.16,0,0,0,5.33,2.84,3.87,3.87,0,0,0,4.1-2.67A17,17,0,0,0,103.6,157.51Z" style="fill:#263238"></path>
                                    <path d="M99.06,163.7c-3.46.13-8.78-6.61-10.21-11.15-.1-.31.92-3.18,2-6.74.65-2.15,1.31-4.57,1.75-6.82L106,145.21a36.46,36.46,0,0,0-3.07,8.37,5.23,5.23,0,0,0-.09.94,1,1,0,0,1,0,.16C102.78,156.49,102.4,163.57,99.06,163.7Z" style="fill:#d3766a"></path>
                                    <path d="M102.85,154.52a.86.86,0,0,1,0,.15,9.09,9.09,0,0,1-1.46-.2c-8.13-1.8-8.07-12.17-7.89-15.06L96.84,141l9.17,4.24a36.46,36.46,0,0,0-3.07,8.37A5.23,5.23,0,0,0,102.85,154.52Z" style="fill:#263238"></path>
                                    <path d="M88.09,126.82c-.39,5.42,5.63,19.48,10,21.93,6.31,3.55,15,2.05,17.58-5.16,2.52-7-5.65-25.16-10.36-27.22C98.36,113.35,88.67,118.8,88.09,126.82Z" style="fill:#d3766a"></path>
                                    <path d="M90.21,136.23c2.06,5.44,5.26,11.06,7.86,12.52,6.31,3.55,15,2.05,17.59-5.16.92-2.58.4-6.66-.87-10.9,0,.21.18,3.49-1.53,4.26a2.58,2.58,0,0,1-3-.62l-1.27,0a8.87,8.87,0,0,1-5.52,3A10.46,10.46,0,0,1,95,137.21c-1.59-1.44-1.72-2.13-1.72-2.13Z" style="fill:#263238;opacity:0.2"></path>
                                    <path d="M103.86,132.73s0,.08,0,.12c.43.94.76,2.08,0,2.76,0,0,0,.06,0,0C104.88,135.07,104.42,133.55,103.86,132.73Z" style="fill:#263238"></path>
                                    <path d="M102.6,132.1c-1.58.53-.4,3.64,1.06,3.15S103.92,131.66,102.6,132.1Z" style="fill:#263238"></path>
                                    <path d="M100.83,130.39a12.86,12.86,0,0,0,1-.88,2.14,2.14,0,0,0,.89-1.1.7.7,0,0,0-.4-.75,1.74,1.74,0,0,0-1.71.45,2.54,2.54,0,0,0-1,1.56A.75.75,0,0,0,100.83,130.39Z" style="fill:#263238"></path>
                                    <path d="M111.15,128.48a12.54,12.54,0,0,1-1.36.14,2.19,2.19,0,0,1-1.41-.11.71.71,0,0,1-.27-.82,1.76,1.76,0,0,1,1.51-.92,2.61,2.61,0,0,1,1.81.36A.76.76,0,0,1,111.15,128.48Z" style="fill:#263238"></path>
                                    <path d="M106.74,141.9a1.58,1.58,0,0,0,1,.26,2.83,2.83,0,0,0,.94-.63s.07,0,.06,0a1.38,1.38,0,0,1-1,1,1.1,1.1,0,0,1-1.07-.57S106.7,141.88,106.74,141.9Z" style="fill:#263238"></path>
                                    <path d="M106.67,138.63a3.51,3.51,0,0,0,2.74.64,4.68,4.68,0,0,0,1.2-.39l.21-.11.2-.12a.23.23,0,0,0,.11-.28h0a.24.24,0,0,0,0-.1h0l0-.09c-.26-.75-.76-1.85-.76-1.85.32,0,1.94.14,1.77-.24a52.21,52.21,0,0,0-5-9.45.09.09,0,0,0-.16.09c1.23,3.07,3,5.9,4.27,9a6.38,6.38,0,0,0-1.73.11c-.09.07,1,2.11,1.09,2.46a.06.06,0,0,1,0,0,4.88,4.88,0,0,1-3.8.22C106.63,138.49,106.58,138.58,106.67,138.63Z" style="fill:#263238"></path>
                                    <path d="M110.13,138.89a4.07,4.07,0,0,1-1.19,1.68,1.82,1.82,0,0,1-1,.39c-.83,0-1.06-.67-1.11-1.32a4.62,4.62,0,0,1,.07-1A5.29,5.29,0,0,0,110.13,138.89Z" style="fill:#263238"></path>
                                    <path d="M108.94,140.57a1.82,1.82,0,0,1-1,.39c-.83,0-1.06-.67-1.11-1.32A1.91,1.91,0,0,1,108.94,140.57Z" style="fill:#ff98b9"></path>
                                    <path d="M111.91,129a3.41,3.41,0,0,0-.81.29,3.29,3.29,0,0,0-.72.52,2.51,2.51,0,0,0-.52.76,1.94,1.94,0,0,0-.15.95l0,.59.47-.37a5.68,5.68,0,0,1,1.05-.67,2.59,2.59,0,0,1,1.25-.29,1.88,1.88,0,0,0-1.4-.14,3.58,3.58,0,0,0-1.29.62l.5.22a2.16,2.16,0,0,1,.45-1.33A6.87,6.87,0,0,1,111.91,129Z" style="fill:#263238"></path>
                                    <path d="M111.75,131.91a5.07,5.07,0,0,1-1.33.27c-.11,0-.55,0-.57-.1a2.58,2.58,0,0,1-.15-.65,1.56,1.56,0,0,0,0,.71.89.89,0,0,0,.7.25A2.83,2.83,0,0,0,111.75,131.91Z" style="fill:#263238"></path>
                                    <path d="M92.27,138.16c2.72-.88.7-7.58.7-7.58s4-1.86,4.59-8.2c0,0,6.32,2,10.66,0,6.81-3.16,4.21-12.4,1-13.59-4.49-1.7-10.22,4-10.22,4s-11-.19-12.21,7.52a5.41,5.41,0,0,0-3.51,6.5C84.31,131.87,90.23,138.82,92.27,138.16Z" style="fill:#263238"></path>
                                    <path d="M92.18,131.63a9.68,9.68,0,0,0,4.58-4.31,7.24,7.24,0,0,0,0-6.67c-.06-.11.12-.2.18-.09a8.33,8.33,0,0,1,.62,7.07,6.76,6.76,0,0,1-5.31,4.2A.11.11,0,0,1,92.18,131.63Z" style="fill:#263238"></path>
                                    <path d="M82.19,123.9c.94-2.15,3-3,5.16-3.46.12,0,.16.17,0,.19a6.08,6.08,0,0,0-4.54,4.24c-.63,1.95.16,4,1.07,5.74a15.43,15.43,0,0,0,8.23,7.31,0,0,0,1,1,0,.09,15.35,15.35,0,0,1-9.17-8C82.08,128.2,81.32,125.88,82.19,123.9Z" style="fill:#263238"></path>
                                    <path d="M98.84,113.15a7.25,7.25,0,0,1,3.15-4,8.64,8.64,0,0,1,6.08-.94,4.87,4.87,0,0,1,3.52,3.38,8.6,8.6,0,0,1-.5,5.76c0,.05-.1,0-.08,0a8.62,8.62,0,0,0,.22-5.17,4.51,4.51,0,0,0-3.56-3.18c-3.27-.54-7.5.79-8.65,4.28A.1.1,0,0,1,98.84,113.15Z" style="fill:#263238"></path>
                                    <path d="M94,138.05s-4.48-3.89-6.33-2.19,2.34,7.94,5.08,8.25a2.64,2.64,0,0,0,3.09-2.23Z" style="fill:#d3766a"></path>
                                    <path d="M88.87,137.62a0,0,0,0,0,0,.07c1.94.28,3.28,1.68,4.35,3.21A1.46,1.46,0,0,0,91,141a.05.05,0,0,0,.07.08,1.64,1.64,0,0,1,1.87.12,8.3,8.3,0,0,1,1.17,1.2c.13.13.39,0,.28-.19l0,0C93.87,140,91.34,137.25,88.87,137.62Z" style="fill:#263238"></path>
                                    <polygon points="151.18 133.72 110.74 136.97 109.54 127.82 149.44 120.47 151.18 133.72" style="fill:#263238"></polygon>
                                    <polygon points="174.18 134.46 133.59 136.56 131.71 122.29 171.45 113.79 174.18 134.46" style="fill:#37474f"></polygon>
                                    <polygon points="193.94 136.74 162.83 136.07 160.07 115.18 189.95 106.46 193.94 136.74" style="fill:#455a64"></polygon>
                                    <path d="M194,121.33c1,7.63.89,13.94-.25,14.1s-2.89-5.92-3.9-13.56-.89-14,.25-14.1S193,113.69,194,121.33Z" style="fill:#92B193"></path>
                                    <path d="M89.18,172.14c13.55,12.51,48.56,32.22,55.79,28.7,13.32-6.49,16-46.05,17.24-53.78.54-3.3-27.6-3.66-28.24-.15-.56,3.06-.48,23.76-3,24.67-1,.38-16.79-4.86-34.47-7.7C83,161.7,85.18,168.44,89.18,172.14Z" style="fill:#d3766a"></path>
                                    <path d="M133.55,153.33s.48-3.25-.71-11.18c-.93-6.2,1.2-21.41,16.25-30.56,5.76-3.51,10.74-1,5.4,3.71-3.77,3.32-6.66,5.29-7.58,6.72,0,0,7.66-.39,10.42,3.1a81.57,81.57,0,0,1,6.54,9.65,17.44,17.44,0,0,1-1.69,1.38,9.35,9.35,0,0,1,.17,10l-.88,6.8Z" style="fill:#d3766a"></path>
                                    <path d="M133.72,136.58c1.7-2.81,5.4-8.7,10.11-12.47,5.23-4.19,16.43-10.84,19.48-7,2.23,2.85-1.82,5.77-1.82,5.77s5.21-1.77,6.67,1.25c1.32,2.75-1.95,4.81-1.95,4.81s3.35-.53,4.12,2.37c.92,3.48-6.24,4-8.35,8.37C161.5,140.7,133.72,136.58,133.72,136.58Z" style="fill:#d3766a"></path>
                                    <path d="M147.33,130.37a26.68,26.68,0,0,1,14-7.49c.14,0,.23.07.11.11a65.78,65.78,0,0,0-14.1,7.43S147.31,130.4,147.33,130.37Z" style="fill:#263238"></path>
                                    <path d="M151.71,135.53c2-1.88,8.35-5.95,14.45-6.65.14,0,.22.08.1.12a70.15,70.15,0,0,0-14.51,6.58S151.69,135.55,151.71,135.53Z" style="fill:#263238"></path>
                                    <path d="M161.88,149.75c0-1.23.09-2.45.19-3.67V146l.05-.08a10,10,0,0,0,1.16-3.79,11.25,11.25,0,0,0-.37-4l0-.17.11-.09a11.16,11.16,0,0,1,2.59-1.68c-.4.32-.79.64-1.16,1s-.74.69-1.08,1.05l.06-.26a9.12,9.12,0,0,1,.57,2.06,8.67,8.67,0,0,1,.07,2.16,8.94,8.94,0,0,1-.46,2.11,7.23,7.23,0,0,1-1,1.94l0-.13C162.41,147.35,162.18,148.56,161.88,149.75Z" style="fill:#263238"></path>
                                    <path d="M133.55,153.33l27.92-.42s5.12,5.08,3.87,10.39-12,36.63-21.31,38.24-41.72-17.29-52.66-26.65-8.76-13.28,5.7-11.79,33.55,7.7,33.86,7.56-1-7.41-.83-10.3S133.55,153.33,133.55,153.33Z" style="fill:#92B193"></path>
                                    <path d="M158.1,179.57a6,6,0,0,0,1.1.86c.07-.15.13-.31.2-.46A6.14,6.14,0,0,0,158.1,179.57Zm-10.64-20.39a8.47,8.47,0,0,0-2.11-.78,7.93,7.93,0,0,0,1.83,1.3,8.47,8.47,0,0,0,2.11.78A7.93,7.93,0,0,0,147.46,159.18Zm-20.67,16.26a7.57,7.57,0,0,0-2.1-.78,8.69,8.69,0,0,0,3.93,2.07A7.89,7.89,0,0,0,126.79,175.44Zm18.43,2.61a8.26,8.26,0,0,0-2.1-.78,7.93,7.93,0,0,0,1.83,1.3,8.26,8.26,0,0,0,2.1.78A7.93,7.93,0,0,0,145.22,178.05Zm-19.91,13.41a7.57,7.57,0,0,0-.78,2.1,8.69,8.69,0,0,0,2.07-3.93A8.2,8.2,0,0,0,125.31,191.46ZM151.07,187a7.57,7.57,0,0,0-.78,2.1,8.69,8.69,0,0,0,2.07-3.93A8.2,8.2,0,0,0,151.07,187Zm-13.81-18.78a7.57,7.57,0,0,0-.78,2.1,7.6,7.6,0,0,0,1.29-1.83,7.51,7.51,0,0,0,.78-2.11A8.26,8.26,0,0,0,137.26,168.22Zm4.17,25.92a8.14,8.14,0,0,0-2,.93,7.7,7.7,0,0,0,2.21-.38,8,8,0,0,0,2-.93A7.76,7.76,0,0,0,141.43,194.14Zm-24.28-9.5a8,8,0,0,0-2,.93,7.76,7.76,0,0,0,2.21-.38,8.3,8.3,0,0,0,2-.93A7.7,7.7,0,0,0,117.15,184.64ZM154,170.23a8.3,8.3,0,0,0-.93-2,7.83,7.83,0,0,0,.38,2.22,8.07,8.07,0,0,0,.93,2A7.82,7.82,0,0,0,154,170.23Zm-40.72,3a7.68,7.68,0,0,0-.94-2,8.07,8.07,0,0,0,.39,2.21,7.35,7.35,0,0,0,.93,2A7.7,7.7,0,0,0,113.23,173.25Zm20.92,10.26a8.3,8.3,0,0,0-.93-2,7.83,7.83,0,0,0,.38,2.22,8.07,8.07,0,0,0,.93,2A7.82,7.82,0,0,0,134.15,183.51Zm.52-26.24a7.51,7.51,0,0,0-2.11-.78,8.79,8.79,0,0,0,3.94,2.07A7.6,7.6,0,0,0,134.67,157.27ZM161,160.39a8.26,8.26,0,0,0-.78,2.1,7.72,7.72,0,0,0,1.3-1.83,8.26,8.26,0,0,0,.78-2.1A7.93,7.93,0,0,0,161,160.39Zm-55.53,20.05a7.57,7.57,0,0,0-2.1-.78,8.69,8.69,0,0,0,3.93,2.07A8.2,8.2,0,0,0,105.45,180.44Zm-6.31-12.63a7.57,7.57,0,0,0-.78,2.1,8.69,8.69,0,0,0,2.07-3.93A7.6,7.6,0,0,0,99.14,167.81Zm-8.21,5.76a4.93,4.93,0,0,0,.11,1l.33.29.36.3A7,7,0,0,0,90.93,173.57Z" style="fill:#fff"></path>
                                    <path d="M106.66,163.16c1.3.5,2.58,1.08,3.84,1.68.57.27,1.14.55,1.72.81-3-.7-6-1.36-9-2-.09,0-.12.13,0,.16,4.64,1.44,9.34,2.74,14,3.94a118.19,118.19,0,0,0,14,3.17.11.11,0,0,0,.05-.22,117.58,117.58,0,0,0-14.06-3.91c-1.15-.29-2.3-.55-3.46-.82-.39-.25-.78-.5-1.19-.72a20,20,0,0,0-1.87-.89c-1.3-.54-2.63-1-4-1.4C106.62,163,106.57,163.13,106.66,163.16Z" style="fill:#263238"></path>
                                    <path d="M95.91,181.41c.89.35,1.81.64,2.72.92.41.13.83.25,1.24.39-1.86-1.05-3.71-2.11-5.53-3.22,0,0,0-.12,0-.1,3,1.43,6,3,9,4.55a54.24,54.24,0,0,1,7,4,.08.08,0,0,1-.07.14,54.73,54.73,0,0,1-7.38-3.61c-.72-.39-1.43-.8-2.15-1.2l-.93-.18a13.15,13.15,0,0,1-1.35-.42c-.91-.33-1.79-.72-2.67-1.14C95.81,181.48,95.85,181.38,95.91,181.41Z" style="fill:#263238"></path>
                                    <path d="M133.4,153.24a16.8,16.8,0,0,0-3.29,5.95c-.65,2.25-.27,4.6,0,6.88q.46,3.84,1.27,7.61a1.84,1.84,0,0,0-.06.62c0,.27,0,.53,0,.8a18.91,18.91,0,0,0,.38,3.09c0,.06.09,0,.09,0-.1-.74-.16-1.49-.21-2.24q0-.59-.06-1.17c0-.17,0-.33,0-.49.49,2.21,1.07,4.4,1.76,6.56,0,.08.17.06.14,0-1-4.67-1.89-9.37-2.47-14.12-.28-2.36-.77-4.9,0-7.2a57.34,57.34,0,0,1,2.62-6.15C133.63,153.22,133.47,153.16,133.4,153.24Z" style="fill:#263238"></path>
                                </g>
                            </svg>
                        </div>

                        <h2 class="text-3xl py-4 font-semibold text-center"><?php _e("No product available.", "lumi") ?></h2>

                        <div class="relative flex justify-center">
                            <button class="relative flex items-center bg-primary-500 rounded-full px-4 py-2 text-sm text-slate-50 mx-auto  space-x-2" onclick="history.back();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <?php _e("Go Back", "lumi") ?>
                            </button>
                        </div>

                    </div>

                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>