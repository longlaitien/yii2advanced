<?php
/**
 * @var $this \backend\models\BackendView
 */
\backend\assets\AppAsset::register($this);
$homeUrl = \Yii::$app->homeUrl;
$bd_module = Yii::$app->controller->module->id;
$bd_controller = Yii::$app->controller->id;
$bd_action = Yii::$app->controller->action->id;

//$this->registerJsFile("@web/layout/scripts/smart-overview.js?v=1.0.3", []);
$this->registerJs(
    <<< JS
    var homeUrl = '$homeUrl';
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        getMenu('$bd_module', '$bd_controller', '$bd_action');
        
        //TODO init smart overview
        /*smartOverview = new SmartOverview();
        smartOverview.init();*/
    });
    function getMenu(module,controller, action) {
        var data  = {
          module: module,
            controller: controller,
            action: action
        };
        $.ajax({
            url: window.homeUrl + 'menu/index',
            data: $.param(data),
            success: function (res) {
                $('#show-left-menu').html(res.content);
            }
        });
    }
    
JS
    , \yii\web\View::POS_END, 'register-js-global');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>REPORT | <?php echo $this->title;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
<!--    <link rel="SHORTCUT ICON" href="/favicon.ico" type="image/x-icon" />-->
    <link rel="SHORTCUT ICON" href="https://www.vietnamworks.com/favicon.ico" type="image/x-icon" />
    <?php $this->head() ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<?php $this->beginBody() ?>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['hehe/index'])?>">
<!--                <img src="/admin/layout/img/logo.png" alt="logo" class="logo-default"/>-->
                <img class="logo-default" alt="logo" src="/images/report.png" style="margin: 0px; height: 40px;">
            </a>
            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <?php //echo \backend\widgets\NotifyWidget::widget([]);?>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <?php echo \backend\widgets\HeaderUserMenuWidget::widget();?>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse" >
            <!-- BEGIN SIDEBAR MENU -->
            <?php echo \backend\widgets\SideMenuWidget::widget();?>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <?php echo $content;?>
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2016 &copy; randommaxtrix
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>

<div id="smart-preview-widget">
    <div class="content">
        <img src="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/global/img/paragraph.png"
             class="img img-responsive img-thumbnail loading"/>
    </div>
</div>
<?php $this->endBody() ?>

</body>
<!-- END BODY -->
</html>
<?php $this->endPage() ?>