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
        <div class="sign_up">

            <h2 class="sign_up-title">Регистрация</h2>

            <div class="cross-line"></div>

            <form action="" class="form">

                <div class="form__box">
                    <p class="form__text">Логин <b>*</b></p>
                    <input type="text" class="form__input" placeholder="Введите логин">

                    <p class="form__text">Пароль <b>*</b></p>
                    <input type="password" class="form__input form__input-pssw" placeholder="Введите пароль">

                    <button type="button" class="form__input-eye" onclick="passwordVisible()">
                        <img src="images/password_eye.svg" alt="pssw eye">
                    </button>
                </div>

                <input type="button" class="form__btn btn" value="Зарегистрироваться">

            </form>

        </div>
    </div>

    <script src="js/functions.js"></script>
    <script src="js/script.js"></script>
</body>
</html>