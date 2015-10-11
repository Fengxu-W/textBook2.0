<?php
//1.连接数据库
try{
    $pdo = new PDO("mysql:host=localhost; dbname=textbook","root","");//连接数据库
    $pdo->query("SET NAMES UTF8");
}catch(PDOException $e){
    die("数据库连接失败".$e->getMessage());
}
//print_r($pdo);

//2.通过action的值做对应操作
switch($_GET['action']){//?参数的形式都是GET方式，所以用GET取
    case "add":
        //添加操作
        $name = $_POST['name'];//add.php中表单通过POST方式传值，这里获取name为'name'的表单数据
        $date = $_POST['date'];
        $memo= $_POST['memo'];

        $time = intval($date);
        //echo $name,$date,$memo;
        $sql = "insert into text values(NULL,'{$name}',{$time},'{$memo}')";
        $rw = $pdo->exec($sql);
        if($rw>0){
            echo "<script>alert('添加成功');window.location='admin.php'</script>";
        }else{
            echo "<script>alert('添加失败');window.history.back();</script>";
        }
        break;

    case "edit":
        //修改操作
        $name = $_POST['name'];//add.php中表单通过POST方式传值，这里获取name为'name'的表单数据
        $date = $_POST['date'];
        $memo= $_POST['memo'];
        $id = $_POST['id'];

        $time = intval($date);

        $sql = "update text set name='{$name}',date={$time},memo='{$memo}' where
                id = {$id} ";
        $rw = $pdo->exec($sql);
        if($rw>0){
            echo "<script>alert('修改成功');window.location='admin.php'</script>";
        }else{
            echo "<script>alert('修改失败');window.history.back();</script>";
        }
        break;

    case "del":
        //删除操作
        $id = $_GET['id'];
        $sql = "delete from text where id = {$id}";
        $rw = $pdo->exec($sql);
        if($rw>0){
            echo "<script>alert('删除成功');window.location='admin.php'</script>";
            //header("Location:admin.php");//php的跳转方法,如果用这个方法echo好像没执行
        }else{
            echo "<script>alert('删除失败');window.history.back();</script>";
        }
        break;
    case "sign":
        $name = $_POST['name'];
        $password = $_POST['password'];

        $sql = "select password from users where name = '{$name}'";
        $stmt = $pdo->query($sql);
        //echo $stmt->rowCount();
        if($stmt->rowCount()){
            //表中含有该用户
            foreach($pdo->query($sql) as $row){
                if($row['password']==$password){
                    //密码正确
                    echo "<script>alert('欢迎回来！');window.location='admin.php'</script>";
                }else{
                    echo "<script>alert('密码错误！');window.history.back();</script>";
                }
            }
        }else{
            echo "<script>alert('用户名不存在！');window.history.back();</script>";
        }

        break;
}