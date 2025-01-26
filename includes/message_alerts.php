<?php
    $action = isset($_GET['action']) && isset($_GET['action']) == 'success' ? 'success' : 'danger';
    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<div class="alert alert-<?= $action ?> alert-dismissible fade show" role="alert">
  <?= $msg ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
