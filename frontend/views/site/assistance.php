<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '资助_水熊BT';
?>
<div class="container" style="padding-top:60px; padding-bottom:50px; font-size:18px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <center><h2>资助</h2></center>
            <p>十分感谢广大网友对水熊BT的支持，我们会再接再励，努力回报朋友们的支持，谢谢！</p>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <p>
                <div style="float:left">
                    <img src="/images/zfbsq.png" style="width:180px;"><br />
                    <center>支付宝</center>
                </div>
                <div style="float:right">
                    <img src="/images/wxsq.png" style="width:180px;"><br />
                    <center>微信</center>
                </div>
            </p>
        </div>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer1.php'); ?>
