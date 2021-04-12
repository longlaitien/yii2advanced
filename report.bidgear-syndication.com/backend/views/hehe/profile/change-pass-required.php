<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model \common\entities\user\Admins
 * @var $changePassForm \backend\forms\ChangePasswordForm
 */
$this->registerCssFile("@web/pages/css/profile.css");

$this->title = "Change Password Required";
?>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="tab-content">
                <div class="tab-pane active" id="profile_setting">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet light">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Change Password Required</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane active" id="profile_setting_password">
                                            <div class="organization-form">
                                                <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
                                                <?php
                                                if ($changePassForm->hasErrors()) {
                                                    ?>
                                                    <div class="note note-danger">
                                                        <?php echo $form->errorSummary($changePassForm); ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <?= $form->field($changePassForm, 'new_password')->passwordInput() ?>
                                                <?= $form->field($changePassForm, 'new_password_again')->passwordInput() ?>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <?= \yii\helpers\Html::submitButton('<i class="fa fa-save"></i> Change Password',
                                                                ['class' => 'btn btn-primary']) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php \yii\bootstrap\ActiveForm::end(); ?>

                                            </div>
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>