var application = new Vue({
    el: '#app',
    data () {
      return {
        allData: [],
        id: '',
        searchInfo: '',
        ObjectName: '',
        Producer: '',
        Guarantee: '',
        Weight: '',
        Price: '',
        ID: '',
      };
    },
    methods: {
      fetchAllData:function() {
          axios
            .post('php/action_control-goods.php')
            .then(res => {
              application.allData = res.data;
            })
            .catch(function(error) {
              console.log(error);
            });
      },

      deleteRow(id) {
          axios
          .get(`php/delete_control-goods.php?id=${id}`)
          .then(response => {
            alert('Товар успешно удален!')
            console.log(response.data)
            location.reload();
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при удалении товара!');
          })
      },

      addRow() {
        axios
        .get('php/add_control-goods.php', { params: { ObjectName: this.ObjectName, Producer: this.Producer, Guarantee: this.Guarantee, Weight: this.Weight, Price: this.Price} })
          .then(response => {
            console.log(response.data.length);
            if (response.data.length == '11064')
              alert('Товар успешно добавлен!');
          })
          .catch(error => {
            console.log(error);
            alert('Произошла ошибка при добавлении товара!');
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
        axios.get(`php/change_control-goods.php?ID_Goods=${this.ID}&ObjectName=${this.ObjectName}&Producer=${this.Producer}&Guarantee=${this.Guarantee}&Weight=${this.Weight}&Price=${this.Price}`)
            .then(response => {
                console.log(response.data.length);
                if (response.data.length == '10449')
                  alert('Данные товара изменены!')
            })
            .catch(error => {
                console.log(error);
                alert('Произошла ошибка при изменении товара!');
            });
    },
  
      sortBy(key) {
        return this.allData.sort(function(a, b){
          if (key == 'ObjectName' || key == 'Guarantee' || key == 'Price' || key == 'Producer' || key == 'Weight')
            return (a[key] > b[key]) ? 1 : -1;
          else if (key == 'ID_Goods')
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
      producerTypes() {
        return [...new Set(this.allData.map(n => n.Producer))];
      },

      guaranteeTypes() {
        return [...new Set(this.allData.map(n => n.Guarantee))];
      },

      IdFind() {
        return this.ID;
      }      
    },
    mounted() {
  
    },
  });