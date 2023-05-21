<?php
require("db.php");

if ($_COOKIE['token'] and !$_GET['id']) {
    $sql = "DELETE FROM user WHERE token=?";
    $query = $pdo->prepare($sql);
    $query->execute([$_COOKIE['token']]);
    setcookie("token", "", time() - 3600);
    setcookie("error", "", time() - 3600);
    header("Location: login.php");
} elseif ($_COOKIE['token'] and $_GET['id']) {
    $sql = "SELECT * FROM user WHERE token=?";
    $query = $pdo->prepare($sql);
    $query->execute([$_COOKIE['token']]);
    $result = $query->fetch();
    if ($result['admin'] != NULL) {
        $sql = "DELETE FROM user WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute([$_GET['id']]);
        header("Location: profile.php");

    }
}