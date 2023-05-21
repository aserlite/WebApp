<?php

if ($_COOKIE['token']) {
    header('Location: profile.php');
}
require("db.php");
if ($_POST['mail'] and $_POST['username'] and $_POST['pwd']) {
    $sql = "SELECT id FROM user WHERE email=?";
    $query = $pdo->prepare($sql);
    $query->execute([$_POST['mail']]);
    if ($query->fetchAll() != NULL) {
        setcookie('error', 'Email already existing', time() + (86400 * 30), "/");
        header('Location: register.php');
    } else {
        if ($_POST['pwd'] == $_POST['cpwd']) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $sql = "INSERT INTO user(email,username,pwd,member_number,birth,token,created_at) VALUES(?,?,?,?,?,?,?)";
                $query = $pdo->prepare($sql);
                $string = sha1(rand());
                $member_number = mt_rand(1111,9999);
                $sqlBis = "SELECT id FROM user WHERE email=?";
                $queryBis = $pdo->prepare($sqlBis);
                $queryBis->execute([$member_number]);
                while ($queryBis->fetchAll() != NULL) {
                    $member_number = mt_rand(1111,9999);
                    $sqlBis = "SELECT id FROM user WHERE member_number=?";
                    $queryBis = $pdo->prepare($sqlBis);
                    $queryBis->execute([$member_number]);
                }
                $token = substr($string, 0, "30");
                $query->execute([$_POST['mail'], $_POST['username'], sha1($_POST['pwd']), $member_number ,$_POST['birth'] ,$token, date('Y-m-d H:i:s')]);
                setcookie('token', $token, time() + (86400 * 60), "/");
                header('Location: index.php');
            } else {
                setcookie('error', 'invalid email', time() + (86400 * 30), "/");
                header('Location: register.php');
            }
        } else {
            setcookie('error', 'Password not the same', time() + (86400 * 30), "/");

            header('Location: register.php');
        }
    }
}else{
    setcookie('error', 'error in the informations', time() + (86400 * 30), "/");
    header('Location: register.php');
}

