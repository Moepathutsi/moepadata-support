<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<div class="dropdown">
  <button class="btn btn-light btn-simple p-0" type="button" id="chat-box-menu" data-bs-toggle="dropdown" aria-expanded="false">
     <i class="fas fa-ellipsis-v"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" aria-labelledby="chat-box-menu">
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#end-chat"><i class="fas fa-times"></i> <?php echo lang( 'end_chat' ); ?></a></li>
  </ul>
</div>
<!-- /.dropdown -->