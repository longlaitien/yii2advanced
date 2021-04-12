<?php
/**
 * Date: 5/10/15
 * Time: 12:18 AM
 */
/**
 * @var $this \backend\models\BackendView
 * @var $content
 */
?>
<?php $this->beginContent('@backend/views/layouts/layout_base.php'); ?>
    <!-- BEGIN BODY -->
    <body class="page-404-full-page">
    <?php $this->beginBody() ?>
    <?php echo $content;?>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!--[if lt IE 9]>
    <script src="global/plugins/respond.min.js"></script>
    <script src="global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <!-- END JAVASCRIPTS -->
    <?php $this->endBody() ?>
    </body>
    <!-- END BODY -->
<?php $this->endcontent(); ?>