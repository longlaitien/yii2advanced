<?php
namespace backend\modules\system\forms\user;


use common\entities\user\Admins;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * Class AdminsSearchForm
 * @package backend\modules\system\models
 *
 * @property string $keyword
 */
class AdminsSearchForm extends Admins
{
    public $keyword;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['keyword'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'keyword' => 'Keyword'
        ]);
    }

    public function getRole()
    {
        if ($this->role == static::ROLE_ADMIN) {
            return "<label style='display: inline-block; width: 90px; margin: 1px' class='label label-danger'>$this->role</label>";
        } else {
            return "<label style='display: inline-block; width: 90px; margin: 1px' class='label label-primary'>$this->role</label>";
        }
    }

    public function search()
    {
        $query = parent::find();
        if ($this->status != null && $this->status != -1) {
            $query->andWhere('status = :status', [
                ':status' => $this->status,
            ]);
        }

        if ($this->keyword != null) {
            $query->andFilterWhere([
                'OR',
                ['LIKE', 'username', $this->keyword],
                ['LIKE', 'email', $this->keyword],
            ]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'defaultOrder' => ['username' => SORT_ASC],
            'attributes' => [
                'user_id',
                'full_name',
                'username',
                'email',
                'role',
                'status',
                'created_at',
            ]
        ]);

        return $dataProvider;
    }

    public static function dataStatusSearch()
    {
        return array(
            -1 => 'All',
            self::STATUS_ACTIVE => "Active",
            self::STATUS_INACTIVE => "Inactive",
        );
    }

    //TODO: formatStatus
    public function formatStatus()
    {
        $class = 'success';
        $status = 'ACTIVE';
        switch ($this->status) {
            case static::STATUS_ACTIVE:
                $class = 'success';
                $status = 'ACTIVE';
                break;
            case static::STATUS_INACTIVE:
                $class = 'danger';
                $status = 'InActive';
                break;
            default:
                break;
        }
        return "<label style='display: inline-block; width: 75px; margin: 1px' class='label label-{$class}'>{$status}</label>";
    }

    //TODO: getUserList
    public static function getAdminList($addAll = false)
    {
        $arr = ['-1' => 'All'];

        $data = Admins::find()->all();

        $users = ArrayHelper::map($data, 'user_id', 'full_name');
        if ($addAll) {
            return ArrayHelper::merge($arr, $users);
        }
        return $users;
    }

    //TODO render menu for left
    public static function renderLeftMenu($module, $controller, $action)
    {
        if (!\Yii::$app->user->isGuest) {
            /**
             * @var $user Admins
             */
            $user = \Yii::$app->user->identity;


            if ($user != null) {
                $menus = [
                    0 => [
                        'icon' => 'icon-home',
                        'text' => 'Dashboard',
                        'class' => ($controller == 'hehe' && $action == 'index') ? 'active' : '',
                        'link' => \Yii::$app->urlManager->createAbsoluteUrl(['hehe/index'])
                    ],
                    1 => [
                        'icon' => 'fa fa-bar-chart',
                        'text' => 'Stats',
                        'class' => ($controller == 'stats' && $action == 'index') ? 'active' : '',
                        'link' => \Yii::$app->urlManager->createAbsoluteUrl(['/user/stats/index'])
                    ],
                    2 => [
                        'icon' => 'fa fa-bar-chart',
                        'text' => 'Mdn Stats',
                        'class' => ($controller == 'mdn-stats' && $action == 'index') ? 'active' : '',
                        'link' => \Yii::$app->urlManager->createAbsoluteUrl(['/user/mdn-stats/index'])
                    ],
                    3 => [
                        'icon' => 'fa fa-bar-chart',
                        'text' => 'Update Date',
                        'class' => ($controller == 'hehe' && $action == 'update-by-date') ? 'active' : '',
                        'link' => \Yii::$app->urlManager->createAbsoluteUrl(['/hehe/update-by-date'])
                    ],
                    4 => [
                        'icon' => 'fa fa-bar-chart',
                        'text' => 'Mdn Update Date',
                        'class' => ($controller == 'hehe' && $action == 'mdn-update-by-date') ? 'active' : '',
                        'link' => \Yii::$app->urlManager->createAbsoluteUrl(['/hehe/mdn-update-by-date'])
                    ],
                ];

                if ($user->role == Admins::ROLE_ADMIN) {

                    $menus[15] = [
                        'icon' => 'fa fa-clock-o',
                        'text' => 'Logs',
                        'class' => ($module == 'system' && $controller == 'log') ? 'active' : '',
                        'link' => \Yii::$app->urlManager->createUrl(['system/log']),
                    ];
                    $menus[16] = [
                        'icon' => 'fa fa-user',
                        'text' => 'Admins',
                        'class' => ($module == 'system' && $controller == 'admin') ? 'active' : '',
                        'link' => \Yii::$app->urlManager->createUrl(['system/admin']),
                    ];
                }
                return $menus;
            }
        }
    }
}