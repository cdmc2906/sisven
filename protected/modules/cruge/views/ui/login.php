<h1><?php
    echo CrugeTranslator::t('logon', "Login");
    $this->pageTitle = 'Login';
    ?>
</h1>
<?php if (Yii::app()->user->hasFlash('loginflash')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('loginflash'); ?>
    </div>
<?php else: ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'logon-form',
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="form-group has-feedback">
        <span class="input-group-addon"><i class="fa fa-user"></i> USUARIO </span>
        <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Usuario')); ?>
        <div class="form-group has-error">
            <?php echo $form->error($model, 'username', array('class' => 'help-block')); ?>
        </div>
    </div>

    <div class="form-group has-feedback">
        <span class="input-group-addon"><i class="fa fa-lock"></i> CLAVE </span>
        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Clave')); ?>
        <div class="form-group has-error">
            <?php echo $form->error($model, 'password', array('class' => 'help-block')); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <?php echo CHtml::submitButton('Ingresar', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
        </div>
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>
                <?php echo $form->label($model, 'rememberMe'); ?>
                <?php echo $form->error($model, 'rememberMe'); ?>
            </div>
        </div>
    </div>

    <div class="form-group has-feedback">
        <?php echo Yii::app()->user->ui->passwordRecoveryLink; ?>
    </div>

    <?php
    //	si el componente CrugeConnector existe lo usa:
    if (Yii::app()->getComponent('crugeconnector') != null) {
        if (Yii::app()->crugeconnector->hasEnabledClients) {
            ?>
            <div class='crugeconnector'>
                <span><?php echo CrugeTranslator::t('logon', 'You also can login with'); ?>:</span>
                <ul>
                    <?php
                    $cc = Yii::app()->crugeconnector;
                    foreach ($cc->enabledClients as $key => $config) {
                        $image = CHtml::image($cc->getClientDefaultImage($key));
                        echo "<li>" . CHtml::link($image, $cc->getClientLoginUrl($key)) . "</li>";
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
    }
    ?>
    <?php $this->endWidget(); ?>
<?php endif; ?>
