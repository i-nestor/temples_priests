// Показать/Скрыть пароль
document.querySelectorAll('.show-password').forEach(function (button) {
    button.addEventListener('click', function () {
        let input = document.querySelector(button.dataset.target);
        if (input.type === 'password') {
            input.type = 'text';
        } else if (input.type === 'text') {
            input.type = 'password';
        }
    });
});

// Валидация формы
const form = document.getElementById("personalDataForm");

form.onsubmit = function (event) {
    event.preventDefault();

    let email = document.getElementById("email").value;
    let regExp = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let testEmail = regExp.test(email);


    if(testEmail) {
        document.getElementById("content").innerHTML="Неправильный адрес электронной почты"; document.getElementById("email").style.background="red";
    } else {
        document.getElementById("content").innerHTML="Электронная почта верна"; document.getElementById("email").style.background="green";
    }


    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirmPassword').value;

    if (password === confirmPassword) {
        // form.reset(); // Очистить форму
        // document.querySelector('.overlay').style.display = 'none';
        // alert('Спасибо за ваше обращение!');
    } else if (password !== confirmPassword) {
        alert('Пароли не совпадают!');
    }

}

