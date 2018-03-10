<?php

class AdminProductController extends AdminBase
{
    /**
     * Страница "Список товар"
     */
    public function actionIndex()
    {
        # Проверка прав администратора
        self::checkAdmin();

        $products = Product::getProductsAdmin();

        # Заголовок страницы
        $page = ['title' => 'Список товаров'];

        include_once(ROOT . '/views/admin/product/index.php');
    }

    /**
     * Удаление товара с заданым id
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Удаляем фото товара
        Product::removeImagesProductById($id);

        # Удаляем товар из базы данных
        Product::remove($id);

        echo 'success';
    }

    /**
     * Страница "Добавить товар"
     */
    public function actionAddPage()
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Получает список категорий
        $categories = Category::getCategoriesListAdmin();

        # Заголовок страницы
        $page = ['title' => 'Добавить товар'];

        include_once(ROOT . '/views/admin/product/add.php');
    }

    /**
     * Добавление товара
     */
    public function actionAdd()
    {
        # Проверка прав администратора
        self::checkAdmin();

        $name = $_POST['name'];
        $price = $_POST['price'];
        $categoryId = $_POST['category'];
        $description = $_POST['description'];
        $brand = $_POST['brand'];
        $hide = $_POST['hide'];
        $new = $_POST['new'];
        $images = [$_FILES['image1'], $_FILES['image2'], $_FILES['image3']];
        $images = array_diff($images, ['']);

        # Проверяем данные
        $result = Product::checkDataAdd($name, $price);

        if ($result === true) {
            # Загружаем фото
            $upload = Product::uploadPhoto($images);

            if ($upload['result']) {
                $imagesList = $upload['imageList'];

                # Проверить существование категории
                if (Category::existCategoryById($categoryId)) {

                    $result = Product::add($name, $price, $categoryId, $description, $brand, $hide, $new, $imagesList);

                    if ($result) echo 'success';

                } else echo 'Указаной категории не существует.';

            } else echo $upload['text'];

        } else echo $result[0];
    }

    /**
     *  Страница "Редактировать товар"
     *
     * @param $id
     */
    public function actionEditPage($id)
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Проверить существование товара
        if(!Product::existProductById($id)) App::locationPageNotFound();

        # Получает список категорий
        $categories = Category::getCategoriesListAdmin();

        # Информация о товаре
        $product = Product::getProductById($id, false);

        # Формирует массив с изоображениями продукта
        $imagesDefault = [
            '1' => $product['images'][0],
            '2' => $product['images'][1],
            '3' => $product['images'][2]
        ];

        # Массив с изображениями
        $images = array_diff($imagesDefault, ['']);

        # Массив с ключами отсутствующих изображений
        $emptyImages = array_diff($imagesDefault, $images);

        # Заголовок страницы
        $page = ['title' => 'Редактирование товара'];

        include_once(ROOT . '/views/admin/product/edit.php');
    }

    /**
     * Обновляет информацию о товаре
     *
     * @param $id
     */
    public function actionEdit($id)
    {
        # Проверка прав администратора
        self::checkAdmin();

        $name = $_POST['name'];
        $price = $_POST['price'];
        $categoryId = $_POST['category'];
        $description = $_POST['description'];
        $brand = $_POST['brand'];
        $hide = $_POST['hide'];
        $new = $_POST['new'];

        $images = [$_FILES['image1'], $_FILES['image2'], $_FILES['image3']];
        $removeImages = [$_POST['remove_photo1'], $_POST['remove_photo2'], $_POST['remove_photo3']];

        $errors = null;

        # Проверить корректность данных
        $checkData = Product::checkDataAdd($name, $price);

        # Проверить существование товара
        if (Product::existProductById($id)) {

            if ($checkData === true) {

                # Загружаем или удаляем фото
                $upload = Product::editPhoto($images, $removeImages);

                if ($upload['result'] === true) {

                    # Редактируем информацию о товаре
                    $result = Product::edit($id, $name, $price, $categoryId, $description, $brand, $hide, $new, $upload['imageList']);

                    if($result['result'] === false) $errors[] = 'Неизвестная ошибка.';


                } else $errors [] = $upload['text'];

            } else $errors[] = $checkData[0];

        } else $errors[] = 'Указанный товар не найден.';


        # Ответ
        if (!is_array($errors)) {
            echo 'success';
        } else {
            echo $errors[0];
        }

    }
}