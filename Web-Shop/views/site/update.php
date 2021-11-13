<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="container">
<h3>Update Profile</h3>
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]) ?>
    <?= $form->field($model, 'filename')->fileInput(['accept'=>'image/*']) ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'phone')->textInput() ?>

    <?=Html::submitButton('update',['class'=>'btn btn-primary'])?>
    <?php ActiveForm::end() ?>
</div>