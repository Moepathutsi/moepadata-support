<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="z-form" action="<?php admin_action('settings/imap'); ?>" method="post" data-csrf="manual">
                    <div class="response-message"><?php echo alert_message(); ?></div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title"><?php echo lang('imap_settings'); ?></h3>

                            <div class="ml-auto">
                                <button type="button" class="btn btn-success text-sm" data-toggle="modal" data-target="#test-imap-settings">
                                    <i class="fas fa-cogs mr-2"></i> <?php echo lang('test_settings'); ?>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php if (! is_email_settings_filled()) { ?>
                                <div class="alert alert-danger">
                                    <p><?php echo lang('add_email_settings'); ?></p>
                                </div><!-- /.alert -->
                            <?php } ?>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="host"><?php echo lang('host'); ?> <span class="required">*</span></label>
                                    <input type="text" id="host" class="form-control" name="imap_host" value="<?php echo html_escape(db_config('imap_host')); ?>">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group col-md-6">
                                    <label for="protocol"><?php echo lang('protocol'); ?> <span class="required">*</span></label>
                                    <input type="text" id="protocol" class="form-control" name="imap_protocol" value="<?php echo html_escape(db_config('imap_protocol')); ?>" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.form-row -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="username"><?php echo lang('username'); ?> <span class="required">*</span></label>
                                    <input type="text" id="username" class="form-control" name="imap_username" value="<?php echo html_escape(db_config('imap_username')); ?>">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group col-md-6">
                                    <label for="password"><?php echo lang('password'); ?> <span class="required">*</span></label>
                                    <input type="password" id="password" class="form-control" name="imap_password" value="<?php echo html_escape(db_config('imap_password')); ?>">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.form-row -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="encryption"><?php echo lang('encryption'); ?></label>
                                    <select id="encryption" class="form-control select2 search-disabled" name="imap_encryption">
                                        <option value=""><?php echo lang('none'); ?></option>
                                        <option value="tls" <?php echo select_single('tls', db_config('imap_encryption')); ?>><?php echo lang('tls'); ?></option>
                                        <option value="ssl" <?php echo select_single('ssl', db_config('imap_encryption')); ?>><?php echo lang('ssl'); ?></option>
                                    </select>
                                </div>
                                <!-- /.col -->
                                <div class="form-group col-md-6">
                                    <label for="port"><?php echo lang('port'); ?> <span class="required">*</span></label>
                                    <input type="number" id="port" class="form-control" name="imap_port" value="<?php echo html_escape(db_config('imap_port')); ?>">
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.form-row -->
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="validate-cert"><?php echo lang('certificate'); ?></label>
                                    <select id="validate-cert" class="form-control select2 search-disabled" name="imap_validate_cert">
                                        <option value="1" <?php echo select_single(1, db_config('imap_validate_cert')); ?>><?php echo lang('validate'); ?></option>
                                        <option value="0" <?php echo select_single(0, db_config('imap_validate_cert')); ?>><?php echo lang('no_validate'); ?></option>
                                    </select>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.form-row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right text-sm">
                                <i class="fas fa-check mr-2"></i> <?php echo lang('update'); ?>
                            </button>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php load_modals('admin/test_imap_settings'); ?>