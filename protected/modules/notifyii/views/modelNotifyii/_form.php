<?php
/* @var $this NotifyiiController */
/* @var $model Notifyii */
/* @var $form CActiveForm */
?>

<?php
    // Load all roles from database
    $rolesReulst = Yii::app()->db
                       ->createCommand('select name from cruge_AuthItem where type = 2;')
                       ->queryAll();
    $roles = array();
    foreach($rolesReulst as $role) {
        $roles[$role['name']] = $role['name'];
    }
    // Load all user from database
    $usersReulst = Yii::app()->db
                       ->createCommand('select iduser, username from cruge_user where state = 1 order by username;')
                       ->queryAll();
    $users = array();
    foreach($usersReulst as $user) {
        $users[$user['iduser']] = $user['username'];
    }    
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'notifyii-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Los campos que lleven <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'expire'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>'ModelNotifyii[expire]',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd'
                ),
                'value' => $model->expire,
                'htmlOptions'=>array(
                    'style'=>'height:20px;'
                ),
            ));
        ?>
        <?php echo $form->error($model, 'expire'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'alert_after_date'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>'ModelNotifyii[alert_after_date]',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd'
                ),
                'value' => $model->alert_after_date,
                'htmlOptions'=>array(
                    'style'=>'height:20px;'
                ),
            ));
        ?>
        <?php echo $form->error($model, 'alert_after_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'alert_before_date'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>'ModelNotifyii[alert_before_date]',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd'
                ),
                'value' => $model->alert_before_date,
                'htmlOptions'=>array(
                    'style'=>'height:20px;'
                ),
            ));
        ?>
	<?php echo $form->error($model, 'alert_before_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textField($model, 'content'); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'role'); ?>
        <?php echo $form->dropDownList($model, 'role', $roles); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'iduser'); ?>
        <?php echo $form->dropDownList($model, 'iduser', $users); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Grabar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
