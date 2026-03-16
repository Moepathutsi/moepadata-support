<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

<div class="response-message no-radius no-mb"><?php echo alert_message(); ?></div>

<!-- Hero: -->
<div class="bg-white z-hero-wrapper">
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-14">

                <h3 class="h1 fw-bold mb-2">
                    <?php echo lang('search_the_solution'); ?>
                </h3>

                <p class="text-muted mb-4">
                    <?php echo lang('search_tagline'); ?>
                </p>

                <form class="search-form" action="<?php echo env_url('search'); ?>">
                    <div class="input-group hero-search">
                        <input 
                            type="search" 
                            class="form-control" 
                            name="query" 
                            placeholder="<?php echo lang('search_articles'); ?>" 
                            required
                        >

                        <button class="btn btn-sub">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <?php if (!empty($popular_topics)) { ?>
                    <div class="popular-tags mt-3">
                        <strong><?php echo lang('popular_tags'); ?>:</strong>

                        <?php
                        $count = sizeof($popular_topics);
                        $i = 1;
                        foreach ($popular_topics as $popular_topic) { ?>

                            <a href="<?php echo env_url(get_kb_category_slug(html_escape($popular_topic->slug))); ?>">
                                <?php echo html_escape($popular_topic->name); ?>
                            </a><?php echo ($i != $count) ? ',' : ''; ?>

                        <?php $i++; } ?>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<!-- /.z-hero-wrapper -->

<!-- Articles -->
<?php if (! empty($categories = get_articles_categories())) { ?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Browse by Category</h2>
    </div>

    <div class="row g-4">

        <?php foreach ($categories as $category) { ?>

            <?php if (! empty($child_categories = get_articles_subcategories($category->id))) { ?>

                <?php foreach ($child_categories as $child_category) { ?>

                <div class="col-lg-4 col-md-6">

                    <div class="kb-category-card">

                        <div class="kb-category-header">

                            <div class="kb-icon">
                                <i class="far fa-folder"></i>
                            </div>

                            <h5>

                                <a href="<?php echo env_url(html_escape(get_kb_category_slug($category->slug, $child_category->slug))); ?>">
                                    <?php echo html_escape($child_category->name); ?>
                                </a>

                                <span class="text-muted">
                                    (<?php echo get_articles_by_category($child_category->id, true); ?>)
                                </span>

                            </h5>

                        </div>

                        <?php if (! empty($articles = get_articles_by_category($child_category->id))) { ?>

                        <ul class="kb-article-list">

                            <?php foreach ($articles as $article) { ?>

                            <li>

                                <i class="far fa-file-alt"></i>

                                <a href="<?php echo env_url(get_kb_article_slug(html_escape($article->slug))); ?>">
                                    <?php echo html_escape($article->title); ?>
                                </a>

                            </li>

                            <?php } ?>

                        </ul>

                        <?php } ?>

                    </div>

                </div>

                <?php } ?>

            <?php } ?>

        <?php } ?>

    </div>

</div>

<?php } ?>
<?php load_view('home/still_no_luck'); ?>