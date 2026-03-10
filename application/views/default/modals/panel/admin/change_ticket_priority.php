<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Change Ticket Priority Modal: -->
<div class="modal" id="change-ticket-priority">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="z-form" action="<?php admin_action('support/change_ticket_priority'); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo intval($ticket->id); ?>">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo lang('change_priority'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body">
                    <div class="response-message"></div>
                    <select class="form-control select2 search-disabled" name="priority" required>
                        <option value="low" <?php echo select_single('low', $ticket->priority); ?>><?php echo lang('low'); ?></option>
                        <option value="medium" <?php echo select_single('medium', $ticket->priority); ?>><?php echo lang('medium'); ?></option>
                        <option value="high" <?php echo select_single('high', $ticket->priority); ?>><?php echo lang('high'); ?></option>
                    </select>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> <?php echo lang('close'); ?>
                    </button>
                    <button type="submit" class="btn btn-primary text-sm">
                        <i class="fas fa-check mr-2"></i> <?php echo lang('change'); ?>
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