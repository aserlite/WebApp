<?php
if($_COOKIE['token']){
    header("Location: profile.php");
}else{
    header("Location: register.php");
}