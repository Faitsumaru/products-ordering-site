<?php

require 'funcs.php';

global $conn;

$id = $_GET['ID_Auto'];

if (!empty($_GET['ReleaseYear']) && !empty($_GET['Brand']) && !empty($_GET['Model']) && !empty($_GET['RegNum'])) {

    echo "<pre>";
    print_r($_POST);
    print_r($_GET);
    echo "</pre>";

    $ReleaseYear = validate($_GET['ReleaseYear']);
    $Brand = validate($_GET['Brand']);
    $Model = validate($_GET['Model']);
    $RegNum = validate($_GET['RegNum']);

    $updSQL = "UPDATE Auto SET ReleaseYear='$ReleaseYear', Brand='$Brand', Model='$Model', RegNum='$RegNum' WHERE ID_Auto='$id'";

    $params = array($ReleaseYear, $Brand, $Model, $RegNum, $id);
    $stmt = sqlsrv_query( $conn, $updSQL, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    echo "Data Changed";
    sqlsrv_free_stmt($stmt);

    header("Location: ../control-auto.php");
    exit();
}
header("Location: ../control-auto.php?error=При изменении данных беспилотного автомобиля №".$id." обнаружены пустые данные!");
exit();
?>