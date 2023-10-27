var application = new Vue({
    el: '#app',
    data () {
      return {
        allData: [],
        id: '',
        searchInfo: '',
        FName: '',
        Tel: '',
        Sex: '',
        BirthDate: '',
        Address: '',
        Password: '',
        ID: '',
      };
    },
    methods: {
      fetchAllData:function() {
          axios
            .post('php/action_control-client.php')
            .then(res => {
              application.allData = res.data;
            })
            .catch(function(error) {
              console.log(error);
            });
      },

      deleteRow(id) {
          axios
          .get(`php/delete_control-client.php?id=${id}`)
          .then(response => {
            alert('Клиент успешно удален!')
            console.log(response.data)
            location.reload();
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при удалении клиента!');
          })
      },

      addRow() {
        axios
        .get('php/add_control-client.php', { params: { FName: this.FName, Tel: this.Tel, Sex: this.Sex, BirthDate: this.BirthDate, Address: this.Address, Password: this.Password } })
          .then(response => {
            console.log(response.data.length);
            if (response.data.length == '10673')
              alert('Клиент успешно добавлен!');
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при добавлении клиента!');
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
        axios.get(`php/change_control-client.php?ID_Client=${this.ID}&FName=${this.FName}&Tel=${this.Tel}&Sex=${this.Sex}&BirthDate=${this.BirthDate}&Address=${this.Address}&Password=${this.Password})`)
            .then(response => {
                console.log(response.data.length);
                if (response.data.length == '11300')
                  alert('Данные клиента изменены!')
            })
            .catch(error => {
                console.log(error);
                alert('Произошла ошибка при изменении клиента!');
            });
    },
  
      sortBy(key) {
        return this.allData.sort(function(a, b){
          if (key == 'FName' || key == 'Sex' || key == 'Address' || key == 'Password')
            return (a[key] > b[key]) ? 1 : -1;
          else if (key == 'BirthDate')
            return (a[key].slice(a[key].length-4, a[key].length) > b[key].slice(b[key].length-4, b[key].length)) ? -1 : 1;
          else if (key == 'ID_Client')
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
      clientTypes() {
        return [...new Set(this.allData.map(n => n.Sex))];
      },

      IdFind() {
        return this.ID;
      }      
    },
    mounted() {
  
    },
  });