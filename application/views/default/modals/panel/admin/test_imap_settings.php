<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Test IMAP Settings Modal: -->
<div class="modal" id="test-imap-settings">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="z-form" action="<?php admin_action('settings/test_imap_settings'); ?>" method="post">
                <div class="modal-body">
                    <div class="response-message"></div>
                    <?php echo lang('sure_to_test_imap'); ?>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> <?php echo lang('close'); ?>
                    </button>
                    <button type="submit" class="btn btn-primary text-sm">
                        <i class="fas fa-check mr-2"></i> <?php echo lang('yes'); ?>
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