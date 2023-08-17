<?php
require 'funcs.php';

$id = $_GET['id'];

$query = "DELETE FROM Client WHERE ID_Client = '$id';";

$result = sqlsrv_query($conn, $query, array($id));

if ($result) {
    sqlsrv_close($conn);
    header("Location: logout.php");
    exit();
} else {
    echo "Ошибка удаления пользователя!";
}
?>