<?php
namespace backend\assets;


use common\models\base\AbstractAppAsset;

/**
 * Class AppAsset
 * @package backend\assets
 */
class AppAsset extends AbstractAppAsset
{
    public $css = [
        "global/css/font-open-sans.css",
        "global/plugins/font-awesome/css/font-awesome.min.css",
        'global/plugins/simple-line-icons/simple-line-icons.min.css',
        "global/plugins/bootstrap/css/bootstrap.min.css",
        "global/plugins/bootstrap-switch/css/bootstrap-switch.min.css",

        "global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css",

        "pages/css/tasks.css",

        "global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css",
        "global/plugins/bootstrap-select/bootstrap-select.min.css",
        'global/plugins/select2/select2.css',
        'global/plugins/bootstrap-toastr/toastr.css',

        "global/css/components.css",
        "global/css/plugins.css",
        "layout/css/layout.css",
        "layout/css/themes/darkblue.css",
        "layout/css/smart-overview.css",
        "layout/css/layout.css",

        'pages/site.css',
    ];
    public $js = [
        "global/plugins/respond.min.js",
        "global/plugins/jquery-ui/jquery-ui.min.js",
        "global/plugins/bootstrap/js/bootstrap.min.js",
        "global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js",
        "global/plugins/jquery-slimscroll/jquery.slimscroll.min.js",
        "global/plugins/jquery.blockui.min.js",
        "global/plugins/jquery.cokie.min.js",
        "global/plugins/flot/jquery.flot.min.js",
        "global/plugins/flot/jquery.flot.resize.min.js",
        "global/plugins/flot/jquery.flot.categories.min.js",
        "global/plugins/bootstrap-daterangepicker/moment.min.js",
        "global/plugins/bootstrap-daterangepicker/daterangepicker.js",
        "global/plugins/fullcalendar/fullcalendar.min.js",
        "global/scripts/metronic.js",
        "layout/scripts/layout.js",

        "global/plugins/select2/select2.js",
        "global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",
        "global/plugins/bootstrap-toastr/toastr.min.js",

    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
