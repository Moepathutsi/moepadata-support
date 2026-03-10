<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Add Announcement Modal: -->
<div class="modal close-after" id="add-announcement">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="z-form" action="<?php admin_action('tools/add_announcement'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo lang('add_announcement'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body">
                    <div class="response-message"></div>
                    <div class="form-group">
                        <label for="subject-add"><?php echo lang('subject'); ?> <span class="required">*</span></label>
                        <input type="text" class="form-control" id="subject-add" name="subject" required>
                    </div>
                    <!-- /.form-group -->
                    <label for="announcement-add"><?php echo lang('announcement'); ?> <span class="required">*</span></label>
                    <textarea class="form-control textarea" id="announcement-add" name="announcement" data-is-editor="true" rows="5" required></textarea>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <?php if (is_openai_ready()) { ?>
                        <button type="button" class="btn btn-success mr-auto modal-button text-sm" data-toggle="modal" data-target="#ai-writer" data-modal-type="add"><i class="fas fa-robot mr-2"></i> <?php echo lang('ai_writer'); ?></button>
                    <?php } ?>

                    <button type="button" class="btn btn-secondary text-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> <?php echo lang('close'); ?>
                    </button>
                    <button type="submit" class="btn btn-primary text-sm">
                        <i class="fas fa-check mr-2"></i> <?php echo lang('submit'); ?>
                    </button>
                </div>
                <!-- /.modal-footer -->
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->