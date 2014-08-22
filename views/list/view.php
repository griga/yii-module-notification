<?php

/** @var Notification $model */

$this->breadcrumbs = [
    t('Notifications') => '/admin/notification/list',
    $model->getTypeName()
];

?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <h3><?= $model->getTypeName(); ?></h3>
        <div class="well">
            <h4><?= $model->subject ?></h4>
            <p><?= $model->message ?></p>
            <hr/>
            <?= app()->format->timeago($model->create_time) ?>
            <hr/>
            <a class="btn btn-default" data-dismiss="modal" href="/admin/notification/list/"><?= t('Back') ?></a>
        </div>

    </div>
</div>