<?php

use yii\helpers\Html;

/* @var $name string */
/* @var $message string */
/* @var $exception \yii\web\HttpException */
/**
 * @var $this \backend\models\BackendView
 */
$this->registerCssFile("@web/pages-admin/css/error.css");
$this->title = $name;
$this->subTitle = $message;

?>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12 page-404">
        <div class="number">
            <?php echo Html::encode($exception->statusCode) ?>
        </div>
        <div class="details">
            <h3><?= Html::encode($this->title) ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>.<br/>
                <a href="<?php echo Yii::$app->homeUrl ?>">
                    <?php echo 'Return home'; ?> </a>
                <?php echo 'Please contact us if you think this is a server error. Thank you.'; ?>
            </p>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
