<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Delete Account Modal ( User ): -->
<div class="modal" id="delete-account">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="z-form" action="<?php user_action('account/delete'); ?>" method="post">
                <div class="modal-body">
                    <div class="response-message"></div>
                    <p class="mb-0"><?php echo lang('sure_del_my_account'); ?></p>
                    <input class="form-control mt-2" type="password" name="password" placeholder="<?php echo lang('account_password'); ?>" required>
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