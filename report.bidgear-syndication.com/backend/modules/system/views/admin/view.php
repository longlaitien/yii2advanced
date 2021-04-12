<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\entities\user\Admins;

/* @var $this \backend\models\BackendView */
/* @var $model \backend\modules\system\forms\user\AdminsSearchForm */

$this->title = 'Admin';
$this->subTitle = $model->username;
?>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">
                <?php echo $this->title ?>
            </span>
            <span class="caption-helper">
                <?php echo $this->subTitle ?>
            </span>
        </div>
        <div class="tools">
            <a title="" data-original-title="" href="javascript:;" class="collapse">
            </a>
        </div>
        <div class="actions">
            <?php
            if ($model->role != Admins::ROLE_ADMIN || \Yii::$app->user->getId() == $model->user_id) {
                echo Html::a('Update', ['update', 'id' => $model->user_id], [
                    'class' => 'btn btn-primary yellow-stripe'
                ]);
            } ?>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'full_name',
                        'username',
                        'email:email',
                    ],
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => $model->formatStatus(),
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => 'raw',
                            'value' => date('Y-m-d H:i:s', $model->created_at),
                        ],
                        [
                            'attribute' => 'modified_at',
                            'format' => 'raw',
                            'value' => date('Y-m-d H:i:s', $model->modified_at),
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
