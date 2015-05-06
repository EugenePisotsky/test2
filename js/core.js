var Core = {
    errorsDOM: [],
    hasError: false,

    initialize: function() {
        this.forms();
    },

    /*
     * Валидатор для форм
     */
    validator: function(form) {
        var _this = this;
        var rows = form.querySelectorAll('[validate]');
        var fail = false;

        var errors = _this.errorsDOM;
        for (x = 0; x < errors.length; x++) {
            var error = errors[x];
            error.parentNode.removeChild(error);
        }
        _this.errorsDOM = [];

        for (i = 0; i < rows.length; i++) {
            var input = rows[i];
            var types = input.getAttribute('validate').split(' ');
            var value = input.value;

            _this.hasError = false;
            for (x = 0; x < types.length; x++) {
                var type = types[x];

                switch (type) {
                    case "notEmpty":
                        if (value.length == 0) {
                            _this.showError(input, x);
                        }
                    break;
                    case "min":
                        var attr = input.getAttribute('validate-min');

                        if (value.length < attr) {
                            _this.showError(input, x);
                        }
                    break;
                    case "email":
                        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

                        if (!re.test(value)) {
                            _this.showError(input, x);
                        }
                    break;
                    case "equalTo":
                        var attr = input.getAttribute('validate-equal-to');
                        var elm = document.getElementById(attr).value;

                        if (value !== elm) {
                            _this.showError(input, x);
                        }
                    break;
                }

                if (_this.hasError) {
                    fail = true;
                    _this.hasError = false;
                    break;
                }
            }
        }

        if (fail) {
            return false;
        }

        return true;
    },

    showError: function(input, x) {
        this.hasError = true;
        var errorsList = input.getElementsByClassName('error');

        if (errorsList.length == 0) {
            var errorField = input.getAttribute('validate-error').split('; ');

            var error = document.createElement("span");
            error.setAttribute('class', 'error');
            error.innerHTML = errorField[x];
            this.errorsDOM.push(error);

            input.parentNode.appendChild(error);
        }
    },

    forms: function() {
        var _this = this;

        var rows = document.getElementsByTagName('form');

        for (i = 0; i < rows.length; i++) {
            var form = rows[i];

            form.addEventListener("submit", function(event) {
                var form = this;
                event.preventDefault();

                var callback = form.getAttribute('callback');
                var url = form.getAttribute('action');
                console.log('C: ' + callback);

                if (!_this.validator(form)) {
                    return false;
                }

                var data = [];
                var elements = form.getElementsByClassName('f-data');

                for (x = 0; x < elements.length; x++) {
                    var elm = elements[x];

                    data[elm.getAttribute('name')] = elm.value;
                }

                console.log('Send post');
                ajax.post(url, data, function(data){
                    console.log(data);
                    window["callbacks"][callback](data);
                })
            });
        }
    }
}

Core.initialize();