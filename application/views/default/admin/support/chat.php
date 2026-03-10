<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (! empty($chat_envato_response)) {
    if (! empty($chat_envato_response->envato_purchase_code_response)) {
        $purchase_information = @json_decode($chat_envato_response->envato_purchase_code_response);
    }
} else {
    $purchase_information = '';
}

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="not-in-form">
                    <div class="response-message"><?php echo alert_message(); ?></div>
                </div>
                <!-- /.not-in-form -->
            </div>
            <!-- /col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">

                <?php if ($this->zuser->has_permission('envato_purchase_information') && ! empty($purchase_information)) { ?>
                    <div class="card collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('envato_purchase_info'); ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="list-group">

                                <?php if ($this->zuser->has_permission('all_chats')) { ?>
                                    <li class="list-group-item">
                                        <span>
                                            <strong><?php echo lang('purchase_code'); ?>:</strong>
                                            <?php
                                            if (! empty($chat_envato_response->envato_purchase_code)) {
                                                echo html_escape($chat_envato_response->envato_purchase_code);
                                            } else {
                                                echo lang('n_a');
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span>
                                            <strong><?php echo lang('amount'); ?>:</strong>
                                            <?php
                                            if (! empty($purchase_information->amount)) {
                                                echo html_escape($purchase_information->amount);
                                            } else {
                                                echo lang('n_a');
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span>
                                            <strong><?php echo lang('purchase_count'); ?>:</strong>
                                            <?php
                                            if (! empty($purchase_information->purchase_count)) {
                                                echo html_escape($purchase_information->purchase_count);
                                            } else {
                                                echo lang('n_a');
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span>
                                            <strong><?php echo lang('support_amount'); ?>:</strong>
                                            <?php
                                            if (! empty($purchase_information->support_amount)) {
                                                echo html_escape($purchase_information->support_amount);
                                            } else {
                                                echo lang('n_a');
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span>
                                            <strong><?php echo lang('buyer'); ?>:</strong>
                                            <?php
                                            if (! empty($purchase_information->buyer)) {
                                                echo html_escape($purchase_information->buyer);
                                            } else {
                                                echo lang('n_a');
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span>
                                            <strong><?php echo lang('sold_at'); ?>:</strong>
                                            <?php
                                            if (! empty($purchase_information->sold_at)) {
                                                echo html_escape($purchase_information->sold_at);
                                            } else {
                                                echo lang('n_a');
                                            }
                                            ?>
                                        </span>
                                    </li>
                                <?php } ?>

                                <li class="list-group-item">
                                    <span>
                                        <strong><?php echo lang('item_name'); ?>:</strong>
                                        <?php
                                        if (! empty($purchase_information->item->name)) {
                                            echo html_escape($purchase_information->item->name);
                                        } else {
                                            echo lang('n_a');
                                        }
                                        ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span>
                                        <strong><?php echo lang('license'); ?>:</strong>
                                        <?php
                                        if (! empty($purchase_information->license)) {
                                            echo html_escape($purchase_information->license);
                                        } else {
                                            echo lang('n_a');
                                        }
                                        ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span>
                                        <strong><?php echo lang('supported_until'); ?>:</strong>
                                        <?php
                                        if (! empty($purchase_information->supported_until)) {
                                            echo html_escape($purchase_information->supported_until);
                                        } else {
                                            echo lang('n_a');
                                        }
                                        ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                <?php } ?>

                <div class="card z-card">
                    <div class="card-body p-0">
                        <p class="pb-2 my-2 text-center shadow-sm">
                            <span class="badge badge-primary mr-1 mb-2 mb-sm-0"><?php printf(lang('chat_no'), html_escape($chat->id)); ?></span>
                            <span class="d-block d-sm-inline-block font-weight-bold"><?php echo replace_some_with_actuals(html_escape($chat->subject)); ?></span>
                        </p>
                        <div id="chat-box-body" class="chat-box-body">
                            <div id="chat-messages" class="chat-messages" data-chat-status="<?php echo html_escape($chat->status); ?>" data-chat-action="<?php admin_action('support/get_chat_messages/' . html_escape($chat->id)); ?>">
                                <div class="chat-message">
                                    <div class="d-flex">
                                        <div class="sender-pic">
                                            <img src="<?php echo user_picture(html_esc_url($chat->user_picture)); ?>" class="img-circle" alt="User Image">
                                        </div>
                                        <!-- /.sender-pic -->
                                        <div class="ml-2">
                                            <p class="message py-2 px-3 rounded"><?php echo nl2br(make_text_links(replace_some_with_actuals(html_escape($chat->message)))); ?></p>
                                            <div class="fs-sm text-secondary">
                                                <?php printf(lang('sent_by_at'), html_escape($chat->first_name . ' ' . $chat->last_name), get_time_by_timezone(html_escape($chat->created_at))); ?>
                                            </div>
                                        </div>
                                        <!-- /.ml-2 -->
                                    </div>
                                    <!-- /.d-flex -->
                                </div>
                                <!-- /.chat-message -->

                                <?php if (! empty($replies)) {
                                    foreach ($replies as $reply) { ?>
                                        <?php if ($reply->area == 1) { ?>
                                            <div class="chat-message sender" data-reply-id="<?php echo html_escape($reply->id); ?>">
                                                <div class="clearfix">
                                                    <p class="message py-2 px-3 rounded"><?php echo nl2br(make_text_links(replace_some_with_actuals(html_escape($reply->message)))); ?></p>
                                                </div>
                                                <!-- /.clearfix -->
                                                <div class="fs-sm message-time text-secondary">
                                                    <?php printf(lang('sent_by_at'), html_escape($reply->first_name . ' ' . $reply->last_name), get_time_by_timezone(html_escape($reply->replied_at))); ?>
                                                </div>
                                            </div>
                                            <!-- /.chat-message -->
                                        <?php } else { ?>
                                            <div class="chat-message" data-reply-id="<?php echo html_escape($reply->id); ?>">
                                                <div class="d-flex">
                                                    <div class="sender-pic mb-2">
                                                        <?php if (! empty($reply->user_picture)) { ?>
                                                            <img src="<?php echo user_picture(html_esc_url($reply->user_picture)); ?>" class="img-circle" alt="User Image">
                                                        <?php } else { ?>
                                                            <img src="<?php echo user_picture(DEFAULT_USER_IMG); ?>" class="img-circle" alt="User Image">
                                                        <?php } ?>
                                                    </div>
                                                    <!-- /.sender-pic -->
                                                    <div class="ml-2">
                                                        <p class="message py-2 px-3 rounded"><?php echo nl2br(make_text_links(replace_some_with_actuals(html_escape($reply->message)))); ?></p>
                                                        <div class="fs-sm text-secondary">
                                                            <?php printf(lang('sent_by_at'), html_escape($reply->first_name . ' ' . $reply->last_name), get_time_by_timezone(html_escape($reply->replied_at))); ?>
                                                        </div>
                                                    </div>
                                                    <!-- /.ml-2 -->
                                                </div>
                                                <!-- /.d-flex -->
                                            </div>
                                            <!-- /.chat-message -->
                                        <?php } ?>

                                <?php }
                                } ?>

                            </div>
                            <!-- /.chat-messages -->
                        </div>
                        <!-- /.chat-box-body -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-body">
                        <?php if ($chat->status != 0) { ?>
                            <form class="z-form add-reply-admin" action="<?php admin_action('support/add_chat_reply'); ?>" method="post" data-csrf="manual">
                                <div class="response-message"></div>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="form-group">
                                    <div class="row mb-3 d-flex align-items-center">
                                        <div class="col-xl-8">
                                            <label for="your-reply"><?php echo lang('your_reply'); ?> <span class="required">*</span></label>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-xl-4">
                                            <select class="form-control select2" id="canned-reply" data-placeholder="<?php echo lang('select_canned_reply'); ?>" data-action="<?php admin_action('support/get_canned_reply/' . html_escape($chat->id)); ?>/chat">
                                                <option></option>

                                                <?php if (! empty($canned_replies)) {
                                                    foreach ($canned_replies as $canned_reply) { ?>
                                                        <option value="<?php echo html_escape($canned_reply->id); ?>"><?php echo html_escape($canned_reply->subject); ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <textarea id="your-reply" class="form-control chat-textarea" name="reply" data-output-field="your_reply" rows="2" placeholder="<?php echo lang('admin_chat_reply_tip'); ?>" required></textarea>
                                </div>
                                <!-- /.form-group -->

                                <?php if (is_openai_ready()) { ?>
                                    <button type="button" class="btn btn-success float-left text-sm take-field-val" data-toggle="modal" data-target="#ai-writer" data-field-val="#your-reply">
                                        <i class="fas fa-robot mr-2"></i> <?php echo lang('ai_writer'); ?>
                                    </button>
                                <?php } ?>

                                <button type="submit" class="btn btn-primary float-right text-sm">
                                    <i class="fas fa-check mr-2"></i> <?php echo lang('send'); ?>
                                </button>
                                <input type="hidden" name="id" value="<?php echo html_escape($chat->id); ?>">
                            </form>
                        <?php } else {
                            $ended_by = (! empty($chat->ended_by)) ? $chat->eb_first_name . ' ' . $chat->eb_last_name : lang('n_a'); ?>
                            <div class="text-center">
                                <span class="d-block"><?php printf(lang('chat_ended_by_msg'), $ended_by); ?></span>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-md-flex align-items-center">
                                <span><?php echo lang('status'); ?>:</span>
                                <span class="ml-auto float-right badge <?php echo chat_status_color($chat->status); ?>">
                                    <?php echo manage_chat_status($chat->status); ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <?php echo lang('requester'); ?>:

                                <?php if (! empty($chat->first_name)) { ?>

                                    <?php if ($this->zuser->has_permission('users')) { ?>
                                        <a class="float-right" href="<?php echo env_url('admin/users/edit_user/' . html_escape($chat->user_id)); ?>" target="_blank">
                                            <?php echo html_escape($chat->first_name . ' ' . $chat->last_name); ?>
                                        </a>
                                    <?php } else { ?>
                                        <span class="float-right"><?php echo html_escape($chat->first_name . ' ' . $chat->last_name); ?></span>
                                    <?php } ?>

                                <?php } else { ?>
                                    <span class="float-right"><?php echo lang('user_deleted'); ?></span>
                                <?php } ?>
                            </li>
                            <li class="list-group-item d-md-flex align-items-center">
                                <span><?php echo lang('department'); ?>:</span>
                                <span class="ml-auto float-right text-right">
                                    <?php
                                    if (! empty($chat->department)) { ?>
                                        <span data-toggle="tooltip" title="<?php echo html_escape($chat->department); ?>">
                                            <?php echo html_escape(long_to_short_name($chat->department)); ?>
                                        </span>
                                    <?php
                                    } else {
                                        echo lang('unknown');
                                    }
                                    ?>
                                    <p class="text-right"><a href="#" data-toggle="modal" data-target="#change-chat-department" class="small">( <?php echo lang('change'); ?> )</a></p>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <?php echo lang('assigned_to'); ?>:

                                <span class="float-right">
                                    <?php if (! empty($chat->assigned_to && ! empty($chat->au_first_name))) { ?>

                                        <?php if ($this->zuser->has_permission('users')) { ?>
                                            <a class="float-right" href="<?php echo env_url('admin/users/edit_user/' . html_escape($chat->assigned_to)); ?>" target="_blank">
                                                <?php echo html_escape($chat->au_first_name . ' ' . $chat->au_last_name); ?>
                                            </a>
                                        <?php } else { ?>
                                            <span class="float-right"><?php echo html_escape($chat->au_first_name . ' ' . $chat->au_last_name); ?></span>
                                        <?php } ?>

                                    <?php } else if (! empty($chat->assigned_to)) { ?>
                                        <span class="float-right"><?php echo lang('user_deleted'); ?></span>
                                    <?php } else { ?>
                                        <span class="float-right"><?php echo lang('n_a'); ?></span>
                                    <?php } ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <?php echo lang('created'); ?>:
                                <span class="float-right">
                                    <?php echo get_date_time_by_timezone(html_escape($chat->created_at)); ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <?php if ($chat->status != 0) { ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <button class="btn btn-success text-sm" data-toggle="modal" data-target="#end-chat">
                                    <i class="fas fa-check mr-2"></i> <?php echo lang('end_chat'); ?>
                                </button>
                                <button class="ml-1 btn btn-primary text-sm" data-toggle="modal" data-target="#assign-user-chat">
                                    <i class="fas fa-user mr-2"></i> <?php echo lang('assign'); ?>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                <?php } ?>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php load_modals(['admin/ai_writer_fixed', 'admin/assign_user_chat', 'admin/end_chat', 'delete', 'admin/change_chat_department']); ?>