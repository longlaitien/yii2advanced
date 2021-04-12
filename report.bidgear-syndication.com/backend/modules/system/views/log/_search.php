<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model \backend\modules\system\forms\log\RecordLogSearchForm
 */
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
    'method' => 'GET',
    'id'=>'log-form',
    'layout' => 'default',
    'action' => \Yii::$app->urlManager->createAbsoluteUrl("/system/log/index"),
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
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Filter by Date</label>
                <?php echo $form->field($model, 'date_search')
                    ->textInput([
                        'placeholder' => 'Date',
                        'id' => 'date_ranger',
                        'class'=>'form-control'
                    ])->label(false); ?>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Filter by Category</label>
                <?php echo $form->field($model, 'category', [])
                    ->dropDownList($model::dataCategory(), ["class" => "form-control select2me"])
                    ->label(false); ?>
            </div>

            <div class="col-xs-3 col-sm-2 col-md-3 col-lg-1">
                <label style="display: block">&nbsp;</label>
                <?php echo \yii\helpers\Html::submitButton('Search', [
                    'class' => 'btn btn-default pull-right',
                ]); ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end() ?>