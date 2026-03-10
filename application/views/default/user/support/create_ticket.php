<?php
defined('BASEPATH') or exit('No direct script access allowed');
$disabled = false;
?>
<div class="response-message no-radius"><?php echo alert_message(); ?></div>

<div class="z-page-form my-5 create-ticket extra-height-1">
    <form class="z-form" action="<?php user_action('support/create_ticket'); ?>" method="post" enctype="multipart/form-data" data-csrf="manual">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">

                    <?php if (db_config('sp_verification_before_submit') && $this->zuser->get('is_verified') == 0) {
                        $disabled = true; ?>
                        <div class="alert alert-warning text-center"><?php echo lang('sp_everification_req'); ?></div>
                    <?php } else if (db_config('create_ticket_page_message') && db_config('show_tp_message') == 1) { ?>
                        <div class="alert bg-sub text-center text-white"><?php echo html_escape(db_config('create_ticket_page_message')); ?></div>
                    <?php } ?>

                    <div class="shadow-sm wrapper rounded">

                        <div class="border-bottom px-4 py-3">
                            <h5 class="fw-bold mb-0"><?php echo lang('submit_ticket'); ?></h5>
                        </div>

                        <div class="p-4">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="subject" class="form-label"><?php echo lang('subject'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" id="subject" class="form-control" name="subject" required>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <label for="priority" class="form-label"><?php echo lang('priority'); ?> <span class="text-danger">*</span></label>
                                    <select id="priority" class="form-control select2 search-disabled" name="priority" data-placeholder="<?php echo lang('choose_priority'); ?>" required>
                                        <option></option>
                                        <option value="low"><?php echo lang('low'); ?></option>
                                        <option value="medium"><?php echo lang('medium'); ?></option>
                                        <option value="high"><?php echo lang('high'); ?></option>
                                    </select>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="mb-3">
                                <label for="department" class="form-label"><?php echo lang('department'); ?> <span class="text-danger">*</span></label>
                                <select id="department" class="form-control select2 search-disabled" name="department" data-placeholder="<?php echo lang('select_department'); ?>" required>
                                    <option></option>
                                    <?php if (! empty($departments)) {
                                        foreach ($departments as $department) { ?>
                                            <option value="<?php echo html_escape($department->id); ?>"><?php echo html_escape($department->name); ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <!-- /.mb-3 -->
                            <div class="mb-3">
                                <label for="message" class="form-label"><?php echo lang('message'); ?> <span class="text-danger">*</span></label>
                                <textarea id="message" class="form-control" name="message" rows="11" required></textarea>
                            </div>
                            <!-- /.mb-3 -->

                            <?php if (db_config('envato_ask_purchase_code_ticket') == 1) { ?>
                                <div class="mb-3">
                                    <label for="purchase-code" class="form-label">
                                        <?php echo lang('purchase_code'); ?> <span class="text-danger">*</span>
                                        <i class="fas fa-info-circle" data-bs-toggle="tooltip" aria-label="<?php echo lang('purchase_code_eg'); ?>" data-bs-original-title="<?php echo lang('purchase_code_eg'); ?>"></i>
                                    </label>
                                    <input type="text" id="purchase-code" class="form-control" name="envato_purchase_code" required>
                                    <small id="purchase-code-guide" class="form-text">
                                        <a class="text-sub fw-normal" href="<?php echo db_config('envato_how_to_find_pc'); ?>" target="_blank">
                                            <?php echo lang('htf_purchase_code'); ?>
                                        </a>
                                    </small>
                                </div>
                                <!-- /.mb-3 -->
                            <?php } ?>

                            <?php load_view('common/custom_fields'); ?>

                            <div>
                                <label for="attachment" class="form-label"><?php echo lang('attach_files'); ?></label>
                            </div>
                            <input type="file" class="w-100" id="attachment" name="attachment" accept="<?php echo ALLOWED_ATTACHMENTS_EXT_HTML; ?>" multiple="true" data-max-files="<?php echo intval(db_config('max_files')); ?>">
                            <small id="attachment-guide" class="form-text"><?php echo lang('attach_file_tip'); ?></small>

                            <?php if (is_gr_togo()) { ?>
                                <div class="mt-3 d-flex justify-content-center">
                                    <div class="g-recaptcha" data-sitekey="<?php echo html_escape(db_config('gr_public_key')); ?>"></div>
                                </div>
                                <!-- /.mb-3 -->
                            <?php } ?>

                        </div>
                        <div class="border-top clearfix p-4">
                            <div class="response-message"></div>
                            <button class="btn btn-sub btn-wide float-end" type="submit" <?php echo ($disabled) ? 'disabled' : ''; ?>><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                    <!-- /.wrapper -->
                </div>
                <!-- /col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </form>
</div>
<!-- /.z-page-form -->