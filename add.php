<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>add</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="bootstrap.min.css">-->
</head>
<body>
    <div class="page-header">
        <h1><em>&nbsp&nbspTextBook&nbsp2.0</em><small>&nbsp&nbsp&nbspPHP、服务器数据库 15/10/2</small></h1>
    </div>
    <br>

    <div class="container">
        <!--输入框-->

        <form class="form-horizontal" action="action.php?action=add" method="post">
            <input type="hidden" name="date" value="<?php echo time();?>">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" placeholder="标题">
                </div>
            </div>
            <div class="form-group">
                <label for="memo" class="col-sm-2 control-label">内容</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="13" name="memo" placeholder="内容"></textarea>
                </div>
            </div>
            <!--按钮-->
            <div class="col-md-1 col-md-offset-11">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">&nbsp;&nbsp;保存&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>