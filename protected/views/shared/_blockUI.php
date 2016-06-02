<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/js/jqueryblockUI.js"></script>

<script type="text/javascript">
function blockUIOpen()
{
    $.blockUI({
                 css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'},
                 message:'<h5>Espere por favor...</h5>'
             });
}

function blockUIClose()
{
     $.unblockUI();
}
 </script>   