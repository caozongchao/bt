<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '资助-BTcc';
?>
<div class="container" style="padding-top:60px; padding-bottom:50px; font-size:20px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <center><h2>资助</h2></center>
            <p>十分感谢广大网友对BTcc的支持，我们会再接再励，努力回报朋友们的支持，谢谢！</p>
            <p>
                <div style="float:left">
                    <img src="/images/zfbsq.png" width="180"><br />
                    <center>支付宝</center>
                </div>
                <div style="float:right;">
                    <img src="/images/wxsq.png" width="180"><br />
                    <center>微信</center>
                </div>
            </p>
        </div>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer1.php'); ?>
