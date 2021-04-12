<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model \backend\modules\system\forms\user\AdminsSearchForm
 */

$form = \yii\bootstrap\ActiveForm::begin([
    'method' => 'GET',
    'layout' => 'default',
    'action'=>\Yii::$app->urlManager->createAbsoluteUrl("/system/admin/index"),
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-0',
            'offset' => '',
            'wrapper' => 'col-sm-12',
            'error' => '',
            'hint' => '',
        ],
    ],
]) ?>
    <div class="form-body">
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'status', [])->dropDownList($model::dataStatusSearch(), [
                    "class" => "form-control select2me"
                ])->label(false) ?>
            </div>
            <div class="col-md-5">
                <?php echo $form->field($model, 'keyword', [])->textInput([
                   'placeholder'=> 'Email or Username'
                ])->label(false); ?>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div>
                        <?php echo \yii\helpers\Html::submitButton('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php \yii\bootstrap\ActiveForm::end() ?>