<?php
if ($_COOKIE['token']) {
    header('Location: profile.php');
}; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/bbfaea1734.js" crossorigin="anonymous"></script>
    <link rel="icon" href="web.png">

</head>
<body>
<div class="container">
    <form action="loginT.php" method="post" class="LoginForm">
        <div class="email">
            <input type="email" name="mail" placeholder="E-mail" class="input" required>
            <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="pwd">
            <input type="password" placeholder="Password" class="input"  name="pwd" required id="pwd">
            <i class="fa-solid fa-eye eye" id="eye" onclick="closeeye()"></i>
            <i class="fa-solid fa-eye-slash hidden eye" id="Ceye" onclick="openeye()"></i>
        </div>
        <button> Login </button>
        <div class="registerLink">
            You don't have an account?
            <a href="register.php" >Create yours</a>
        </div>

    </form>
</div>
</body>
<script>
    function openeye(){
        document.getElementById("eye").classList.remove('hidden')
        document.getElementById("Ceye").classList.add('hidden')
        document.getElementById("pwd").type = 'password'
    }

    function closeeye(){
        document.getElementById("eye").classList.add('hidden')
        document.getElementById("Ceye").classList.remove('hidden')
        document.getElementById("pwd").type = 'text'
    }

    <?php
    if ($_COOKIE['error']) {
        echo 'alert("' . $_COOKIE['error'] . '");';
        setcookie("error", "", time() - 3600);
    }
    ?>
</script>
</html>