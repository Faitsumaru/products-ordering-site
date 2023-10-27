<?php

    require 'funcs.php';

    global $conn;

    $id = $_GET["id"];

    $sql = "DELETE FROM Auto WHERE ID_Auto = '$id'";
    $params = array($id);

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    echo "Auto Deleted";
    sqlsrv_free_stmt($stmt);
?>