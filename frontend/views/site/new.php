<?php
use yii\widgets\LinkPager;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use frontend\helpers\FormatSizeHelper;
use frontend\helpers\ColorHelper;
$this->title = '收录库_水熊BT';
?>
<div class="container" style="padding-top:100px;">
    <div class="row">
        <!-- Results Content Column -->
        <div class="col-lg-8">
            <!-- Page title -->
            <div class="table-responsive">
                <ul class="media-list">
                    <?php foreach ($datas as $key => $value): ?>
                    <li class="media">
                        <!-- <div class="media-left">
                            <a href="" rel="author" data-original-title="" title=""><img class="media-object" src="" alt=""></a>
                        </div> -->
                        <div class="media-body" style="padding-bottom:5px; border-bottom:1px solid #dddddd;">
                            <div class="media-heading" style="font-size:16px;"><a href="<?=Url::to(['site/detail','id' => $value->id])?>"><?=$value->name?> </a><small><i class="fa fa-file"></i> <span class="badge" style="background-color: #99CC33"><?=$value->num?></span></small></div>
                            <div class="media-action">
                                <i class="fa fa-clock-o fa-fw"></i> <span class="badge" style="background-color: #FFCC99"><?=$value->time?></span>
                                <i class="fa fa-database fa-fw"></i> <span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($value->size)?></span>
                                <i class="fa fa-eye fw"></i> <span class="badge" style="background-color: #FF9999"><?=$value->hot?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-download fw"></i> <a href="<?=Url::to(['site/detail','id' => $value->id])?>">磁力链接</a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach ?>
                </ul>
                <!-- Pagination -->
                <nav>
                    <center>
                        <?php
                            echo LinkPager::widget([
                                'pagination' => $pagination,
                            ]);
                        ?>
                    </center>
                </nav>

            </div>
        </div>
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/sidebar.php'); ?>
    </div>
    <!-- /.row -->
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer1.php'); ?>
