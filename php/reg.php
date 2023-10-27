<?php

session_start();
require('funcs.php');

if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['re-password'])) {

    $name = validate($_POST['name']);
    $tel = validate($_POST['phone']);
    $pass = validate($_POST['password']);
    $repass = validate($_POST['re-password']);

    $user_data = 'name=' . $name . '&phone=' . $tel;

    if (empty($name)) {
        header("Location: ../registration.php?error=Необходимо ввести ФИО пользователя!&$user_data");
        exit();
    } else if (empty($tel)) {
        header("Location: ../registration.php?error=Необходимо ввести номер телефона!&$user_data");
        exit();
    } else if (empty($pass)) {
        header("Location: ../registration.php?error=Необходимо ввести пароль!&$user_data");
        exit();
    } else if (empty($repass)) {
        header("Location: ../registration.php?error=Необходимо ввести повторный пароль!&$user_data");
        exit();
    } else if ($pass !== $repass) {
        header("Location: ../registration.php?error=Введенные пароли не совпадают!&$user_data");
        exit();
    } else if (!isset($_POST['check'])) {
        header("Location: ../registration.php?error=Нет согласия на обработку персональных данных!&$user_data");
        exit();
    } else if (empty($tel) && empty($pass) && empty($name) && empty($repass)) {
        header("Location: ../registration.php?error=Необходимо ввести данные!&$user_data");
        exit(); 
    } else {

        // $pass = md5($pass);

        $sql0 = "SELECT * FROM Client WHERE FName='$name'";
        $stmt0 = sqlsrv_query($conn, $sql0, array($name));

        $sql1 = "SELECT * FROM Client WHERE Tel='$tel'";
        $stmt1 = sqlsrv_query($conn, $sql1, array($tel));

        if (sqlsrv_has_rows($stmt0)) {
                header("Location: ../registration.php?error=Пользователь с таким ФИО уже существует!&$user_data");
                exit();
        } else if (sqlsrv_has_rows($stmt1)) {
            header("Location: ../registration.php?error=Пользователь с таким номером телефона уже существует!&$user_data");
            exit();
        } else {
            $sql2 = "INSERT INTO Client(FName, Tel, Password) VALUES('$name', '$tel', '$pass')";

            $params2 = array($name, $tel, $pass);
            $stmt2 = sqlsrv_query($conn, $sql2, $params2);

            if ($stmt2) {
                header("Location: ../registration.php?success=Ваш аккаунт был успешно создан!");
                exit();
            } else {
                header("Location: ../registration.php?error=Произошла неизвестная ошибка!&$user_data");
                exit();
            }
        }

    } 
}

?>