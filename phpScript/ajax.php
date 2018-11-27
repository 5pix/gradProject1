<?php
/**Фаза 1.
 * Регистрация или “авторизация” пользователя.
 * Регистрация происходит по полю email, в эту же таблицу записывается имя и
 * телефон. В случае если пользователь уже заказывал - происходит “авторизация”.
 * Никаких паролей нет!
*/
// проверка коннекта к БД
$userEmailForm = $_REQUEST['email'];

try {
    $dsn = "mysql:host=localhost;dbname=burgers;charset=utf8";
    $pdo = new PDO($dsn, 'burger', '123456');
    $prepare = $pdo->prepare("SELECT * FROM users_registration where userEmail = :email");
    $prepare->execute(['email' => $userEmailForm]);
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка выполнения запроса -> ".$e->getMessage());
}
if (isset($_REQUEST['pay'])) {
    $cash = "со сдачей";
} else {
    $cash = "оплата картой";
} if (isset($_REQUEST['callback'])) {
    $callBack = 'перезвоните';
} else {
    $callBack = 'не перезванивать';
}
if (empty($result)) {
//записб в БД для регистрации
    $insert = $pdo->prepare("insert into users_registration(userName, userEmail, usersPhone)
    values (:name, :email, :phone)");
    $insert->execute([':name' => $_REQUEST['name'], ':email' => $_REQUEST['email'],
        ':phone' => $_REQUEST['phone']]);
    $lastId = $pdo->lastInsertId();// Id последней добавленной записи
            // вставляем новую запись в таблицу информации
    $countOrder = 1;
    $insertInfoTable = $pdo->prepare("insert into users_order_info(userId, userName, email, phone, street,
       houseNumber, corps, flatNumber, floorNumber, comment, backMoney, notCall, countOrder)
    values(:usrId, :nameUser, :emailUser, :phoneUser, :streetHouse, :homeNum, :corp, :flat, :floor, :commen,
    :backMon, :call, :countOrd)");
        $insertInfoTable->execute([
            ':usrId' => $lastId, ':nameUser' => $_REQUEST['name'], ':emailUser' => $_REQUEST['email'],
            ':phoneUser' => $_REQUEST['phone'], ':streetHouse' => $_REQUEST['street'], ':homeNum' => $_REQUEST['house'],
            ':corp' => $_REQUEST['corps'], ':flat' => $_REQUEST['flat'], ':floor' => $_REQUEST['floor'],
            ':commen' => $_REQUEST['comment'], ':backMon' => $cash, ':call' => $callBack, ':countOrd'=>$countOrder]);
    if ($insertInfoTable) {
                echo "вы успешно зарегистрировались";
    }
} else {
    foreach ($result as $userData) {
            //Если пользователь есть, нужно обработать данные и занести в таблицу счетчика заказов
        if (isset($userData['userEmail'])) {
                $id = $userData['id'];
                $prepare = $pdo->prepare("update users_order_info SET countOrder = countOrder + 1 where userId = :id");
                $prepare->execute(['id' => $id]);
            if ($prepare) {
                echo"вы успешно авторизировались";
                //выборка данных таблицы заказа
                $orderQuery = $pdo->query("select * from users_order_info 
                where userId = {$id}")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($orderQuery as $dataInRows) {
                    //Разделяем данные для читабельности
                    $separateData .= "Покупатель: {$dataInRows['userName']},\r\nПочта: {$dataInRows['email']},\r\n
                    Телефон: {$dataInRows['phone']},\r\n Улица: {$dataInRows['street']},\r\nНомер дома: 
                    {$dataInRows['houseNumber']},\r\nКорпус: {$dataInRows['corps']},\r\n
                    Квартира: {$dataInRows['flatNumber']},\r\n
                     Этаж: {$dataInRows['floorNumber']},\r\nКомментарий: {$dataInRows['comment']},\r\n 
                     Сдача/карта: {$dataInRows['backMoney']},\r\nПерезвонить: {$dataInRows['notCall']},\r\n
                     Количестов заказов: {$dataInRows['countOrder']}\r\n";
                    $pathToOrderInfo = "../Order from #{$dataInRows['userId']}.txt";
                    // пишем данные в файл
                    file_put_contents($pathToOrderInfo, $separateData);
                    // данные дл я вывода
                    $infoOrder = file_get_contents($pathToOrderInfo);
                    print ($infoOrder);
                }
            }
        }
    }
}
