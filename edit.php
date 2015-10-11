<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>edit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="bootstrap.min.css">-->
</head>
<body>
<?php
    //1.连接数据库
    try{
        $pdo = new PDO("mysql:host=localhost; dbname=textbook","root","");//连接数据库
        $pdo->query("SET NAMES UTF8");//指定mysql以UTF8输出汉字，处理乱码问题
    }catch(PDOException $e){
        die("数据库连接失败".$e->getMessage());
    }
    //print_r($pdo);

    //2.拼装SQL语句取出信息
    $sql = "select * from text where id = ".$_GET['id'];
    $stmt = $pdo->query($sql);
    if($stmt->rowCount() > 0){
        $record = $stmt->fetch(PDO::FETCH_ASSOC);//解析数据
    }else{
        die("没有要修改的数据");
    }
?>
<div class="page-header">
    <h1><em>&nbsp&nbspTextBook&nbsp2.0</em><small>&nbsp&nbsp&nbspPHP、服务器数据库 15/10/2</small></h1>
</div>
<br>

<div class="container">
    <!--输入框-->
    <form class="form-horizontal" action="action.php?action=edit" method="post">
        <input type="hidden" name="date" value="<?php echo time();?>">
        <input type="hidden" name="id" value="<?php echo $record['id'];?>">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">标题</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="name" value="<?php echo $record['name'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="memo" class="col-sm-2 control-label">内容</label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="13" name="memo"><?php echo $record['memo'];?></textarea>
            </div>
        </div>
        <!--按钮-->
        <div class="col-md-1 col-md-offset-11">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">&nbsp;&nbsp;修改&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>