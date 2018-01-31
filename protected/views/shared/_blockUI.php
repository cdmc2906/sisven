<script type="text/javascript">
    function blockUIOpen1()
    {
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#0000FF'},
            message: '<h5><img src="loading.gif" />Espere por favor...</h5>'
        });

    }
    function blockUIOpen()
    {
        $.blockUI({
            css: {
            },
            message: $('#domMessage')
        }
        );
    }

    function blockUIClose()
    {
        $.unblockUI();
    }
</script>   
<div id="domMessage" style="display:none;"> 
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif" /><br/>
    <h4>Espere por favor</h4> 
</div> 