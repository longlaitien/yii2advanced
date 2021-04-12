<?php

namespace backend\forms;


use backend\models\BackendForm;
use yii\helpers\ArrayHelper;

/**
 * Class UpdateByDateForm
 * @package backend\forms
 *
 */
class UpdateByDateForm extends BackendForm
{
    public $partner = [];
    public $date;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['date'], 'string'],
            [['partner'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            "partner" => "Partner",
            'date' => 'Date',
            'a' => 1
        ];
    }
}