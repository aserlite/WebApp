<?php

if($_COOKIE['token']){
    setcookie("token", "", time()-3600);
    setcookie("error", "", time()-3600);
    header("Location: login.php");
}