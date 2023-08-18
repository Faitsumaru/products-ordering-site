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
          { text: 'Работник', value: 'name' },
          { text: 'Должность', value: 'job' },
          { text: 'Телефон', value: 'tel' },
          { text: 'Авто', value: 'brand' },
          { text: 'Модель', value: 'model' },
          { text: 'Рег. номер', value: 'reg_num' },
          { text: 'Год выпуска', value: 'release_year' },
        ]
      };
    },
    methods: {
      fetchAllData:function() {
          axios
            .post('php/action_auto.php')
            .then(res => {
              application.allData = res.data;
            })
            .catch(function(error) {
              console.log(error);
            });
      },
  
      sortBy(key) {
        return this.allData.sort(function(a, b){
          if (key == 'ObjectName' || key == 'name' || key == 'job' || key == 'brand' || key == 'model')
            return (a[key] > b[key]) ? 1 : -1;
          else if (key == 'release_year')
            return (a[key].slice(a[key].length-4, a[key].length) > b[key].slice(b[key].length-4, b[key].length)) ? -1 : 1;
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
                if (typeof(elem[sel]) === 'string') 
                    return elem[sel].toLowerCase().includes(si.toLowerCase())
                return elem[sel].toString().includes(si);
            }
            return (
                elem.name.toLowerCase().includes(si.toLowerCase())
            );
        })
      },
      
    },
    mounted() {
  
    },
  });