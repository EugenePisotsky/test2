/*
 * Обработчики для ajax-форм. Методы указываются в параметре формы "callback"
 */

var callbacks = {
    register: function(data) {
        var data = JSON.parse(data);

        if (data.status == 'ok') {
            var result = document.getElementById('register-block__result');
            result.innerHTML = 'Вы успешно зарегистрировались! Теперь вы можете войти с помощью своей учётной записи!'
        } else if (data.status == 'email') {
            var input = document.getElementById('email');
            Core.showError(input, 2);
        }
    },

    login: function(data) {
        var data = JSON.parse(data);

        if (data.status == 'ok') {
            window.location = '/?page=profile';
        } else {
            var input = document.getElementById('password-login');
            Core.showError(input, 1);
        }
    }
}