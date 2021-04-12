<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model \common\entities\user\Admins
 * @var $changePassForm \backend\forms\ChangePasswordForm
 */
$this->registerCssFile("@web/pages/css/profile.css");

$this->title =  "Profile";
?>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar" style="width: 250px;">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php echo Yii::$app->urlManager->getBaseUrl() ?>/images/no-avatar.jpg"
                         class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name uppercase">
                        <?php echo \Yii::$app->user->identity->username; ?>
                    </div>
                    <div class="profile-usertitle-job">
                        <?php echo \Yii::$app->user->identity->email; ?>
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="#profile_setting" data-toggle="tab">
                                <i class="icon-settings"></i>
                                <?php echo 'Account Settings'; ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="tab-content">
                <div class="tab-pane active" id="profile_setting">
                    <?php echo $this->renderAjax("_setting", [
                        'changePassForm' => $changePassForm,
                    ]); ?>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<!-- END PAGE CONTENT-->