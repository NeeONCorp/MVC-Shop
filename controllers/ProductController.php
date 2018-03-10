<?php

class ProductController
{
    /**
     * Страница "Просмотр товара"
     *
     * @param $productId
     */
    public function actionView($productId)
    {

        # Проверить существования товара
        if (!Product::existProductById($productId)) App::locationPageNotFound();


        # Получает данные о товаре
        $product = Product::getProductById($productId);

        # Проверка на скрытость категории товара
        if (Category::isHideCategory($product['category_id'])) App::locationPageNotFound();

        # Проверяем доступность товара
        if (!$product['status']) App::locationPageNotFound();

        # Заголовок страницы
        $page = ['title' => $product['name'] . ' - ' . $product['categoryName']];

        # Подключение дополнительных CSS файлов
        $additionalCss = App::includeCssFiles([
            '/template/default/styles/single_styles.css',
            '/template/default/styles/single_responsive.css'
        ]);

        require_once(ROOT . '/views/product/view.php');
    }
}