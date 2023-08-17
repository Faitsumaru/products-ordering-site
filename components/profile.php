<?php
    require_once dirname(__DIR__, 1) . '/php/funcs.php';

    $id = $_SESSION['id'];
    $query = "SELECT * FROM Client WHERE ID_Client='$id'";

    global $conn;
    $params = array($id);
    $stmt = sqlsrv_query($conn, $query, $params);

    $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if (!empty($_POST['submit'])) {
        if (!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['date']) && !empty($_POST['address']) && !empty($_POST['password'])) {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
        $sex = $_POST['sex'];
		$date = $_POST['date'];
		$address = $_POST['address'];
		$password = $_POST['password'];
		
		$updSQL = "UPDATE Client SET FName='$name', Tel='$phone', Sex='$sex', BirthDate='$date', Address='$address', Password='$password' WHERE ID_Client=$id";

		$stmt = sqlsrv_query($conn, $updSQL, $params);

        $_SESSION['name'] = $name;

        header("Location: user_profile.php");
        exit();

        } else {
            header("Location: user_profile.php?error=Есть незаполненные поля!");
            exit();
        }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Unicase:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Yandex - Личный кабинет</title>
</head>
<body>
    
    <div class="container">
        <div class="sign sign_in">

            <h2 class="sign-title sign-title-profile">Личный кабинет</h2>

            <div class="cross-line"></div>

            <form action="" method="POST" class="form">

                <div class="form__box">
                    <?php if(isset($_GET['error'])) { ?>
                        <p class="form__error form__text"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <p class="form__text">ФИО</p>
                    <input type="text" class="form__input f_i" name="name" value="<?= $user['FName'] ?>">

                    <p class="form__text">Телефон</p>
                    <input type="tel" class="form__input f_i" name="phone" id="phone_number" value="<?= $user['Tel'] ?>">

                    <p class="form__text">Пол</p>
                    <select name="sex" class="form__input">
                        <option value="M" <?= $user['Sex'] == 'M' ? ' selected="selected"' : ''; ?>>Мужской</option>
                        <option value="F" <?= $user['Sex'] == 'F' ? ' selected="selected"' : ''; ?>>Женский</option>
                    </select>

                    <p class="form__text">Дата рождения</p>
                    <?php if(isset($_GET['date'])) { ?>
                        <input type="tel" class="form__input" name="date" id="birth_date" value="<?= $user['BirthDate']->format('d/m/Y') ?>">
                    <?php } else { ?>
                        <input type="tel" class="form__input" name="date" id="birth_date" placeholder="Введите дату рождения"
                        value="<?php echo (!IS_NULL($user['BirthDate'])) ? $user['BirthDate']->format('d/m/Y') : '' ?>">
                    <?php } ?>

                    <p class="form__text">Адрес доставки</p>
                    <?php if(isset($_GET['address'])) { ?>
                        <input type="text" class="form__input" name="address" value="<?= $user['Address'] ?>">
                    <?php } else { ?>
                        <input type="text" class="form__input" name="address" placeholder="Введите адрес доставки" value="<?php echo empty($_POST['address']) ? $user['Address'] : '' ?>">
                    <?php } ?>

                    <p class="form__text">Пароль</p>
                    <?php if(isset($_GET['password'])) { ?>
                        <input type="password" class="form__input form__input-pssw" name="password" value="<?= $user['Password'] ?>">
                    <?php } else { ?>
                        <input type="password" class="form__input form__input-pssw" name="password" placeholder="Введите пароль" value="<?php echo empty($_POST['password']) ? $user['Password'] : '' ?>">
                    <?php } ?>

                    <button type="button" class="form__input-eye" onclick="passwordVisible()">
                        <img src="images/password_eye.svg" alt="pssw eye">
                    </button>
                </div>

                <input type="submit" name="submit" class="form__btn btn update-btn" value="Обновить данные">

            </form>

            <form method="POST" action="php/delete_user.php?id=<?php echo $_SESSION['id']; ?>" onsubmit="return DeleteConfirm()">
                <button type="submit" class="delete-btn">Удалить аккаунт</button>
            </form>

        </div>
    </div>

    <script>
        function DeleteConfirm() {
            let answer = confirm("Вы уверены, что хотите удалить пользователя?");
            if (answer)
                alert('Аккаунт успешно удален!');
            else 
                alert('Отмена удаления аккаунта!');

            return answer;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>

    <script src="js/functions.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
</body>
</html>