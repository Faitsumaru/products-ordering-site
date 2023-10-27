<?php

require 'funcs.php';

global $conn;

$id = $_GET['ID_Goods'];

if (!empty($_GET['ObjectName']) && !empty($_GET['Producer']) && !empty($_GET['Guarantee']) && !empty($_GET['Weight']) && !empty($_GET['Price'])) {

    echo "<pre>";
    print_r($_POST);
    print_r($_GET);
    echo "</pre>";

    $ObjectName = validate($_GET['ObjectName']);
    $Producer = validate($_GET['Producer']);
    $Guarantee = validate($_GET['Guarantee']);
    $Weight = validate($_GET['Weight']);
    $Price = validate($_GET['Price']);

    $updSQL = "UPDATE Goods SET ObjectName='$ObjectName', Producer='$Producer', Guarantee='$Guarantee', Weight='$Weight', Price='$Price' WHERE ID_Goods='$id'";

    $params = array($ObjectName, $Producer, $Guarantee, $Weight, $Price, $id);
    $stmt = sqlsrv_query( $conn, $updSQL, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    echo "Data Changed";
    sqlsrv_free_stmt($stmt);

    header("Location: ../control-goods.php");
    exit();
}
header("Location: ../control-goods.php?error=При изменении данных товара №".$id." обнаружены пустые данные!");
exit();
?>