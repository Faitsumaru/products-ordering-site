<?php
    require_once dirname(__DIR__, 1) . '/php/funcs.php';

    $id = $_SESSION['id'];
    global $conn;

    if (!isset($_SESSION['employee_check'])) {

        $query = "SELECT * FROM Client WHERE ID_Client='$id'";

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
            $_SESSION['tel'] = $phone;
            $_SESSION['address'] = $address;

            header("Location: user_profile.php");
            exit();

            } else {
                header("Location: user_profile.php?error=Есть незаполненные поля!");
                exit();
            }
        }

    } else {
        $query2 = "SELECT * FROM Employee WHERE ID_Employee='$id'";

        $params2 = array($id);
        $stmt2 = sqlsrv_query($conn, $query2, $params2);
        $user = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);

        if (!empty($_POST['submit'])) {
            if (!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['job']) && !empty($_POST['password'])) {

            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $job = $_POST['job'];
            $password = $_POST['password'];
            
            $updSQL = "UPDATE Employee SET FName='$name', Tel='$phone', Job='$job', Password='$password' WHERE ID_Employee=$id";

            $stmt = sqlsrv_query($conn, $updSQL, $params);

            $_SESSION['name'] = $name;
            $_SESSION['job'] = $job;

            header("Location: user_profile.php");
            exit();

            } else {
                header("Location: user_profile.php?error=Есть незаполненные поля!");
                exit();
            }
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
        <div class="sign sign_in profile">

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
                    
<?php if (!isset($_SESSION['employee_check'])) { ?>
                    <p class="form__text">Пол</p>
                    <select name="sex" class="form__input">
                        <option value="M" <?= $user['Sex'] == 'M' ? ' selected="selected"' : ''; ?>>Мужской</option>
                        <option value="F" <?= $user['Sex'] == 'F' ? ' selected="selected"' : ''; ?>>Женский</option>
                    </select>
<?php } ?>

<?php if (!isset($_SESSION['employee_check'])) { ?>
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
<?php } ?>

<?php if (isset($_SESSION['employee_check'])) { ?>
                    <p class="form__text">Должность</p>
                    <?php if(isset($_GET['job'])) { ?>
                        <input type="job" class="form__input" name="password" value="<?= $user['Job'] ?>">
                    <?php } else { ?>
                        <input type="text" class="form__input" name="job" placeholder="Введите должность" value="<?php echo empty($_POST['job']) ? $user['Job'] : '' ?>">
                    <?php } ?>
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

            <div class="profile__box">
                <?php if (isset($_SESSION['id_note'])) { ?>
                    <div>
                        <a href="consignment_note.php">Накладная по заказу</a>
                    </div>
                <?php } else { ?>
                    <div></div>
                <?php } ?>
    
                <form method="POST" action="php/delete_user.php?id=<?php echo $_SESSION['id']; ?>" onsubmit="return DeleteConfirm()" class="form__del-user">
                    <button type="submit" class="form__del-user-btn">Удалить аккаунт</button>
                </form>
            </div>

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