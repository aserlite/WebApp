<?php
if ($_COOKIE['token']) {
    header('Location: profile.php');
};
require("db.php");

if ($_POST['mail'] and $_POST['pwd']) {
    if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
        $sql = "SELECT * FROM user WHERE email=? and pwd=?";
        $query = $pdo->prepare($sql);
        $query->execute([$_POST['mail'], sha1($_POST['pwd'])]);

        if($query->fetchAll() != NULL){
            $string = sha1(rand());
            $token = substr($string, 0, "30");
            $sql = "UPDATE user SET token=? WHERE email=? AND pwd=?";
            $query = $pdo->prepare($sql);
            $query->execute([$token,$_POST['mail'],sha1($_POST['pwd'])]);
            setcookie('token', $token, time() + (86400 * 60), "/");

            header('Location: profile.php');
        }else{
            setcookie('error', 'Account not found', time() + (86400 * 30), "/");
            header('Location: login.php');
        }
    }else{
        setcookie('error', 'invalid email', time() + (86400 * 30), "/");
        header('Location: login.php');
    }
} else {
    setcookie('error', 'error in the informations', time() + (86400 * 30), "/");
    header('Location: login.php');
}

