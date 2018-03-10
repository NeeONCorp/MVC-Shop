<?php

class AppController
{
    /**
     * Главная страница
     */
    public function actionIndex()
    {
        # Количетсво отображаемых последних продуктов
        $countProduct = 5;

        # Получаем последние продукты
        $lastedProducts = Product::getLastedProducts($countProduct);

        # Получаем категории последних продуктов
        $categoryLastedProducts = Category::getCategoryLastedProducts($countProduct);

        # Заголовок страницы
        $page = ['title' => 'Главная страница'];

        # Подключение дополнительных CSS файлов
        $additionalCss = App::includeCssFiles([
            '/template/default/styles/main_styles.css',
            '/template/default/styles/responsive.css'
        ]);

        include_once (ROOT . '/views/app/index.php');
    }

    /**
     * Страница ошибки 404
     */
    public function actionPageNotFound()
    {
        # Заголовок страницы
        $page = ['title' => 'Ошибка 404'];

        include_once (ROOT . '/views/app/404.php');
    }
}