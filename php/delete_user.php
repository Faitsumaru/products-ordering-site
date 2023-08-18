<?php
require 'funcs.php';

$id = $_GET['id'];

if (!isset($_SESSION['id_note'])) {
    $query2 = "DELETE FROM Consignment_Note WHERE [ID_Client (FK)] = '$id'";
    $result2 = sqlsrv_query($conn, $query2, array($id));
    if (!$result2)
        echo "Ошибка удаления накладной!";
}

$query = "DELETE FROM Client WHERE ID_Client = '$id'";

$result = sqlsrv_query($conn, $query, array($id));

if ($result && $result2) {
    sqlsrv_close($conn);
    header("Location: logout.php");
    exit();
} else {
    echo "Ошибка удаления пользователя!";
}
?>