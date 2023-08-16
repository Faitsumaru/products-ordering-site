<?php

require_once('db.php');

function debug(array $data): void
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function get_allGoods(): array
{
    global $conn;
    $tsql = "SELECT * FROM Goods";
    $stmt = sqlsrv_query($conn, $tsql);

    if ($stmt === false) {
        return false;
    }

    $result = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $result[] = $row;
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $result;
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

function add_to_order($goods): void 
{
    if (isset($_SESSION['order'][$goods['ID_Goods']])) {
        $_SESSION['order'][$goods['ID_Goods']]['count'] += 1;
        $_SESSION['order'][$goods['ID_Goods']]['sum'] = $_SESSION['order'][$goods['ID_Goods']]['count'] * $goods['Price'];
    } else {
        $_SESSION['order'][$goods['ID_Goods']] = [
            'ObjectName' => $goods['ObjectName'],
            'Price' => $goods['Price'],
            'Weight' => $goods['Weight'],
            'count' => 1, 
            'sum' => $goods['Price'],
        ];
    }

    $_SESSION['order.count'] = !empty($_SESSION['order.count']) ? ++$_SESSION['order.count'] : 1;

    $_SESSION['order.sum'] = !empty($_SESSION['order.sum']) ? $_SESSION['order.sum'] + $goods['Price'] : $goods['Price'];
}

function del_from_order($goods): void 
{
    // $_SESSION['order.count'] = --$_SESSION['order.count'];
    $_SESSION['order.count'] -= $_SESSION['order'][$goods['ID_Goods']]['count'];
    $_SESSION['order.sum'] -= $goods['Price'] * $_SESSION['order'][$goods['ID_Goods']]['count'];

    unset($_SESSION['order'][$goods['ID_Goods']]);

    if (empty($_SESSION['order'])) {
        unset($_SESSION['order']);
        unset($_SESSION['order.count']);
        unset($_SESSION['order.sum']);
    }
}

?>