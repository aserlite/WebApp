<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Other Profile</title>
    <script src="https://kit.fontawesome.com/bbfaea1734.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="web.png">

</head>
<body>
<button onclick="history.back()" class="backbtn"> <i class="fa-solid fa-circle-arrow-left backIcon"></i> Go back </button>
<?php
require ('db.php');
if ($_COOKIE['token']) {
    $sql = "SELECT * FROM user WHERE token=?";
    $query = $pdo->prepare($sql);
    $query->execute([$_COOKIE['token']]);
    $result = $query->fetch();
    if ($result['admin'] != NULL) {

        $sql = "SELECT * FROM user WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute([$_GET['id']]);
        $acc = $query->fetch();
        if($acc !=NULL){
        ?>
            <div class="other">
                <div><p>Id:  </p><p><?php echo $acc['id'] ?></p></div>
                <div><p>Username: </p> <p><?php echo $acc['username'] ?></p></div>
                <div><p>Email:  </p><p><?php echo $acc['email'] ?></p></div>
                <div><p>Birth date:  </p><p><?php echo $acc['birth'] ?></p></div>
                <div><p>Member number: </p> <p><?php echo $acc['member_number'] ?></p></div>
                <div><p>Created: </p> <p><?php echo $acc['created_at'] ?></p></div>
                <div><p>Admin :  </p><p><?php if ($acc['admin'] != NULL) {
                        echo '<i class="fa-sharp fa-solid fa-circle-check"></i>';
                    } else {
                        echo "<i class='fa-regular fa-circle-xmark'></i>";
                    } ?></p>
            </div>
        <?php
        } else {
            echo "Account not found";
        }
    }else{
        header('Location: profile.php');
        }
}; ?>
</body>
</html>
