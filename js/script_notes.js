var application = new Vue({
    el: '#app',
    data () {
      return {
        allData: [],
        id: '',
        searchInfo: '',
        cltName: '',
        ordAddress: '',
        ordDate: '',
        empName: '',
        autoModel: '',
        noteID: '',
        // filterSelType: '',
        // filterClientNames: [
        //   { text: 'Работник', value: 'name' },
        //   { text: 'Должность', value: 'job' },
        //   { text: 'Телефон', value: 'tel' },
        //   { text: 'Авто', value: 'brand' },
        //   { text: 'Модель', value: 'model' },
        //   { text: 'Рег. номер', value: 'reg_num' },
        //   { text: 'Год выпуска', value: 'release_year' },
        // ]
      };
    },
    methods: {
      fetchAllData:function() {
          axios
            .post('php/action_notes.php')
            .then(res => {
              application.allData = res.data;
            })
            .catch(function(error) {
              console.log(error);
            });
      },

      deleteNote(id) {
          axios
          .get(`php/delete_note.php?id=${id}`)
          .then(response => {
            alert('Заказ успешно удален!')
            console.log(response.data)
            location.reload();
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при удалении заказа!');
          })
      },

      addNote() {
        axios
        .get('php/add_note.php', { params: { cltName: this.cltName, ordAddress: this.ordAddress, ordDate: this.ordDate, empName: this.empName, autoModel: this.autoModel } })
          .then(response => {
            console.log(response.data.length);
            if (response.data.length == '12659')
              alert('Заказ успешно добавлен!');
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при добавлении записи!');
          });
      },
  
      sortBy(key) {
        return this.allData.sort(function(a, b){
          if (key == 'cltName' || key == 'ordAddress' || key == 'empName' || key == 'Brand' || key == 'Model')
            return (a[key] > b[key]) ? 1 : -1;
          else if (key == 'ordDate')
            return (a[key].slice(a[key].length-4, a[key].length) > b[key].slice(b[key].length-4, b[key].length)) ? -1 : 1;
          else if (key == 'ID_Note')
            return (a[key] > b[key] ? -1 : -1);
          return (parseInt(a[key]) >= parseInt(b[key])) ? 1 : -1;
        });
      },
  
      filterSelect(colSel = this.filterSelType) {
        return colSel;
      },
    },
  
    created:function() {
      this.fetchAllData();
    },
  
    computed: {
      
      clientNames() {
        return [...new Set(this.allData.map(n => n.cltName))];
      },

      employeeNames() {
        return [...new Set(this.allData.map(n => n.empName))];
      },

      noteIdFind() {
        return this.noteID;
      }

      // filteredList() {        
      //   let sel = this.filterSelect();
      //   var si = this.searchInfo;
      //   return this.paginatedPages.filter(function (elem) {
      //       if(si !== '') {
      //           if (typeof(elem[sel]) === 'string') 
      //               return elem[sel].toLowerCase().includes(si.toLowerCase())
      //           return elem[sel].toString().includes(si);
      //       }
      //       return (
      //           elem.name.toLowerCase().includes(si.toLowerCase())
      //       );
      //   })
      // },
      
    },
    mounted() {
  
    },
  });