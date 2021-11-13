<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Signup</div>
                    <div class="card-body">

                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <?= $form->field($model, 'fullname') ?>
                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'password')->passwordInput()->hint('6 character minimum') ?>

                        <div class="form-group">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>