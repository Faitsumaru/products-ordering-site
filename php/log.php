<?php

session_start();
require('funcs.php');

if (isset($_POST['phone']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $tel = validate($_POST['phone']);
    $pass = validate($_POST['password']);

    // $pass = md5($pass);

    if (empty($tel) && !empty($pass)) {
        header("Location: ../login.php?error=Необходимо ввести номер телефона!");
        exit();
    } else if (empty($pass) && !empty($tel)) {
        header("Location: ../login.php?error=Необходимо ввести пароль!");
        exit();
    } else if (empty($tel) && empty($pass)) {
        header("Location: ../login.php?error=Необходимо ввести данные!");
        exit();
    } else if (!empty($pass) && !empty($tel)) {
        $sql = "SELECT * FROM Client WHERE Tel='$tel' AND Password='$pass'";
    
        $params = array($tel, $pass);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            return false;
        }

        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if ($row['Tel'] === $tel && $row['Password'] === $pass) {
                $_SESSION['id'] = $row['ID_Client'];
                $_SESSION['name'] = $row['FName'];
                $_SESSION['tel'] = $row['Tel'];
                header("Location: ../index.php");
                exit();
            } else {
                header("Location: ../login.php?error=Неверный логин или пароль!");
                exit();
            }
        } else {
            header("Location: ../login.php?error=Неверный логин или пароль!");
            exit();
        }
    } else {
        header("Location: ../login.php");
        exit();
    }
}

?>