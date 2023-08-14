<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Logistics Transportation Table</title>
    
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
          
          <input v-model="searchInfo" @change="changeList()" type="text" class="search" placeholder="Search">

          <button class="btn__all-items" @click="fullArr()">
            <i class="all-items-icon fa-solid fa-list"></i>
          </button>
        </div>
          
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <h2 class="panel-title">Таблица товаров для заказа:</h2>
            </div>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              
              <table class="table table-bordered table-striped">
                <tr>
                  <th @click="sortBy('ID_Goods')">ID <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('ObjectName')">Продукт <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Weight')">Вес <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Price')">Цена <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Count')">Количество <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Producer')">Производитель <i class="fa fa-fw fa-sort"></i></th>
                  <th @click="sortBy('Guarantee')">Гарантия <i class="fa fa-fw fa-sort"></i></th>
                </tr>
                <tr v-for="(i, idx) in filteredList" :key="idx">
                  <td>{{ i.ID_Goods }}</td>
                  <td>{{ i.ObjectName }}</td>
                  <td>{{ i.Weight }}</td>
                  <td>{{ i.Price }}</td>
                  <td>{{ i.Count }}</td>
                  <td>{{ i.Producer }}</td>
                  <td>{{ i.Guarantee }}</td>
                  <td>
                    <button @click="addToOrder(idx)" class="btn btn-addToOrder">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                  </td>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://unpkg.com/axios@1.0.0/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="js/script.js"></script>
