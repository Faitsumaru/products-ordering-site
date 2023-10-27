<?php

    require 'funcs.php';

    global $conn;

    $id = $_GET["id"];
    $sql = "DELETE FROM Consignment_Note WHERE ID_Note = ?";
    $params = array($id);

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    echo "Data Deleted";
    sqlsrv_free_stmt($stmt);
?>