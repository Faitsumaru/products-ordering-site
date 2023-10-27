<?php

    require 'funcs.php';

    global $conn;

    $cltName = validate($_GET['cltName']);;
    $empName = validate($_GET['empName']);
    $autoModel = validate($_GET['autoModel']);

    $ordAddress = validate($_GET['ordAddress']);
    $ordDate = $_GET['ordDate'];

    if (empty($cltName)) {
        header("Location: ../orders_list.php?error=Необходимо ввести ФИО клиента при добавлении заказа!");
        exit();
    } else if (empty($ordAddress)) {
        header("Location: ../orders_list.php?error=Необходимо ввести адрес доставки при добавлении заказа!");
        exit();
    } else if (empty($ordDate)) {
        header("Location: ../orders_list.php?error=Необходимо ввести дату доставки при добавлении заказа!");
        exit();
    } else if (empty($empName)) {
        header("Location: ../orders_list.php?error=Необходимо ввести ФИО менеджера при добавлении заказа!");
        exit();
    } else if (empty($autoModel)) {
        header("Location: ../orders_list.php?error=Необходимо ввести модель авто при добавлении заказа!");
        exit();
    } else {
        //ID
        $sql_clt_id = "SELECT Client.ID_Client
        FROM Client
        WHERE Client.FName = '$cltName'"; 

        $sql_emp_id = "SELECT Employee.ID_Employee
        FROM Employee
        WHERE Employee.FName = '$empName'"; 

        $sql_auto_id = "SELECT Auto.ID_Auto
        FROM Auto
        WHERE Auto.Model = '$autoModel'"; 

        $params1 = array($cltName);
        $params2 = array($empName);
        $params3 = array($autoModel);

        $stmt1 = sqlsrv_query($conn, $sql_clt_id, $params1);
        $stmt2 = sqlsrv_query($conn, $sql_emp_id, $params2);
        $stmt3 = sqlsrv_query($conn, $sql_auto_id, $params3);

        $cltID = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)['ID_Client'];
        $empID = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)['ID_Employee'];
        $autoID = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)['ID_Auto'];
        
        $_SESSION['cltID'] = $cltID;
        $_SESSION['empID'] = $empID;
        $_SESSION['autoID'] = $autoID;

        //inserting
        $sql = "INSERT INTO Consignment_Note([ID_Client (FK)], [ID_Employee (FK)], [ID_Auto (FK)], Date, DeliveryAddress) 
        VALUES('$cltID', '$empID', '$autoID', '$ordDate', '$ordAddress')";

        $stmt = sqlsrv_query($conn, $sql, array($cltID, $empID, $autoID, $ordAddress, $ordDate));
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        echo "Data Inserted";
        sqlsrv_free_stmt($stmt);

        header("Location: ../orders_list.php");
        exit();
    }
?>