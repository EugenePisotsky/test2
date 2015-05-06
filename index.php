<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

require 'bootstrap.php';

class RegistrationForm {
    /*
     * Вызов экшена в конструкторе из переменной _GET['page']
     */
    function __construct() {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            if (method_exists($this, $page)) {
                $this->{$page}();
            } else {
                $this->e404();
            }
        } else {
            $this->index();
        }
    }

    private function index() {
        if (isset($_SESSION['id'])) {
            header('Location: /?page=profile');
        }

        View::display('index', [
            'title' => i18n::msg('homePageTitle'),
            'field' => 'passed variable'
        ]);
    }

    private function login() {
        $id = Model::get('Users')->check([
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);

        if ($id) {
            $_SESSION['id'] = $id;

            $this->response('ok');
        } else {
            $this->response('fail');
        }
    }

    private function register() {
        $fields = ['first_name', 'last_name', 'email', 'password', 'repassword'];

        $validator = new Validator([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min' => 6],
            'repassword' => ['equal' => 'password'],
        ]);

        if (!Model::get('Users')->checkEmail($_POST['email'])) {
            $this->response('email');
        }

        if ($validator->check()) {
            Model::get('Users')->insert([
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_BCRYPT, [
                    'cost' => 11,
                ])
            ]);

            $this->response('ok');
        }

        $this->response('fail');
    }

    private function profile() {
        if (!isset($_SESSION['id'])) {
            header('Location: /');
        }

        $profile = Model::get('Users')->getUserById($_SESSION['id']);

        View::display('profile', [
            'title' => 'Профиль пользователя',
            'profile' => $profile
        ]);
    }

    private function logout() {
        unset($_SESSION['id']);
        header('Location: /');
    }

    private function lang() {
        i18n::setLang($_GET['l']);

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }

    /*
     * Ошибка 404, если метод из _GET['page'] не нашёлся
     */
    private function e404() {
        View::display('404', [
            'title' => i18n::msg('pageNotFoundTitle')
        ]);
    }

    private function response($status, $data=[]) {
        exit(json_encode([
            'status' => $status,
            'data' => $data
        ]));
    }
}

$app = new RegistrationForm();