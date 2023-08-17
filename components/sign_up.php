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
    <title>Yandex - Регистрация</title>
</head>
<body>
    
    <div class="container">
        <div class="sign sign_up">

            <h2 class="sign-title">Регистрация</h2>

            <div class="cross-line"></div>

            <form action="php/reg.php" method="POST" class="form">

                <div class="form__box">
                    <?php if(isset($_GET['error'])) { ?>
                        <p class="form__error form__text"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <?php if(isset($_GET['success'])) { ?>
                        <p class="form__success form__text"><?php echo $_GET['success']; ?></p>
                    <?php } ?>

                    <p class="form__text">ФИО <b>*</b></p>
                    <?php if(isset($_GET['name'])) { ?>
                        <input type="text" class="form__input" name="name" placeholder="Введите ФИО" value="<?php echo $_GET['name']; ?>">
                    <?php } else { ?>
                        <input type="text" class="form__input" name="name" placeholder="Введите ФИО">
                    <?php } ?>
                    

                    <p class="form__text">Логин <b>*</b></p>
                    <?php if(isset($_GET['phone'])) { ?>
                        <input type="text" class="form__input" placeholder="Введите номер телефона" id="phone_number" name="phone" value="<?php echo $_GET['phone']; ?>">
                    <?php } else { ?>
                        <input type="text" class="form__input" placeholder="Введите номер телефона" id="phone_number" name="phone">
                    <?php } ?>

                    <p class="form__text">Пароль <b>*</b></p>
                    <?php if(isset($_GET['password'])) { ?>
                        <input type="password" class="form__input form__input-pssw" placeholder="Введите пароль" name="password" value="<?php echo $_GET['password']; ?>">
                    <?php } else { ?>
                        <input type="password" class="form__input form__input-pssw" placeholder="Введите пароль" name="password">
                    <?php } ?>
                    
                    <p class="form__text">Повторный пароль <b>*</b></p>
                    <?php if(isset($_GET['re-password'])) { ?>
                        <input type="password" class="form__input form__input-repssw" placeholder="Введите пароль повторно" name="re-password" value="<?php echo $_GET['re-password']; ?>">
                    <?php } else { ?>
                        <input type="password" class="form__input form__input-repssw" placeholder="Введите пароль повторно" name="re-password">
                    <?php } ?>


                    <button type="button" class="form__input-eye" onclick="passwordVisible()">
                        <img src="images/password_eye.svg" alt="pssw eye">
                    </button>

                    <button type="button" class="form__input-eye form__input-repassword_eye" onclick="repasswordVisible()">
                        <img src="images/password_eye.svg" alt="pssw eye">
                    </button>

                    <p class="form__check">
                        <input type="checkbox" id="check" name="check" value="1">
                        <label for="check">Cогласие на обработку персональных данных</label>
                    </p>
                </div>

                <input type="submit" class="form__btn btn" value="Зарегистрироваться">

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