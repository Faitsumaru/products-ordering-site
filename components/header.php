<?php

error_reporting(-1);
session_start();

require_once dirname(__DIR__, 1) . '/php/funcs.php';

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
    <title>Yandex</title>
</head>
<body>
    
    <header class="header">
        <div class="container">
            <div class="header__inner">

                <a href="" class="header__logo">
                    <img src="images/logo.svg" alt="yandex logo" class="header__logo-img">  
                    
                    <img src="images/logo_text.svg" alt="Доставка" class="header__logo-text">
                </a>

                <nav class="header__nav">
                    <ul class="header__nav-items">
                        <li>
                            <a href="index.php" class="header__nav-link">Главная</a>
                        </li>
<?php if (!isset($_SESSION['employee_check'])) { ?>
                        <li>
                            <a href="products_list.php" class="header__nav-link">Список товаров</a>
                        </li>
                        <li>
                            <a href="make_order.php" class="header__nav-link">Сделать заказ 
                                <b class="header__nav-count">
                                    <?php echo $_SESSION['order.count'] ?? 0 ?>
                                </b>
                            </a>
                        </li>
<?php } else if (isset($_SESSION['employee_check']) && $_SESSION['job'] == 'Админ') { ?>
                            <li>
                                <a href="control_list.php" class="header__nav-link">Управление базой данных</a>
                            </li>
                            <li></li>
<?php } else if (isset($_SESSION['employee_check']) && $_SESSION['job'] == 'Менеджер') { ?>
                            <li>
                                <a href="orders_list.php" class="header__nav-link">Список заказов клиентов</a>
                            </li>
                            <li></li>
<?php } else if (isset($_SESSION['employee_check']) && $_SESSION['job'] == 'Автомеханик') { ?>
                            <li>
                                <a href="auto_list.php" class="header__nav-link">Список автомобилей</a>
                            </li>
                            <li></li>
<?php } ?>
                    </ul>
                </nav>

<?php if (isset($_SESSION['id']) && isset($_SESSION['name'])) { ?>
                <ul class="header__sign header__sign-login">
                    <li class="header__sign-item">
                        <h6 class="header__sign-text">
                            Добро пожаловать, <br/> 
                            <a href="user_profile.php" title="Личный кабинет" class="header__sign-link">
                                <?php echo $_SESSION['name']; ?>
                            </a>
                        </h6>
                    </li>
                    <li class="header__sign-item">
                        <a href="php/logout.php" class="header__sign-link logout-btn">Выход</a>
                    </li>
                </ul>
<?php } else { ?>
                <ul class="header__sign">
                    <li class="header__sign-item">
                        <a href="login.php" class="header__sign-link">Вход</a>
                    </li>
                    <li class="header__sign-item">
                        <a href="registration.php" class="header__sign-link">Регистрация</a>
                    </li>
                </ul>
<?php } ?>             
            </div>
        </div>
    </header>