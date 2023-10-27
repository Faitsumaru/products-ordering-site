<?php

require 'funcs.php';

global $conn;

$id = $_GET['ID_Client'];

if (!empty($_GET['FName']) && !empty($_GET['Tel']) && !empty($_GET['Sex']) && !empty($_GET['BirthDate']) && !empty($_GET['Address']) && !empty($_GET['Password'])) {

    echo "<pre>";
    print_r($_POST);
    print_r($_GET);
    echo "</pre>";

    $FName = validate($_GET['FName']);
    $Tel = validate($_GET['Tel']);
    $Sex = validate($_GET['Sex']);
    $BirthDate = validate($_GET['BirthDate']);
    $Address = validate($_GET['Address']);
    $Password = validate($_GET['Password']);

    $updSQL = "UPDATE Client SET FName='$FName', Tel='$Tel', Sex='$Sex', BirthDate='$BirthDate', Address='$Address', Password='$Password' WHERE ID_Client='$id'";

    $params = array($FName, $Tel, $Sex, $BirthDate, $Address, $Password, $id);
    $stmt = sqlsrv_query( $conn, $updSQL, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    echo "Data Changed";
    sqlsrv_free_stmt($stmt);

    header("Location: ../control-clients.php");
    exit();
}
header("Location: ../control-clients.php?error=При изменении данных клиента №".$id." обнаружены пустые данные!");
exit();
?>