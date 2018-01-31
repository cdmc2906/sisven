<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
                <?php
                $this->beginWidget('zii.widgets.CPortlet', array(
                    'title' => 'Operaciones',
                    'contentCssClass' => 'box-title',
                ));
                ?>
            </div>
            <div class="box-body">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => 'form-group'),
                ));
                $this->endWidget();
                ?>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->endContent(); ?>