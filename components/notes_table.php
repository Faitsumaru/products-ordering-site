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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/reset.css">
  </head>

  <body>
    <div id="app"> 
      <div class="container">

        <!-- <div class="filter-box">
          <select name="searchSelect" id="" @change="filterSelect(filterSelType)" v-model="filterSelType" class="filter-sel">
            <option v-for="item in filterSelOptions" :value="item.value">{{ item.text }}</option>
          </select>
          
          <input v-model="searchInfo" @change="changeList()" type="text" class="search" placeholder="Поиск">

        </div> -->
          
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <h2 class="panel-title">Список заказов клиентов:</h2>
            </div>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              
              <table class="table table-bordered table-striped">
                <tr>
                  <th>ID</th>
                  <th @click="sortBy('ID_Note')" title="Номер накладной">Номер заказа <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('cltName')">Клиент <i class="fa fa-fw fa-sort"></i></th>
                  <th>Тел. клиента</th>
                  <th @click="sortBy('DeliveryAddress')">Адрес доставки <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('ordDate')">Дата доставки <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('empName')">Менеджер <i class="fa fa-fw fa-sort"></i></th>
                  <th>Тел. менеджера</th>
                  <th @click="sortBy('Brand')">Бренд авто <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Model')">Модель авто <i class="fa fa-fw fa-sort"></i></th>
                </tr>
                <tr v-for="(i, idx) in allData" :key="i.ID_Note">
                  <td>{{ idx + 1 }}</td>
                  <td>{{ i.ID_Note }}</td>
                  <td>{{ i.cltName }}</td>
                  <td>{{ i.cltTel }}</td>
                  <td>{{ i.ordAddress }}</td>
                  <td>{{ i.ordDate }}</td>
                  <td>{{ i.empName }}</td>
                  <td>{{ i.empTel }}</td>
                  <td>{{ i.Brand }}</td>
                  <td>{{ i.Model }}</td>
                  <td>
                        <button @click="deleteNote(i.ID_Note)" class="btn btn-delOrder">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                  </td>
                </tr>
              </table>

            </div>
          </div>

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
<script src="js/script_notes.js"></script>