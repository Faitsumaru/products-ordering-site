<?php
    error_reporting(-1);
    session_start();
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
    <title>Yandex - Главная</title>
</head>
<body>
    
    <div class="hero">
        <div class="container">
            <header class="header header-main">

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
                                <a href="make_order.php" class="header__nav-link">Сделать заказ</a>
                            </li>
<?php } else if (isset($_SESSION['employee_check']) && $_SESSION['job'] == 'Админ') { ?>
                            <li>
                                <a href="" class="header__nav-link">Управление базой данных</a>
                            </li>
                            <li></li>
<?php } else if (isset($_SESSION['employee_check']) && $_SESSION['job'] == 'Менеджер') { ?>
                            <li>
                                <a href="" class="header__nav-link">Список заказов клиентов</a>
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

                <?php  
                    if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
                ?>
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
                <?php 
                    }
                ?>        
                </div>
            </header>
            
            <div class="hero__inner">
                
                <div class="hero__textbox">
                    <h1 class="hero__title">Яндекс доставит ваши товары быстро и надежно</h1>
                    <p class="hero__text">Мы предоставляем услуги по доставке товаров на беспилотном автомобильном транспорте</p>
                    <a href="make_order.php" class="hero__btn btn">Сделать заказ</a>
                </div>
                
                <div class="hero__img">
                    <img src="images/hero_car.png" alt="car">
                </div>
                
            </div>
        </div>
    </div>

    <main class="main">
        <div class="container">

            <h2 class="main__title" id="features">Особенности и актуальность</h2>
            <p class="main__text">Наш сервис предоставляет физическим лицам спектр услуг по учету заказов на автомобильном беспилотном транспорте.
            Учет заказов – это очень распространенная на сегодняшний день деятельность, требующая большого количества данных и как нельзя лучше подходящая для примера проектирования информационной системы. А учет заказов с применением беспилотного транспорта – очень перспективная и актуальная концепция оказания услуг в будущем.</p>

            <ul class="main__features">
                <li class="main__features-item">
                    <img src="images/features/1.svg" alt="" class="main__features-img">
                    <span class="main__features-title">Быстрая доставка товара</span>
                    <p class="main__features-text">Быстро доставим товар в любую точку страны.</p>
                </li>
                <li class="main__features-item">
                    <img src="images/features/2.svg" alt="" class="main__features-img">
                    <span class="main__features-title">Простое оформление заказа</span>
                    <p class="main__features-text">Оформление заказа на нашем сайте происходит всего за несколько кликов!</p>
                </li>
                <li class="main__features-item">
                    <img src="images/features/3.svg" alt="" class="main__features-img">
                    <span class="main__features-title">Современные решения</span>
                    <p class="main__features-text">Мы предлагаем самые актуальные решения по доставке вашего товара в различные пункты выдачи, используя беспилотный транспорт.</p>
                </li>
            </ul>

            <ul class="main__elements">
                <li class="main__item">
                    <div class="main__textbox">
                        <h2 class="main__title">Беспилотный транспорт</h2>
                        <p class="main__text">Мы гарантируем быструю, надежную и безопасную доставку товаров с помощью наших беспилотных автомобилей. Обращайтесь к нам, и мы с удовольствием поможем вам осуществить доставку в любое удобное для вас время и место.</p>
                    </div>
                    <div class="main__img">
                        <img src="images/actualities/1.png" alt="car">
                    </div>
                </li>
                <li class="main__item">
                    <div class="main__textbox">
                        <h2 class="main__title">Заказ в любую точку страны</h2>
                        <p class="main__text">С помощью нашего сервиса клиенту будет дана возможность сделать заказ на любой интересующий его адрес и выбрать необходимый тип доставки товара:</p>
                        <ul class="main__textlist">
                            <li>В пункт выдачи</li>
                            <li>В почтовое отделение</li>
                            <li>Клиенту на дом</li>
                        </ul>
                    </div>
                    <div class="main__img">
                        <img src="images/actualities/2.png" alt="map">
                    </div>
                </li>
                <li class="main__item">
                    <div class="main__textbox">
                        <h2 class="main__textbox-title">Заказ на любую дату</h2>
                        <p class="main__textbox-text">С помощью нашего сервиса пользователю будет дана возможность оформить заказ на любое удобное клиенту время.</p>
                    </div>
                    <div class="main__img">
                        <img src="images/actualities/3.png" alt="calendar">
                    </div>
                </li>
            </ul>

        </div>
    </main>

    <div class="villain">
        <div class="container">

            <div class="villain__about">
                <h2 class="villain__title" id="about">О нас</h2>

                <p class="villain__text"><b>Yandex</b> — компания, которая предоставляет возможность осуществлять доставку товаров с помощью беспилотных автомобилей. Мы используем новейшие технологии и системы контроля, чтобы гарантировать безопасность и надежность наших услуг. Вы можете оформить заказ на нашем сайте и мы доставим ваш товар в любое удобное для вас место и время.</p>
                <p class="villain__text">Беспилотные автомобили оснащены специальными датчиками, которые позволяют им безопасно и точно доставлять товары по заданному маршруту. Кроме того, наша система контроля позволяет отслеживать местоположение автомобилей и мониторить их состояние в режиме реального времени.</p>
                <p class="villain__text">Для того чтобы воспользоваться услугами доставки с помощью беспилотных автомобилей, необходимо оформить заказ на нашем сайте. Ваш заказ будет автоматически передан в систему управления, которая назначит ближайший свободный автомобиль для доставки.</p>
                <p class="villain__text">Мы гарантируем быструю, надежную и безопасную доставку товаров с помощью наших беспилотных автомобилей. Обращайтесь к нам, и мы с удовольствием поможем вам осуществить доставку в любое удобное для вас время и место!</p>

                <ul class="villain__partners">
                    <li class="villain__partner">
                        <a href="">
                            <img src="images/partners/1.svg" alt="dpd">
                        </a>
                    </li>
                    <li class="villain__partner villain__partner-madi">
                        <a href="">
                            <img src="images/partners/2.svg" alt="madi">
                        </a>
                    </li>
                    <li class="villain__partner">
                        <a href="">
                            <img src="images/partners/3.svg" alt="pickpoint">
                        </a>
                    </li>
                </ul>
            </div>

            <footer class="footer footer-main">
                <div class="footer__inner">
                    <div class="footer__logo">
                        <a href="">
                            <img src="images/logo_footer.svg" alt="">

                            <img src="images/logo_text.svg" alt="Доставка" class="header__logo-text">
                        </a>
                    </div>

                    <nav class="footer__nav">
                        <ul class="footer__nav-items">
                            <li>
                                <a href="index.php" class="footer__nav-link">Главная</a>
                            </li>
                            <li>
                                <a href="#features" class="footer__nav-link">Особенности и актуальность</a>
                            </li>
                            <li>
                                <a href="#about" class="footer__nav-link">О нас</a>
                            </li>
                        </ul>
                    </nav>

                    <ul class="footer__social">
                        <li>
                            <a href="" class="footer__social-item">
                                <img src="images/social/vk.svg" alt="vk">
                            </a>
                        </li>
                        <li>
                            <a href="" class="footer__social-item">
                                <img src="images/social/whatsapp.svg" alt="whatsapp">
                            </a>
                        </li>
                        <li>
                            <a href="" class="footer__social-item">
                                <img src="images/social/telegram.svg" alt="telegram">
                            </a>
                        </li>
                    </ul>
                </div>

                <p class="footer__copy">
                    © Yandex Inc., 2023 г. Все права защищены.
                </p>
            </footer>
        </div>
    </div>

    <script src="js/functions.js"></script>
    <script src="js/script.js"></script>
</body>
</html>