<?php

/**
 * The theme support.
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
 * 		The actions of the themes
 * ======================================================================================
 */


// Replace the default slug with the custom color field in the term list table
add_filter('manage_edit-product_color_columns', 'lumi_taxonomy_custom_column');
function lumi_taxonomy_custom_column($columns)
{
    $new_columns = [
        "cb"            => "<input type=\"checkbox\" />",
        "name"          => __('Name', 'lumi'),
        "color"         => __('Color', 'lumi'),
        "description"   => __('Description', 'lumi'),
        "slug"          => __('Slug', 'lumi'),
        "posts"         => __('Count', 'lumi'),
    ];

    return $new_columns;
}


/**
 * Create two taxonomies, colors for the post type "book".
 *
 * @see register_post_type() for registering custom post types.
 */
function lumi_create_color_taxonomies()
{
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x('Colors', 'taxonomy general name', 'lumi'),
        'singular_name'              => _x('Color', 'taxonomy singular name', 'lumi'),
        'search_items'               => __('Search Colors', 'lumi'),
        'popular_items'              => __('Popular Colors', 'lumi'),
        'all_items'                  => __('All Colors', 'lumi'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Color', 'lumi'),
        'update_item'                => __('Update Color', 'lumi'),
        'add_new_item'               => __('Add New Color', 'lumi'),
        'new_item_name'              => __('New Color Name', 'lumi'),
        'separate_items_with_commas' => __('Separate Colors with commas', 'lumi'),
        'add_or_remove_items'        => __('Add or remove Colors', 'lumi'),
        'choose_from_most_used'      => __('Choose from the most used Colors', 'lumi'),
        'not_found'                  => __('No Colors found.', 'lumi'),
        'menu_name'                  => __('Colors', 'lumi'),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'description'           => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'color'),
        'public'                => false, // Disable the public slug
    );

    register_taxonomy('product_color', 'product', $args);
}
// hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'lumi_create_color_taxonomies', 0);


// Add custom field to term edit form
function lumi_taxonomy_edit_form_fields($term, $taxonomy)
{
    $color = get_term_meta($term->term_id, 'color', true);
?>
    <tr class="form-field">
        <th scope="row"><label for="color"><?php esc_html_e('Color', 'lumi'); ?></label></th>
        <td>
            <input type="text" name="color" id="color" value="<?php echo esc_attr($color); ?>">
            <p class="description"><?php esc_html_e('Enter the color for this term.', 'lumi'); ?></p>
        </td>
    </tr>
<?php
}

// Save custom field when editing term
function lumi_taxonomy_save_custom_fields($term_id)
{
    if (isset($_POST['color'])) {
        $color = sanitize_text_field($_POST['color']);
        update_term_meta($term_id, 'color', $color);
    }
}

// Hook into term edit and save actions
// add_action('product_color_edit_form_fields', 'lumi_taxonomy_edit_form_fields', 10, 2);
add_action('edited_product_color', 'lumi_taxonomy_save_custom_fields', 10, 2);
add_action('create_product_color', 'lumi_taxonomy_save_custom_fields', 10, 2);

function lumi_taxonomy_custom_column_data($deprecated, $column_name, $term_id)
{
    if ($column_name === 'color') {
        $color = get_term_meta($term_id, 'slug', true);

        if (!$color) {
            $term = get_term($term_id);
            $color =  $term->slug;
        }

        return $color ? "<div style=\"height:30px;width:30px;border:1px solid;border-radius:100%;background: $color;\"></div>" : '-';
    }
}

add_filter('manage_product_color_custom_column', 'lumi_taxonomy_custom_column_data', 9999, 3);
