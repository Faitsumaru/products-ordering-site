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
    <title>Yandex - Логин</title>
</head>
<body>
    
    <div class="container">
        <div class="sign sign_in">

            <h2 class="sign-title">Логин</h2>

            <div class="cross-line"></div>

            <form action="php/log.php" method="POST" class="form">

                <div class="form__box">
                    <?php if(isset($_GET['error'])) { ?>
                        <p class="form__error form__text"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <p class="form__text">Логин <b>*</b></p>
                    <input type="tel" class="form__input" placeholder="Введите телефон" name="phone" id="phone_number">

                    <p class="form__text">Пароль <b>*</b></p>
                    <input type="password" class="form__input form__input-pssw" placeholder="Введите пароль" name="password">

                    <p class="form__check">
                        <input type="checkbox" id="check" name="employee_check" value="1">
                        <label for="check">Вход для сотрудников</label>
                    </p>

                    <button type="button" class="form__input-eye" onclick="passwordVisible()">
                        <img src="images/password_eye.svg" alt="pssw eye">
                    </button>
                </div>

                <input type="submit" class="form__btn btn" value="Войти">

            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>

    <script src="js/jquery.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/script.js"></script>
</body>
</html>