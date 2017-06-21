<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUploadUI;
use dosamigos\fileupload\FileUpload;

/* @var $this yii\web\View */
/* @var $model common\models\Topic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="topic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            // 'imageManagerJson' => ['/redactor/upload/image-json'],
            // 'imageUpload' => ['/redactor/upload/image'],
            // 'fileUpload' => ['/redactor/upload/file'],
            // 'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>

    <?//= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>
    <?//= FileUploadUI::widget([
        // 'model' => $model,
        // 'attribute' => 'img',
        // 'url' => ['media/upload', 'id' => 1],
        // 'gallery' => false,
        // 'fieldOptions' => [
        //     'accept' => 'image/*'
        // ],
        // 'clientOptions' => [
        //     'maxFileSize' => 2000000
        // ],
        // // ...
        // 'clientEvents' => [
        //     'fileuploaddone' => 'function(e, data) {
        //         console.log(e);
        //         console.log(data);
        //     }',
        //     'fileuploadfail' => 'function(e, data) {
        //         console.log(e);
        //         console.log(data);
        //     }',
        // ],
    // ]);
    ?>
    <b>上传缩略图</b><br />
    <?= FileUpload::widget([
        'name' => 'Topic[img]',
        // 'model' => $model,
        // 'attribute' => 'img',
        'url' => ['topic/upload'], // your url, this is just for demo purposes,
        'options' => ['accept' => 'image/*'],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
        // Also, you can specify jQuery-File-Upload events
        // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                result = eval("("+data.result+")");
                // console.log(result);
                $("#topicImg").val(result.name);
                alert("上传成功");
            }',
            'fileuploadfail' => 'function(e, data) {
                console.log(e);
                console.log(data);
            }',
        ],
    ]); ?>
    <input type="hidden" id="topicImg" name="img">
    <?= $form->field($model, 'click')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
