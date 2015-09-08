<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title></title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body class="align">

<div class="site__container">

    <div class="grid__container">

        <form action="loginCheck" method="post" class="form form--login">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <img class="logo" src="img/big-logo.png">

            <div class="form__field">
                <label class="fontawesome-user" for="login__username"><span class="hidden">用户名</span></label>
                <input name="username" id="login__username" type="text" class="form__input" placeholder="用户名" required>
            </div>

            <div class="form__field">
                <label class="fontawesome-lock" for="login__password"><span class="hidden">密码</span></label>
                <input name="password" id="login__password" type="password" class="form__input" placeholder="密码" required>
            </div>

            <div class="form__field">
                <input type="submit" value="登陆">
            </div>

        </form>

    </div>

</div>

</body>
</html>