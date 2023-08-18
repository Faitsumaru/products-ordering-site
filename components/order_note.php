<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once dirname(__DIR__, 1) . '/php/funcs.php';

$index = 1;

if(isset($_POST['submit'])) {
    if ((isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['deliveryDate']) && isset($_POST['address'])) || (isset($_SESSION['name']) && isset($_SESSION['tel']) && isset($_POST['deliveryDate']) && isset($_POST['address']))) {
        
        if (isset($_SESSION['name']) && isset($_SESSION['tel'])) {
            $name = $_SESSION['name'];
            $tel = $_SESSION['tel'];
        } else {
            $name = $_POST['name'];
            $tel = $_POST['phone'];
        }
        $orderType = $_POST['orderType'];
        $address = $_POST['address'];
        $deliveryDate = $_POST['deliveryDate'];

        // $deliveryDate = new DateTime($deliveryDate);
        $currentDate = new DateTime(date('m/d/Y'));
        // $date = new DateTime("09/14/2020");

        $user_data = 'name=' . $name . '&phone=' . $tel . '&orderType=' . $orderType . '&address=' . $address;

        if (empty($name)) {
            header("Location: ../make_order.php?error=Необходимо ввести ФИО пользователя!&$user_data");
            exit();
        } else if (empty($tel)) {
            header("Location: ../make_order.php?error=Необходимо ввести номер телефона!&$user_data");
            exit();
        } else if (empty($orderType)) {
            header("Location: ../make_order.php?error=Необходимо выбрать способ доставки!&$user_data");
            exit();
        } else if (empty($address)) {
            header("Location: ../make_order.php?error=Необходимо указать адрес доставки!&$user_data");
            exit();
        } else if (empty($deliveryDate)) {
            header("Location: ../make_order.php?error=Необходимо указать дату доставки!&$user_data");
            exit();
        } else if (new DateTime($deliveryDate) < $currentDate) {
            header("Location: ../make_order.php?error=Необходимо указать дату доставки в будущем времени!&$user_data");
            exit();
        } else if (empty($_SESSION['order'])) {
            header("Location: ../make_order.php?error=Необходимо добавить товары в заказ! Список пуст.&$user_data");
            exit();
        } else {
            // $noteSQL = "SELECT Consignment_Note.ID_Note AS [Номер накладной], Client.FName AS Клиент, Client.Address AS [Адрес доставки], 
            // (Services.Price * [Consignment_Note Services].Count + Goods.Price * [Consignment_Note Goods].Count) AS [Общая стоимость заказа], Consignment_Note.Date AS [Дата заказа]
            // FROM Consignment_Note
            //             INNER JOIN Client ON Client.ID_Client = Consignment_Note.[ID_Client (FK)]
            //             INNER JOIN [Consignment_Note Services] ON [Consignment_Note Services].[ID_Note (FK)] = Consignment_Note.ID_Note
            //             INNER JOIN Services ON Services.ID_Service = [Consignment_Note Services].[ID_Service (FK)]
            //             INNER JOIN [Consignment_Note Goods] ON [Consignment_Note Goods].[ID_Note (FK)] = Consignment_Note.ID_Note
            //             INNER JOIN Goods ON Goods.ID_Goods = [Consignment_Note Goods].[ID_Goods (FK)]
            // ";
            
            // $updSQL = "UPDATE Client SET FName='$name', Tel='$phone', Sex='$sex', BirthDate='$date', Address='$address', Password='$password' WHERE ID_Client=$id";

            ////---random ID:
            $autoID_SQL = "SELECT TOP 1 Auto.ID_Auto FROM Auto
            ORDER BY NEWID()";
            $employeeID_SQL = "SELECT TOP 1 Employee.ID_Employee FROM Employee
            ORDER BY NEWID()";

            $stmtAutoID = sqlsrv_query($conn, $autoID_SQL);
            $stmtEmployeeID = sqlsrv_query($conn, $employeeID_SQL);

            $resultAutoID = sqlsrv_fetch_array($stmtAutoID, SQLSRV_FETCH_ASSOC);
            $resultEmployeeID = sqlsrv_fetch_array($stmtEmployeeID, SQLSRV_FETCH_ASSOC);

            $autoID = $resultAutoID['ID_Auto'];
            $employeeID = $resultEmployeeID['ID_Employee'];

            if(!isset($_SESSION['id'])) {
                $clientID_SQL = "SELECT TOP 1 Client.ID_Client FROM Client
                ORDER BY NEWID()";

                $stmtClientID = sqlsrv_query($conn, $clientID_SQL);

                $resultClientID = sqlsrv_fetch_array($stmtClientID, SQLSRV_FETCH_ASSOC);

                $clientID = $resultClientID['ID_Client'];
            } else {
                $clientID = $_SESSION['id'];
            }
            ///---

            $nodeSQL = "INSERT INTO Consignment_Note (Date, DeliveryAddress, [ID_Client (FK)], [ID_Auto (FK)], [ID_Employee (FK)]) 
            VALUES('$deliveryDate', '$address', '$clientID', '$autoID', '$employeeID')
            ";

// $nodeServSQL = "INSERT INTO [Consignment_Note Services] ([ID_Note (FK)], [ID_Service (FK)], Count) 
// VALUES()
// WHERE [Consignment_Note Services].[ID_Note (FK)] = Consignment_Note.ID_Note
// FROM Consignment_Note";

            $params = array($deliveryDate, $address, $clientID, $autoID, $employeeID);

            $stmt = sqlsrv_query($conn, $nodeSQL, $params);

            $_SESSION['orderType'] = $_POST['orderType'];
            $_SESSION['deliveryDate'] = $_POST['deliveryDate'];
            $_SESSION['serialNumber'] = random_int(1000, 10000);
            $_SESSION['orderAddress'] = $_POST['address'];

            if (!isset($_SESSION['name']) && !isset($_SESSION['tel'])) {
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['tel'] = $_POST['phone'];
            }

            $orderInfoSQL = "SELECT Client.ID_Client, Consignment_Note.ID_Note, Employee.FName as empName, Employee.Tel as empTel, Auto.Brand, Auto.Model, Auto.RegNum, YEAR(Auto.ReleaseYear) as ReleaseYear
            FROM Consignment_Note
                INNER JOIN Client ON Client.ID_Client = '$clientID'
                INNER JOIN Auto ON Auto.ID_Auto = '$autoID'
                INNER JOIN Employee ON Employee.ID_Employee = '$employeeID'
                ORDER BY Consignment_Note.ID_Note DESC";

            $stmt2 = sqlsrv_query($conn, $orderInfoSQL);
            if ($stmt2 === false) {
                return false;
            }

            $row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
            if ($row['ID_Client'] === $clientID) {
                $_SESSION['id_note'] = $row['ID_Note'];
                $_SESSION['employee_name'] = $row['empName'];
                $_SESSION['employee_tel'] = $row['empTel'];
                $_SESSION['brand'] = $row['Brand'];
                $_SESSION['model'] = $row['Model'];
                $_SESSION['reg_num'] = $row['RegNum'];
                $_SESSION['release_year'] = $row['ReleaseYear'];
            }

            header("Location: ../consignment_note.php");
            exit();
        }
    } else {
        header("Location: ../make_order.php?error=Необходимо заполнить данные!&$user_data");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Unicase:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Yandex - Накладная по заказу</title>
</head>
<body>
    
    <div class="container">
        <div class="sign note consignment_note">

            <div class="note__head">
                <img src="images/logo.svg" alt="logo">
                <h2 class="sign-title">Накладная по заказу</h2>
            </div>

            <div class="note__data">
                <div class="note__data-info note__data-info-first">
                   <p>«ООО» Яндекс</p>
                   <p>119021, г. Москва, <br> ул. Льва Толстого, д. 16.</p>
                   <p>+7(800)250-96-39</p>
                </div>
                <div class="note__data-info note__data-info-second">
                    <div class="note__data-info-title">
                        <p>Дата заказа:</p>
                        <p>Заказ №:</p>
                        <p>Серийный номер:</p>
                    </div>
                    <div class="note__data-info-text">
                        <p><?php echo $_SESSION['deliveryDate'] ?></p>
                        <p><?php echo $_SESSION['id_note'] ?></p>
                        <p><?php echo '№' . $_SESSION['serialNumber'] ?></p>
                    </div>
                </div>
            </div>

            <div class="note__info">
                <div class="note__info-user">
                    <h4>Информация о клиенте</h4>

                    <div class="note__info-box">
                        <div class="note__info-user-title">
                            <div>ФИО:</div>
                            <div>Телефон:</div>
                            <div>Адрес доставки:</div>
                        </div>
                        <div class="note__info-user-text">
                            <div><?php echo $_SESSION['name']; ?></div>
                            <div><?php echo $_SESSION['tel']; ?></div>
                            <div><?php echo $_SESSION['orderAddress']; ?></div>
                        </div>
                    </div>
                </div>

                <div class="note__info-other">
                    <h4>Другая информация о заказе</h4>

                    <div class="note__info-box">
                        <div class="note__info-user-title">
                            <div>Менеджер:</div>
                            <div>Телефон:</div>
                            <div>Беспилотный авто:</div>
                        </div>
                        <div class="note__info-user-text">
                            <div><?php echo $_SESSION['employee_name']; ?></div>
                            <div><?php echo $_SESSION['employee_tel']; ?></div>
                            <div><?php echo $_SESSION['brand'] . ' ' . $_SESSION['model'] . ', №' . $_SESSION['reg_num'] . ', ' . $_SESSION['release_year'] ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="note__list">
                <h3 class="note__list-title">Список товаров</h3>
                    <?php if (!empty($_SESSION['order'])): ?>
                        <table class="note__item-table-head">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Продукт</th>
                                    <th>Количество</th>
                                    <th>Вес</th>
                                    <th>Цена</th>
                                </tr>
                            </thead>
                        </table>
                        <?php foreach ($_SESSION['order'] as $id => $item): ?>
                            <li class="note__item">
                                <table class="note__item-table-body">
                                    <tbody>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><?php echo $item['ObjectName'] ?></td>
                                            <td><?php echo $item['count'] . ' шт.' ?></td>
                                            <td><?php echo $item['Weight'] . ' г.' ?></td>
                                            <td><?php echo $item['Price'] . ' ₽' ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        <?php endforeach; ?>

                        <div class="note__item-result">
                            <div>
                                <p class="note__text">Всего товаров:</p>
                                <p class="note__text">
                                    <?php echo (' ' . $_SESSION['order.count'] . ' шт.') ?>
                                </p>
                            </div>
                            
                            <div>
                                <p class="note__text">Общая стоимость товаров:</p>
                                <p class="note__text">
                                    <?php echo (' ' . $_SESSION['order.sum'] . ' ₽') ?>
                                </p>
                            </div>

                            <div>
                                <p class="note__text">
                                    <?php if ($_SESSION['orderType'] == "orderingPoint") echo 'Стоимость доставки в пункт выдачи:';
                                    else if ($_SESSION['orderType'] == "orderingMail") echo 'Стоимость доставки в почтовое отделение:';
                                    else if ($_SESSION['orderType'] == "orderingHome") echo 'Стоимость доставки на дом:';
                                    else echo 'Стоимость доставки:'?>
                                </p>
                                <p class="note__text">
                                    <?php if ($_SESSION['orderType'] == "orderingPoint") echo $orderPrice = 300 . ' ₽';
                                    else if ($_SESSION['orderType'] == "orderingMail") echo $orderPrice = 150 . ' ₽';
                                    else if ($_SESSION['orderType'] == "orderingHome") echo $orderPrice = 600 . ' ₽';
                                    else echo $orderPrice = 0 . ' ₽'?>
                                </p>
                            </div>

                            <div>
                                <p class="note__text">Налог:</p>
                                <p class="note__text">0 ₽</p>
                            </div>

                            <div class="note__res">
                                <p class="note__text note__text-res"><b>Итого</b></p>
                                <p class="note__text note__text-res"><b>
                                    <?php echo ($_SESSION['order.sum'] + (int)$orderPrice) . ' ₽' ?></b>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
            </ul>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>

    <script src="js/jquery.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
