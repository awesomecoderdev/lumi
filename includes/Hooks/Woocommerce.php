<?php

/**
 * The core template class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this template as well as the current
 * version of the template.
 *
 * @since      1.0.0
 * @package    Lumi
 * @subpackage Lumi/includes
 * @author     Md Ibrahim Kholil <awesomecoder.org@gmail.com>
 *
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */


/**
 * ======================================================================================
 * 		product after before contents
 * ======================================================================================
 */


/**
 * Add custom code before the woocommerce contents
 *
 * @since    1.0.0
 * <section class="menu section bd-container" id="menu">
 *	<div class="menu__container bd-grid products columns-<?php echo esc_attr(wc_get_loop_prop('columns')); ?>
 *
 */
function open_container_before_woocommerce_after_main_contents()
{
    echo '<section class="menu section bd-container products product-col-' . esc_attr(wc_get_loop_prop('columns')) . ' ">';
    // echo get_search_form();
}
add_action("woocommerce_before_main_content", "open_container_before_woocommerce_after_main_contents", 5);


/**
 * Add custom code after the woocommerce contents
 *
 * @since    1.0.0
 *
 */
function close_container_after_woocommerce_after_main_contents()
{
    echo '</section>';
}

add_action("woocommerce_after_main_content", "close_container_after_woocommerce_after_main_contents", 5);


/**
 * ======================================================================================
 * 		product loop functions
 * ======================================================================================
 */


/**
 * modify the product loop title
 *
 * @since    1.0.0
 *
 */
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
function woocommerce_template_loop_product_title()
{
    echo '<h3 class="menu__name">' . get_the_title() . '</h3>';
    echo '<span class="menu__detail">';
    $terms = get_the_terms(get_the_ID(), 'product_cat');
    echo (isset($terms[0])) ? ucfirst($terms[0]->name) : "Uncategory";
    echo (isset($terms[1])) ? ", " . ucfirst($terms[1]->name) : "";
    echo '</span><br>';
}



/**
 * modify the product title with eht exceript
 *
 * @since    1.0.0
 *
 */
// add_action('woocommerce_shop_loop_item_title', 'the_excerpt');


/**
 * modify the product loop thumbnail
 *
 * @since    1.0.0
 *
 */
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
function woocommerce_template_loop_product_thumbnail()
{
    $img = woocommerce_get_product_thumbnail();
    $img = str_replace("<img", "<img  class=\"menu__img\"", $img);
    echo $img;
}

/**
 * modify the product loop add to cart loop
 *
 * @since    1.0.0
 *
 */
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 1);
function woocommerce_template_loop_add_to_cart($args)
{
    global $product;
    echo apply_filters(
        'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
        sprintf(
            '<span data-quantity="%s" data-product_id="%d" id="product_id_%d" data-product_sku="%s" class="button menu__button restaurant_cart_btn"><i class="bx bx-cart-alt"></i></span>',
            esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
            esc_attr($product->get_id()),
            esc_attr($product->get_id()),
            esc_attr($product->get_sku()),
        ),
        $product,
        $args
    );
}


/**
 * modify the product single add to cart
 *
 * @since    1.0.0
 *
 */
add_action("woocommerce_simple_add_to_cart", "woocommerce_simple_add_to_cart", 30);
function woocommerce_simple_add_to_cart()
{
    global $product;
    echo '<form class="cart" action="' . esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) . '" method="post" enctype="multipart/form-data">';
    woocommerce_quantity_input(
        array(
            'classes'     => 'input-text qty text button',
            'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
            'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
            'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
        )
    );
    echo '<button class="button menu__button" type="submit" name="add-to-cart" value="' . get_the_ID() . '"><span>Add to cart <i class="bx bx-cart-alt"></i></span></button>';
    echo '</form>';
}


/**
 * modify the single product title
 *
 * @since    1.0.0
 *
 */
add_action("woocommerce_single_product_summary", "woocommerce_template_single_title", 5);
function woocommerce_template_single_title()
{
    echo '<h3 class="menu__name">' . get_the_title() . '</h3>';
}




/**
 * Show cart contents / total Ajax
 */
// add_filter('woocommerce_add_to_cart_fragments', 'ac_add_to_cart_fragment');

function ac_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

?>
    <li class="nav__item nav_cart menu-item menu-item-type-post_type menu-item-object-page current_page_item nav__item nav_shop"><a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="nav__link ">Cart<span id='cartCount'><?php echo $woocommerce->cart->cart_contents_count; ?></span></i></a></li>
<?php
    $fragments['li.nav_cart'] = ob_get_clean();
    return $fragments;
}



/**
 * Customize the "shop" title on the main shop page
 *
 * @since    1.0.0
 *
 */
add_filter('woocommerce_show_page_title', 'custom_shop_page_title');
function custom_shop_page_title()
{
    echo '<h3 class="services__title">Shop</h3>';
}


/**
 * ======================================================================================
 * 		removing elements from archive-product.php
 * ======================================================================================
 */
/**
 * remove woocommerce sidebar
 *
 * @since    1.0.0
 *
 */
// remove_action("woocommerce_sidebar", "woocommerce_get_sidebar");


/**
 * remove woocommerce breadcrumb
 *
 * @since    1.0.0
 *
 */
remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb", 20);


/**
 * remove woocommerce result_count
 *
 * @since    1.0.0
 *
 */
// remove_action("woocommerce_before_shop_loop", "woocommerce_result_count", 20);



/**
 * remove woocommerce ordering
 *
 * @since    1.0.0
 *
 */
// remove_action("woocommerce_before_shop_loop", "woocommerce_catalog_ordering", 30);


/**
 * Removes the "shop" title on the main shop page
 *
 * @since    1.0.0
 *
 */
// add_filter('woocommerce_show_page_title', '__return_false');

/**
 * ======================================================================================
 * 		set posisiton of the single product page contents
 * ======================================================================================
 */


/**
 * move the rating location on single product page
 *
 * @since    1.0.0
 *
 */
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_rating", 10);
add_action("woocommerce_single_product_summary", "woocommerce_template_single_rating", 25);


/**
 *  move the price location on single product page
 *
 * @since    1.0.0
 *
 */
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_price", 10);
add_action("woocommerce_single_product_summary", "woocommerce_template_single_price", 26);


/**
 * ======================================================================================
 * 		set posisiton of the single product page contents
 * ======================================================================================
 */

/**
 *  Rggister customize settings
 *
 * @since    1.0.0
 *
 */
add_action("customize_register", 'ac_restaurant_customize_register');
function ac_restaurant_customize_register($wp_customize)
{

    /**
     *  Add section
     *
     * @since    1.0.0
     *
     */
    $wp_customize->add_section("sec_copyright", array(
        "title"             => "Copyright Settings",
        "description"       => "This is copyright section.",
    ));

    /**
     * ======================================================================================
     * 		 Add settings on customize
     * ======================================================================================
     */

    /**
     *  adding copyright text
     *
     * @since    1.0.0
     *
     */
    $wp_customize->add_setting("copyright_text", array(
        "type" => "theme_mod",
        "default" => get_bloginfo("title"),
        "sanitize_callback" => "sanitize_text_field",
    ));
    $wp_customize->add_control("copyright_text", array(
        "label" => "Copyright",
        "description" => "Please fill the copyright text field.",
        "section" => "sec_copyright",
        "type" => "text",
    ));


    /**
     *  adding copyright year
     *
     * @since    1.0.0
     *
     */
    $wp_customize->add_setting("copyright_year", array(
        "type" => "theme_mod",
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
    ));
    $wp_customize->add_control("copyright_year", array(
        "label" => "Year",
        "description" => "Please fill the copyright year field.",
        "section" => "sec_copyright",
        "type" => "number",
    ));


    /**
     *  adding hover color
     *
     * @since    1.0.0
     *
     */
    $wp_customize->add_setting("text_color", array(
        "type" => "theme_mod",
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
    ));
    $wp_customize->add_control("text_color", array(
        "label" => "Text Color",
        "section" => "colors",
        "type" => "color",
    ));




    /**
     *  adding hover color
     *
     * @since    1.0.0
     *
     */
    $wp_customize->add_setting("first_color", array(
        "type" => "theme_mod",
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
    ));
    $wp_customize->add_control("first_color", array(
        "label" => "Font Color",
        "section" => "colors",
        "type" => "color",
    ));


    /**
     *  adding hover color
     *
     * @since    1.0.0
     *
     */
    $wp_customize->add_setting("hover_color", array(
        "type" => "theme_mod",
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
    ));
    $wp_customize->add_control("hover_color", array(
        "label" => "Hover Color",
        "section" => "colors",
        "type" => "color",
    ));
}
