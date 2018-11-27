<?php
// Коннект к БД
echo $html = '<html style="background: #ddeedd">';
try {
    $dsn = "mysql:host=localhost;dbname=burgers;charset=utf8";
    $pdo = new PDO($dsn, 'burger', '123456');
    $prepare = $pdo->query("SELECT * FROM users_registration ");
    $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка выполнения запроса -> ".$e->getMessage());
}

$tableUsers = '<table style="background: #f3f3f3"><tr<th style="background: #ddeedd;text-align: center; 
font-weight: bold">Зарегистрированные пользователи';
foreach ($users as $user) {
    $tableUsers .= '<tr>';
    foreach ($user as $userDetail) {
        $tableUsers .= "<td style='border-bottom: 1px solid #cccccc'>$userDetail</td>";
    }
    $tableUsers .= '</tr>';
}
//вывод всей таблицы с результатами
echo $tableUsers .= '</th></tr></table><hr>';
//аналог предыдущей таблицы только другой запрос
$infoOrder = $pdo->query("SELECT * FROM users_order_info")->fetchAll(PDO::FETCH_ASSOC);
$tableUsersInfo = '<table style="background: #f3f3f3"><tr<th style="background: #ddeedd;text-align: center; 
font-weight: bold">Информация по всем заказам';
foreach ($infoOrder as $info) {
    $tableUsersInfo .= '<tr>';
    foreach ($info as $infoDetail) {
        $tableUsersInfo .= "<td style='border-bottom: 1px solid #cccccc'>$infoDetail</td>";
    }
    $tableUsersInfo .= '</tr>';
}
echo $tableUsersInfo .= '</th></tr></table></html>';
