<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if ($article->visibility != 1) { ?>
    <div class="no-radius">
        <div class="alert alert-warning text-center"><?php echo lang('hidden_post'); ?></div>
    </div>
<?php } ?>

<div class="z-posts container mt-5 extra-height-2">
    <div class="row mb-4">
        <div class="col">
            <?php load_view('home/support/breadcrumb', [
                'name' => $article->category_name,
                'slug' => $article->category_slug,
                'parent_id' => $article->category_parent_id,
                'article_page' => true
            ]); ?>
        </div>
        <!-- /col -->
    </div>
    <!-- /.row -->
    <div class="row row-main">
        <div class="col-lg-8">
            <div class="shadow-sm rounded">
                <?php if (! empty($article)) {
                    $article_url = env_url(get_kb_article_slug($article->slug)); ?>

                    <div class="p-4 border-bottom">

                        <?php if (DISPLAY_DATES_ON_VIEW) { ?>
                            <div class="mb-2">
                                <span class="d-inline-block small me-2">
                                    <i class="far fa-clock"></i> <?php printf(lang('posted_on'), get_date_time_by_timezone(html_escape($article->created_at), true)); ?>
                                </span>

                                <?php if (! empty($article->updated_at)) { ?>
                                    <span class="d-inline-block small">
                                        <i class="far fa-clock"></i> <?php printf(lang('updated_on'), get_date_time_by_timezone(html_escape($article->updated_at), true)); ?>
                                    </span>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <h3 class="fw-bold mb-0"><?php echo html_escape($article->title); ?></h3>
                    </div>

                    <div class="content">

                        <div class="p-4">
                            <div class="content-holder">
                                <?php echo strip_extra_html(do_secure($article->content, true)); ?>
                            </div>
                            <!-- /.content-holder -->
                            <div class="social-share mt-4">
                                <a
                                    class="btn-z" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo html_escape($article_url); ?>"
                                    data-bs-toggle="tooltip"
                                    title="<?php echo lang('share_on_facebook'); ?>"
                                    target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a
                                    class="btn-z" href="https://twitter.com/intent/tweet?url=<?php echo html_escape($article_url); ?>"
                                    data-bs-toggle="tooltip"
                                    title="<?php echo lang('share_on_twitter'); ?>"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a
                                    class="btn-z" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo html_escape($article_url); ?>"
                                    data-bs-toggle="tooltip"
                                    title="<?php echo lang('share_on_linkedin'); ?>"
                                    target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                            <!-- /.social-share -->
                        </div>

                        <div class="border-top p-4 text-center">
                            <h4 class="fw-bold mb-3"><?php echo lang('found_article_helpful'); ?></h4>
                            <div class="mb-3 d-flex justify-content-center gap-2">
                                <button
                                    class="btn btn-outline-success btn-wide article-vote"
                                    data-action="<?php echo env_url('support/article_vote/y/' . html_escape($article->id)); ?>"
                                    <?php echo ($voted) ? 'disabled' : ''; ?>>
                                    <?php echo lang('yes'); ?>
                                </button>
                                <button
                                    class="btn btn-outline-danger btn-wide article-vote"
                                    data-action="<?php echo env_url('support/article_vote/n/' . html_escape($article->id)); ?>"
                                    <?php echo ($voted) ? 'disabled' : ''; ?>>
                                    <?php echo lang('no'); ?>
                                </button>
                            </div>
                            <div class="not-in-form">
                                <div class="response-message"></div>
                            </div>
                            <p class="mb-0" id="article-votes">( <?php echo html_escape(sprintf(lang('found_helpful'), $article->helpful, ($article->helpful + $article->not_helpful))); ?> )</p>
                        </div>
                    </div>
                    <!-- /.content -->
                <?php } ?>
            </div>
        </div>
        <!-- /col -->
        <div class="col-lg-4 mt-4 mt-lg-0">

            <div class="sticky-sidebar">
                <div class="shadow-sm mb-4 p-4 rounded bg-white">
                    <form class="mb-0" action="<?php echo env_url('search'); ?>">
                        <div class="input-group align-items-center">
                            <input type="search" class="form-control" name="query" placeholder="<?php echo lang('search_articles'); ?>" required>
                            <button class="btn btn-sub btn-wide"><i class="fas fa-search"></i></button>
                        </div>
                        <!-- /.input-group -->
                    </form>
                </div>

                <?php if (! empty($related)) { ?>
                    <div class="shadow-sm rounded bg-white">

                        <div class="px-4 py-3 border-bottom">
                            <p class="fw-bold mb-0"><?php echo lang('related_articles'); ?></p>
                        </div>

                        <ul class="p-4 nav flex-column z-kb-list">
                            <?php foreach ($related as $related_article) { ?>
                                <li>
                                    <div class="d-flex">
                                        <div><i class="far fa-file-alt me-2"></i></div>
                                        <div>
                                            <a href="<?php echo env_url(get_kb_article_slug(html_escape($related_article->slug))); ?>">
                                                <?php echo html_escape($related_article->title); ?>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>

        </div>
        <!-- /col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<?php load_view('home/still_no_luck'); ?>