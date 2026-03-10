<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container my-5 extra-height-1">
    <div class="row">
        <div class="col">
            <div class="z-page-wrapper shadow-sm rounded">
                <div class="p-4 border-bottom">
                    <h3 class="fw-bold mb-0"><?php echo html_escape($page->name); ?></h3>
                </div>
                <div class="page p-4">

                    <?php echo strip_extra_html(do_secure($page->content)); ?>

                    <?php if (DISPLAY_DATES_ON_VIEW && ! empty($page->updated_at)) { ?>
                        <p class="small mt-4 mb-0">
                            <i class="far fa-clock"></i> <?php printf(lang('updated_on'), get_date_time_by_timezone(html_escape($page->updated_at), true)); ?>
                        </p>
                    <?php } ?>

                </div>
                <!-- /.page -->
            </div>
            <!-- /.list-wrapper -->
        </div>
        <!-- /col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->