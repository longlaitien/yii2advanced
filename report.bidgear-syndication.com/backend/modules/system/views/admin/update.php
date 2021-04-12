<?php

/* @var $this \backend\models\BackendView */
/* @var $model \backend\modules\system\forms\user\AdminForm
 * @var $user \common\entities\user\Admins 
 * 
*/
$this->title =  'Admin';

?>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">
                <?php echo $this->title ?>
            </span>
            <span class="caption-helper">
                <?php echo $this->subTitle ?>
            </span>
        </div>
        <div class="tools">
        </div>
        <div class="actions">
            <?php
            echo \yii\helpers\Html::a( 'Cancel',
                ['index'], [
                    "class" => 'btn btn-default'
                ]);
            ?>
        </div>
    </div>
    <div class="portlet-body">
        <?= $this->render('_form', [
            'model' => $model,
            'user'=>$user,
        ]) ?>
    </div>
</div>
