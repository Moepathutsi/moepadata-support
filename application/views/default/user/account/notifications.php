<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="response-message no-radius"><?php echo alert_message(); ?></div>

<div class="z-list extra-height-1 container my-5">
    <div class="row mb-4">
        <div class="col d-lg-flex align-items-center justify-content-between">
            <h2 class="h4 fw-bold mb-0"><?php echo lang('notifications'); ?></h2>
            <?php if ($unread_notifications && $unread_notifications > 1) { ?>
                <div>
                    <button class="btn btn-dark w-100 mt-3 mt-lg-0" data-bs-toggle="modal" data-bs-target="#mark-all-as-read">
                        <small><i class="fas fa-check me-2"></i> <?php echo lang('mark_all_as_read'); ?></small>
                    </button>
                </div>
            <?php } ?>
        </div>
        <!-- /col -->
    </div>
    <div class="shadow-sm rounded z-card">
        <div class="row">
            <div class="col">
                <?php
                if (! empty($notifications)) {
                    foreach ($notifications as $notify) {
                        $togo = ($notify->is_read == 1) ? $notify->location : "user/read_notification/{$notify->id}"; ?>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-lg-9 ">
                                    <p class="mb-1">
                                        <?php echo lang(html_escape($notify->message_key)); ?>

                                        <?php if ($notify->is_read == 0) { ?>
                                            <span class="text-danger">(<?php echo lang('unread'); ?>)</span>
                                        <?php } ?>
                                    </p>
                                    <span class="text-secondary small basic-info mt-2"><i class="far fa-clock"></i> <?php echo get_date_time_by_timezone(html_escape($notify->created_at)); ?></span>
                                </div>
                                <!-- /col -->
                                <div class="col-lg-3 align-self-center clearfix">
                                    <div class="float-lg-end">
                                        <button class="btn btn-link text-danger tool d-none d-lg-inline-block" data-id="<?php echo html_escape($notify->id); ?>" data-bs-toggle="modal" data-bs-target="#delete">
                                            <i class="fas fa-trash tool-c"></i>
                                        </button>
                                        <a href="<?php echo env_url($togo); ?>" class="btn btn-sub mt-3 mt-lg-0"><i class="far fa-eye"></i></a>
                                        <button class="btn btn-link text-danger tool d-inline-block d-lg-none mt-3 mt-lg-0" data-id="<?php echo html_escape($notify->id); ?>" data-bs-toggle="modal" data-bs-target="#delete">
                                            <i class="fas fa-trash tool-c"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.list-item -->
                    <?php }
                } else {
                    ?>
                    <div class="list-item">
                        <div class="row">
                            <div class="col">
                                <div class="text-center">
                                    <img class="not-found mt-2 mb-4" src="<?php illustration_by_color('not_found'); ?>" alt="">
                                    <h2 class="h4 fw-bold"><?php echo lang('no_records_found'); ?></h2>
                                </div>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.list-item -->
                <?php } ?>
            </div>
            <!-- /col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.z-card -->
    <div class="row">
        <div class="col">
            <div class="clearfix pagination-wrapper"><?php echo $pagination; ?></div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<?php load_modals(['user/mark_all_as_read', 'user/delete_notification']); ?>