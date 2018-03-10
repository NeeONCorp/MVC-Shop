<?php

class CabinetController
{
    /**
     * Страница "Кабинет"
     */
    public function actionIndex()
    {
        # Получить Id пользователя или перенаправить на страницу входа
        $userId = User::checkLogged();

        # Получить данные пользователя
        $user = User::getUserById($userId);

        # Узнает является ли пользователь администратором
        $isAdmin = User::isAdmin($userId);

        # Заголовок страницы
        $page = ['title' => 'Кабинет пользователя'];

        include_once(ROOT . '/views/cabinet/index.php');
    }

    /**
     * Страница "Кабинет - Редактировать данные"
     */
    public function actionEditPage()
    {
        # Получить Id пользователя или перенаправить на страницу входа
        $userId = User::checkLogged();

        # Получить данные пользователя
        $user = User::getUserById($userId);

        # Навигация для пользователя
        $navigation = App::getContentFile(
            ROOT . '/views/layouts/default/cabinet_menu.php',
            [
                'isAdmin'    => User::isAdmin($userId),
                'activePage' => 'edit'
            ]);

        # Заголовок страницы
        $page = ['title' => 'Редактировать информацию - Кабинет'];

        include_once(ROOT . '/views/cabinet/edit.php');
    }

    /**
     * Редактирование данных профиля
     */
    public function actionEditProfile()
    {
        # Получить Id пользователя или перенаправить на страницу входа
        $userId = User::checkLogged();

        # Получаем отредактированные данные
        $name = $_POST['name'];
        $phoneNumber = $_POST['phone_number'];

        # Проверить корректность полученных данных
        $result = User::checkEditData($name, $phoneNumber);

        # Редактируем
        if ($result === true) {
            User::editData($name, $phoneNumber, $userId);
            echo 'success';
        } else echo $result[0];
    }

    /**
     * Редактирование пароля
     */
    public function actionEditPassword()
    {
        # Получить Id пользователя или перенаправить на страницу входа
        $userId = User::checkLogged();

        # Получаем данные от пользователя
        $passwordOld = $_POST['password_old'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        # Проверить корректность полученных данных
        $result = User::checkEditPassword($passwordOld, $password1, $password2, $userId);

        # Сменить пароль
        if ($result === true) {
            User::editPassword($password1, $userId);
            echo 'success';
        } else echo $result[0];

    }

    /**
     * Страница "Кабинет - История заказов"
     */
    public function actionHistoryOrder()
    {
        # Получить Id пользователя или перенаправить на страницу входа
        $id = User::checkLogged();

        # Получить информацию о пользователе
        $user = User::getUserById($id);

        # Получить список заказов пользователя
        $orders = User::getOrdersByUserId($id);

        # Навигация для пользователя
        $navigation = App::getContentFile(
            ROOT . '/views/layouts/default/cabinet_menu.php',
            [
                'isAdmin'    => User::isAdmin($id),
                'activePage' => 'history_order'
            ]);

        # Заголовок страницы
        $page = ['title' => 'История заказов - Кабинет'];

        include_once(ROOT . '/views/cabinet/historyOrder.php');
    }

    /**
     * Выход из профиля
     */
    public function actionLogout()
    {
        User::logout();
    }
}