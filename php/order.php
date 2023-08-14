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

            echo (!$goods) ? json_encode(['code' => 'error', 'answer' => 'Error goods']) : json_encode(['code' => 'ok', 'answer' => $goods]);
            break;
        
    }
}

?>