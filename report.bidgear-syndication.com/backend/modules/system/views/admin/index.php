<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model \backend\modules\system\forms\user\AdminsSearchForm
 */
use backend\modules\system\forms\user\AdminsSearchForm;
use yii\helpers\Html;
use \yii\widgets\Pjax;
use \yii\grid\GridView;
use common\entities\user\Admins;

$this->title = "Admin";
$this->subTitle = "management";

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

        </div>
        <div class="actions">
            <?php echo Html::a('Create', ['create'], ['class' => 'btn btn-success yellow-stripe']); ?>
        </div>
    </div>
    <div class="portlet-body">

        <?php echo $this->render('_search', ['model' => $model]); ?>

        <div class="row">
            <div class="col-md-12">
                <?php Pjax::begin(); ?>
                <div class="row table-responsive">
                    <?php
                    echo GridView::widget([
                        'id' => 'grid-view-account',
                        'dataProvider' => $model->search(),
                        'filterModel' => null,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'options' => [
                                    'style' => 'width:5px'
                                ]
                            ],
                            [
                                'attribute' => 'full_name',
                                'format' => 'raw',
                                'value' => function (AdminsSearchForm $data) {
                                    return Html::a($data->full_name, ['view', 'id' => $data->user_id]);
                                },
                                'options' => [
                                    'class' => 'col-md-2'
                                ]
                            ],
                            [
                                'attribute' => 'username',
                                'format' => 'raw',
                                'value' => function (AdminsSearchForm $data) {
                                    return Html::a($data->username, ['view', 'id' => $data->user_id]);
                                },
                                'options' => [
                                    'class' => 'col-md-2'
                                ]
                            ],
                            [
                                'attribute' => 'email',
                                'format' => 'email',
                                'value' => function (AdminsSearchForm $data) {
                                    return $data->email;
                                },
                            ],
                            [
                                'attribute' => 'role',
                                'format' => 'raw',
                                'value' => function (AdminsSearchForm $data) {
                                    return $data->getRole();
                                },
                                'options' => [
                                    'class' => 'col-md-1'
                                ]
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function (AdminsSearchForm $data) {
                                    return $data->formatStatus();
                                },
                                'options' => [
                                    'class' => 'col-md-1'
                                ]
                            ],
                            [
                                'attribute' => 'created_at',
                                'value' => function (AdminsSearchForm $data) {
                                    return date('Y-m-d H:i:s', $data->created_at);
                                },
                                'options' => [
                                    'class' => 'col-md-2'
                                ]
                            ],
                            //TODO: action
                            [
                                'attribute' => 'created_at',
                                'header' => '&nbsp;',
                                'format' => 'raw',
                                'value' => function (AdminsSearchForm $data) {
                                    if ($data->role != Admins::ROLE_ADMIN || \Yii::$app->user->getId() == $data->user_id) {
                                        return Html::a(
                                            '<i class="fa fa-edit"></i> Edit',
                                            ['update', 'id' => $data->user_id,],
                                            ['class' => "btn default btn-xs purple",]
                                        );
                                    }
                                    return '';
                                },
                                'options' => ['style' => 'width: 50px']
                            ],
                            [
                                'attribute' => 'created_at',
                                'header' => '&nbsp;',
                                'format' => 'raw',
                                'value' => function (AdminsSearchForm $data) {
                                    return Html::a("<i class='fa fa-eye'></i> View",
                                        ['view', 'id' => $data->user_id],
                                        ['class' => "btn default btn-xs blue",]
                                    );
                                },
                                'options' => ['style' => 'width: 50px']
                            ],

                        ],
                        'options' => [
                            'class' => '',
                        ],
                        'showHeader' => true,
                        'showFooter' => false,
                        'layout' => '{items}{summary}{pager}',
                        'filterSelector' => '',
                    ]);
                    \yii\widgets\Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>