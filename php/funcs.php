<?php

require_once('db.php');

function debug(array $data): void
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function get_allGoods(): array
{
    global $conn;
    $res = sqlsrv_query( $conn, "SELECT * FROM Goods");
    return sqlsrv_fetch_array($res);
}

function get_goods(int $id): array|false
{
    global $conn;

    $tsql = "SELECT * FROM Goods WHERE ID_Goods = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $tsql, $params);

    if ($stmt === false) {
        return false;
    }

    $result = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $result = $row;
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $result;
}

?>