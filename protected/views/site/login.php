<!-- Login block -->
<div class="login">

    <div class="well">
        <div class="form row-fluid">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>

            <div class="form-group has-feedback">
                <?php // echo $form->labelEx($model, 'Usuario', array('class' => 'control-label')); ?>
                <?php echo $form->textField($model, 'username', array('autocomplete' => 'off', 'class' => 'controls span12', 'placeholder' => "usuario")); ?>
                <?php // echo $form->error($model, 'username', array('class' => 'control-label')); ?>
            </div>

            <div class="form-group has-feedback">
                <?php // echo $form->labelEx($model, 'Contrase&ntilde;a', array('class' => 'control-label')); ?>
                <?php echo $form->passwordField($model, 'password', array('autocomplete' => 'off', 'class' => 'contros span12  autoDisable', 'placeholder' => "passwrd")); ?>
                <?php // echo $form->error($model, 'password', array('class' => 'control-label')); ?>

            </div>
            <div class="login-btn">
                <?php echo CHtml::submitButton('Ingresar', array('class' => 'btn btn-primary btn-block')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div><!-- form -->

    </div>
</div>
<!-- /login block -->
<script type="text/javascript">
    $('.autoDisable').attr('autocomplete', 'off');
</script>