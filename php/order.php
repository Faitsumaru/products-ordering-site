<?php

error_reporting();
session_start();

// require_once __DIR__ . '/php/action.php';
// require_once __DIR__ . '/js/script.js';
require_once 'funcs.php';
// require_once 'action.php';

if (isset($_GET['order'])) {
    switch ($_GET['order']) {
        case 'add':
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $goods = get_goods($id);

            if (!$goods) {
                echo json_encode(['code' => 'error', 'answer' => 'Error in goods adding']);
            } else {
                add_to_order($goods); 
                // json_encode(['code' => 'ok', 'answer' => $goods]);
                ob_start();
                $order = ob_get_clean();
                json_encode(['code' => 'ok', 'answer' => $order]);
            }
            break;
        case 'clear':
            if (!empty($_SESSION['order'])) {
                unset($_SESSION['order']);
                unset($_SESSION['order.sum']);
                unset($_SESSION['order.count']);
            }
            break;
        case 'delete':
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $goods = get_goods($id);

            if (!$goods) {
                echo json_encode(['code' => 'error', 'answer' => 'All goods have been already deleted!']);
            } else {
                del_from_order($goods); 
                ob_start();
                $order = ob_get_clean();
                json_encode(['code' => 'ok', 'answer' => $order]);
            }
            break;
    }
}

?>