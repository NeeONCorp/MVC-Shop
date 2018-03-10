<?php

class AdminCategoryController extends AdminBase
{
    /**
     * Страница из списком категорий
     */
    public function actionIndex()
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Получить список категорий
        $categories = Category::getCategoriesListAdmin();

        # Заголовок страницы
        $page = ['title' => 'Список категорий'];

        include_once(ROOT . '/views/admin/category/index.php');
    }

    /**
     * Удаляет категорию с заданным id
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        # Проверка прав администратора
        self::checkAdmin();

        $errors = false;

        # Проверяем существование категории
        if (Category::existCategoryById($id)) {

            # Удаляет категорию
            if (!Category::removeCategoryById($id)) $errors = true;

            # Удаляет товары в категории
            if (!Product::removeProductsByCategoryId($id)) $errors = true;

        } else $errors = true;


        # Ответ
        if ($errors === false) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    /**
     * Страница "Добавить категорию"
     */
    public function actionAddPage()
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Заголовок страницы
        $page = ['title' => 'Добавить категорию'];

        include_once(ROOT . '/views/admin/category/add.php');
    }

    /**
     * Добавляет категорию
     */
    public function actionAdd()
    {
        # Проверка прав администратора
        self::checkAdmin();

        $errors = null;

        # Сохраняет полученые данные
        $name = $_POST['name'];
        $sort = $_POST['sort'];
        $hide = $_POST['hide'];

        $checkData = Category::checkDataAdd($name, $sort);

        # Проверяем корректность введенных данных
        if ($checkData === true) {

            # Добавляем товар
            if (!Category::add($name, $sort, $hide)) $errors[] = 'Неизвестная ошибка.';

        } else $errors[] = $checkData[0];

        # Ответ
        if (!is_array($errors)) {
            echo 'success';
        } else {
            echo $errors[0];
        }
    }

    /**
     * Страница редактирования категории
     *
     * @param $id
     */
    public function actionEditPage($id)
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Проверить существование категории
        if (Category::existCategoryById($id)) {

            # Информация о категории
            $category = Category::getCategoryById($id);

        } else App::locationPageNotFound();

        # Заголовок страницы
        $page = ['title' => 'Редактировать категорию'];

        include_once(ROOT . '/views/admin/category/edit.php');
    }

    /**
     * Редактирует данные о товаре
     *
     * @param $id
     */
    public function actionEdit($id)
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Отредактированные данные товара
        $name = $_POST['name'];
        $sort = $_POST['sort'];
        $hide = $_POST['hide'];

        $errors = null;

        # Проверить корректность данных
        $checkData = Category::checkDataAdd($name, $sort);

        if ($checkData === true) {

            if(!Category::editCategoryById($id, ['name' => $name, 'sort' => $sort, 'hide' => $hide]))
                $errors[] = 'Неизвестная ошибка.';

        } else $errors[] = $checkData[0];

        # Ответ
        if(!is_array($errors)) {
            echo 'success';
        } else {
            echo $errors[0];
        }
    }

}