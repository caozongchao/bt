<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '磁力搜索-bt搜索-磁力链接-迅雷下载_水熊BT';
?>
<div class="container" style="padding-top:60px;">
    <!-- <div class="row" style="margin-bottom: 15px;">
        <div class="col-lg-12 text-center">
            <img src="/images/index1.png" class="img-rounded img-responsive center-block" style="width:300px;" alt="水熊BT">
        </div>
    </div> -->

    <div class="row">
        <div class="col-lg-12 text-center">
            <h1>水熊BT</h1>
            <!-- <p class="lead">你想搜的这都有</p> -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 text-center">
            <form action="<?=Url::to(['site/search'])?>">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" name="k">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">
                            <i class="fa fa-fw fa-search"></i>
                        </button>
                    </span>
                </div>
                <div style="padding:10px 0px 0px 0px">共<?=number_format($total,0,',',' ')?>条数据，上次更新时间<?=$totalTime?>，今日持续更新<?=number_format($today,0,',',' ')?></div>
                <div style="padding:10px 0px 0px 0px">
                    热门搜索：
                    <a href="http://bt.vieway.cn/s?k=%E9%80%9F%E5%BA%A6%E4%B8%8E%E6%BF%80%E6%83%858">速度与激情8</a>&nbsp;&nbsp;
                    <a href="http://bt.vieway.cn/s?k=%E6%91%94%E8%B7%A4%E5%90%A7%E7%88%B8%E7%88%B8">摔跤吧！爸爸</a>&nbsp;&nbsp;
                    <a href="http://bt.vieway.cn/s?k=%E6%AC%A2%E4%B9%90%E9%A2%822">欢乐颂2</a>&nbsp;&nbsp;
                    <a href="http://bt.vieway.cn/s?k=%E4%BA%BA%E6%B0%91%E7%9A%84%E5%90%8D%E4%B9%89">人民的名义</a>&nbsp;&nbsp;
                    <a href="http://bt.vieway.cn/s?k=tvb">tvb</a>
                </div>
                <div style="padding:10px 0px 0px 0px">
                    最新收录：<br />
                    <?php foreach ($latest5 as $latest): ?>
                        <a href="http://bt.vieway.cn/<?=$latest['id']?>"><?=$latest['name']?></a>
                        <?php if ($latest != end($latest5)): ?>
                            <br />
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </form>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <!-- /.row -->
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer.php'); ?>
