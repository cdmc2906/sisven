<?php
/* @var $this NotifyiiReadsController */
/* @var $data NotifyiiReads */
?>

<div class="view">
    <strong><?php echo $data->username; ?></strong> tiene una notificaci�n de lectura <strong><?php echo $data->notification->content; ?></strong> que expirar� el <strong><?php echo $data->notification->expire; ?></strong>.
</div>
