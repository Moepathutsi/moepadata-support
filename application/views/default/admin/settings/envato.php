<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="z-form" action="<?php admin_action('settings/envato'); ?>" method="post" data-csrf="manual">
                    <div class="response-message"><?php echo alert_message(); ?></div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title"><?php echo lang('envato_settings'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php if (empty(db_config('envato_api_token'))) { ?>
                                <div class="alert alert-danger">
                                    <p><?php echo lang('add_envato_api_token'); ?></p>
                                </div><!-- /.alert -->
                            <?php } ?>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ask-tickets-pc"><?php echo lang('ask_tickets_pc'); ?></label>
                                    <select id="ask-tickets-pc" class="form-control select2 search-disabled" name="envato_ask_purchase_code_ticket">
                                        <option value="0" <?php echo select_single(0, db_config('envato_ask_purchase_code_ticket')); ?>><?php echo lang('no'); ?></option>
                                        <option value="1" <?php echo select_single(1, db_config('envato_ask_purchase_code_ticket')); ?>><?php echo lang('yes'); ?></option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group col-md-6">
                                    <label for="ask-chat-pc"><?php echo lang('ask_chat_pc'); ?></label>
                                    <select id="ask-chat-pc" class="form-control select2 search-disabled" name="envato_ask_purchase_code_chat">
                                        <option value="0" <?php echo select_single(0, db_config('envato_ask_purchase_code_chat')); ?>><?php echo lang('no'); ?></option>
                                        <option value="1" <?php echo select_single(1, db_config('envato_ask_purchase_code_chat')); ?>><?php echo lang('yes'); ?></option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.row -->
                            <div class="form-group <?php echo (db_config('envato_ask_purchase_code_ticket') == 0) ? 'd-none' : ''; ?>" id="ask-tickets-pc-child">
                                <label for="can-ct-if-unsupported"><?php echo lang('can_ct_if_unsupported'); ?></label>
                                <select id="can-ct-if-unsupported" class="form-control select2 search-disabled" name="envato_se_create_ticket">
                                    <option value="0" <?php echo select_single(0, db_config('envato_se_create_ticket')); ?>><?php echo lang('no'); ?></option>
                                    <option value="1" <?php echo select_single(1, db_config('envato_se_create_ticket')); ?>><?php echo lang('yes'); ?></option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group <?php echo (db_config('envato_ask_purchase_code_chat') == 0) ? 'd-none' : ''; ?>" id="ask-chat-pc-child">
                                <label for="can-cc-if-unsupported"><?php echo lang('can_cc_if_unsupported'); ?></label>
                                <select id="can-cc-if-unsupported" class="form-control select2 search-disabled" name="envato_se_create_chat">
                                    <option value="0" <?php echo select_single(0, db_config('envato_se_create_chat')); ?>><?php echo lang('no'); ?></option>
                                    <option value="1" <?php echo select_single(1, db_config('envato_se_create_chat')); ?>><?php echo lang('yes'); ?></option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="how-to-find-pc-link"><?php echo lang('how_to_find_pc_link'); ?></label>
                                <input type="text" id="how-to-find-pc-link" class="form-control" name="envato_how_to_find_pc" value="<?php echo html_escape(db_config('envato_how_to_find_pc')); ?>">
                            </div>
                            <!-- /.form-group -->
                            <label for="support-policy-url"><?php echo lang('support_policy_url'); ?></label>
                            <input type="text" id="support-policy-url" class="form-control" name="envato_support_policy_url" value="<?php echo html_escape(db_config('envato_support_policy_url')); ?>">
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