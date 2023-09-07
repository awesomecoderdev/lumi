<section id="categories" class="relative border-y border-primary-50/50 dark:border-slate-50/25 text-slate-500 dark:text-white">
    <div class="relative container text-sm font-normal py-2 flex flex-wrap justify-evenly items-center">
        <?php foreach (get_lumi_categories([
            "number" => 12,
            'parent'        => 0,
        ]) as $key => $category) : ?>
            <a class="lg:px-4 px-2 py-1 <?php echo  $category->term_id == get_queried_object_id() ? "bg-primary-500 rounded-full text-white" : "" ?>" href="<?php echo get_term_link($category); ?>">
                <?php echo $category->name; ?>
            </a>
        <?php endforeach; ?>
    </div>
</section>