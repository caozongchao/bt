<?php
use frontend\helpers\FormatSizeHelper;

$this->title = $data->name.'磁力搜索-bt搜索-磁力链接-迅雷下载_水熊BT专题详情';
?>
<div class="container" style="padding-top:100px;">
    <div class="row">
        <!-- Results Content Column -->
        <div class="col-lg-8">
            <!-- Page title -->
            <h3><?=$data->name?></h3><hr>
            <?=$data->content?>
        </div>
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/sidebar.php'); ?>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer1.php'); ?>
<script type="text/javascript">
$(function() {
    $("img").addClass("img-responsive");
});
</script>
