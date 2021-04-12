<?php
/**
 * @var $this \backend\models\BackendView
 */
use yii\helpers\Html;
use common\util\Common;
?>

<li class="dropdown dropdown-user">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-close-others="true">
        <span class="username username-hide-on-mobile">
					<?php echo Common::getSourceName(); ?> </span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-default">
        <li>
            <a href="<?php echo Yii::$app->urlManager->createUrl(["/hehe/change-source",'source'=>1]) ?>">
                 <?php echo 'Bidgear'; ?> </a>
        </li>
        <li class="divider">
        </li>
        <li>
            <a href="<?php echo Yii::$app->urlManager->createUrl(["/hehe/change-source",'source'=>2]) ?>">
                <?php echo '2mdnsys'; ?> </a>
        </li>
        <li class="divider">
        </li>
        <li>
            <a href="<?php echo Yii::$app->urlManager->createUrl(["/hehe/change-source",'source'=>4]) ?>">
                <?php echo 'RTB Bidgear'; ?> </a>
        </li>
    </ul>
</li>
<li class="dropdown dropdown-user">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-close-others="true">
        <img alt="" class="img-circle" src="<?php echo Yii::$app->urlManager->getBaseUrl() ?>/images/no-avatar.jpg"/>
					<span class="username username-hide-on-mobile">
					<?php echo Html::encode(\Yii::$app->user->identity->username); ?> </span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-default">
        <li>
            <a href="<?php echo Yii::$app->urlManager->createUrl('hehe/profile') ?>">
                <i class="icon-user"></i> <?php echo 'My Profile'; ?> </a>
        </li>
        <li class="divider">
        </li>
        <li>
            <a href="<?php echo Yii::$app->urlManager->createUrl('hehe/logout') ?>">
                <i class="icon-key"></i> <?php echo 'Log Out'; ?> </a>
        </li>
    </ul>
</li>