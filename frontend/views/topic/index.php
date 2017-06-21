<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '磁力搜索-bt搜索-磁力链接-迅雷下载_水熊BT专题';
?>
<link rel="stylesheet" type="text/css" href="/css/animate.css">
<div class="container" style="padding-top:70px;">
    <div class="row">
        <?php foreach ($datas as $data): ?>
            <div class="piece col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center animate-box fadeInDown animated">
                <a href="<?=Url::to(['topic/detail','id' => $data->id])?>" class="text-center" style="display: block;background: #ffffff;position: relative;overflow: hidden;-webkit-border-radius: 5px;-moz-border-radius: 5px;-ms-border-radius: 5px;border-radius: 5px;-webkit-box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);-moz-box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);-ms-box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);-o-box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);margin-bottom: 30px;border-bottom: none;bottom: 0;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease; text-decoration: none;color:#8b969c;">
                    <img src="<?=$data->img?>" style="width:270px;" class="img-responsive">
                    <div class="text-center">
                        <h4><?=$data->name?></h4>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $(".piece").hover(function(){
        $(".piece").removeClass('fadeInDown');
        $(".piece").addClass('jello');
        $(".piece h4").css("color","#57cecd");
    },function(){
        $(".piece").removeClass('jello');
        $(".piece h4").css("color","#8b969c");
    });
});
</script>