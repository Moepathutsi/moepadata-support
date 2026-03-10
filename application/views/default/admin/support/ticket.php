<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (! empty($ticket_envato_response)) {
  if (! empty($ticket_envato_response->envato_purchase_code_response)) {
    $purchase_information = @json_decode($ticket_envato_response->envato_purchase_code_response);
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
      <div class="col-xl-8">

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

                <?php if ($this->zuser->has_permission('all_tickets')) { ?>
                  <li class="list-group-item">
                    <span>
                      <strong><?php echo lang('purchase_code'); ?>:</strong>
                      <?php
                      if (! empty($ticket_envato_response->envato_purchase_code)) {
                        echo html_escape($ticket_envato_response->envato_purchase_code);
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
          <div class="card-body">
            <div class="clearfix">
              <span class="badge badge-primary"><?php printf(lang('ticket_no'), html_escape($ticket->id)); ?></span>

              <?php if ($ticket->user_id == null) { ?>
                <a class="float-right" href="<?php echo env_url('ticket/guest/' . html_escape($ticket->security_key) . '/' . html_escape($ticket->id)); ?>" target="_blank">
                  <i class="fas fa-external-link-alt mr-1"></i> <?php echo lang('open_guest_view'); ?>
                </a>
              <?php } ?>

            </div>
            <!-- /.clearfix -->
            <h3 class="h4 mt-2 font-weight-bold"><?php echo replace_some_with_actuals(html_escape($ticket->subject)); ?></h3>
            <p>
              <?php echo nl2br(make_text_links(replace_some_with_actuals(html_escape($ticket->message)))); ?>

              <?php if (! empty($fields) && is_custom_fields_having_value($fields)) { ?>
            <div class="mt-3">
              <span class="d-block font-weight-bold"><?php echo lang('additional_information'); ?>:</span>
              <?php $i = 0;
                foreach ($fields as $field) {
                  if (! empty($field->value)) {
                    $mt_class = ($i == 0) ? 'mt-1' : 'mt-2'; ?>
                  <p class="<?php echo html_escape($mt_class); ?>"><span><?php echo html_escape($field->name); ?>:</span> <?php echo nl2br(html_escape($field->value)); ?></p>
              <?php $i++;
                  }
                } ?>
            </div>
            <!-- /.mt-3 -->
          <?php } ?>

          <?php if (! empty($ticket->attachment_name)) { ?>
            <span class="mt-3 d-block font-weight-bold"><?php echo lang('attachment'); ?>:</span>

            <?php if (is_image_file($ticket->attachment)) { ?>
              <img
                class="rounded d-block mt-2 cursor-pointer shadow attached-img popup-img-attachment"
                src="<?php echo attachments_uploads(html_escape($ticket->attachment)); ?>"
                alt="Attachment">
            <?php } ?>

            <span class="small"><i class="fas fa-paperclip text-muted mr-1"></i></span>
            <a href="<?php echo attachments_uploads(html_escape($ticket->attachment)); ?>" class="text-primary fs-sm" download="<?php echo html_escape($ticket->attachment_name); ?>">
              <span data-toggle="tooltip" title="<?php echo html_escape($ticket->attachment_name); ?>">
                <?php echo html_escape(long_to_short_name($ticket->attachment_name)); ?>
              </span>
            </a>

          <?php } else { ?>

            <?php

            $ticket_main_attachments = get_ticket_attachments($ticket->id);

            if (! empty($ticket_main_attachments)) { ?>

              <span class="mt-3 d-block font-weight-bold"><?php echo lang('attachments'); ?>:</span>

              <?php foreach ($ticket_main_attachments as $ticket_main_attachment) { ?>

                <?php if (is_image_file($ticket_main_attachment->attachment)) { ?>
                  <img
                    class="rounded d-block mt-2 cursor-pointer shadow attached-img popup-img-attachment"
                    src="<?php echo attachments_uploads(html_escape($ticket_main_attachment->attachment)); ?>"
                    alt="Attachment">
                <?php } ?>

                <span class="d-block">
                  <span class="small"><i class="fas fa-paperclip text-muted mr-1"></i></span>
                  <a href="<?php echo attachments_uploads(html_escape($ticket_main_attachment->attachment)); ?>" class="text-primary fs-sm" download="<?php echo html_escape($ticket_main_attachment->attachment_name); ?>">
                    <span data-toggle="tooltip" title="<?php echo html_escape($ticket_main_attachment->attachment_name); ?>">
                      <?php echo html_escape(long_to_short_name($ticket_main_attachment->attachment_name)); ?>
                    </span>
                  </a>
                </span>
              <?php } ?>
            <?php } ?>

          <?php } ?>
          </p>
          <hr>
          <?php if (! empty($replies)) {
            foreach ($replies as $reply) {
              $reply_attachments = get_ticket_reply_attachments($reply->id);
              $display_attachments_label = true; ?>
              <div class="reply-message" id="section-<?php echo md5($reply->id); ?>">
                <div class="replier mb-2">
                  <?php if (! empty($reply->user_picture)) { ?>
                    <img src="<?php echo user_picture(html_esc_url($reply->user_picture)); ?>" class="img-circle" alt="User Image">
                    <span class="name"><?php echo html_escape($reply->first_name . ' ' . $reply->last_name); ?></span>
                  <?php } else { ?>
                    <img src="<?php echo user_picture(DEFAULT_USER_IMG); ?>" class="img-circle" alt="User Image">
                    <span class="name"><?php echo ($reply->user_id == null) ? lang('customer') : lang('user_deleted'); ?></span>
                  <?php } ?>
                </div>
                <!-- /.replier -->
                <p class="mb-2">
                  <?php echo nl2br(make_text_links(replace_some_with_actuals(html_escape($reply->message)))); ?>

                  <?php if (! empty($reply->attachment_name)) {
                    $display_attachments_label = false; ?>
                    <span class="mt-3 d-block font-weight-bold"><?php echo lang('attachments'); ?>:</span>

                    <?php if (is_image_file($reply->attachment)) { ?>
                      <img
                        class="rounded d-block mt-2 cursor-pointer shadow attached-img popup-img-attachment"
                        src="<?php echo attachments_uploads(html_escape($reply->attachment)); ?>"
                        alt="Attachment">
                    <?php } ?>

                    <span class="small"><i class="fas fa-paperclip text-muted mr-1"></i></span>
                    <a href="<?php echo attachments_uploads(html_escape($reply->attachment)); ?>" class="text-primary fs-sm" download="<?php echo html_escape($reply->attachment_name); ?>">
                      <span data-toggle="tooltip" title="<?php echo html_escape($reply->attachment_name); ?>">
                        <?php echo html_escape(long_to_short_name($reply->attachment_name)); ?>
                      </span>
                    </a>
                  <?php } ?>

                  <?php if (! empty($reply_attachments)) { ?>

                    <?php if ($display_attachments_label) { ?>
                      <span class="mt-3 d-block font-weight-bold"><?php echo lang('attachments'); ?>:</span>
                    <?php } ?>

                    <?php foreach ($reply_attachments as $reply_attachment) { ?>

                      <?php if (is_image_file($reply_attachment->attachment)) { ?>
                        <img
                          class="rounded d-block mt-2 cursor-pointer shadow attached-img popup-img-attachment"
                          src="<?php echo attachments_uploads(html_escape($reply_attachment->attachment)); ?>"
                          alt="Attachment-<?php echo html_escape($reply_attachment->id); ?>">
                      <?php } ?>

                      <span class="d-block">
                        <span class="small"><i class="fas fa-paperclip text-muted mr-1"></i></span>
                        <a href="<?php echo attachments_uploads(html_escape($reply_attachment->attachment)); ?>" class="text-primary fs-sm" download="<?php echo html_escape($reply_attachment->attachment_name); ?>">
                          <span data-toggle="tooltip" title="<?php echo html_escape($reply_attachment->attachment_name); ?>">
                            <?php echo html_escape(long_to_short_name($reply_attachment->attachment_name)); ?>
                          </span>
                        </a>
                      </span>
                    <?php } ?>
                  <?php } ?>
                </p>

                <?php if (! empty($reply->quoted_message)) { ?>
                  <p class="fs-sm text-primary mb-2 show-quoted-message cursor-pointer" id="<?php echo intval($reply->id); ?>">
                    <i class="nav-icon fas fa-quote-right mr-1"></i> <?php echo lang('quoted_message'); ?>
                  </p>
                  <p class="d-none data-target-<?php echo intval($reply->id); ?>"><?php echo nl2br(html_escape($reply->quoted_message)); ?></p>
                <?php } ?>

                <div class="fs-sm text-secondary">
                  <p>
                    <i class="nav-icon far fa-clock mr-1"></i>
                    <?php echo get_date_time_by_timezone(html_escape($reply->replied_at)); ?>
                  </p>

                  <?php if (! empty($reply->updated_at)) { ?>
                    <p>
                      <i class="nav-icon far fa-clock mr-1"></i>
                      <?php echo get_date_time_by_timezone(html_escape($reply->updated_at)) . ' <i>' . lang('edited_brackets') . '</i>'; ?>
                    </p>
                  <?php } ?>

                </div>
                <!-- /.replied-at -->

                <?php if ($this->zuser->has_permission('edit_ticket_reply') || $this->zuser->has_permission('delete_ticket_reply')) { ?>
                  <div class="btn-group">

                    <?php if ($this->zuser->has_permission('edit_ticket_reply')) { ?>
                      <button class="btn text-sm btn-primary get-data-tool mt-4" data-source="<?php admin_action('support/edit_ticket_reply'); ?>" data-id="<?php echo html_escape($reply->id); ?>">
                        <span class="fas fa-edit get-data-tool-c"></span>
                      </button>
                    <?php } ?>

                    <?php if ($this->zuser->has_permission('delete_ticket_reply')) { ?>
                      <button class="btn text-sm btn-danger tool mt-4" data-id="<?php echo html_escape($reply->id); ?>" data-toggle="modal" data-target="#delete">
                        <i class="fas fa-trash tool-c"></i>
                      </button>
                    <?php } ?>

                  </div>
                  <!-- /.btn-group -->
                <?php } ?>

              </div>
              <!-- /.reply-message -->
            <?php }
          } else { ?>
            <div class="text-center">
              <span class="d-block text-secondary"><?php echo lang('no_replies'); ?></span>
            </div>
          <?php } ?>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-body">
            <?php if ($ticket->status != 0) { ?>
              <form class="z-form add-reply-admin" action="<?php admin_action('support/add_reply'); ?>" method="post" enctype="multipart/form-data" data-csrf="manual">
                <div class="response-message"></div>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                  <div class="row mb-3 d-flex align-items-center">
                    <div class="col-xl-8">
                      <label for="your-reply"><?php echo lang('your_reply'); ?> <span class="required">*</span></label>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-4">
                      <select class="form-control select2" id="canned-reply" data-placeholder="<?php echo lang('select_canned_reply'); ?>" data-action="<?php admin_action('support/get_canned_reply/' . html_escape($ticket->id)); ?>">
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
                  <textarea id="your-reply" class="form-control" name="reply" data-output-field="your_reply" rows="10"></textarea>

                  <?php if ($ticket->sub_status != 3) { ?>
                    <small class="form-text text-muted"><?php echo lang('your_reply_opt'); ?></small>
                  <?php } ?>
                </div>
                <!-- /.form-group -->

                <?php if (is_openai_ready()) { ?>
                  <div class="form-group">
                    <button type="button" class="btn btn-success text-sm take-field-val" data-toggle="modal" data-target="#ai-writer" data-field-val="#your-reply">
                      <i class="fas fa-robot mr-2"></i> <?php echo lang('ai_writer'); ?>
                    </button>
                  </div>
                  <!-- /.form-group -->
                <?php } ?>

                <?php
                $my_id = $this->zuser->get('id');

                if ($ticket->sub_status != 3 || $ticket->assigned_to != $my_id) { ?>
                  <div class="form-group">

                    <?php if ($ticket->sub_status != 3) { ?>
                      <div class="icheck icheck-primary d-inline-block mr-2">
                        <input type="checkbox" name="solved" value="1" id="solved">
                        <label for="solved"><span class="label-span"><?php echo lang('mark_as_solved'); ?></span></label>
                      </div>
                      <!-- /.icheck -->
                    <?php } ?>

                    <?php if ($ticket->assigned_to != $my_id && $ticket->user_id != $my_id) { ?>
                      <div class="icheck icheck-primary d-inline-block">
                        <input type="checkbox" name="assign_to_me" value="1" id="assign-to-me" <?php echo ($ticket->assigned_to == null) ? 'checked' : ''; ?>>
                        <label for="assign-to-me"><span class="label-span"><?php echo lang('assign_to_me'); ?></span></label>
                      </div>
                      <!-- /.icheck -->
                    <?php } ?>

                  </div>
                  <!-- /.form-group -->
                <?php } ?>

                <div class="form-group">
                  <label for="attachment"><?php echo lang('attach_files'); ?></label>
                  <input type="file" class="d-block" id="attachment" name="attachment" accept="<?php echo ALLOWED_ATTACHMENTS_EXT_HTML; ?>" multiple="true" data-max-files="<?php echo intval(db_config('max_files')); ?>">
                  <small class="form-text text-muted"><?php echo lang('attach_file_tip'); ?></small>
                </div>
                <!-- /.form-group -->
                <button type="submit" class="btn btn-primary float-right text-sm">
                  <i class="fas fa-check mr-2"></i> <?php echo lang('submit'); ?>
                </button>

                <input type="hidden" name="id" value="<?php echo html_escape($ticket->id); ?>">
              </form>
            <?php } else if ($ticket->user_id != null || ! empty($ticket->closed_by)) {
              $closed_by = (! empty($ticket->closed_by)) ? $ticket->cb_first_name . ' ' . $ticket->cb_last_name : lang('system'); ?>
              <div class="text-center">
                <span class="d-block"><?php printf(lang('ticket_closed_by_msg'), $closed_by); ?></span>
              </div>
            <?php } else { ?>
              <div class="text-center">
                <span class="d-block"><?php echo lang('ticket_closed_msg'); ?></span>
              </div>
            <?php } ?>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="card-title"><?php echo lang('tasks'); ?></h3>
            <div class="ml-auto">
              <button class="btn btn-success text-sm" data-toggle="modal" data-target="#add-ticket-task">
                <i class="fas fa-plus mr-2"></i> <?php echo lang('add_task'); ?>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <div class="card-body pt-0 pb-0 records-card-body">
            <div class="table-responsive">
              <table class="custom-table table z-table table-striped table-valign-middle mb-0">
                <thead class="records-thead">
                  <tr>
                    <th><?php echo lang('title'); ?></th>
                    <th class="text-right"><?php echo lang('created'); ?></th>
                    <th class="text-right th-2"><?php echo lang('priority'); ?></th>
                    <th class="text-right th-2"><?php echo lang('actions'); ?></th>
                  </tr>
                </thead>
                <tbody class="records-tbody text-sm">
                  <?php
                  if (! empty($tasks)) {
                    foreach ($tasks as $task) {
                      $task_username = (! empty($task->username)) ? $task->username : lang('n_a');
                      $id = $task->id; ?>
                      <tr id="record-<?php echo html_escape($id); ?>">
                        <td>
                          <div class="icheck icheck-success d-inline-block">
                            <input class="todo-checkbox" type="checkbox" id="checkbox-<?php echo intval($task->id); ?>" value="<?php echo intval($task->id); ?>" data-url="<?php admin_action('support/update_task_status'); ?>" <?php echo check_single($task->status, 1); ?>>
                            <label for="checkbox-<?php echo intval($task->id); ?>"><strong class="<?php echo ($task->status == 1) ? 'line-through' : ''; ?>" id="checkbox-title-<?php echo intval($task->id); ?>"><?php echo html_escape($task->title); ?></strong></label>
                          </div>
                          <p><?php echo nl2br(html_escape($task->description)); ?></p>
                        </td>
                        <td class="text-right">
                          <span class="d-block"><?php echo get_date_time_by_timezone(html_escape($task->created_at)); ?></span>
                          <span class="text-muted"><?php printf(lang('added_by'), html_escape($task_username)); ?></span>
                        </td>
                        <td class="text-right"><span class="badge <?php echo ticket_priority_color($task->priority, 'admin'); ?>"><?php echo lang(html_escape($task->priority)); ?></span></td>
                        <td class="text-right">
                          <div class="btn-group">
                            <button class="btn text-sm btn-primary get-data-tool" data-source="<?php admin_action('support/edit_ticket_task'); ?>" data-id="<?php echo html_escape($task->id); ?>">
                              <span class="fas fa-edit get-data-tool-c"></span>
                            </button>
                            <button class="btn text-sm btn-danger" data-toggle="modal" data-target="#delete-ticket-task-<?php echo intval($task->id); ?>">
                              <i class="fas fa-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    <?php }
                  } else {
                    ?>
                    <tr id="record-0">
                      <td colspan="4"><?php echo lang('no_tasks'); ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="card-title"><?php echo lang('notes'); ?></h3>
            <div class="ml-auto">
              <button class="btn btn-success text-sm" data-toggle="modal" data-target="#add-ticket-note">
                <i class="fas fa-plus mr-2"></i> <?php echo lang('add_note'); ?>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <div class="card-body">
            <?php if (! empty($notes)) { ?>
              <ul class="list-group">
                <?php foreach ($notes as $note) { ?>
                  <li class="list-group-item">
                    <?php $note_username = (! empty($note->username)) ? $note->username : lang('n_a'); ?>
                    <small class="d-block text-muted"><?php printf(lang('added_by'), html_escape($note_username)); ?></small>
                    <p><?php echo html_escape($note->note); ?></p>

                    <?php if (! empty($note->attachment)) { ?>
                      <span class="small"><i class="fas fa-paperclip text-muted mr-1"></i></span>
                      <a href="<?php echo attachments_uploads(html_escape($note->attachment)); ?>" class="text-primary fs-sm" download="<?php echo html_escape($note->attachment_name); ?>">
                        <span data-toggle="tooltip" title="<?php echo html_escape($note->attachment_name); ?>">
                          <?php echo html_escape(long_to_short_name($note->attachment_name)); ?>
                        </span>
                      </a>
                    <?php } ?>

                    <small class="mt-1 d-block text-muted"><?php echo get_date_time_by_timezone(html_escape($note->created_at)); ?></small>

                    <button class="mt-3 btn text-sm btn-danger tool" data-toggle="modal" data-target="#delete-ticket-note-<?php echo intval($note->id); ?>">
                      <i class="fas fa-trash tool-c"></i>
                    </button>
                  </li>
                <?php } ?>
              </ul>
            <?php } else { ?>
              <div class="text-center">
                <span class="d-block text-secondary"><?php echo lang('no_notes'); ?></span>
              </div>
            <?php } ?>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <?php if (! empty($history)) { ?>
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h3 class="card-title"><?php echo lang('history'); ?></h3>

              <?php if ($history_count > 3) { ?>
                <div class="ml-auto">
                  <a href="<?php echo env_url('admin/tickets/history/' . html_escape($ticket->id)); ?>/page/1" class="btn btn-dark text-sm">
                    <i class="fas fa-eye mr-2"></i> <?php echo lang('see_all'); ?>
                  </a>
                </div>
                <!-- /.card-tools -->
              <?php } ?>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <?php foreach ($history as $data) { ?>
                  <li class="list-group-item">
                    <?php
                    if (! empty($data->user_id)) {
                      printf(lang(html_escape($data->message_key)), $data->username);
                    } else {
                      echo lang(html_escape($data->message_key));
                    }
                    ?>

                    <small class="mt-1 d-block text-muted"><?php echo get_date_time_by_timezone(html_escape($data->created_at)); ?></small>
                  </li>
                <?php } ?>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        <?php } ?>

      </div>
      <!-- /.col -->
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body">

            <?php if ($ticket->user_id == null) { ?>
              <button class="btn-block btn btn-secondary text-sm mb-3" data-toggle="modal" data-target="#resend-access">
                <i class="fas fa-paper-plane mr-2"></i> <?php echo lang('resend_access'); ?>
              </button>
            <?php } ?>

            <ul class="list-group">
              <li class="list-group-item d-md-flex align-items-center">
                <span><?php echo lang('status'); ?>:</span>
                <span class="ml-auto float-right badge <?php echo ticket_status_color($ticket->status, 'admin'); ?>">
                  <?php echo manage_ticket_status($ticket->status); ?>
                </span>
              </li>
              <li class="list-group-item d-md-flex align-items-center">
                <span><?php echo lang('reply_status'); ?>:</span>
                <span class="ml-auto float-right badge <?php echo ticket_sub_status_color($ticket->sub_status, 'admin'); ?>">
                  <?php echo manage_ticket_sub_status($ticket->sub_status, 'admin'); ?>
                </span>
              </li>
              <li class="list-group-item">
                <?php echo lang('requester'); ?>:

                <?php if (! empty($ticket->first_name)) { ?>

                  <?php if ($this->zuser->has_permission('users')) { ?>
                    <a class="float-right" href="<?php echo env_url('admin/users/edit_user/' . html_escape($ticket->user_id)); ?>" target="_blank">
                      <?php echo html_escape($ticket->first_name . ' ' . $ticket->last_name); ?>
                    </a>
                  <?php } else { ?>
                    <span class="float-right"><?php echo html_escape($ticket->first_name . ' ' . $ticket->last_name); ?></span>
                  <?php } ?>

                <?php } else { ?>
                  <span class="float-right"><?php echo ($ticket->email_address != '') ? html_escape(long_to_short_name($ticket->email_address)) : lang('user_deleted'); ?></span>
                <?php } ?>
              </li>

              <?php if ($ticket->user_id == null) { ?>
                <li class="list-group-item">
                  <?php echo lang('email_verified'); ?>:
                  <span class="float-right badge <?php echo ($ticket->is_verified == 0) ? 'badge-danger' : 'badge-success'; ?>">
                    <?php echo ($ticket->is_verified == 0) ? lang('no') : lang('yes'); ?>
                  </span>
                </li>
              <?php } ?>

              <li class="list-group-item d-md-flex align-items-center">
                <span><?php echo lang('department'); ?>:</span>
                <span class="ml-auto float-right text-right">
                  <?php
                  if (! empty($ticket->department)) { ?>
                    <span data-toggle="tooltip" title="<?php echo html_escape($ticket->department); ?>">
                      <?php echo html_escape(long_to_short_name($ticket->department)); ?>
                    </span>
                  <?php
                  } else {
                    echo lang('unknown');
                  }
                  ?>
                  <p class="text-right"><a href="#" data-toggle="modal" data-target="#change-ticket-department" class="small">( <?php echo lang('change'); ?> )</a></p>
                </span>
              </li>
              <li class="list-group-item">
                <?php echo lang('assigned_to'); ?>:

                <span class="float-right">
                  <?php if (! empty($ticket->assigned_to && ! empty($ticket->au_first_name))) { ?>

                    <?php if ($this->zuser->has_permission('users')) { ?>
                      <a class="float-right" href="<?php echo env_url('admin/users/edit_user/' . html_escape($ticket->assigned_to)); ?>" target="_blank">
                        <?php echo html_escape($ticket->au_first_name . ' ' . $ticket->au_last_name); ?>
                      </a>
                    <?php } else { ?>
                      <span class="float-right"><?php echo html_escape($ticket->au_first_name . ' ' . $ticket->au_last_name); ?></span>
                    <?php } ?>

                  <?php } else if (! empty($ticket->assigned_to)) { ?>
                    <span class="float-right"><?php echo lang('user_deleted'); ?></span>
                  <?php } else { ?>
                    <span class="float-right"><?php echo lang('n_a'); ?></span>
                  <?php } ?>
                </span>
              </li>
              <li class="list-group-item d-md-flex align-items-center">
                <span><?php echo lang('priority'); ?>:</span>
                <span class="ml-auto float-right text-right">
                  <span class="badge <?php echo ticket_priority_color($ticket->priority, 'admin'); ?>"><?php echo lang(html_escape($ticket->priority)); ?></span>
                  <p class="text-right"><a href="#" data-toggle="modal" data-target="#change-ticket-priority" class="small">( <?php echo lang('change'); ?> )</a></p>
                </span>
              </li>
              <li class="list-group-item">
                <?php echo lang('updated'); ?>:
                <span class="float-right"><?php manage_updated_at(html_escape($ticket->updated_at)); ?></span>
              </li>
              <li class="list-group-item">
                <?php echo lang('created'); ?>:
                <span class="float-right">
                  <?php echo get_date_time_by_timezone(html_escape($ticket->created_at)); ?>
                </span>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <?php if ($ticket->feedback_type != null) {
          $feedback_type = ($ticket->feedback_type == 1) ? lang('great') : lang('poor'); ?>
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <p class="card-title"><?php echo lang('requestor_feedback'); ?></p>

              <?php if ($this->zuser->has_permission('delete_ticket_feedback')) { ?>
                <div class="ml-auto">
                  <button class="btn btn-danger text-sm" data-toggle="modal" data-target="#delete-ticket-feedback">
                    <i class="fas fa-trash mr-2"></i> <?php echo lang('delete'); ?>
                  </button>
                </div>
                <!-- /.card-tools -->
              <?php } ?>

            </div>
            <div class="card-body">
              <?php if (! empty($ticket->feedback)) { ?>
                <p class="mb-1 text-center"><q><?php echo html_escape($ticket->feedback); ?></q></p>
              <?php } ?>

              <p class="text-<?php echo ($ticket->feedback_type == 1) ? 'success' : 'danger'; ?> mb-0 text-center rounded">
                <?php printf(lang('received_support'), $feedback_type); ?>
              </p>
            </div>
          </div>
          <!-- /.z-ticket-reply -->
        <?php } ?>

        <div class="card">
          <div class="card-body">
            <div class="text-center">
              <?php if ($ticket->status != 0) { ?>
                <form class="z-form d-inline-block" method="post" action="<?php admin_action('support/close_ticket'); ?>" data-csrf="manual">
                  <div class="response-message"></div>
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <button type="submit" class="mr-1 btn btn-danger text-sm">
                    <i class="fas fa-times mr-2"></i> <?php echo lang('close_ticket'); ?>
                  </button>
                  <button type="button" class="mr-1 btn btn-primary text-sm" data-toggle="modal" data-target="#assign-user">
                    <i class="fas fa-user mr-2"></i> <?php echo lang('assign'); ?>
                  </button>
                  <input type="hidden" name="id" value="<?php echo html_escape($ticket->id); ?>">
                </form>

              <?php } else { ?>
                <form class="z-form d-inline-block" method="post" action="<?php admin_action('support/reopen_ticket'); ?>" data-csrf="manual">
                  <div class="response-message c-alert-spacing"></div>
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <button type="submit" class="btn btn-success text-sm">
                    <i class="fas fa-envelope-open-text mr-2"></i> <?php echo lang('reopen_ticket'); ?>
                  </button>

                  <input type="hidden" name="id" value="<?php echo html_escape($ticket->id); ?>">
                </form>
              <?php } ?>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php load_modals(['admin/ai_writer_fixed', 'admin/assign_user', 'admin/ticket_attachments', 'admin/ticket_resend_access', 'admin/add_ticket_note', 'admin/add_ticket_task', 'read_lg', 'delete', 'admin/delete_ticket_note', 'admin/delete_ticket_feedback', 'admin/change_ticket_department', 'admin/change_ticket_priority', 'admin/delete_ticket_task']); ?>