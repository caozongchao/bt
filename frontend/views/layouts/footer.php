<?php
use yii\helpers\Url;
?>
<div class="container">
    <footer>
        <hr>
        <div class="container">
            <center>
                <ul class="list-inline">
                    <li><a href="http://bt.yssousuo.com" target="_blank">磁力搜索</a></li>
                    <li><a href="http://bt.yssousuo.com" target="_blank">BT搜索</a></li>
                </ul>
            </center>
            <!-- <center>
                <p>
                    Template by <a href="http://tiagoanleite.github.io">Tiago Leite</a>
                </p>
            </center> -->
        </div>
    </footer>
</div>
<div class="jumbotron" style="margin-bottom:0px;">
    <div class="container">
        <div class="row">
            <center>
                <p style="font-size:14px;">水熊BT是一个基于DHT协议的BT资源搜索引擎，所有资源来源于爬虫24小时从DHT网络自动抓取，所有排行数据由程序自动生成。</p>
                <p style="font-size:14px;">我们不存储任何资源和种子文件，只索引种子meta信息并提供搜索服务。</p>
                <p style="font-size:14px;">
                    <a href="<?=Url::to(['site/declare'])?>">使用必读</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?=Url::to(['site/assistance'])?>">资助我们</a>
                </p>
            </center>
        </div>
    </div>
</div>
