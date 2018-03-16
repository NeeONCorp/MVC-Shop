<?php

class Cart
{

    /**
     * Добавляет товар в корзину
     *
     * @param int $id
     * @param int $count - колличество добавлений
     * @return array
     */
    public static function addProduct($id, $count = 1)
    {
        $count = intval($count);

        if ($count < 1) $count = 1;

        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!array_key_exists($id, $_SESSION['cart'])) {
            $_SESSION['cart'][$id] = $count;
        } else {
            $_SESSION['cart'][$id] += $count;
        }

        return $_SESSION['cart'];
    }

    /**
     * Вовзращает количество товаров в корзине
     *
     * @return int
     */
    public static function getCountItems()
    {
        $count = 0;

        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product => $productCount) {
                $count += $productCount;
            }
        }

        return $count;
    }

    /**
     * Возвращает массив с товарами в корзине
     *
     * @return array
     */
    public static function getProducts()
    {
        return $_SESSION['cart'];
    }

    /**
     * Возвращает массив с товарами в корзине и данными о них
     *
     * @return array
     */
    public static function getProductsIncludeData()
    {
        $productsList = [];

        foreach ($_SESSION['cart'] as $productId => $productCount) {
            $productsList[] = $productId;
        }

        $in = str_repeat('?,', count($productsList));
        $in = preg_replace('/,$/', '', $in);

        $db = Db::getConnection();
        $sql = $db->prepare("SELECT id, name, category_id, price, image1, image2, image3 
                                       FROM product p WHERE p.id IN ($in)");
        $sql->execute($productsList);

        $i = 0;
        unset($productsList);

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $productId = $row['id'];
            $productCount = $_SESSION['cart'][$productId];

            # Получает изоображение товара
            $imagesArr = [$row['image1'], $row['image2'], $row['image3']];
            $image = Product::getImageProduct($imagesArr);

            $productsList[$i]['id'] = $productId;
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['category_id'] = $row['category_id'];
            $productsList[$i]['count'] = $productCount;
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['image'] = $image;
            $productsList[$i]['total_price'] = $row['price'] * $productCount;

            $i++;
        }

        return $productsList;
    }

    /**
     * Возвращает общую стоимость товаров в корзине
     *
     * @return int
     */
    public static function getTotalPrice()
    {
        $productsList = self::getProductsIncludeData();
        $totalPrice = 0;

        foreach ($productsList as $item) {
            $totalPrice += $item['total_price'];
        }

        return $totalPrice;
    }

    /**
     * Удаляет товар с корзины (вне зависимости от количества)
     *
     * @param $productId
     * @return bool
     */

    public static function removeProduct($productId)
    {
        if (key_exists($productId, $_SESSION['cart'])) {
            unset($_SESSION['cart'][$productId]);

            return true;
        }

        return false;
    }

    /**
     * Изменяет количество единиц продукта в корзине.
     * Удаляет товар из корзины: если $count равен 0.
     *
     * @param $productId
     * @param $count
     * @return bool
     */
    public static function editCountProduct($productId, $count)
    {
        $count = intval($count);

        if ($count < 1) {
            return self::removeProduct($productId);
        }

        if (array_key_exists($productId, $_SESSION['cart'])) {
            $_SESSION['cart'][$productId] = $count;

            return true;
        }

        return false;
    }

    /**
     * Получает количество единиц товара в корзине.
     *
     * @param $productId
     * @return int
     */
    public static function getCountProduct($productId)
    {
        $count = 0;

        if (array_key_exists($productId, $_SESSION['cart'])) {
            $count = $_SESSION['cart'][$productId];
        }

        return $count;
    }

    /**
     * Добавляет/отнимает одну единицу товара
     *
     * @param $productId
     * @param $action
     * @return bool
     */
    public static function incrementOrDecrementCountProduct($productId, $action)
    {
        $result = false;
        $count = self::getCountProduct($productId);

        if ($action == 'increment') {
            $result = self::editCountProduct($productId, $count + 1);
        } else {
            $result = self::editCountProduct($productId, $count - 1);
        }

        return $result;
    }

    /**
     * Проверяет данные из формы "Оформления заказа"
     *
     * @param $name
     * @param $phoneNumber
     * @param $email
     * @return array|bool
     */
    public static function checkDataCheckout($name, $phoneNumber, $email)
    {
        $errors = null;

        if (!User::checkName($name)) $errors[] = 'Некорректное имя: необходимо от 2 до 35 символов.';;
        if (!User::checkPhoneNumber($phoneNumber)) $errors[] = 'Некорректный номер телефона. Необходимый формат: +380xxxxxxx.';;
        if (!User::checkEmailCorrect($email)) $errors[] = 'Некорректный email.';

        if (is_array($errors)) {
            return $errors;
        }

        return true;
    }

    /**
     * Очищает корзину
     */
    public static function clear () {
        unset($_SESSION['cart']);
    }



}