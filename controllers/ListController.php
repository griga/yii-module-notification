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

} 