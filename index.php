<!--
    显示（查询）、删除数据库
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>textbook</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="bootstrap.min.css">-->
    <link rel="stylesheet" href="page.css">
    <script type="text/javascript" src="upDown.js"></script>
</head>
<body>
<!--侧边悬浮按钮-->
<!--使用锚链接实现，没兼容性问题，但直接跳转，视觉效果不够好-->
<!--<div class="side-nav" role="navigation">-->
<!--    <ul class="nav-side-nav">-->
<!--        <li><a class="tooltip-side-nav" href="#">-->
<!--                <span class="glyphicon glyphicon-chevron-up"></span>-->
<!--            </a>-->
<!--        </li>-->
<!--        <li><a class="tooltip-side-nav" href="#bottom" id="down">-->
<!--                <span class="glyphicon glyphicon-chevron-down"></span>-->
<!--            </a>-->
<!--        </li>-->
<!--    </ul>-->
<!--</div>-->

<!--使用JS的定时器实现动画效果-->
<div class="side-nav" role="navigation">
    <ul class="nav-side-nav">
        <li><a class="tooltip-side-nav" href="javascript:up()" id="up">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
        </li>
        <li><a class="tooltip-side-nav" href="javascript:down()" id="down">
                <span class="glyphicon glyphicon-chevron-down"></span>
            </a>
        </li>
    </ul>
</div>

<div class="page-header" >
    <h1><em>&nbsp&nbspTextBook&nbsp2.0</em><small>&nbsp&nbsp&nbspPHP、服务器数据库 15/10/2</small></h1>
</div>

<div class="container" id="frameContent" style="width: 75%">
    <!--添加按钮，转到add.html-->
    <div class="clearfix" >
        <div class="pull-right">
            <a href="sign.php" class="btn btn-success btn-block" role="button">
                &nbsp;&nbsp;Sign in&nbsp;&nbsp;
            </a>
            <a href="imageKey.html" class="btn btn-success btn-block" role="button">
                &nbsp;&nbsp;图形密码登录&nbsp;&nbsp;
            </a>
            <br>
        </div>
    </div>

    <!--显示内容-->
    <div name="datatable">
        <?php

        //1.连接数据库
        try{
            $pdo = new PDO("mysql:host=localhost; dbname=textbook","root","");
            $pdo->query("SET NAMES UTF8");//指定mysql以UTF8输出汉字，处理乱码问题
        }catch(PDOException $e){
            die("数据库连接失败！".$e->getMessage());
        }
        //print_r($pdo);
//
//
        //2.查询遍历数据库，并用echo输出（同一个循环中）
//        $sql = "select * from text";
//        foreach($pdo->query($sql) as $row){
//            echo '<div class="panel panel-primary" name="content">
//                            <div class="panel-heading">
//                                <h3 class="panel-title">';
//            echo $row['name'];
//            echo '<small class="text-right">&nbsp;&nbsp;&nbsp;';
//            echo date("Y/m/d",intval($row['date']));//数据库中为Int型时间戳
//            echo '</small></h3></div><div class="panel-body"><p><pre>';
//            echo $row['memo'];
//            echo '</pre></p></div></div>';
//        }

        //分页
        $sql = "select * from text";
        //得到$recordNum数据库中记录条数
        $res = $pdo->prepare($sql);
        $res->execute();
        $recordNum = $res->rowCount();

        $recordLimt = 5;//限制每页显示条数
        $pageNum = ceil($recordNum/$recordLimt);//页数

        //得到当前页码
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }

        //根据页码查询数据库输出对应记录
        //2.查询遍历数据库，并用echo输出（同一个循环中）
        $sql = "select * from text limit ".(($page-1)*5).",5";
        foreach($pdo->query($sql) as $row){
            echo '<div class="panel panel-primary" name="content">
                            <div class="panel-heading">
                                <h3 class="panel-title">';
            echo $row['name'];
            echo '<small class="text-right">&nbsp;&nbsp;&nbsp;';
            echo date("Y/m/d",intval($row['date']));//数据库中为Int型时间戳
            echo '</small></h3></div><div class="panel-body"><p><pre>';
            echo $row['memo'];
            echo '</pre></p></div></div>';
        }

        //根据总页数生成分页组件
        //若页码为第一页则previous禁用，若页码为页数则禁用next，根据$_GET['page']判断页数
        echo '<nav  style="text-align: center">';
        echo '<ul class="pagination">';
        //上一页
        if($page==1){
            echo '<li class="disabled"><span aria-hidden="true">&laquo;</span>';
        }else{
            echo '<li><a href="index.php?page='.($page-1).'" aria-label="Previous">';
            echo '<span aria-hidden="true">&laquo;</span>';
            echo '</a>';
        }
        echo '</li>';
        //页码
        for($i=1; $i<=$pageNum; $i++){
            echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
        }
        //下一页
        if($page==$pageNum){
            echo '<li class="disabled"><span aria-hidden="true">&raquo;</span>';
        }else{
            echo '<li><a href="index.php?page='.($page+1).'" aria-label="Next">';
            echo '<span aria-hidden="true">&raquo;</span>';
            echo '</a>';
        }
        echo '</li>';

        echo '</ul></nav>';
        ?>

    </div>
    <div class="footer" id="bottom">
        <hr>
        <h6>@designed by wfx</h6>
    </div>
</div>
</body>
</html>