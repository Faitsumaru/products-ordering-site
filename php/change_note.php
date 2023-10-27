<?php

require 'funcs.php';

global $conn;

$id = $_GET['ID_Note'];

if (!empty($_GET['cltName']) && !empty($_GET['ordAddress']) && !empty($_GET['ordDate']) && !empty($_GET['empName']) && !empty($_GET['autoModel'])) {

    echo "<pre>";
    print_r($_POST);
    print_r($_GET);
    echo "</pre>";

    $cltName = validate($_GET['cltName']);;
    $empName = validate($_GET['empName']);
    $autoModel = validate($_GET['autoModel']);

    $ordAddress = validate($_GET['ordAddress']);
    $ordDate = $_GET['ordDate'];

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

    $updSQL = "UPDATE Consignment_Note SET [ID_Client (FK)]='$cltID', [ID_Employee (FK)]='$empID', [ID_Auto (FK)]='$autoID', Date='$ordDate', DeliveryAddress='$ordAddress' WHERE ID_Note='$id'";

    $params = array($cltID, $empID, $autoID, $ordDate, $ordAddress, $id);
    $stmt = sqlsrv_query( $conn, $updSQL, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    echo "Data Changed";
    sqlsrv_free_stmt($stmt);

    header("Location: ../orders_list.php");
    exit();
}
header("Location: ../orders_list.php?error=При изменении заказа №".$id." обнаружены пустые данные!");
exit();
?>