<?php
require ('db.php');
if($_COOKIE['token']){
    if($_POST['pwd'] != ''){
        $pwd = sha1($_POST['pwd']);
    }else{
        $pwd = $_POST['pwdS'];
    }
    $sql = "SELECT id FROM user WHERE email=?";
    $query = $pdo->prepare($sql);
    $query->execute([$_POST['email']]);
    if ($query->fetchAll() != NULL) {
        setcookie('error', 'Email already existing', time() + (86400 * 30), "/");
        header('Location: profile.php');
    }else{
        $sql = "UPDATE user SET email=?, username=?, pwd=? WHERE token=? ";
        $query = $pdo->prepare($sql);
        $result = $query->execute([$_POST['email'],$_POST['username'],$pwd,$_COOKIE['token']]);
        header('Location: profile.php');
    }
}
