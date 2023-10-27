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

<?php //debug($_SESSION); //session_destroy(); ?>

<div id="app">

<div class="container">
    <div class="sign">

        <h2 class="sign-title">Оформление заказа</h2>

        <div class="cross-line"></div>

        <form action="components/order_note.php" method="POST" class="form">
            
            <div class="form__box">
                <?php if(isset($_GET['error'])) { ?>
                    <p class="form__error form__text"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                
                <p class="form__text">ФИО <b>*</b></p>
                <?php if(isset($_SESSION['name'])) { ?>
                    <input type="text" class="form__input" disabled placeholder="Введите ФИО" value="<?php echo $_SESSION['name'] ?>" name="name">
                <?php } else if(isset($_GET['name'])) { ?>
                    <input type="text" class="form__input" placeholder="Введите ФИО" value="<?php echo $_GET['name'] ?>" name="name">
                <?php } else { ?>
                    <input type="text" class="form__input" placeholder="Введите ФИО" value="" name="name">
                <?php } ?>

                <p class="form__text">Телефон <b>*</b></p>
                <?php if(isset($_SESSION['tel'])) { ?>
                    <input type="tel" class="form__input" disabled placeholder="Введите номер телефона" value="<?php echo $_SESSION['tel'] ?>" name="phone" id="phone_number">
                <?php } else if(isset($_GET['phone'])) { ?>
                    <input type="tel" class="form__input" placeholder="Введите номер телефона" value="<?php echo $_GET['phone'] ?>" name="phone" id="phone_number">
                <?php } else { ?>
                    <input type="tel" class="form__input" placeholder="Введите номер телефона" value="" name="phone" id="phone_number">
                <?php } ?>

                <p class="form__text">Тип доставки <b>*</b></p>
                <select name="orderType" id="orderType-select" class="form__select">
                    <?php if (isset($_GET['orderType'])) { ?>
                        <option value="" <?php echo empty($_GET['orderType']) ? 'selected' : '' ?> disabled>--Выберите тип доставки--</option>
                        <option value="orderingPoint" <?php echo (isset($_GET['orderType']) === 'orderingPoint') ? 'selected' : '' ?>>Доставка в пункт выдачи</option>
                        <option value="orderingMail" <?php echo (isset($_GET['orderType']) === 'orderingMail') ? 'selected' : '' ?>>Доставка в почтовое отделение</option>
                        <option value="orderingHome" <?php echo (isset($_GET['orderType']) === 'orderingHome') ? 'selected' : '' ?>>Доставка до дома</option>
                    <?php } else { ?>
                        <option value="" disabled selected>--Выберите тип доставки--</option>
                        <option value="orderingPoint">Доставка в пункт выдачи</option>
                        <option value="orderingMail">Доставка в почтовое отделение</option>
                        <option value="orderingHome">Доставка до дома</option>
                    <?php } ?>
                </select>

                <p class="form__text">Адрес доставки <b>*</b></p>
                <input type="text" class="form__input" placeholder="Введите адрес доставки товара" value="<?php echo isset($_GET['address']) ? $_GET['address'] : '' ?>" name="address">

                <p class="form__text">Дата доставки <b>*</b></p>
                <input type="date" name="deliveryDate" class="form__input form__input-clndr">

                <div class="form__order">
                    <p class="form__text">Список товаров:</p>
                    <button class="form__order-clear" type="button" @click="clearOrder()" title="Удалить все товары"></button>
                </div>

                <ul class="form__list">
                    <?php if (!empty($_SESSION['order'])): ?>
                        <table class="form__item-table-head">
                            <thead>
                                <tr>
                                    <th>Продукт</th>
                                    <th>Цена</th>
                                    <th>Кол-во</th>
                                    <th>Вес</th>
                                </tr>
                            </thead>
                        </table>
                    <?php foreach ($_SESSION['order'] as $id => $item): ?>
                        <li class="form__item">
                            <table class="form__item-table-body">
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
                                echo '<button class="form__item-btn form__item-del" type="button" title="Удалить товар" @click="deleteFromOrder(' . $goods[$id-1]['ID_Goods'] . ')" ></button>'
                            ?>
                        </li>
                        <?php endforeach; ?>

                        <div class="form__item-result">
                            <p class="form__text form__result">Итого:</p>
                            <div>
                                <div>
                                    <p class="form__text">Количество товаров:</p>
                                    <p class="form__text">Общая стоимость:</p>
                                </div>

                                <div>
                                    <p class="form__text">
                                        <?php echo (' ' .$_SESSION['order.count'] . ' шт.') ?>
                                    </p>
                                    <p class="form__text">
                                        <?php echo (' ' . $_SESSION['order.sum'] . ' ₽') ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="form__result">Список пуст, добавьте товары!</p>
                    <?php endif; ?>
                </ul>

                <p class="form__text">Сообщение:</p>
                <textarea name="message" id="" cols="30" rows="10" class="form__input" placeholder="Введите сообщение"></textarea>

            </div>

            <input type="submit" name="submit" class="form__btn btn" value="Сделать заказ">

        </form>

    </div>
</div>

</div>

<script src="https://unpkg.com/axios@1.0.0/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
<script src="js/functions.js"></script>
<script src="js/jquery.js"></script>
<script src="js/script.js"></script>