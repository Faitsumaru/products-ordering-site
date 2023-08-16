<?php

require_once dirname(__DIR__, 1) . '/php/funcs.php';

$goods = get_allGoods();
// echo json_encode($goods);
?>

<!-- <div style="display: none;" >
  <?php 
  //  require_once "php/action.php";
  ?>
</div> -->

<?php debug($_SESSION); //session_destroy(); ?>

<div id="app">

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

                <div class="form__order">
                    <p class="form__text">Список товаров:</p>
                    <button class="form__order-clear" type="button" @click="clearOrder()" ></button>
                </div>

                <ul class="form__list">
                <?php if (!empty($_SESSION['order'])): ?>
                    <?php foreach ($_SESSION['order'] as $id => $item): ?>
                        <li class="form__item">
                            <table class="form__item-table">
                                <thead>
                                    <tr>
                                        <th>Продукт</th>
                                        <th>Цена</th>
                                        <th>Кол-во</th>
                                        <th>Вес</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $item['ObjectName'] ?></td>
                                        <td><?php echo $item['Price'] . ' ₽' ?></td>
                                        <td><?php echo $item['count'] . ' шт.' ?></td>
                                        <td><?php echo $item['Weight'] . ' г.' ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php 
                                echo '<button class="form__item-btn form__item-del" type="button" @click="deleteFromOrder(' . $goods[$id-1]['ID_Goods'] . ')" ></button>'
                            ?>
                        </li>
                        <?php endforeach; ?>

                        <div class="form__item-result">
                            <p class="form__text form__result">Итого:</p>
                            <div>
                                <p class="form__text">Количество товаров:<?php echo (' ' .$_SESSION['order.count'] . ' шт.') ?></p>
                                <p class="form__text">Общая стоимость:<?php echo (' ' . $_SESSION['order.sum'] . ' ₽') ?></p>
                            </div>
                        </div>
                <?php else: ?>
                    <p class="form__result">Список пуст, добавьте товары!</p>
                <?php endif; ?>
                </ul>

                <p class="form__text">Сообщение:</p>
                <textarea name="" id="" cols="30" rows="10" class="form__input" placeholder="Введите сообщение"></textarea>

            </div>

            <input type="button" class="form__btn btn" value="Сделать заказ">

        </form>

    </div>
</div>

</div>

<script src="https://unpkg.com/axios@1.0.0/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/functions.js"></script>
<script src="js/script.js"></script>