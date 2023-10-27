<?php

    require 'funcs.php';

    global $conn;

    $ObjectName = validate($_GET['ObjectName']);
    $Producer = validate($_GET['Producer']);
    $Guarantee = validate($_GET['Guarantee']);
    $Weight = validate($_GET['Weight']);
    $Price = validate($_GET['Price']);

    if (empty($ObjectName)) {
        header("Location: ../control-goods.php?error=Необходимо ввести название товара при добавлении!");
        exit();
    } else if (empty($Producer)) {
        header("Location: ../control-goods.php?error=Необходимо выбрать производителя товара при добавлении!");
        exit();
    } else if (empty($Guarantee)) {
        header("Location: ../control-goods.php?error=Необходимо выбрать наличие или отсутствие гарантии у товара при добавлении!");
        exit();
    } else if (empty($Weight)) {
        header("Location: ../control-goods.php?error=Необходимо ввести вес товара при добавлении!");
        exit();
    } else if (empty($Price)) {
        header("Location: ../control-goods.php?error=Необходимо ввести цену товара при добавлении!");
        exit();
    } else {
        //inserting
        $sql = "INSERT INTO Goods(ObjectName, Producer, Guarantee, Weight, Price) 
        VALUES('$ObjectName', '$Producer', '$Guarantee', '$Weight', '$Price')";

        $stmt = sqlsrv_query($conn, $sql, array($ObjectName, $Producer, $Guarantee, $Weight, $Price));
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        echo "Data Inserted";
        sqlsrv_free_stmt($stmt);

        header("Location: ../control-goods.php");
        exit();
    }
?>