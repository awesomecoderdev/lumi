<?php
global $product;
?>

<?php

// // Check if the product has the "Color" attribute
// if ($product->get_attribute('pa_size')) {
//     echo '<div class="color-attributes">';
//     echo '<p><strong>' . __("Select Size", "lumi") . '</strong></p>';
//     echo '<ul>';

//     // Get the color attribute terms
//     $color_terms = wc_get_product_terms($product->get_id(), 'pa_size');

//     foreach ($color_terms as $color_term) {
//         echo '<li>';
//         echo '<a href="' . get_term_link($color_term) . '">' . $color_term->name . '</a>';
//         echo '</li>';
//     }

//     echo '</ul>';
//     echo '</div>';
// }

?>
<?php if ($product->get_attribute('pa_size')) : ?>
    <?php $sizes = wc_get_product_terms($product->get_id(), 'pa_size'); ?>
    <h2 class="text-base font-semibold"><?php _e("Select Size", "lumi") ?></h2>
<?php endif; ?>