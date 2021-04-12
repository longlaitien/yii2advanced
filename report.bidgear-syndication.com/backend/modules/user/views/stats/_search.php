<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model \backend\modules\user\forms\stats\StatsAdsSearchForm
 */

$form = \yii\bootstrap\ActiveForm::begin([
    'method' => 'GET',
    'action'=>\Yii::$app->urlManager->createUrl(['/user/stats/index']),
    'layout' => 'horizontal',
    'enableClientValidation' => false,
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
            <div class="col-xs-8 col-lg-2">
                <label>Ad ID</label>
                <?php echo $form->field($model, 'ads_id', [])->textInput([
                    'placeholder'=>''
                ])->label(false); ?>
            </div>
            <div class="col-xs-8 col-lg-2">
                <label>Ad Campaign ID</label>
                <?php echo $form->field($model, 'ads_campaign_id', [])->textInput([
                    'placeholder'=>''
                ])->label(false); ?>
            </div>
            <div class="col-xs-8 col-lg-2">
                <label>Bg Campaign ID</label>
                <?php echo $form->field($model, 'bg_campaign_id', [])->textInput([
                    'placeholder'=>''
                ])->label(false); ?>
            </div>
            <div class="col-xs-8 col-lg-2">
                <label>Date</label>
                <?php echo $form->field($model, 'date_search', [])->textInput([
                    'placeholder'=>'',
                    'id'=>"date_ranger",
                ])->label(false); ?>
            </div>

            <div class="col-xs-4 col-lg-2">
                <label style="display: block">&nbsp;</label>
                <?php echo \yii\helpers\Html::submitButton( 'Search', ['class' => 'btn btn-default']); ?>
            </div>
        </div>
    </div>
<?php \yii\bootstrap\ActiveForm::end() ?>