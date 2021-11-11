<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\RegisterForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <center><h1><?= Html::encode($this->title) ?></h1></center>

    <center><p>Please fill out the following fields to register:</p></center>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-3\">{error}</div>\n{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'firstName')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'middleName')->textInput() ?>

        <?= $form->field($model, 'lastName')->textInput() ?>

        <?= $form->field($model, 'username')->textInput() ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'userRole')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'passwordConfirm')->passwordInput() ?>

        <div class="form-group">
            <div class="offset-lg-5 col-lg-7">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
