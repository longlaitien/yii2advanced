<?php
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\DetailView;

/* @var $this \backend\models\BackendView */
/* @var $model \backend\modules\system\forms\log\RecordLogSearchForm */

$this->title = 'Logs';
$this->subTitle = $model->log_id;

$from = [];
$to = [];
if ($model->from_value != "[]") {
    $from = Json::decode($model->from_value);
}
if ($model->to_value != "[]") {
    $to = Json::decode($model->to_value);
}
?>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-clock-o font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">
                <?php echo $this->title ?>
            </span>
            <span class="caption-helper">
                <?php echo $this->subTitle ?>
            </span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'message',
                            'format' => 'raw',
                            'value' => $model->formatMessageView(),
                        ],
                        'type',
                        'category',
                        [
                            'attribute' => 'created_time',
                            'format' => 'raw',
                            'value' => date("Y-m-d H:i:s", $model->created_time),
                        ]
                    ],
                ]) ?>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</div>

<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-clock-o font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">
                Values
            </span>
            <span class="caption-helper">
                information
            </span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($from as $key => $value) { ?>
                        <?php
                        $have_value = false;
                        $change_value = false;
                        if (isset($to[$key])) {
                            $have_value = true;
                            if ($value != $to[$key])
                                $change_value = true;
                        }
                        ?>
                        <tr>
                            <td><?php echo Html::encode($key); ?></td>
                            <td><?php echo Html::encode($value); ?></td>
                            <td style="<?php if ($change_value) echo "background-color: #DFBA49"; ?>">
                                <?php if ($have_value) echo Html::encode($to[$key]) ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</div>
