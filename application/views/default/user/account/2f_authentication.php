<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="z-align-middle">
    <div class="card z-card-mini-box form-based">
        <div class="card-body shadow-sm p-0 rounded">
            <div class="card-padding">
                <form class="z-form" action="<?php echo env_url('actions/account/verify_2f_authentication'); ?>" method="post" data-csrf="manual">
                    <div class="response-message"><?php echo alert_message(); ?></div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <p><?php echo lang('2f_auth_tagline'); ?></p>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="code" placeholder="<?php echo lang('code'); ?>" required>
                    </div>
                    <!-- /.mb-3 -->

                    <?php if (db_config('u_2fa_show_remember')) { ?>
                        <div class="mb-3">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                            <label class="form-check-label small ms-1" for="remember"><?php echo lang('do_not_ask_browser'); ?></label>
                        </div>
                        <!-- /.mb-3 -->
                    <?php } ?>

                    <?php if (is_gr_togo()) { ?>
                        <div class="mb-3 d-flex justify-content-center">
                            <div class="g-recaptcha" data-sitekey="<?php echo html_escape(db_config('gr_public_key')); ?>"></div>
                        </div>
                    <?php } ?>

                    <div class="d-grid">
                        <button class="btn btn-sub" type="submit"><?php echo lang('continue'); ?></button>
                    </div>
                    <!-- /.d-grid -->
                </form>
            </div>
            <!-- /.card-padding -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.z-align-middle -->