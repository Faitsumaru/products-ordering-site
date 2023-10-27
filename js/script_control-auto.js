var application = new Vue({
    el: '#app',
    data () {
      return {
        allData: [],
        id: '',
        searchInfo: '',
        ReleaseYear: '',
        Brand: '',
        Model: '',
        RegNum: '',
        ID: '',
      };
    },
    methods: {
      fetchAllData:function() {
          axios
            .post('php/action_control-auto.php')
            .then(res => {
              application.allData = res.data;
            })
            .catch(function(error) {
              console.log(error);
            });
      },

      deleteRow(id) {
          axios
          .get(`php/delete_control-auto.php?id=${id}`)
          .then(response => {
            alert('Авто успешно удалено!')
            console.log(response.data)
            location.reload();
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при удалении авто!');
          })
      },

      addRow() {
        axios
        .get('php/add_control-auto.php', { params: { ReleaseYear: this.ReleaseYear, Brand: this.Brand, Model: this.Model, RegNum: this.RegNum } })
          .then(response => {
            console.log(response.data.length);
            if (response.data.length == '10274')
              alert('Авто успешно добавлено!');
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при добавлении авто!');
          });
      },

      changeRowBtn(id) {
        let modal = document.getElementById("myModal");
        modal.style.display = "flex";

        let span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }
        
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }

        this.ID = id;
        return id;
      },

      changeRow() {
        axios.get(`php/change_control-auto.php?ID_Auto=${this.ID}&ReleaseYear=${this.ReleaseYear}&Brand=${this.Brand}&Model=${this.Model}&RegNum=${this.RegNum}`)
            .then(response => {
                console.log(response.data.length);
                if (response.data.length == '9638')
                  alert('Данные авто изменены!')
            })
            .catch(error => {
                console.log(error);
                alert('Произошла ошибка при изменении авто!');
            });
    },
  
      sortBy(key) {
        return this.allData.sort(function(a, b){
          if (key == 'Brand' || key == 'Model' || key == 'RegNum')
            return (a[key] > b[key]) ? 1 : -1;
          else if (key == 'ReleaseYear')
            return (a[key].slice(a[key].length-4, a[key].length) > b[key].slice(b[key].length-4, b[key].length)) ? -1 : 1;
          else if (key == 'ID_Auto')
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
      IdFind() {
        return this.ID;
      }      
    },
    mounted() {
  
    },
  });