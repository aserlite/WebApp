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
    <script src="https://kit.fontawesome.com/bbfaea1734.js" crossorigin="anonymous"></script>
    <title>Register</title>
    <link rel="icon" href="web.png">

</head>
<body>
<div class="container">

<form action="registerT.php" method="post" class="LoginForm">
    <div class="email">
        <input type="email" class="input" name="mail" placeholder="E-mail" required>
        <i class="fa-solid fa-envelope"></i>
    </div>
    <div class="username">
        <input type="text" class="input" name="username" placeholder="Username" required>
        <i class="fa-solid fa-user"></i>
    </div>
    <div class="pwd">
        <div class="PwdContainer">
            <input type="password" class="input" placeholder="Password" name="pwd" id="pwd" required>
            <input type="password" class="input" placeholder="Confirm password" name="cpwd" id="Cpwd" required>
        </div>
        <i class="fa-solid fa-eye eye" id="eye" onclick="closeeye()"></i>
        <i class="fa-solid fa-eye-slash hidden eye" id="Ceye" onclick="openeye()"></i>
    </div>
    <div class="date">
        <input type="date" class="input" id="calendar" name="birth" >
        <i class="fa-solid fa-calendar-days iconCalendar" onclick="document.getElementById('calendar').showPicker(); console.log('test')"></i>
    </div>
    <button> Register </button>
    <div class="registerLink">
        You have an account?
        <a href="login.php" >Log in</a>
    </div>
</form>
</div>

</body>
<script>
    function openeye(){
        document.getElementById("eye").classList.remove('hidden')
        document.getElementById("Ceye").classList.add('hidden')
        document.getElementById("pwd").type = 'password'
        document.getElementById("Cpwd").type = 'password'
    }

    function closeeye(){
        document.getElementById("eye").classList.add('hidden')
        document.getElementById("Ceye").classList.remove('hidden')
        document.getElementById("pwd").type = 'text'
        document.getElementById("Cpwd").type = 'text'
    }

    <?php
    if ($_COOKIE['error']) {
        echo 'alert("' . $_COOKIE['error'] . '");';
        setcookie("error", "", time() - 3600);
    }
    ?>
</script>
</html>