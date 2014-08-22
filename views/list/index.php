<?php

/** @var Notification $model */

$this->breadcrumbs = [
    t('Notifications') => '/admin/notification/list',
    t('List')
];

?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <h3><?= t('Notifications'); ?></h3>

        <?php

        $this->widget('\yg\tb\GridView', [
            'id' => 'notification-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => [
                [
                    'name'=>'type',
                    'value'=>function($data){
                            return app()->controller->widget('\yg\tb\ModalRemoteLink',[
                                'label'=>$data->getTypeName(),
                                'href'=>CHtml::normalizeUrl(["/notification/list/view","id"=>$data->id]),
                                'htmlOptions'=>[
                                    'data-modal-success-rise'=>'updateGrid'
                                ]
                            ], true);
                        },
                    'type'=>'raw',

                        'htmlOptions' => ['encodeLabel'=>false],
                ],
                [  'name'=>'create_time',
                    'sortable' => true,
                    'header'=>t('Date'),
                    'type' => 'timeago',
                ],
                [
                    'name'=>'status',
                    'type'=>'raw',
                    'value'=>function($data){
                            if($data->status == Notification::STATUS_NEW)
                                return '<span class="label label-success">&nbsp;</span>';
                        }
                ]
            ]
        ]); ?>

    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#notification-grid').parent().on('updateGrid', function(event, data){
            $.fn.yiiGridView.update('notification-grid');
        });
    })
</script>