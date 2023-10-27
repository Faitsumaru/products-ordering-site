<?php

    require 'funcs.php';

    global $conn;

    $id = $_GET["id"];

    $sql = "DELETE FROM Client WHERE ID_Client = '$id'";
    $params = array($id);

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    echo "Client Deleted";
    sqlsrv_free_stmt($stmt);
?>