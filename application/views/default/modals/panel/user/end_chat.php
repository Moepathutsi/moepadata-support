<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- End Chat Modal ( User ): -->
<div class="modal" id="end-chat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="z-form" action="<?php user_action('support/end_chat'); ?>" method="post">
                <div class="modal-body">
                    <div class="response-message"></div>
                    <p class="mb-0"><?php echo lang('sure_end_chat_user'); ?></p>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang('no'); ?></button>
                    <button type="submit" class="btn btn-danger btn-wide"><?php echo lang('yes'); ?></button>
                </div>
                <!-- /.modal-footer -->
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->