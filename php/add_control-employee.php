<?php

    require 'funcs.php';

    global $conn;

    $FName = validate($_GET['FName']);
    $Tel = validate($_GET['Tel']);
    $Job = validate($_GET['Job']);
    $Password = validate($_GET['Password']);

    if (empty($FName)) {
        header("Location: ../control-employee.php?error=Необходимо ввести ФИО работника при добавлении!");
        exit();
    } else if (empty($Tel)) {
        header("Location: ../control-employee.php?error=Необходимо ввести телефон работника при добавлении!");
        exit();
    } else if (empty($Job)) {
        header("Location: ../control-employee.php?error=Необходимо ввести должность работника при добавлении!");
        exit();
    } else if (empty($Password)) {
        header("Location: ../control-employee.php?error=Необходимо ввести пароль работника при добавлении!");
        exit();
    } else {
        //inserting
        $sql = "INSERT INTO Employee(FName, Tel, Job, Password) 
        VALUES('$FName', '$Tel', '$Job', '$Password')";

        $stmt = sqlsrv_query($conn, $sql, array($FName, $Tel, $Job, $Password));
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        echo "Data Inserted";
        sqlsrv_free_stmt($stmt);

        header("Location: ../control-employee.php");
        exit();
    }
?>