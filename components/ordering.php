<div style="display: none;" >
  <?php 
    require_once "php/action.php";
  ?>
</div>

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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <title>Yandex - Оформление заказа</title>
</head>
<body>
    
    <div class="container">
        <div class="sign_up">

            <h2 class="sign_up-title">Оформление заказа</h2>

            <div class="cross-line"></div>

            <form action="" class="form">

                <div class="form__box">
                    <p class="form__text">ФИО <b>*</b></p>
                    <input type="text" class="form__input" placeholder="Введите ФИО">

                    <p class="form__text">Тип доставки <b>*</b></p>
                    <select name="orderType" id="orderType-select" class="form__select">
                        <option value="" disabled selected>--Выберите тип доставки--</option>
                        <option value="orderingPoint">Доставка в пункт выдачи</option>
                        <option value="orderingMail">Доставка в почтовое отделение</option>
                        <option value="orderingHome">Доставка до дома</option>
                    </select>

                    <p class="form__text">Адрес доставки <b>*</b></p>
                    <input type="text" class="form__input" placeholder="Введите адрес доставки товара">

                    <p class="form__text">Дата доставки <b>*</b></p>
                    <input type="date" class="form__input form__input-clndr">

                    <p class="form__text">Список товаров:</p>
                    <ul class="form__list">
                        <li class="form__item">
                            Товар №1
                            <button class="form__item-btn" type="button"></button>
                        </li>
                        <li class="form__item">
                            Товар №2
                            <button class="form__item-btn" type="button"></button>
                        </li>
                        <li class="form__item">
                            Товар №3
                            <button class="form__item-btn" type="button"></button>
                        </li>
                    </ul>

                    <p class="form__text">Сообщение:</p>
                    <textarea name="" id="" cols="30" rows="10" class="form__input" placeholder="Введите сообщение"></textarea>

                </div>

                <input type="button" class="form__btn btn" value="Сделать заказ">

            </form>

        </div>
    </div>

    <script src="js/functions.js"></script>
</body>
</html>