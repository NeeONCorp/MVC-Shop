<?php

class CategoryController
{
    /**
     * Каталог товаров
     *
     * @param int $page - активная страница
     */
    public function actionIndex($page = 1)
    {
        # Фильтруем номер страницы от мусора
        $page = Product::getCleanNumberPage($page);

        # Получаем список категорий
        $categories = Category::getCategoriesList();

        # Список продуктов
        $products = Product::getProducts($page);

        # Количество продуктов
        $сountProduct = Product::getTotalCountProducts();

        # Настройка пагинации
        $pagenation = new Pagination($сountProduct, $page, Product::PRODUCTS_ON_PAGE_CATEGORY_SHOW, 'page-');
        $pagenation = $pagenation->get();

        # Заголовок страницы
        $page = ['title' => 'Каталог'];

        # Подключение дополнительных CSS файлов
        $additionalCss = App::includeCssFiles([
            '/template/default/styles/categories_styles.css',
            '/template/default/styles/categories_responsive.css'
        ]);

        include_once(ROOT . '/views/category/index.php');
    }

    /**
     * Категория товаров
     *
     * @param int $categoryId
     * @param int $page - активная страница
     */
    public function actionView($categoryId, $page = 1)
    {
        # Фильтруем номер страницы от мусора
        $page = Product::getCleanNumberPage($page);

        # Проверяем существование категории
        if(!Category::existCategoryById($categoryId)) App::locationPageNotFound();

        # Получаем данные категории
        $category = Category::getCategoryById($categoryId);

        # Проверяем доступность категории
        if(!$category['status']) App::locationPageNotFound();

        # Получаем список категорий
        $categories = Category::getCategoriesList();

        # Список продуктов
        $products = Product::getProductsByCategoryId($categoryId, $page);

        # Количество продуктов
        $сountProduct = Category::getTotalCountProductsInCategory($categoryId);

        # Настройка пагинации
        $pagenation = new Pagination($сountProduct, $page, Product::PRODUCTS_ON_PAGE_CATEGORY_SHOW, 'page-');
        $pagenation = $pagenation->get();

        # Заголовок страницы
        $page = ['title' => $category['title'] . ' - Страница: ' . $page];

        # Подключение дополнительных CSS файлов
        $additionalCss = App::includeCssFiles([
            '/template/default/styles/categories_styles.css',
            '/template/default/styles/categories_responsive.css'
        ]);

        include_once(ROOT . '/views/category/view.php');
    }
}