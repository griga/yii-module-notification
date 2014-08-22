<?php
/** Created by griga at 20.08.14 | 17:09.
 * 
 */

class ListController extends BackendController {

    public function actionIndex(){
        $model = new Notification('search');
        $model->unsetAttributes();
        if(isset($_GET['Notification'])){
            $model->attributes = $_GET['Notification'];
        }
        $this->render('index',[
            'model'=>$model
        ]);
    }

    /**
     *
     */
    public function actionView($id)
    {
        $model = Notification::model()->findByPk($id);
        Notification::model()->updateByPk($id,[
            'status'=>Notification::STATUS_PROCESSED
        ]);
        $data = [
            'model'=>$model
        ];
        if (r()->isAjaxRequest || isset($_GET['ajax'])) {
            $this->renderPartial('view', $data, false, true);
        } else {
            $this->render('view', $data);
        }
    }

} 