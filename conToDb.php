<?php
try {
    $dsn = "mysql:host=localhost;dbname=burgers;charset=utf8";
    $pdo = new PDO($dsn, 'burger', '123456');
    $prepare = $pdo->prepare("SELECT * FROM users_orders where id >= :number");
    $prepare->execute(['number' => 1]);
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка выполнения запроса -> ".$e);
}

echo "<pre>";
var_dump($result);
echo "</pre>";
