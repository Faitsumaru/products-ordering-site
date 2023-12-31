function passwordVisible() {
    let pssw_field = document.querySelector('.form__input-pssw');
    
    if (pssw_field.type === "password") {
      pssw_field.type = "text";
    } else {
      pssw_field.type = "password";
    }
}

function repasswordVisible() {
  let repssw_field = document.querySelector('.form__input-repssw');
  
  if (repssw_field.type === "password") {
    repssw_field.type = "text";
  } else {
    repssw_field.type = "password";
  }
}

let logout = document.querySelector('.logout-btn');

logout.addEventListener('click', function() {
  alert("Вы успешно вышли из аккаунта!");
})

let update_user = document.querySelector('.update-btn');

update_user.addEventListener('click', function() {
  alert("Данные обновлены!");
})
  
let items = document.querySelectorAll('.form__item')
let delBtns = document.querySelectorAll('.form__item-btn');
let list = document.querySelector('.form__list');
let clearOrderBtn = document.querySelector('.form__order-clear');

delBtns.forEach(function(item) {
  item.addEventListener('click', function() {
    alert(item.parentElement.textContent.trim() + ' удален из списка заказываемых товаров.')
    item.parentElement.remove(item);

    if (!list.childElementCount) {
      clearOrderBtn.disabled = true;
      list.textContent = "Список пуст, добавьте товары!"  
    }
  })
})

let emptyText = document.querySelector('.form__result');
if (list.textContent.trim() === emptyText.textContent) {
  clearOrderBtn.disabled = true;
}

// clearOrderBtn.addEventListener('click', function() {
//   delBtns.forEach(i => {
//     i.parentElement.remove(i);
//   })
//   alert('Все товары успешно удалены!');

//   if (!list.childElementCount) {
//     clearOrderBtn.disabled = true;
//     list.textContent = "Список пуст, добавьте товары!"  
//   }
// })

// if (!list.childElementCount) {
//   
//   list.textContent = "Список пуст, добавьте товары!"  
// }