<?php

$serverName = "DESKTOP-Q0LGBR0\SQLEXPRESS";
$database = "db_cw";
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass,
    "CharacterSet" => "UTF-8",
];

$conn = sqlsrv_connect($serverName,$connection);

if (!$conn)
    die(print_r(sqlsrv_errors(), true));

?>