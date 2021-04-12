<?php
/**
 * @var $this \backend\models\BackendView
 * @var $content
 */
?>
<?php $this->beginContent('@backend/views/layouts/layout_base.php'); ?>
    <!-- BEGIN BODY -->
    <body class="login">
    <?php echo $content ?>
    </body>
    <!-- END BODY -->
<?php $this->endContent(); ?>