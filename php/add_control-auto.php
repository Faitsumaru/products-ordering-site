<?php

    require 'funcs.php';

    global $conn;

    $ReleaseYear = validate($_GET['ReleaseYear']);
    $Brand = validate($_GET['Brand']);
    $Model = validate($_GET['Model']);
    $RegNum = validate($_GET['RegNum']);

    $currentDate = new DateTime(date('m/d/Y'));

    if (empty($ReleaseYear)) {
        header("Location: ../control-auto.php?error=Необходимо указать дату выпуска авто при добавлении!");
        exit();
    } else if (new DateTime($ReleaseYear) > $currentDate) {
        header("Location: ../control-auto.php?error=Необходимо указать дату выпуска авто в прошедшем времени!");
        exit();
    } else if (empty($Brand)) {
        header("Location: ../control-auto.php?error=Необходимо ввести марку авто при добавлении!");
        exit();
    } else if (empty($Model)) {
        header("Location: ../control-auto.php?error=Необходимо ввести модель авто при добавлении!");
        exit();
    } else if (empty($RegNum)) {
        header("Location: ../control-auto.php?error=Необходимо ввести цифры регистрационного номера авто при добавлении!");
        exit();
    } else {
        //inserting
        $sql = "INSERT INTO Auto(ReleaseYear, Brand, Model, RegNum) 
        VALUES('$ReleaseYear', '$Brand', '$Model', '$RegNum')";

        $stmt = sqlsrv_query($conn, $sql, array($ReleaseYear, $Brand, $Model, $RegNum));
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        echo "Data Inserted";
        sqlsrv_free_stmt($stmt);

        header("Location: ../control-auto.php");
        exit();
    }
?>