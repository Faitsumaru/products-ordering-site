<?php

require_once dirname(__DIR__, 1) . '/php/funcs.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/reset.css">
  </head>

  <body>
    <div id="app"> 
      <div class="container">
          
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
                <h2 class="panel-title">Панель управления базой данных с товарами</h2>
            </div>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              
              <table class="table table-bordered table-striped">

                <?php if(isset($_GET['error'])) { ?>
                    <p class="form__error form__text"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                
                <tr>
                  <th>№</th>
                  <th @click="sortBy('ID_Goods')" title="Номер товара">ID т-ра <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('ObjectName')">Товар <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Producer')">Производитель <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Guarantee')">Гарантия <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Weight')">Вес <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Price')">Цена <i class="fa fa-fw fa-sort"></i></th>
                </tr>
                <tr v-for="(i, idx) in allData" :key="i.ID_Goods">
                  <td>{{ idx + 1 }}</td>
                  <td>
                    <button @click="changeRowBtn(i.ID_Goods)" id="myBtn" title="Изменить данные товара"> {{ i.ID_Goods }} </button>
                  </td>
                  <td>{{ i.ObjectName }}</td>
                  <td>{{ i.Producer }}</td>
                  <td>{{ i.Guarantee }}</td>
                  <td>{{ i.Weight }}</td>
                  <td>{{ i.Price }}</td>
                  <td>
                      <button @click="deleteRow(i.ID_Goods)" class="btn btn-delNote" title="Удалить товара">
                          <i class="fa fa-close" aria-hidden="true"></i>
                      </button>
                  </td>
                </tr>
              </table>

              <form method="get" action="php/add_control-goods.php" class="form__addNote">
                <p class="goods__text">Добавить товар:</p>

                <input type="text" name="ObjectName" class="goods__name" placeholder="Название">

                <select name="Producer" class="goods__producer">
                  <option value="" disabled selected>Производитель</option>
                  <option v-for="type in producerTypes" :value="type">{{ type }}</option>
                </select>

                <select name="Guarantee" class="goods__guarantee">
                  <option value="" disabled selected>Гарантия</option>
                  <option v-for="type in guaranteeTypes" :value="type">{{ type }}</option>
                </select>

                <input type="text" name="Weight" class="goods__weight" placeholder="Вес">

                <input type="text" name="Price" class="goods__price" placeholder="Цена">
                
                <button @click="addRow" type="submit" class="btn btn-addNote goods__add-btn" title="Добавить товара">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
              </form>

            </div>
          </div>
        </div>

      </div>

      <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>

          <h2 class="sign-title">Данные товара</h2>

            <form method="get" action="php/change_control-goods.php" class="form form__change goods__change">
                <input type="" :value="IdFind" hidden name="ID_Goods">

                <input type="text" name="ObjectName" class="goods__name form__input" placeholder="Название">

                <select name="Producer" class="goods__producer form__input">
                  <option value="" disabled selected>Производитель</option>
                  <option v-for="type in producerTypes" :value="type">{{ type }}</option>
                </select>

                <select name="Guarantee" class="goods__guarantee form__input">
                  <option value="" disabled selected>Гарантия</option>
                  <option v-for="type in guaranteeTypes" :value="type">{{ type }}</option>
                </select>

                <input type="text" name="Weight" class="goods__weight form__input" placeholder="Вес">

                <input type="text" name="Price" class="goods__price form__input" placeholder="Цена">

                <button @click="changeRow" type="submit" name="submit" class="form__btn btn update-btn" value="Обновить данные">Обновить данные</button>
            </form>

        </div>
      </div>
    </div>

  </body>
</html>

<script src="https://unpkg.com/axios@1.0.0/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
<script src="js/jquery.js"></script>
<script src="js/script_control-goods.js"></script>