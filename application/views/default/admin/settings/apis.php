<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="z-form" action="<?php admin_action('settings/apis'); ?>" method="post" data-csrf="manual">
                    <div class="response-message"><?php echo alert_message(); ?></div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="pt-2 px-3"><?php echo lang('apis_settings'); ?></li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="facebook-tab" data-toggle="pill" href="#facebook" role="tab" aria-controls="facebook" aria-selected="true">
                                        <?php echo lang('facebook'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="google-login-tab" data-toggle="pill" href="#google-login" role="tab" aria-controls="google-login" aria-selected="false">
                                        <?php echo lang('google_login'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="google-recaptcha-tab" data-toggle="pill" href="#google-recaptcha" role="tab" aria-controls="google-recaptcha" aria-selected="false">
                                        <?php echo lang('google_recaptcha'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="google-analytics-tab" data-toggle="pill" href="#google-analytics" role="tab" aria-controls="google-analytics" aria-selected="false">
                                        <?php echo lang('google_analytics'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="twitter-tab" data-toggle="pill" href="#twitter" role="tab" aria-controls="twitter" aria-selected="false">
                                        <?php echo lang('twitter'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ipinfo-tab" data-toggle="pill" href="#ipinfo" role="tab" aria-controls="ipinfo" aria-selected="false">
                                        <?php echo lang('ipinfo'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="envato-tab" data-toggle="pill" href="#envato" role="tab" aria-controls="envato" aria-selected="false">
                                        <?php echo lang('envato'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="vkontakte-tab" data-toggle="pill" href="#vkontakte" role="tab" aria-controls="vkontakte" aria-selected="false">
                                        <?php echo lang('vkontakte'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="openai-tab" data-toggle="pill" href="#openai" role="tab" aria-controls="openai" aria-selected="false">
                                        <?php echo lang('openai'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Facebook: -->
                                <div class="tab-pane show active" id="facebook" role="tabpanel" aria-labelledby="facebook-tab">
                                    <div class="alert alert-info">
                                        <p><?php printf(lang('callback_url'), env_url('login/facebook')); ?></p>
                                    </div><!-- /.alert -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="fb-app-id"><?php echo lang('facebook_app_id'); ?></label>
                                            <input type="text" id="fb-app-id" class="form-control" name="fb_app_id" value="<?php echo html_escape(db_config('fb_app_id')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group col-md-6">
                                            <label for="fb-app-secret"><?php echo lang('facebook_app_secret'); ?></label>
                                            <input type="password" id="fb-app-secret" class="form-control" name="fb_app_secret" value="<?php echo html_escape(db_config('fb_app_secret')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.form-row -->
                                    <label class="d-block"><?php echo lang('enable_facebook_login'); ?></label>
                                    <div class="icheck icheck-primary d-inline-block mr-2">
                                        <input type="radio" name="fb_enable_login" id="fb-enable-login-1" value="1" <?php echo check_single(1, db_config('fb_enable_login')); ?>>
                                        <label for="fb-enable-login-1"><span class="label-span"><?php echo lang('yes'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                    <div class="icheck icheck-primary d-inline-block">
                                        <input type="radio" name="fb_enable_login" id="fb-enable-login-0" value="0" <?php echo check_single(0, db_config('fb_enable_login')); ?>>
                                        <label for="fb-enable-login-0"><span class="label-span"><?php echo lang('no'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Google Login: -->
                                <div class="tab-pane" id="google-login" role="tabpanel" aria-labelledby="google-login-tab">
                                    <div class="alert alert-info">
                                        <p><?php printf(lang('callback_url'), env_url('login/google')); ?></p>
                                    </div><!-- /.alert -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="gl-client-key"><?php echo lang('google_app_client_key'); ?></label>
                                            <input type="text" id="gl-client-key" class="form-control" name="gl_client_key" value="<?php echo html_escape(db_config('gl_client_key')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group col-md-6">
                                            <label for="gl-secret-key"><?php echo lang('google_app_secret_key'); ?></label>
                                            <input type="password" id="gl-secret-key" class="form-control" name="gl_secret_key" value="<?php echo html_escape(db_config('gl_secret_key')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.form-row -->
                                    <label class="d-block"><?php echo lang('enable_google_login'); ?></label>
                                    <div class="icheck icheck-primary d-inline-block mr-2">
                                        <input type="radio" name="gl_enable" id="gl-enable-1" value="1" <?php echo check_single(1, db_config('gl_enable')); ?>>
                                        <label for="gl-enable-1"><span class="label-span"><?php echo lang('yes'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                    <div class="icheck icheck-primary d-inline-block">
                                        <input type="radio" name="gl_enable" id="gl-enable-0" value="0" <?php echo check_single(0, db_config('gl_enable')); ?>>
                                        <label for="gl-enable-0"><span class="label-span"><?php echo lang('no'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Google reCaptcha: -->
                                <div class="tab-pane" id="google-recaptcha" role="tabpanel" aria-labelledby="google-recaptcha-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="gr-public-key"><?php echo lang('gr_public_key'); ?></label>
                                            <input type="text" id="gr-public-key" class="form-control" name="gr_public_key" value="<?php echo html_escape(db_config('gr_public_key')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group col-md-6">
                                            <label for="gr-secret-key"><?php echo lang('gr_secret_key'); ?></label>
                                            <input type="password" id="gr-secret-key" class="form-control" name="gr_secret_key" value="<?php echo html_escape(db_config('gr_secret_key')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.form-row -->
                                    <label class="d-block"><?php echo lang('enable_google_recaptcha'); ?></label>
                                    <div class="icheck icheck-primary d-inline-block mr-2">
                                        <input type="radio" name="gr_enable" id="gr-enable-1" value="1" <?php echo check_single(1, db_config('gr_enable')); ?>>
                                        <label for="gr-enable-1"><span class="label-span"><?php echo lang('yes'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                    <div class="icheck icheck-primary d-inline-block">
                                        <input type="radio" name="gr_enable" id="gr-enable-0" value="0" <?php echo check_single(0, db_config('gr_enable')); ?>>
                                        <label for="gr-enable-0"><span class="label-span"><?php echo lang('no'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Google Analytics: -->
                                <div class="tab-pane" id="google-analytics" role="tabpanel" aria-labelledby="google-analytics-tab">
                                    <label for="google-analytics-id"><?php echo lang('google_analytics_id'); ?></label>
                                    <input type="text" id="google-analytics-id" class="form-control" name="google_analytics_id" value="<?php echo html_escape(db_config('google_analytics_id')); ?>">
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Twitter: -->
                                <div class="tab-pane" id="twitter" role="tabpanel" aria-labelledby="twitter-tab">
                                    <div class="alert alert-info">
                                        <p><?php printf(lang('callback_url'), env_url('login/twitter')); ?></p>
                                    </div><!-- /.alert -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="tw-consumer-key"><?php echo lang('tw_consumer_key'); ?></label>
                                            <input type="text" id="tw-consumer-key" class="form-control" name="tw_consumer_key" value="<?php echo html_escape(db_config('tw_consumer_key')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group col-md-6">
                                            <label for="tw-consumer-secret"><?php echo lang('tw_consumer_secret'); ?></label>
                                            <input type="password" id="tw-consumer-secret" class="form-control" name="tw_consumer_secret" value="<?php echo html_escape(db_config('tw_consumer_secret')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.form-row -->
                                    <label class="d-block"><?php echo lang('enable_twitter_login'); ?></label>
                                    <div class="icheck icheck-primary d-inline-block mr-2">
                                        <input type="radio" name="tw_enable_login" id="tw-enable-login-1" value="1" <?php echo check_single(1, db_config('tw_enable_login')); ?>>
                                        <label for="tw-enable-login-1"><span class="label-span"><?php echo lang('yes'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                    <div class="icheck icheck-primary d-inline-block">
                                        <input type="radio" name="tw_enable_login" id="tw-enable-login-0" value="0" <?php echo check_single(0, db_config('tw_enable_login')); ?>>
                                        <label for="tw-enable-login-0"><span class="label-span"><?php echo lang('no'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                </div>
                                <!-- /.tab-pane -->

                                <!-- IPinfo: -->
                                <div class="tab-pane" id="ipinfo" role="tabpanel" aria-labelledby="ipinfo-tab">
                                    <label for="ipinfo-token"><?php echo lang('ipinfo_api_token'); ?></label>
                                    <input type="password" id="ipinfo-token" class="form-control" name="ipinfo_token" value="<?php echo html_escape(db_config('ipinfo_token')); ?>">
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Envato: -->
                                <div class="tab-pane" id="envato" role="tabpanel" aria-labelledby="envato-tab">
                                    <label for="envato-api-token"><?php echo lang('api_token'); ?></label>
                                    <input type="text" id="envato-api-token" class="form-control" name="envato_api_token" value="<?php echo html_escape(db_config('envato_api_token')); ?>">
                                </div>
                                <!-- /.tab-pane -->

                                <!-- VKontakte Login: -->
                                <div class="tab-pane" id="vkontakte" role="tabpanel" aria-labelledby="vkontakte-tab">
                                    <div class="alert alert-info">
                                        <p><?php printf(lang('callback_url'), env_url('login/vkontakte')); ?></p>
                                    </div><!-- /.alert -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="vkontakte-app-id"><?php echo lang('vkontakte_app_id'); ?></label>
                                            <input type="text" id="vkontakte-app-id" class="form-control" name="vkontakte_app_id" value="<?php echo html_escape(db_config('vkontakte_app_id')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group col-md-6">
                                            <label for="vkontakte-secret-key"><?php echo lang('vkontakte_secret_key'); ?></label>
                                            <input type="password" id="vkontakte-secret-key" class="form-control" name="vkontakte_secret_key" value="<?php echo html_escape(db_config('vkontakte_secret_key')); ?>">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.form-row -->
                                    <label class="d-block"><?php echo lang('enable_vkontakte_login'); ?></label>
                                    <div class="icheck icheck-primary d-inline-block mr-2">
                                        <input type="radio" name="vkontakte_enable" id="vkontakte-enable-1" value="1" <?php echo check_single(1, db_config('vkontakte_enable')); ?>>
                                        <label for="vkontakte-enable-1"><span class="label-span"><?php echo lang('yes'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                    <div class="icheck icheck-primary d-inline-block">
                                        <input type="radio" name="vkontakte_enable" id="vkontakte-enable-0" value="0" <?php echo check_single(0, db_config('vkontakte_enable')); ?>>
                                        <label for="vkontakte-enable-0"><span class="label-span"><?php echo lang('no'); ?></span></label>
                                    </div>
                                    <!-- /.icheck -->
                                </div>
                                <!-- /.tab-pane -->

                                <!-- OpenAI: -->
                                <div class="tab-pane" id="openai" role="tabpanel" aria-labelledby="openai-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="openai-status"><?php echo lang('openai_status'); ?></label>
                                            <select id="openai-status" class="form-control select2 search-disabled" name="openai_status">
                                                <option value="0" <?php echo select_single(0, db_config('openai_status')); ?>><?php echo lang('disable'); ?></option>
                                                <option value="1" <?php echo select_single(1, db_config('openai_status')); ?>><?php echo lang('enable'); ?></option>
                                            </select>
                                        </div>
                                        <!-- /.col -->
                                        <div class="form-group col-md-6">
                                            <label for="openai-api-key"><?php echo lang('openai_api_key'); ?></label>
                                            <input type="text" id="openai-api-key" class="form-control" name="openai_api_key" value="<?php echo html_escape(db_config('openai_api_key')); ?>">
                                        </div>
                                        <!-- /.col -->
                                        <div class="form-group col-md-6">
                                            <label for="openai-model"><?php echo lang('openai_model'); ?></label>
                                            <select id="openai-model" class="form-control select2" name="openai_model">
                                                <?php foreach (OPENAI_MODEL as $model) { ?>
                                                    <option value="<?php echo html_escape($model); ?>" <?php echo select_single($model, db_config('openai_model')); ?>><?php echo html_escape($model); ?></option>
                                                <?php } ?>
                                            </select>
                                            <small class="form-text text-muted"><?php echo lang('openai_model_tip'); ?></small>
                                        </div>
                                        <!-- /.col -->
                                        <div class="form-group col-md-6">
                                            <label for="openai-max-tokens"><?php echo lang('openai_max_tokens'); ?></label>
                                            <input type="number" id="openai-max-tokens" class="form-control" name="openai_max_tokens" value="<?php echo html_escape(db_config('openai_max_tokens')); ?>" min="0">
                                            <small class="form-text text-muted"><?php echo lang('openai_max_tokens_tip'); ?></small>
                                        </div>
                                        <!-- /.col -->
                                        <div class="form-group col-md-6">
                                            <label for="openai-temperature"><?php echo lang('openai_temperature'); ?></label>
                                            <input type="number" id="openai-temperature" class="form-control" name="openai_temperature" value="<?php echo html_escape(db_config('openai_temperature')); ?>" min="0" step="0.1">
                                            <small class="form-text text-muted"><?php echo lang('openai_temperature_tip'); ?></small>
                                        </div>
                                        <!-- /.col -->
                                        <div class="form-group col-md-6">
                                            <label for="openai-frequency-penalty"><?php echo lang('openai_frequency_penalty'); ?></label>
                                            <input type="number" id="openai-frequency-penalty" class="form-control" name="openai_frequency_penalty" value="<?php echo html_escape(db_config('openai_frequency_penalty')); ?>" min="0" step="0.1">
                                            <small class="form-text text-muted"><?php echo lang('openai_frequency_penalty_tip'); ?></small>
                                        </div>
                                        <!-- /.col -->
                                        <div class="mb-3 mb-md-0 col-md-6">
                                            <label for="openai-presence-penalty"><?php echo lang('openai_presence_penalty'); ?></label>
                                            <input type="number" id="openai-presence-penalty" class="form-control" name="openai_presence_penalty" value="<?php echo html_escape(db_config('openai_presence_penalty')); ?>" min="0" step="0.1">
                                            <small class="form-text text-muted"><?php echo lang('openai_presence_penalty_tip'); ?></small>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <label for="openai-top-p"><?php echo lang('openai_top_p'); ?></label>
                                            <input type="number" id="openai-top-p" class="form-control" name="openai_top_p" value="<?php echo html_escape(db_config('openai_top_p')); ?>" min="0" step="0.1">
                                            <small class="form-text text-muted"><?php echo lang('openai_top_p_tip'); ?></small>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.form-row -->
                                </div>
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
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