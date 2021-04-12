<?php
/**
 * @var $this \backend\models\BackendView
 * @var $changePassForm \backend\forms\ChangePasswordForm
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title tabbable-line">
                <div class="caption caption-md">
                    <i class="icon-globe theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">
                        <?php echo  'Profile Account'; ?>
                    </span>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#profile_setting_password" data-toggle="tab">
                            <?php echo  'Change Password'; ?>
                        </a>
                    </li>
                </ul>
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
                            <?= $form->field($changePassForm, 'password')->passwordInput() ?>
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
                </div>
            </div>
        </div>
    </div>
</div>