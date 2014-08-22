<?php

class ApiController extends Controller
{
	public function actionContact()
	{
        $model = new NotificationForm();
        $model->attributes = $this->inputJson();
        if($model->validate()){
            NotificationDispatcher::processContactRequest($model);
            $this->renderJson([
                'success'=>ts('Contact successfully requested')
            ]);
        } else {
            $this->renderJson($model->errors);
        }
	}
}