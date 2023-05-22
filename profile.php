<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/bbfaea1734.js" crossorigin="anonymous"></script>
    <link rel="icon" href="web.png">
</head>
<body>
<?php
require("db.php");
if (!$_COOKIE['token']) {
    header('Location: login.php');
};

$sql = "SELECT * FROM user WHERE token=?";
$query = $pdo->prepare($sql);

$query->execute([$_COOKIE['token']]);
$result = $query->fetch();
?>
<div class="profile">
    <form action="edit.php" method="post" class="formInfos">
        <div class="chInfo">
            <label for="email">Your email:</label><input type="email" class="editField input" name="email"
                                                         value="<?php echo $result['email'] ?>"
            >


            <label for="username">Your username:</label><input type="text" name="username"
                                                               value="<?php echo $result['username'] ?>"
                                                               class="editField input">


            <label id="changepwdLab" class="cache" for="pwd">Change password</label> <input id="changepwd"
                                                                                            class="cache input"
                                                                                            type="password"
                                                                                            placeholder="Change your password"
                                                                                            name="pwd" class="input">
            <input type="hidden" value="<?php echo $result['pwd'] ?>" name="pwdS">
        </div>
        <button class="cache" id="submithidden"> Submit changes</button>
        <button onclick="edit()" id="editbtn">Edit profile</button>

    </form>
    <p class="stroke">Account created: <?php echo $result['created_at'] ?></p>
    <p class="strokeB">Member number: <?php echo $result['member_number'] ?></p>
    <div class="panel">
        <form action="delete.php">
            <button>Delete account</button>
        </form>
        <form action="logout.php">
            <button>Logout</button>
        </form>
    </div>

</div>
<?php
if ($result['admin'] != NULL) {
    if ($_GET['order']) {
        $order = $_GET['order'];
    } else {
        $order = "id";
    }
    $sql = "SELECT * FROM user WHERE NOT id = ? ORDER BY ?";
    $query = $pdo->prepare($sql);

    $query->execute([$result['id'],$order]);

    $allAcc = $query->fetchAll();
    ?>
    <form action="profile.php" class="changeOrder">
        <select name="order" onchange="this.form.submit()" id="selector">
            <option value="id">Select new order value</option>
            <option value="id">Id</option>
            <option value="email">email</option>
            <option value="username">username</option>
            <option value="created_at">Creation</option>
            <option value="birth">Birth Date</option>
            <option value="admin DESC">Admin</option>
        </select>
    </form>
    <table>

        <thead>
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Username</th>
            <th>Last Token</th>
            <th>Created at</th>
            <th>Admin</th>
            <th>Delete</th>
            <th>See profile</th>
        </tr>
        </thead>
        <?php

        foreach ($allAcc as $curAcc) {
            ?>
            <tr>
                <td><?php echo $curAcc['id'] ?></td>
                <td><?php echo $curAcc['email'] ?></td>
                <td><?php echo $curAcc['username'] ?></td>
                <td><?php echo $curAcc['token'] ?></td>
                <td><?php echo $curAcc['created_at'] ?></td>
                <td class="iconAdmin"><?php if ($curAcc['admin'] != NULL) {
                        echo '<i class="fa-sharp fa-solid fa-circle-check"></i>';
                    } else {
                        echo "<i class='fa-regular fa-circle-xmark'></i>";
                    } ?></td>
                <td class="iconAdmin"><a href="delete.php?id=<?php echo $curAcc['id'] ?>" class="deleteAcc"><i class="fa-solid fa-trash"></i>️</a></td>
                <td class="iconAdmin"><a href="other.php?id=<?php echo $curAcc['id'] ?>" class="deleteAcc"><i class="fa-solid fa-address-card"></i></a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>

<script>

    <?php
    if ($_COOKIE['error']) {
        echo 'alert("' . $_COOKIE['error'] . '");';
        setcookie("error", "", time() - 3600);
    }
    if ($result['admin'] != NULL){
    ?>

    const selector = document.getElementById("selector");

    selector.addEventListener("focusin", (event) => {
        document.body.style.filter='blur(2px)'
    });

    document.body.addEventListener("focusout", (event) => {
        document.body.style.filter='blur(0px)'
    });
    function edit() {
        event.preventDefault();
        document.getElementById('submithidden').classList = null;
        document.getElementById('changepwd').classList.remove('cache');
        document.getElementById('changepwdLab').classList = null;

        document.getElementById('editbtn').classList = "cache";

        let fields = document.querySelectorAll('.editField');
        fields.forEach(elt => {
            console.log(elt)
            elt.classList.remove("editField");
        })
    }
    <?php
    } ?>
</script>
</body>
</html>
