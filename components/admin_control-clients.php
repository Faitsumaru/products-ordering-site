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
                <h2 class="panel-title">Панель управления базой данных с клиентами</h2>
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
                  <th @click="sortBy('ID_Client')" title="Номер клиента">ID к-та <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('FName')">ФИО <i class="fa fa-fw fa-sort"></i></th>
                  <th>Телефон</th>
                  <th @click="sortBy('Sex')">Пол <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('BirthDate')">Дата рождения <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Address')">Адрес <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Password')">Пароль <i class="fa fa-fw fa-sort"></i></th>
                </tr>
                <tr v-for="(i, idx) in allData" :key="i.ID_Client">
                  <td>{{ idx + 1 }}</td>
                  <td>
                    <button @click="changeRowBtn(i.ID_Client)" id="myBtn" title="Изменить данные клиента"> {{ i.ID_Client }} </button>
                  </td>
                  <td>{{ i.FName }}</td>
                  <td>{{ i.Tel }}</td>
                  <td>{{ i.Sex }}</td>
                  <td>{{ i.BirthDate }}</td>
                  <td>{{ i.Address }}</td>
                  <td>{{ i.Password }}</td>
                  <td>
                      <button @click="deleteRow(i.ID_Client)" class="btn btn-delNote" title="Удалить клиента">
                          <i class="fa fa-close" aria-hidden="true"></i>
                      </button>
                  </td>
                </tr>
              </table>

              <form method="get" action="php/add_control-client.php" class="form__addNote">
                <p class="client__text">Добавить клиента:</p>

                <input type="text" name="FName" class="client__name" placeholder="ФИО">

                <input type="tel" class="client__tel" placeholder="Телефон" name="Tel" id="phone_number">

                <select name="Sex" class="client__sex">
                  <option value="" disabled selected>Пол</option>
                  <option v-for="type in clientTypes" :value="type">{{ type }}</option>
                </select>

                <input name="BirthDate" class="client__date" placeholder="Дата рождения" type="text" onfocus="(this.type='date')" onblur="(this.value == '' ? this.type='text' : this.type='date')">

                <input type="text" name="Address" class="client__address" placeholder="Адрес">
                
                <input type="text" class="client__password" placeholder="Пароль" name="Password">

                <button @click="addRow" type="submit" class="btn btn-addNote" title="Добавить клиента">
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

          <h2 class="sign-title">Данные клиента</h2>

            <form method="get" action="php/change_control-client.php" class="form form__change client__change">
                <input type="" :value="IdFind" hidden name="ID_Client">

                <input type="text" name="FName" class="client__name form__input" placeholder="ФИО">

                <input type="tel" class="client__tel form__input" placeholder="Телефон" name="Tel" id="phone_number2">

                <select name="Sex" class="client__sex form__input">
                    <option value="" disabled selected>Пол</option>
                    <option v-for="type in clientTypes" :value="type">{{ type }}</option>
                </select>

                <input name="BirthDate" class="client__date form__input" placeholder="Дата рождения" type="text" onfocus="(this.type='date')" onblur="(this.value == '' ? this.type='text' : this.type='date')">

                <input type="text" name="Address" class="client__address form__input" placeholder="Адрес">
                
                <input type="text" class="form__input client__password" placeholder="Пароль" name="Password">

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
<script src="js/script_control-clients.js"></script>