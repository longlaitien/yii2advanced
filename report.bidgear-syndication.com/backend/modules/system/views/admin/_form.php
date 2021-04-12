<?php
/**
 * @var $model \backend\modules\system\forms\user\AdminForm
 * @var $user Admins
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\entities\user\Admins;

?>
<?php $form = ActiveForm::begin([
    'id' => 'admin-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => '',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ]
]); ?>
<?php
if ($model->hasErrors()) {
    echo Html::tag("div", $form->errorSummary($model), [
        "class" => "note note-danger"
    ]);
}
?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'full_name', [])->textInput(['maxlength' => 255, 'class' => 'form-control']) ?>

            <?= $form->field($model, 'username', [])->textInput(['maxlength' => 255, 'class' => 'form-control']) ?>

            <?php
            if ($user->role == Admins::ROLE_ADMIN) {
                echo $form->field($model, 'role', [])->dropDownList($model::dataRole(), [
                    "class" => "form-control select2me"
                ]);
            } ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email', [])->textInput(['maxlength' => 255, 'class' => 'form-control']) ?>

            <?php
            if ($model->role != Admins::ROLE_ADMIN) {
                echo $form->field($model, 'status', [])->dropDownList($model::dataStatus(), [
                    "class" => "form-control select2me"
                ]);
            } ?>
        </div>
    </div>

    <div class="form-submit">
        <?php echo Html::submitButton("<i class='fa fa-save'></i> " . ($model->isNewRecord ? 'Save' : 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="<?php echo \yii\helpers\Url::toRoute('index') ?>"
           class="btn btn-default"><?php echo 'Cancel' ?></a>

    </div>

<?php ActiveForm::end(); ?>