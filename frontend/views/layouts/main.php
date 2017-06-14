<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="水熊BT,bt搜索,磁力链接,迅雷下载,磁力搜索" />
    <meta name="description" content="磁力链接搜索引擎水熊BT（bt.vieway.com)索引了全球最新最热门的磁力链接，提供磁力搜索和bt搜索强大功能。" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?815d721ee7f91f9c35144a5b3d6efb1f";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
<!-- <style type="text/css">
body {
    background: url('/images/bg.jpg') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;

    height: 100%;
}
</style> -->
</head>
<body>
<?php $this->beginBody() ?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=Yii::$app->homeUrl?>">水熊BT</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"></div>
        </div>
    </nav>
    <?=$content;?>
<?php $this->endBody() ?>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" >
var jiathis_config={
    siteNum:10,
    sm:"cqq,weixin,tsina,tqq,qzone,tieba,douban,ishare",
    summary:"",
    boldNum:6,
    showClose:true,
    shortUrl:false,
    hideMore:false
}
</script>
<!-- <script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?btn=r.gif&move=1" charset="utf-8"></script> -->
<!-- JiaThis Button END -->

<!-- 分享代码 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"4","bdPos":"right","bdTop":"100"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<!-- admin5广告 -->
<script src='http://slb.pcmzn.com/44587'></script>
<!-- 老榕树广告 -->
<script src="http://wm.lrswl.com/page/?s=239616"></script>
</body>
</html>
<?php $this->endPage() ?>
