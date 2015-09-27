<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>推送 | Novel Fetcher</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/favicon.ico">
</head>
<body class="align">

<div class="site__container">

    <div class="grid__container">

        <form action="sendFile" method="post" class="form form--login" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <img class="logo" src="img/big-logo.png">

            <div class="form__field">
                <input name="sendFile" id="login__username" type="file" class="form__input" required>
            </div>

            <div class="form__field">
                <input type="submit" value="推送">
            </div>

        </form>

    </div>

</div>

</body>
</html>