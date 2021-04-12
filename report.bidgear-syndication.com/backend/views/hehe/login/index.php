<?php
/**
 * @var $this \backend\models\BackendView
 * @var $loginForm \backend\forms\BackendLoginForm
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
?>
<style>
    ul li {
        list-style: none;
    }

    ul {
        padding-left: 0px;
    }

    input.form-control {
        width: 250px;
        padding: 10px;
        font-size: 15px;
    }
    button.btn {
        font-size: 15px;
        font-weight: bold;
        height: 40px;
        width: 150px;
    }
</style>

<div class="container">
    <h1>LOGIN BG SYNDICATION</h1>
    <?php $form = ActiveForm::begin(
        [
            'id' => 'login-form',
            'options' => ['class' => 'login-form']
        ]
    ); ?>

    <?php if ($loginForm->hasErrors()) {
        echo Html::errorSummary($loginForm, [
            'style' => 'color:red',
            'header' => '',
        ]);
    }; ?>

    <?php echo $form->field($loginForm, 'username')->textInput([
        'placeholder' => 'username'
    ])
        ->label(''); ?>

    <?php echo $form->field($loginForm, 'password')->passwordInput([
        'placeholder' => 'password'
    ])->label(''); ?>

    <?php echo $form->field($loginForm, 'rememberMe')->checkbox(); ?>

    <?php echo Html::submitButton('Login',
        [
            'class' => 'btn btn-success uppercase',
        ]
    ) ?>
    <?php ActiveForm::end(); ?>
</div>
