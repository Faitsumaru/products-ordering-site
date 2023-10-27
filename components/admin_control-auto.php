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
                <h2 class="panel-title">Панель управления базой данных с беспилотными автомобилями</h2>
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
                  <th @click="sortBy('ID_Auto')" title="Номер авто">ID авто <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('ReleaseYear')">Год выпуска <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Brand')">Марка <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Model')">Модель <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('RegNum')">Рег. номер <i class="fa fa-fw fa-sort"></i></th>
                </tr>
                <tr v-for="(i, idx) in allData" :key="i.ID_Auto">
                  <td>{{ idx + 1 }}</td>
                  <td>
                    <button @click="changeRowBtn(i.ID_Auto)" id="myBtn" title="Изменить данные авто"> {{ i.ID_Auto }} </button>
                  </td>
                  <td>{{ i.ReleaseYear }}</td>
                  <td>{{ i.Brand }}</td>
                  <td>{{ i.Model }}</td>
                  <td>{{ i.RegNum }}</td>
                  <td>
                      <button @click="deleteRow(i.ID_Auto)" class="btn btn-delNote" title="Удалить авто">
                          <i class="fa fa-close" aria-hidden="true"></i>
                      </button>
                  </td>
                </tr>
              </table>

              <form method="get" action="php/add_control-auto.php" class="form__addNote">
                <p class="auto__text">Добавить авто:</p>

                <input name="ReleaseYear" class="auto__releaseyear" placeholder="Дата выпуска" type="text" onfocus="(this.type='date')" onblur="(this.value == '' ? this.type='text' : this.type='date')">

                <input type="text" name="Brand" class="auto__brand" placeholder="Марка">

                <input type="text" name="Model" class="auto__model" placeholder="Модель">

                <input type="text" name="RegNum" class="auto__regnum" placeholder="Рег. номер">

                <button @click="addRow" type="submit" class="btn btn-addNote auto__add-btn" title="Добавить авто">
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

          <h2 class="sign-title">Данные авто</h2>

            <form method="get" action="php/change_control-auto.php" class="form form__change auto__change">
                <input type="" :value="IdFind" hidden name="ID_Auto">

                <input name="ReleaseYear" class="auto__releaseyear form__input" placeholder="Дата выпуска" type="text" onfocus="(this.type='date')" onblur="(this.value == '' ? this.type='text' : this.type='date')">

                <input type="text" name="Brand" class="auto__brand form__input" placeholder="Марка">

                <input type="text" name="Model" class="auto__model form__input" placeholder="Модель">

                <input type="text" name="RegNum" class="auto__regnum form__input" placeholder="Рег. номер">

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
<script src="js/script_control-auto.js"></script>