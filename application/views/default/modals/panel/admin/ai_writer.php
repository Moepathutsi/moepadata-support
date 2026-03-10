<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- AI Writer Modal: -->
<div class="modal close-after" id="ai-writer">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="z-form" action="<?php admin_action('ai_writer/generate'); ?>" method="post">
                <input type="hidden" name="modal_type" id="modal-type" value="none">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title"><?php echo lang('ai_writer'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body pb-0">
                    <div class="response-message"></div>
                    <div class="form-group">
                        <label for="prompt-ai"><?php echo lang('enter_your_message_for_ai'); ?> <span class="text-danger">*</span></label>
                        <textarea id="prompt-ai" class="form-control" name="prompt" rows="3" required></textarea>
                        <small class="form-text text-muted"><?php echo lang('enter_your_message_for_ai_tip'); ?></small>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="language-ai"><?php echo lang('language'); ?> <span class="text-danger" *></span></label>
                        <select id="language-ai" class="form-control select2 search-disabled" name="language" required>
                            <?php foreach (AVAILABLE_LANGUAGES as $key => $value) { ?>
                                <option value="<?php echo html_escape($key); ?>"><?php echo html_escape($value['display_label']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="d-none output">
                        <div class="form-group">
                            <label for="response-ai"><?php echo lang('ai_response'); ?></label>
                            <textarea id="response-ai" class="form-control mb-3" name="response" rows="10"></textarea>

                            <?php if (!empty($ai_write_for_fields)) { ?>
                                <?php if (count($ai_write_for_fields) > 1) { ?>
                                    <div class="form-group">
                                        <label for="where-to-push-ai"><?php echo lang('where_to_push'); ?></label>
                                        <select id="where-to-push-ai" class="form-control select2 search-disabled" name="field">
                                            <?php foreach ($ai_write_for_fields as $field) { ?>
                                                <option value="<?php echo html_escape($field); ?>"><?php echo lang($field); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                <?php } else { ?>
                                    <input type="hidden" id="where-to-push-ai" name="field" value="<?php echo html_escape($ai_write_for_fields[0]); ?>"></option>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.output -->
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-sm px-3" data-dismiss="modal"><i class="fas fa-times mr-2"></i> <?php echo lang('close'); ?></button>
                    <button type="submit" class="btn btn-primary text-sm px-3"><i class="fas fa-sync mr-2"></i> <?php echo lang('generate'); ?></button>
                    <button id="use-ai-response" type="button" class="btn btn-success text-sm px-3 d-none"><i class="fas fa-check mr-2"></i> <?php echo lang('push_ai_response'); ?></button>
                </div>
                <!-- /.modal-footer -->
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->