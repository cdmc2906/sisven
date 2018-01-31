<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/plugins/iCheck/square/blue.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href=""><b>SIS</b>VEN</a>
            </div>
            <div class="login-box-body">
                <?php echo $content; ?>
            </div>
        </div>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });
        </script>
    </body>
</html>
