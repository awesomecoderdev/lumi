<section id="categories" class="relative border-y border-primary-50/50 dark:border-slate-50/25 text-slate-500 dark:text-white">
    <div class="relative container text-sm font-normal py-2 flex justify-evenly items-center">

        <?php foreach (get_lumi_categories([
            "number" => 12,
            'parent'        => 0,
        ]) as $key => $category) : ?>
            <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
        <?php endforeach; ?>
    </div>
</section>