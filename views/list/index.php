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
                            return $data->getTypeName();
                        }
                ],
                [  'name'=>'create_time',
                    'sortable' => true,
                    'header'=>t('Date'),
                    'type' => 'timeago',
                ],
            ]
        ]); ?>

    </div>
</div>