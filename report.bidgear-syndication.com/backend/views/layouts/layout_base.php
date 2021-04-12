<?php
use yii\helpers\Html;

/**
 * @var $this \backend\models\BackendView
 * @var $content
 */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Management" name="description"/>
    <link href="/admin/global/css/font-open-sans.css" rel="stylesheet" type="text/css"/>
<!--    <link rel="shortcut icon" href="/favicon.ico"/>-->
    <link rel="SHORTCUT ICON" href="https://s.yimg.com/pw/favicon.ico" type="image/x-icon" />
    <?php $this->head() ?>
</head>
<!-- END HEAD -->
<?php echo $content; ?>
</html>
<?php $this->endPage() ?>
