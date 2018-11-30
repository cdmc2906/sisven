<h1><?php
    echo CrugeTranslator::t("Recuperar la clave");
    $this->pageTitle = 'Recuperar la clave';
    ?>
</h1>
<?php if (Yii::app()->user->hasFlash('pwdrecflash')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('pwdrecflash'); ?>
        <?php echo CHtml::link('Link Text',array('site/action')); ?>
    </div>
<?php else: ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pwdrcv-form',
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="form-group has-feedback">
        <?php
        echo $form->textField(
                $model, 'username', array('class' => 'form-control',
            'placeholder' => 'Usuario'
        ));
        ?>

        <span class="fa fa-user form-control-feedback"></span>
        <div class="form-group has-error">
            <?php echo $form->error($model, 'username', array('class' => 'help-block')); ?>
        </div>

    </div>

    <?php if (CCaptcha::checkRequirements()): ?>
        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model, 'verifyCode'); ?>
            <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model, 'verifyCode', array('class' => 'form-control', 'placeholder' => 'Ingrese los caracteres que vea en la imagen')); ?>
            </div>
            <!--<div class="form-group has-warning">-->
                <?php
//                echo CrugeTranslator::t("Por favor ingrese los caracteres o digitos que vea en la imagen");
                ?>
            <!--</div>-->
            <div class="form-group has-error">
                <?php echo $form->error($model, 'verifyCode', array('class' => 'help-block')); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php echo CHtml::submitButton('Recuperar la Clave', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
        <?php // Yii::app()->user->ui->tbutton("Recuperar la Clave"); ?>
    </div>

    <?php $this->endWidget(); ?>
    </div>
<?php endif; ?>