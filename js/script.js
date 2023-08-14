var application = new Vue({
  el: '#app',
  data () {
    return {
      allData: [],
      pageNumber: 1,
      rowsPerPage: 5,
      searchInfo: '',
      filterSelType: 'ObjectName',
      filterSelOptions: [
        { text: 'ID', value: 'ID_Goods' },
        { text: 'Продукт', value: 'ObjectName' },
        { text: 'Вес', value: 'Weight' },
        { text: 'Цена', value: 'Price' },
        { text: 'Количество', value: 'Count' },
        { text: 'Производитель', value: 'Producer' },
        { text: 'Гарантия', value: 'Guarantee' },
      ]
    };
  },
  methods: {
    fetchAllData:function() {
        axios
          .post('php/action.php')
          .then(res => {
            application.allData = res.data;
            
            this.allData.forEach(i => {
              if (i['Guarantee'])
                return i['Guarantee'] = '✅';
              return i['Guarantee'] = '⛔'; 
            });
          })
          .catch(function(error) {
            console.log(error);
          });
    },

    sortBy(key) {
      return this.allData.sort(function(a, b){
        if (key == 'ObjectName' || key == 'Producer')
          return (a[key] > b[key]) ? 1 : -1;
        else if (key == 'Guarantee')
          return (a[key] > b[key]) ? -1 : 1;
        return (parseInt(a[key]) >= parseInt(b[key])) ? 1 : -1;
      });
    },

    pageClick(page) {
      this.pageNumber = page;
    },

    rightClick() {
      this.pageNumber++;
    },

    leftClick() {
      this.pageNumber--;
    },

    filterSelect(colSel = this.filterSelType) {
      //console.log(colSel);
      return colSel;
    },

    changeList() {
      this.rowsPerPage = 10;
      return this.rowsPerPage;
    },

    fullArr() {
      let pagination = document.querySelector('.table-pagination');
      if (!pagination.classList.contains('--active')) {
        pagination.classList.add('--active');
        this.pageNumber = 1;
        this.rowsPerPage = this.allData.length;
      } else {
        pagination.classList.remove('--active');
        this.rowsPerPage = 5;
      }
      return this.rowsPerPage;
    },
    
    addToOrder(idx, event) {
      if (event)
        event.preventDefault(); //deny link following
      
      let id = this.paginatedPages[idx]['ID_Goods'];
      // console.log(this.paginatedPages[idx]['ID_Goods']);

      $.ajax({
        url: 'php/order.php',
        type: 'GET',
        data: {order: 'add', id: id},
        dataType: 'json',
        success: function(res) {
          console.log(res);
        },
        error: function() {
          alert("Error");
        }
      });
        

    },
  },

  created:function() {
    this.fetchAllData();
  },

  computed: {
    pages() {
      return Math.ceil(this.allData.length / 10 + 1);
    },

    paginatedPages() {
      let from = (this.pageNumber - 1) * this.rowsPerPage;
      let to = from + this.rowsPerPage;
      return this.allData.slice(from, to);
    },
    
    filteredList() {        
      let sel = this.filterSelect();
      var si = this.searchInfo;
      return this.paginatedPages.filter(function (elem) {
        if(si !== '') {
          return elem[sel].toLowerCase().indexOf(si) > -1;
        }
        return true;
      })
    },
    
  },
  mounted() {

  },
});