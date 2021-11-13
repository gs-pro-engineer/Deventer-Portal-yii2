<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>
<div class="site-login">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form'
                        ]); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        
                        <div class="custom-control custom-checkbox mb-3">
                            <?= $form->field($model, 'rememberMe')->checkbox([
                                'template' => "<div class=\"custom-control custom-checkbox mb-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            ]) ?>
                        </div>

                        <hr class="my-4">

                        <div class="form-group">
                            <div class="">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-lg btn-primary btn-block text-uppercase', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-center links">
                                Don't have an account?   <?= Html::a('Sign Up', ['site/register']) ?>.
                            </div>
                            <div class="d-flex justify-content-center links">
                                <a href="#">Forgot your password?</a>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>