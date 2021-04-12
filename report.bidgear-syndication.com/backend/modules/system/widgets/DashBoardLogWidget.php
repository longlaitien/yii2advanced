<?php
namespace backend\modules\system\widgets;

use backend\models\BackendWidget;
use backend\modules\system\forms\log\LogSearchForm;

/***
 * Class DashBoardLogWidget
 * @package backend\modules\system\widgets
 * 
 * @property integer $run_query
 */
class DashBoardLogWidget extends BackendWidget
{
    public $run_query = 0;
    public function init()
    {
        if($run_query = \Yii::$app->request->get('run_query')){
            $this->run_query = $run_query;
        }
        $data = false;
        if($this->run_query == 1){
            $model = new LogSearchForm();
            $data = $model->search();
        }
        echo $this->render("dashboard-log/dashboard-log-widget", [
            'data'=>$data,
        ]);
    }
}