<?php

class CartController
{
    /**
     * Страница "Корзина"
     */
    public function actionIndex()
    {
        # Удаляем продукт из корзины
        if (isset($_POST['remove_product'])) {
            $productData = [
                'id' => $_POST['product_id'],
            ];

            Cart::removeProduct($productData['id']);
        }

        # Увеличиваем/уменьшаем количество товара
        if (isset($_POST['edit_count'])) {
            $editCount = [
                'id'     => $_POST['edit_count_id'],
                'action' => $_POST['edit_count_action'],
            ];

            Cart::incrementOrDecrementCountProduct($editCount['id'], $editCount['action']);
        }

        # Получить количество продуктов в корзине
        $countItems = Cart::getCountItems();

        if ($countItems > 0) {
            # Получить список продуктов и информацией о них
            $products = Cart::getProductsIncludeData();

            # Получить общую стоимость
            $totalPrice = Cart::getTotalPrice();
        }

        # Заголовок страницы
        $page = ['title' => 'Корзина ('.$countItems.')'];

        include_once(ROOT.'/views/cart/index.php');
    }

    /**
     * Добавление товара в корзину
     *
     * @param $id
     * @param int $count
     */
    public function actionAddProduct($id, $count = 1)
    {
        if (Product::existProductById($id)) {
            Cart::addProduct($id, $count);
            echo Cart::getCountItems();
        }
    }

    /**
     * Страница "Оформления заказа"
     */
    public function actionCheckout()
    {
        # Получить количество продуктов
        $countProducts = Cart::getCountItems();

        $result = false;
        $userId = null;

        $userData = [
            'name'         => '',
            'phone_number' => '',
            'email'        => '',
        ];

        if ($countProducts > 0) {

            # Получаем userId (если пользователь авторизован)
            if ( ! User::isGuest()) {
                $userId = User::checkLogged();
            }

            # Разрешаем сделать заказ авторизованным пользователям
            if ($userId > 0) {
                $userData = ['id' => $userId];
                $result   = true;
            }

            # Проверяем данные на корректность от гостей
            if (isset($_POST['checkout'])) {
                $userData['name']         = $_POST['checkout_name'];
                $userData['phone_number'] = $_POST['checkout_phone_number'];
                $userData['email']        = $_POST['checkout_email'];

                $result = Cart::checkDataCheckout($userData['name'], $userData['phone_number'], $userData['email']);
            }

        } else {
            header('Location: /cart');
        }

        # Создаем заказ
        if ($result === true) {
            Order::create($userData);
            Cart::clear();
        }

        # Заголовок страницы
        $page = ['title' => 'Оформление заказа'];

        include_once(ROOT.'/views/cart/checkout.php');

    }
}