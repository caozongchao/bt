<?php
use frontend\helpers\FormatSizeHelper;

$this->title = $data->name.'磁力搜索-bt搜索-磁力链接-迅雷下载_水熊BT详情';
?>
<div class="container" style="padding-top:100px;">
    <div class="row">
        <!-- Results Content Column -->
        <div class="col-lg-8">
            <!-- Page title -->
            <h3><?=$data->name?></h3><hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <!-- <div class="col-lg-6">
                            <center>
                                <img src="http://placehold.it/100x145" class="img-responsive">
                            </center>
                        </div> -->
                        <div class="col-lg-6">
                            <br>
                            <dl class="dl-horizontal">
                                <dt>大小</dt>
                                <dd><span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($data->size)?></span></dd>
                                <dt>文件数</dt>
                                <dd><span class="badge" style="background-color: #99CC33"><?=$data->num?></span></dd>
                                <dt>收录时间</dt>
                                <dd><span class="badge" style="background-color: #FFCC99"><?=$data->time?></span></dd>
                                <dt>索引类型</dt>
                                <dd><span class="badge" style="background-color: #FF9999"><?=$type?></span></dd>
                            </dl>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">只显示文件列表中最大的前10个文件</div>
                                <div class="panel-body">
                                    <?php $files = explode('@||@',$data->files) ?>
                                    <?php foreach ($files as $key => $value): ?>
                                        <?php $array = explode('$||$',$value); ?>
                                        <p><?=$array[0]?>  <span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($array[1])?></span></p>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <center>
                        <ul class="list-inline">
                            <li><i class="fa fa-download"></i> <a href="magnet:?xt=urn:btih:<?=$data->hash?>">磁力链接</a></li><br />
                        </ul>
                    </center>
                </div>
            </div>
        </div>
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/sidebar.php'); ?>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer1.php'); ?>
