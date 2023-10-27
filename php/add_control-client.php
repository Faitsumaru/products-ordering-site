<?php

    require 'funcs.php';

    global $conn;

    $FName = validate($_GET['FName']);
    $Tel = validate($_GET['Tel']);
    $Sex = validate($_GET['Sex']);
    $BirthDate = validate($_GET['BirthDate']);
    $Address = validate($_GET['Address']);
    $Password = validate($_GET['Password']);

    $currentDate = new DateTime(date('m/d/Y'));

    if (empty($FName)) {
        header("Location: ../control-clients.php?error=Необходимо ввести ФИО клиента при добавлении!");
        exit();
    } else if (empty($Tel)) {
        header("Location: ../control-clients.php?error=Необходимо ввести телефон клиента при добавлении!");
        exit();
    } else if (empty($Sex)) {
        header("Location: ../control-clients.php?error=Необходимо выбрать пол клиента при добавлении!");
        exit();
    } else if (empty($BirthDate)) {
        header("Location: ../control-clients.php?error=Необходимо ввести дату рождения клиента при добавлении!");
        exit();
    } else if (new DateTime($BirthDate) > $currentDate) {
        header("Location: ../control-clients.php?error=Необходимо указать дату рождения в прошедшем времени!");
        exit();
    } else if (empty($Address)) {
        header("Location: ../control-clients.php?error=Необходимо ввести адрес клиента при добавлении!");
        exit();
    } else if (empty($Password)) {
        header("Location: ../control-clients.php?error=Необходимо ввести пароль клиента при добавлении!");
        exit();
    } else {
        //inserting
        $sql = "INSERT INTO Client(FName, Tel, Sex, BirthDate, Address, Password) 
        VALUES('$FName', '$Tel', '$Sex', '$BirthDate', '$Address', '$Password')";

        $stmt = sqlsrv_query($conn, $sql, array($FName, $Tel, $Sex, $BirthDate, $Address, $Password));
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        echo "Data Inserted";
        sqlsrv_free_stmt($stmt);

        header("Location: ../control-clients.php");
        exit();
    }
?>