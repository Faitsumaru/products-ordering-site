<?php

require('funcs.php');

if (isset($_POST['phone']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $tel = $_POST['phone'];
    $pass = $_POST['password'];

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
            echo ("Logged in!");
        } else {
            header("Location: ../login.php?error=Неверный логин или пароль!");
            exit();
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        }

    } else {
        header("Location: ../login.php");
        exit();
    }

?>