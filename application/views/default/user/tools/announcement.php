<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="z-posts container mt-5 <?php echo (db_config('module_tickets') == 1) ? 'extra-height-2' : 'extra-height-1 mb-5'; ?>">
    <div class="row row-main">
        <div class="col">
            <div class="shadow-sm rounded rounded announcement">

                <?php if (! empty($announcement)) { ?>

                    <div class="border-bottom p-4 d-xxl-flex justify-content-between align-items-center gap-4">
                        <h3 class="fw-bold mb-2 mb-xxl-0"><?php echo html_escape($announcement->subject); ?></h3>

                        <?php if (DISPLAY_DATES_ON_VIEW) { ?>
                            <span class="d-inline-block small flex-shrink-0 text-end">
                                <i class="far fa-clock"></i> <?php printf(lang('posted_on'), get_date_time_by_timezone(html_escape($announcement->created_at), true)); ?>
                            </span>
                        <?php } ?>
                    </div>

                    <div class="content">
                        <div class="p-4">
                            <div class="content-holder">
                                <?php echo strip_extra_html(do_secure($announcement->announcement, true)); ?>
                            </div>
                            <!-- /.content-holder -->
                        </div>
                    </div>
                    <!-- /.content -->
                <?php } ?>

            </div>
        </div>
        <!-- /col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<?php load_view('home/still_no_luck'); ?>