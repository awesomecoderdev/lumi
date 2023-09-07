<div class="relative <?php echo isset($args["class"]) ? $args["class"] : "" ?>">
    <h2 class="font-semibold text-base"><?php _e("Categories", "lumi"); ?></h2>
    <div class="relative grid">
        <?php foreach (get_lumi_categories(["number" => 100]) as $key => $category) : ?>
            <a class="relative flex justify-between items-center" href="<?php echo get_term_link($category); ?>">
                <span><?php echo $category->name; ?></span>
                <span>(<?php echo $category->count; ?>)</span>
            </a>
        <?php endforeach; ?>
    </div>
</div>