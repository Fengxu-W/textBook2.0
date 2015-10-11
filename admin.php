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
    <script>
        //js调用php,其实pHp提前解析，就看解析后的东西，所以js调用php并没什么，只是解析php后生成了js的代码
        function doDel(id){
            if(confirm("确定要删除吗？")){
                window.location = 'action.php?action=del&id='+id;//JS中用location做跳转
            }
        }
    </script>
</head>
<body>
<!--<div class="side-nav" role="navigation">-->
<!--    <ul class="nav-side-nav">-->
<!--        <li><a class="tooltip-side-nav" href="#">-->
<!--                当锚链接为#时即为页面顶部-->
<!--                <span class="glyphicon glyphicon-chevron-up "></span>-->
<!--            </a>-->
<!--        </li>-->
<!--        <li><a class="tooltip-side-nav" href="#bottom">-->
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

    <div class="page-header">
        <h1><em>&nbsp&nbspTextBook&nbsp2.0</em><small>&nbsp&nbsp&nbspPHP、服务器数据库 15/10/2</small></h1>
    </div>

    <div class="container "style="width: 75%">
        <!--添加按钮，转到add.html-->
        <div class="clearfix">
            <div class="pull-right">
                <a href="add.php" class="btn btn-success btn-block" role="button">
                    &nbsp;&nbsp;add&nbsp;&nbsp;
<!--                    <span class="glyphicon glyphicon-star">Add!</span>-->
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


                //2.查询遍历数据库，并用echo输出（同一个循环中）
                $sql = "select * from text limit ".(($page-1)*5).",5";
                foreach($pdo->query($sql) as $row){
                    echo '<div  class="btn-group btn-group-sm" role="group" aria-label="delOrEdit">
                            <a href="edit.php?id='.$row['id'].'" class="btn btn-default" role="button">edit</a>
                            <a href="javascript:doDel('.$row['id'].')" class="btn btn-default" role="button">delete</a>
                          </div>';


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
                echo '<li><a href="admin.php?page='.($page-1).'" aria-label="Previous">';
                echo '<span aria-hidden="true">&laquo;</span>';
                echo '</a>';
            }
            echo '</li>';
            //页码
            for($i=1; $i<=$pageNum; $i++){
                echo '<li><a href="admin.php?page='.$i.'">'.$i.'</a></li>';
            }
            //下一页
            if($page==$pageNum){
                echo '<li class="disabled"><span aria-hidden="true">&raquo;</span>';
            }else{
                echo '<li><a href="admin.php?page='.($page+1).'" aria-label="Next">';
                echo '<span aria-hidden="true">&raquo;</span>';
                echo '</a>';
            }
            echo '</li>';

            echo '</ul></nav>';
            ?>

<!--            示例-->
<!--            <div  class="btn-group btn-group-sm" role="group" aria-label="delOrEdit">-->
<!--                <a href="edit.php" class="btn btn-default" role="button">编辑</a>-->
<!--                <a href="javascript:doDel()" class="btn btn-danger" role="button">删除</a>-->
<!--            </div>-->
<!---->
<!---->
<!--            <div  class="panel panel-primary" name="content">-->
<!--                <div class="panel-heading">-->
<!--                    <h3 class="panel-title">title<small class="text-right">&nbsp;&nbsp;&nbsp;15/10/2</small></h3>-->
<!--                </div>-->
<!--                <div class="panel-body">-->
<!--                    <p>1.关于js调用php，其实只是php提前编译，用echo生成js代码，最终执行的还是js程序，所以只能操作客户端，仍然无法实现服务器端数据库操作-->
<!---->
<!--                        2.关于乱码，乱码只是编码问题，一种可能是文件编码方式，用IDE、记事本都能改，另一种是这次遇到的，输出mysql数据库中汉字的问题，需要在Php中指定Mysql以何种编码输出：-->
<!--                        $pdo->query("SET NAMES UTF8");//指定mysql以UTF8输出汉字，处理乱码问题-->
<!---->
<!--                        3.关于日期，为了操作方便，在数据库中以INT存储时间戳，在输出时用PHP转换为日期格式</p>-->
<!--                </div>-->
<!--            </div>-->


        </div>
        <div class="footer" id="bottom">
            <hr>
            <h6>@designed by wfx</h6>
        </div>
    </div>

</body>
</html>