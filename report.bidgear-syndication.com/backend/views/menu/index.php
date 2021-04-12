<?php
/**
 * @var $this \backend\models\BackendView
 * @var $menus array
 */
use yii\helpers\Html;

function getHtmlMenuItem($menu)
{
    $html = "";
    $html .= "<li class='" . (isset($menu['class']) ? $menu['class'] : "") . "'>";
    //TODO menu item text
    $text = '<i class="' . (isset($menu['icon']) ? $menu['icon'] : "") . '"></i>' . "<span class='title'>" . $menu['text'] . "</span>";
    if (isset($menu['subs']) && count($menu['subs']) > 0) {
        $text .= '<span class="arrow ' . (isset($menu['class']) ? $menu['class'] : "") . '"></span>';
    }

    $html .= Html::a($text, $menu['link']);

    //TODO check sub-menu
    if (isset($menu['subs']) && count($menu['subs']) > 0) {
        $html .= '<ul class="sub-menu">';
        foreach ($menu['subs'] as $i => $subMenu) {
            $html .= getHtmlMenuItem($subMenu);
        }
        $html .= '</ul>';
    }
    $html .= '</li>';
    return $html;
}

?>
<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="sidebar-toggler-wrapper">
        <div class="sidebar-toggler">
        </div>
    </li>

    <li class="start active ">
    </li>
    <?php foreach ($menus as $menu) {
        echo getHtmlMenuItem($menu);
    } ?>
    <li class="last ">
    </li>
</ul>