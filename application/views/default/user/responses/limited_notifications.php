<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<span class="dropdown-item dropdown-header"><?php echo lang( 'notifications' ); ?></span>
<div class="dropdown-divider"></div>
<?php
if ( ! empty( $limited_notifications ) ) {
  foreach ( $limited_notifications as $notification_header ) {
    $nh_togo = ( $notification_header->is_read == 1 ) ? $notification_header->location : "admin/read_notification/{$notification_header->id}"; ?>
    <a href="<?php echo html_escape( env_url( $nh_togo ) ); ?>" class="dropdown-item">
      
      <?php if ( $notification_header->is_read == 0 ) { ?>
        <span class="badge badge-danger mb-1"><?php echo lang( 'unread' ); ?></span>
      <?php } ?>
      
      <span class="d-block"><?php echo lang( html_escape( $notification_header->message_key ) ); ?></span>
      <span class="text-muted d-block mt-1">
        <i class="far fa-clock"></i> <?php echo get_date_time_by_timezone( html_escape( $notification_header->created_at ), true ); ?>
      </span>
    </a>
    <div class="dropdown-divider"></div>
  <?php } ?>

<a href="<?php echo env_url( 'admin/notifications' ); ?>" class="dropdown-item dropdown-footer"><?php echo lang( 'see_all' ); ?></a>
<?php } else { ?>
  <span class="dropdown-item text-center"><?php echo lang( 'no_notifications' ); ?></span>
<?php } ?>