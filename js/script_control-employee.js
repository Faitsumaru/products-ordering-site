var application = new Vue({
    el: '#app',
    data () {
      return {
        allData: [],
        id: '',
        searchInfo: '',
        FName: '',
        Tel: '',
        Job: '',
        Password: '',
        ID: '',
      };
    },
    methods: {
      fetchAllData:function() {
          axios
            .post('php/action_control-employee.php')
            .then(res => {
              application.allData = res.data;
            })
            .catch(function(error) {
              console.log(error);
            });
      },

      deleteRow(id) {
          axios
          .get(`php/delete_control-employee.php?id=${id}`)
          .then(response => {
            alert('Работник успешно удален!')
            console.log(response.data)
            location.reload();
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при удалении работника!');
          })
      },

      addRow() {
        axios
        .get('php/add_control-employee.php', { params: { FName: this.FName, Tel: this.Tel, Job: this.Job, Password: this.Password } })
          .then(response => {
            console.log(response.data.length);
            if (response.data.length == '10070')
              alert('Работник успешно добавлен!');
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при добавлении работника!');
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
        axios.get(`php/change_control-employee.php?ID_Employee=${this.ID}&FName=${this.FName}&Tel=${this.Tel}&Job=${this.Job}&Password=${this.Password})`)
            .then(response => {
                console.log(response.data.length);
                if (response.data.length == '10190')
                  alert('Данные работника изменены!')
            })
            .catch(error => {
                console.log(error);
                alert('Произошла ошибка при изменении работника!');
            });
    },
  
      sortBy(key) {
        return this.allData.sort(function(a, b){
          if (key == 'FName' || key == 'Job' || key == 'Password')
            return (a[key] > b[key]) ? 1 : -1;
          else if (key == 'ID_Employee')
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