<?php 

// require_once dirname(__DIR__, 1) . '/php/funcs.php';

// $sql = "SELECT Employee.FName AS name, Employee.Job AS job, Employee.Tel as tel, Auto.Brand as brand, Auto.Model as model, Auto.RegNum as reg_num, Auto.ReleaseYear as release_year
//   FROM Consignment_Note
// 			INNER JOIN Employee ON Employee.ID_Employee = Consignment_Note.[ID_Employee (FK)]
// 			INNER JOIN Auto ON Auto.ID_Auto = Consignment_Note.[ID_Auto (FK)]
//   WHERE Employee.Job = 'Автомеханик'
// ";

// getData($sql);

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

        <div class="filter-box">
          <select name="searchSelect" id="" @change="filterSelect(filterSelType)" v-model="filterSelType" class="filter-sel">
            <option v-for="item in filterSelOptions" :value="item.value">{{ item.text }}</option>
          </select>
          
          <input v-model="searchInfo" @change="changeList()" type="text" class="search" placeholder="Поиск">

          <button class="btn__all-items" @click="fullArr()">
            <i class="all-items-icon fa-solid fa-list"></i>
          </button>
        </div>
          
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <h2 class="panel-title">Список беспилотных автомобилей и сотрудников:</h2>
            </div>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              
              <table class="table table-bordered table-striped">
                <tr>
                  <th>ID</th>
                  <th @click="sortBy('name')">Работник <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('job')">Должность <i class="fa fa-fw fa-sort"></i></th>
                  <th>Телефон</th>
                  <th @click="sortBy('brand')">Авто <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('model')">Модель <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('reg_num')">Рег. номер <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('release_year')">Год выпуска <i class="fa fa-fw fa-sort"></i></th>
                </tr>
                <tr v-for="(i, idx) in filteredList" :key="idx">
                  <td>{{ idx + 1 }}</td>
                  <td>{{ i.name }}</td>
                  <td>{{ i.job }}</td>
                  <td>{{ i.tel }}</td>
                  <td>{{ i.brand }}</td>
                  <td>{{ i.model }}</td>
                  <td>{{ i.reg_num }}</td>
                  <td>{{ i.release_year }}</td>
                </tr>
              </table>

              <div class="table-pagination">
                <button @click="leftClick()" :disabled="pageNumber === 1" class="arrow arrow-left">
                  <i class="fa-solid fa-arrow-left"></i>
                </button>

                <div class="page" 
                    v-for="page in pages" 
                    @click="pageClick(page)" 
                    :key="page"
                    :class="{'page-active': page === pageNumber}">
                          {{ page }}
                </div>

                <button @click="rightClick()" :disabled="pageNumber > Math.ceil(this.allData.length / 10)" class="arrow arrow-right">
                  <i class="fa-solid fa-arrow-right"></i>
                </button>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </body>
</html>

<script src="https://unpkg.com/axios@1.0.0/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/script_auto.js"></script>
