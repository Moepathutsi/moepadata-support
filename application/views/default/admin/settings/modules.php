<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form class="z-form" action="<?php admin_action('settings/modules'); ?>" method="post" data-csrf="manual">
          <div class="response-message"><?php echo alert_message(); ?></div>
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h3 class="card-title"><?php echo lang('modules_settings'); ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group">
                <label for="module-tickets"><?php echo lang('tickets'); ?></label>
                <select id="module-tickets" class="form-control select2 search-disabled" name="module_tickets">
                  <option value="0" <?php echo select_single(0, db_config('module_tickets')); ?>><?php echo lang('disable'); ?></option>
                  <option value="1" <?php echo select_single(1, db_config('module_tickets')); ?>><?php echo lang('enable'); ?></option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="module-knowledgebase"><?php echo lang('knowledge_base'); ?></label>
                <select id="module-knowledgebase" class="form-control select2 search-disabled" name="module_knowledgebase">
                  <option value="0" <?php echo select_single(0, db_config('module_knowledgebase')); ?>><?php echo lang('disable'); ?></option>
                  <option value="1" <?php echo select_single(1, db_config('module_knowledgebase')); ?>><?php echo lang('enable'); ?></option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="module-faqs"><?php echo lang('faqs'); ?></label>
                <select id="module-faqs" class="form-control select2 search-disabled" name="module_faqs">
                  <option value="0" <?php echo select_single(0, db_config('module_faqs')); ?>><?php echo lang('disable'); ?></option>
                  <option value="1" <?php echo select_single(1, db_config('module_faqs')); ?>><?php echo lang('enable'); ?></option>
                </select>
              </div>
              <!-- /.form-group -->
              <label for="module-announcements"><?php echo lang('announcements'); ?></label>
              <select id="module-announcements" class="form-control select2 search-disabled" name="module_announcements">
                <option value="0" <?php echo select_single(0, db_config('module_announcements')); ?>><?php echo lang('disable'); ?></option>
                <option value="1" <?php echo select_single(1, db_config('module_announcements')); ?>><?php echo lang('enable'); ?></option>
              </select>
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