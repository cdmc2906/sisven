<?php
/* @var $this NotifyiiReadsController */
/* @var $data NotifyiiReads */
?>

<div class="view">
    <strong><?php echo $data->username; ?></strong> tiene una notificación de lectura <strong><?php echo $data->notification->content; ?></strong> que expirará el <strong><?php echo $data->notification->expire; ?></strong>.
</div>
