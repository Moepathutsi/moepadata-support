<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form class="z-form" action="<?php admin_action('support/update_ticket_task'); ?>" method="post">
    <div class="modal-header">
        <h5 class="modal-title"><?php echo lang('edit_task'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- /.modal-header -->
    <div class="modal-body">
        <div class="response-message"></div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="title-edit"><?php echo lang('title'); ?> <span class="required">*</span></label>
                <input type="text" class="form-control" id="title-edit" name="title" value="<?php echo html_escape($title); ?>" required>
            </div>
            <!-- /.form-group -->
            <div class="form-group col-md-6">
                <label for="priority-edit"><?php echo lang('priority'); ?> <span class="required">*</span></label>
                <select id="priority-edit" data-placeholder="<?php echo lang('choose_priority'); ?>" class="form-control select2 search-disabled" name="priority" required>
                    <option></option>
                    <option value="low" <?php echo select_single('low', $priority); ?>><?php echo lang('low'); ?></option>
                    <option value="medium" <?php echo select_single('medium', $priority); ?>><?php echo lang('medium'); ?></option>
                    <option value="high" <?php echo select_single('high', $priority); ?>><?php echo lang('high'); ?></option>
                </select>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.form-row -->
        <label for="description-edit"><?php echo lang('description'); ?></label>
        <textarea class="form-control" id="description-edit" name="description" rows="5"><?php echo html_escape($description); ?></textarea>
    </div>
    <!-- /.modal-body -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-sm" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i> <?php echo lang('close'); ?>
        </button>
        <button type="submit" class="btn btn-primary text-sm">
            <i class="fas fa-check mr-2"></i> <?php echo lang('update'); ?>
        </button>
    </div>
    <!-- /.modal-footer -->

    <input type="hidden" name="id" value="<?php echo html_escape($id); ?>">
</form>