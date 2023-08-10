<?php

$tsql = "select * from Client";
$tsql2 = "select * from Goods";

// $client_cols = array(
//     "id" => "ID_Client", 
//     "name" => "FName", 
//     "tel" => "Tel", 
//     "sex" => "Sex", 
//     "date" => "BirthDate", 
//     "address" => "Address"
// );

// $goods_cols = array(
//     "id" => "ID_Goods", 
//     "name" => "ObjectName", 
//     "producer" => "Producer", 
//     "guarantee" => "Guarantee", 
//     "weight" => "Weight", 
//     "price" => "Price"
// );

// function textEncoding($text) {
//     return iconv('windows-1251', 'UTF-8', $text);
// }

function fetchData($sql) {
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

    $conn = sqlsrv_connect($serverName, $connection);

    if (!$conn)
        die(print_r(sqlsrv_errors(), true));

    $stmt = sqlsrv_query($conn, $sql);

    if (!$stmt)
        echo 'Error';

    $arr = array();

    while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // echo $obj[$table_arr['date']]->format('d/m/Y') . '</br>' . $obj[$table_arr['name']] . '</br></br>';

        $arr[] = $obj;
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    
    echo json_encode($arr);

    // echo '</br><hr>';
}

fetchData($tsql);

// phpinfo();

?>