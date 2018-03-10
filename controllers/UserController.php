<?php

class UserController
{
    /**
     * Страница авторизации/регистрации
     */
    public function actionLoginRegister()
    {
        # Проверка не авторизован ли пользователь
        if(!User::isGuest()) header('Location: /cabinet/history_order');

        # Сценарий регистрации пользователя
        if (isset($_POST['register'])) {
            $resultRegister = false;

            $register = [
                'name'      => $_POST['register_name'],
                'email'     => $_POST['register_email'],
                'password1' => $_POST['register_password1'],
                'password2' => $_POST['register_password2']
            ];

            # Проверяем данные на корректность
            $resultRegister = User::checkDataRegister($register['name'], $register['email'], $register['password1'],
                $register['password2']);

            if ($resultRegister === true) {
                # Производим регистрацию
                User::register($register['name'], $register['email'], $register['password1']);
            }
        }

        # Сценарий авторизации пользователя
        if (isset($_POST['login'])) {
            $login = [
                'email'    => $_POST['login_email'],
                'password' => $_POST['login_password']
            ];

            # Проверяем данные для авторизации
            $idUser = User::checkDataLogin($login['email'], $login['password']);

            if (!is_array($idUser)) {
                # Авторизируем пользователя
                User::auth($idUser);
            } else {
                # Записываем ошибки входа
                $resultLogin = $idUser;
            }

        }

        # Заголовок страницы
        $page = ['title' => 'Вход - Регистрация'];

        include_once ROOT . '/views/user/login-register.php';
    }
}