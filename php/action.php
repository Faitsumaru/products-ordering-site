<?php
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

// phpinfo();
?>