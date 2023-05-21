<?php
$host="localhost";
$db="app_ATW";
$user="root";
$passwd="root";




try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $passwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `pwd` text NOT NULL,
  `member_number` int NOT NULL,
  `birth` date DEFAULT NULL,
  `token` text,
  `created_at` date NOT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`id`, `email`, `username`, `pwd`, `member_number`, `birth`, `token`, `created_at`, `admin`) VALUES
(1, 'admin@admin.com', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3853, '2000-01-01', '2ace18f2614e9680700b1caa87f1cf', '2023-05-21', 1);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
";
    $pdo->exec($sql);
}
catch(Exception $e) {
}


?>