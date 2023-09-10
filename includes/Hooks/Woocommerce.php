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
 * Show cart fragment
 */
add_filter('woocommerce_add_to_cart_fragments', 'lumi_add_to_cart_fragment');

function lumi_add_to_cart_fragment($fragments = [])
{
    global $woocommerce;

    $lumi_cart_fragment = "<svg class=\"mr-1.5\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
    <path d=\"M16.651 6.5984C16.651 4.21232 14.7167 2.27799 12.3307 2.27799C11.1817 2.27316 10.0781 2.72619 9.26387 3.53695C8.44968 4.3477 7.992 5.44939 7.992 6.5984M16.5137 21.5H8.16592C5.09955 21.5 2.74715 20.3924 3.41534 15.9348L4.19338 9.89359C4.60528 7.66934 6.02404 6.81808 7.26889 6.81808H17.4474C18.7105 6.81808 20.0469 7.73341 20.5229 9.89359L21.3009 15.9348C21.8684 19.889 19.5801 21.5 16.5137 21.5Z\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\" />
    <path d=\"M15.296 11.102H15.251\" stroke=\"#2D2D2D\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\" />
    <path d=\"M9.46604 11.102H9.42004\" stroke=\"#2D2D2D\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\" />
    </svg>\nbag";

    if ($woocommerce->cart->cart_contents_count) {
        $lumi_cart_fragment .= "<span class=\"absolute -top-2 left-3 h-4 w-4 text-[8px] font-medium flex justify-center items-center rounded-full bg-primary-500 text-white\">{$woocommerce->cart->cart_contents_count}</span>";
    }

    $lumi_cart_mobile_fragment = '<svg class="mr-1.5 h-14 w-8" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.651 6.5984C16.651 4.21232 14.7167 2.27799 12.3307 2.27799C11.1817 2.27316 10.0781 2.72619 9.26387 3.53695C8.44968 4.3477 7.992 5.44939 7.992 6.5984M16.5137 21.5H8.16592C5.09955 21.5 2.74715 20.3924 3.41534 15.9348L4.19338 9.89359C4.60528 7.66934 6.02404 6.81808 7.26889 6.81808H17.4474C18.7105 6.81808 20.0469 7.73341 20.5229 9.89359L21.3009 15.9348C21.8684 19.889 19.5801 21.5 16.5137 21.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /><path d="M15.296 11.102H15.251" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /><path d="M9.46604 11.102H9.42004" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>';

    if ($woocommerce->cart->cart_contents_count) {
        $lumi_cart_mobile_fragment .= "<span class=\"absolute top-2.5 -right-0.5 h-4 w-4 mr-1 mt-0.5 text-[8px] font-medium flex justify-center items-center rounded-full bg-primary-500 text-white\">{$woocommerce->cart->cart_contents_count}</span>";
    }

    $fragments["lumi_cart_fragment"] = $lumi_cart_fragment;
    $fragments["lumi_cart_mobile_fragment"] = $lumi_cart_mobile_fragment;

    return $fragments;
}



/**
 * Tags thumbnail fields.
 */
function add_tags_fields()
{
?>
    <div class="form-field term-display-type-wrap">
        <label for="display_type"><?php esc_html_e('Display type', 'woocommerce'); ?></label>
        <select id="display_type" name="display_type" class="postform">
            <option value=""><?php esc_html_e('Default', 'woocommerce'); ?></option>
            <option value="products"><?php esc_html_e('Products', 'woocommerce'); ?></option>
            <option value="subcategories"><?php esc_html_e('Subcategories', 'woocommerce'); ?></option>
            <option value="both"><?php esc_html_e('Both', 'woocommerce'); ?></option>
        </select>
    </div>
    <div class="form-field term-thumbnail-wrap">
        <label><?php esc_html_e('Thumbnail', 'woocommerce'); ?></label>
        <div id="product_cat_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" width="60px" height="60px" /></div>
        <div style="line-height: 60px;">
            <input type="hidden" id="product_cat_thumbnail_id" name="product_cat_thumbnail_id" />
            <button type="button" class="upload_image_button button"><?php esc_html_e('Upload/Add image', 'woocommerce'); ?></button>
            <button type="button" class="remove_image_button button"><?php esc_html_e('Remove image', 'woocommerce'); ?></button>
        </div>
        <script type="text/javascript">
            // Only show the "remove image" button when needed
            if (!jQuery('#product_cat_thumbnail_id').val()) {
                jQuery('.remove_image_button').hide();
            }

            // Uploading files
            var file_frame;

            jQuery(document).on('click', '.upload_image_button', function(event) {

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                // Create the media frame.
                file_frame = wp.media.frames.downloadable_file = wp.media({
                    title: '<?php esc_html_e('Choose an image', 'woocommerce'); ?>',
                    button: {
                        text: '<?php esc_html_e('Use image', 'woocommerce'); ?>'
                    },
                    multiple: false
                });

                // When an image is selected, run a callback.
                file_frame.on('select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                    jQuery('#product_cat_thumbnail_id').val(attachment.id);
                    jQuery('#product_cat_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                    jQuery('.remove_image_button').show();
                });

                // Finally, open the modal.
                file_frame.open();
            });

            jQuery(document).on('click', '.remove_image_button', function() {
                jQuery('#product_cat_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                jQuery('#product_cat_thumbnail_id').val('');
                jQuery('.remove_image_button').hide();
                return false;
            });

            jQuery(document).ajaxComplete(function(event, request, options) {
                if (request && 4 === request.readyState && 200 === request.status &&
                    options.data && 0 <= options.data.indexOf('action=add-tag')) {

                    var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                    if (!res || res.errors) {
                        return;
                    }
                    // Clear Thumbnail fields on submit
                    jQuery('#product_cat_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                    jQuery('#product_cat_thumbnail_id').val('');
                    jQuery('.remove_image_button').hide();
                    // Clear Display type field on submit
                    jQuery('#display_type').val('');
                    return;
                }
            });
        </script>
        <div class="clear"></div>
    </div>
<?php
}




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
