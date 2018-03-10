<?php

class AdminUserController extends AdminBase
{
    /**
     * Страница "Список пользователей"
     */
    public function actionIndex()
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Получаем список пользователей
        $users = User::getUsers();

        # Заголовок страницы
        $page['title'] = 'Список пользователей';

        include_once(ROOT . '/views/admin/user/index.php');
    }

    /**
     * Страница "Просмотр данных о пользователе"
     *
     * @param $id
     */
    public function actionView($id)
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Проверить существование пользователя
        if (!User::existUserById($id)) App::locationPageNotFound();

        # Получить все заказы пользователя
        $orders = User::getOrdersByUserId($id);

        # Получить данные о пользователе
        $user = User::getUserById($id);

        # Заголовок страницы
        $page['title'] = 'Пользователь: ' . $user['name'];

        include_once(ROOT . '/views/admin/user/view.php');
    }
}