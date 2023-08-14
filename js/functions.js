function passwordVisible() {
    let pssw_field = document.querySelector('.form__input-pssw');
    
    if (pssw_field.type === "password") {
      pssw_field.type = "text";
    } else {
      pssw_field.type = "password";
    }
}
  
let items = document.querySelectorAll('.form__item')
let delBtns = document.querySelectorAll('.form__item-btn');
let list = document.querySelector('.form__list');

delBtns.forEach(function(item) {
  item.addEventListener('click', function() {
    alert(item.parentElement.textContent.trim() + ' удален из списка заказываемых товаров.')
    item.parentElement.remove(item);

    if (!list.childElementCount)
      list.textContent = "Список пуст, добавьте товары!"  
  })
})
