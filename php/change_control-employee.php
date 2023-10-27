<?php

require 'funcs.php';

global $conn;

$id = $_GET['ID_Employee'];

if (!empty($_GET['FName']) && !empty($_GET['Tel']) && !empty($_GET['Job']) && !empty($_GET['Password'])) {

    echo "<pre>";
    print_r($_POST);
    print_r($_GET);
    echo "</pre>";

    $FName = validate($_GET['FName']);
    $Tel = validate($_GET['Tel']);
    $Job = validate($_GET['Job']);
    $Password = validate($_GET['Password']);

    $updSQL = "UPDATE Employee SET FName='$FName', Tel='$Tel', Job='$Job', Password='$Password' WHERE ID_Employee='$id'";

    $params = array($FName, $Tel, $Job, $Password, $id);
    $stmt = sqlsrv_query( $conn, $updSQL, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    echo "Data Changed";
    sqlsrv_free_stmt($stmt);

    header("Location: ../control-employee.php");
    exit();
}
header("Location: ../control-employee.php?error=При изменении данных работника №".$id." обнаружены пустые данные!");
exit();
?>