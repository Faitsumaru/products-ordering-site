var application = new Vue({
    el: '#app',
    data () {
      return {
        allData: [],
        pageNumber: 1,
        rowsPerPage: 5,
        searchInfo: '',
        filterSelType: 'name',
        filterSelOptions: [
          { text: 'ID', value: 'id' },
          { text: 'Date', value: 'date' },
          { text: 'Name', value: 'name' },
          { text: 'Count', value: 'count' },
          { text: 'Distance', value: 'distance' }
        ]
      };
    },
    methods: {
      fetchAllData:function() {
          axios
            .post('php/action.php')
            .then(res => {
              application.allData = res.data;
              //console.log(res.data);
            })
            .catch(function(error) {
              console.log(error);
            });
      },
  
      sortBy(key) {
        return this.allData.sort(function(a, b){
          if (key == 'name' || key == 'date')
            return (a[key] > b[key]) ? 1 : -1;
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
      }
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
      }
      
    }
  });