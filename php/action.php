<?php
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
    require('db.php');

    $stmt = sqlsrv_query($conn, $sql);

    if (!$stmt)
        echo 'Error';

    $arr = array();

    while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // echo $obj[$table_arr['date']]->format('d/m/Y') . '</br>' . $obj[$table_arr['name']] . '</br></br>';

        $arr[] = $obj;
    }
    $res = json_encode($arr);

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    
    echo $res;
}

$tsql = "select * from Client";
$tsql2 = "SELECT *, [Consignment_Note Goods].Count 
FROM Goods
INNER JOIN [Consignment_Note Goods] 
ON [Consignment_Note Goods].[ID_Goods (FK)] = Goods.ID_Goods";


fetchData($tsql2);

// phpinfo();

?>