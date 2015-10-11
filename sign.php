<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign in</title>
<!--    <link rel="stylesheet" href="bootstrap.min.css">-->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="signin.css" rel="stylesheet">

</head>
<body>
<script>
    function check(){
        var regexp = /^[A-Za-z_][A-Za-z0-9_]{0,10}$/;//定义正则表达式模式
//        alert(document.getElementById("inputName").value);
        if(!regexp.test(document.getElementById("inputName").value)){
            alert("用户名格式不满足");
        }
    }
</script>

<div class="container">

    <form class="form-signin" action="action.php?action=sign" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <br>
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" id="inputName" name="name" onchange="check()" class="form-control" placeholder="Name" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->
</body>
</html>