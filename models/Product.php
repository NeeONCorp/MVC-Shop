<?php

class Product
{
    # Количество последних товаров на главной странице для отображения
    const LASTED_PRODUCT_SHOW = 5;

    # Количество товаров на одной странице каталога/категории для отображения
    const PRODUCTS_ON_PAGE_CATEGORY_SHOW = 8;

    # Фото продукта по умолчанию
    const DEFAULT_IMAGE = '/template/default/images/empty_image.jpg';

    /**
     * Возвращает массив с последними товарами
     *
     * @count - количество последних товаров для отображения
     * @return array
     */
    public static function getLastedProducts($count = self::LASTED_PRODUCT_SHOW)
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT 
                                        product.*
                                        FROM product, category
                                        WHERE product.status = 1 
                                        AND category.id = product.category_id
                                        AND category.status = 1
                                        ORDER BY product.id DESC 
                                        LIMIT ' . $count);

        $lastedProduct = [];
        $i = 0;

        while ($row = $result->fetch()) {
            # Получает изоображение товара
            $imagesArr = [$row['image1'], $row['image2'], $row['image3']];
            $image = self::getImageProduct($imagesArr);

            $lastedProduct[$i]['id'] = $row['id'];
            $lastedProduct[$i]['category_id'] = $row['category_id'];
            $lastedProduct[$i]['name'] = $row['name'];
            $lastedProduct[$i]['price'] = $row['price'];
            $lastedProduct[$i]['is_new'] = $row['is_new'];
            $lastedProduct[$i]['image'] = $image;

            $i++;
        }

        return $lastedProduct;
    }

    /**
     * Возвращает массив с товарами для каталога
     *
     * @param int $page
     * @return array
     */
    public static function getProducts($page = 1)
    {
        # Показать продукты начиная с first_row
        $first_row = ($page - 1) * self::PRODUCTS_ON_PAGE_CATEGORY_SHOW;

        $db = Db::getConnection();
        $result = $db->query("
                    SELECT 
                    product.* 
                    FROM product, category
                    WHERE product.status = 1 
                    AND product.category_id = category.id 
                    AND category.status = 1
                    ORDER BY product.id DESC
                    LIMIT $first_row, " . self::PRODUCTS_ON_PAGE_CATEGORY_SHOW
        );

        $products = [];
        $i = 0;

        while ($row = $result->fetch()) {
            # Получает изоображение товара
            $imagesArr = [$row['image1'], $row['image2'], $row['image3']];
            $image = self::getImageProduct($imagesArr);

            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['image'] = $image;

            $i++;
        }

        return $products;
    }

    /**
     * Возвращает массив с товарами из заданой категории
     *
     * @param $categoryId
     * @param int $page
     * @return array
     */

    public static function getProductsByCategoryId($categoryId, $page = 1)
    {
        # Показать продукты начиная с first_row
        $first_row = ($page - 1) * self::PRODUCTS_ON_PAGE_CATEGORY_SHOW;

        $db = Db::getConnection();
        $result = $db->query("
                    SELECT * 
                    FROM product 
                    WHERE category_id = $categoryId 
                    AND status = 1
                    ORDER BY id DESC
                    LIMIT $first_row, " . self::PRODUCTS_ON_PAGE_CATEGORY_SHOW
        );

        $products = [];
        $i = 0;

        while ($row = $result->fetch()) {
            # Получает изоображение товара
            $imagesArr = [$row['image1'], $row['image2'], $row['image3']];
            $image = self::getImageProduct($imagesArr);

            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['image'] = $image;

            $i++;
        }

        return $products;
    }

    /**
     * Возвращает массив с данными о товаре
     *
     * @param $productId
     * @param bool $defaultImage - показывать ли стандартное фото, если для товара не добавлено изображений
     * @return array
     */
    public static function getProductById($productId, $defaultImage = true)
    {
        $db = Db::getConnection();
        $result = $db->query("
            SELECT 
            p.id, p.name, p.category_id, p.price, p.is_new, p.brand, p.description, p.status, p.image1, p.image2, 
            p.image3, c.title as categoryName
            FROM 
            product p, category c 
            WHERE p.id = $productId AND p.category_id = c.id
        ");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result = $result->fetch();
        $images = [$result['image1'], $result['image2'], $result['image3']];

        # Оставляем только поля с ссылкой на фото
        for ($i = count($images) - 1; $i >= 0; $i--) {
            if ($images[$i] == '') {
                unset($images[$i]);
            }

            unset($result['image' . $i]);
        }

        $result['images'] = array_values($images);

        if ($defaultImage) {
            if (empty($result['images'])) $result['images'][0] = self::DEFAULT_IMAGE;
        }

        return $result;
    }

    /**
     * Фильтрует значение номера страницы во вкладках: каталог, категория
     *
     * @param $page
     * @return int
     */
    public static function getCleanNumberPage($page)
    {
        $page = preg_replace('/[^0-9+]/', '', $page);

        if ($page < 1) $page = 1;

        return $page;
    }


    /**
     * Проверка на существование продукта
     *
     * @param $productId
     * @return bool
     */
    public static function existProductById($productId)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('SELECT id FROM product WHERE id = :id');
        $sql->execute(['id' => $productId]);

        $result = $sql->fetch();

        if (!$result) return false;

        return true;
    }

    /**
     * Возвращает количество товаров
     *
     * @return mixed
     */
    public static function getTotalCountProducts()
    {
        $db = Db::getConnection();
        $sql = $db->query("SELECT COUNT(*) AS count 
                                     FROM product, category
                                     WHERE product.status = 1 
                                     AND product.category_id = category.id 
                                     AND category.status = 1");
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $result = $result['count'];

        return $result;
    }

    /**
     * Возвращает массив со всеми существующими продуктами
     * для панели администратора
     *
     * @return array
     */
    public static function getProductsAdmin()
    {
        $db = Db::getConnection();
        $query = $db->query('
                          SELECT 
                          p.name, p.id, p.category_id, c.title AS category_name
                          FROM 
                          product p,
                          category c
                          WHERE
                          p.category_id = c.id');
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Удаляет товар с заданным Id
     *
     * @param $productId
     * @return bool
     */
    public static function remove($productId)
    {
        $existProduct = Product::existProductById($productId);

        if ($existProduct) {
            $db = Db::getConnection();
            $query = $db->prepare('DELETE FROM product WHERE id = :id');
            $query->execute(['id' => $productId]);

            return true;
        }

        return false;
    }

    /**
     * Удаляет все фото продукта с заданным id
     *
     * @param $id
     * @return bool
     */
    public static function removeImagesProductById($id)
    {
        if (self::existProductById($id)) {
            $db = Db::getConnection();
            $sql = $db->prepare('SELECT image1, image2, image3 FROM product WHERE id = :productId');
            $sql->execute(['productId' => $id]);

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result[0] as $image) {
                if ($image != '') {
                    $file = ROOT . $image;

                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Проверка имени: неменьше 3x
     *
     * @param $name
     * @return bool
     */
    public static function checkName($name)
    {
        if (mb_strlen($name) < 3) {
            return false;
        } else return true;
    }

    /**
     * Проверка стоимости: больше ноля
     *
     * @param $price
     * @return bool
     */
    public static function checkPrice($price)
    {
        if (is_numeric($price)) {
            if ($price > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Проверка данных при добавлении товара
     *
     * @param $name
     * @param $price
     * @return array|bool
     */
    public static function checkDataAdd($name, $price)
    {
        $errors = null;

        if (!self::checkName($name)) $errors[] = 'Некорректное имя: необходимо от 2 до 35 символов.';
        if (!self::checkPrice($price)) $errors[] = 'Некорректная цена.';

        if (!is_array($errors)) {
            return true;
        }

        return $errors;
    }

    /**
     * Добавляет товар
     *
     * @param $name
     * @param $price
     * @param $categoryId
     * @param $description
     * @param $brand
     * @param $hide
     * @param $new
     * @param $images
     * @return bool
     */
    public static function add($name, $price, $categoryId, $description, $brand, $hide, $new, $images)
    {
        # Заменяем значения
        $hide = AdminBase::convertBooleanInOppositeNumber($hide);
        $new = AdminBase::convertBooleanInNumber($new);

        # Если нужно скрыть категорию, то устанавливаем status '0', и наоборот
        if ($hide == 'true') {
            $status = 0;
        } else {
            $status = 1;
        }

        # Параметры запроса
        $params = [$name, $categoryId, $price, $description, $brand, $hide, $new];

        if (count($images) > 0) {
            # Получает дополнительный SQL код в зависимости от количество фото
            $additionalSql = self::getAdditionalParamsSqlAdd($images);

            # Соеденяем массивы
            $params = array_merge($params, $images);
        }


        $db = Db::getConnection();
        $sql = $db->prepare("INSERT INTO product 
                                (name, category_id, price, description, brand, status, is_new $additionalSql[params])
                                VALUES 
                                (?, ?, ?, ?, ?, ?, ? $additionalSql[placeholders])");
        $result = $sql->execute($params);

        return $result;
    }




    /**
     * Вовзращает дополнительные параметры и плейсхолжеры для SQL запроса 'Добавление товара' в завистимости от
     * количествоа загружаемых фотографий
     *
     * @param array $images
     * @return array
     */
    private static function getAdditionalParamsSqlAdd($images)
    {
        $params = '';
        $placeholders = '';

        for ($i = 1; $i <= count($images); $i++) {
            $params .= ',image' . $i;
            $placeholders .= ',?';
        }

        return ['params' => $params, 'placeholders' => $placeholders];
    }

    /**
     * Загружает фото продукта при добавлении.
     * При успешной загрузки возвращает список загруженных файлов.
     *
     * @param array $images
     * @return array
     */
    public static function uploadPhoto($images)
    {
        $errors = null;
        $imagesList = [];

        foreach ($images as $image) {
            if (is_array($image)) {
                $path = 'images/products';
                $fileName = time() . '-' . rand(1, 255);
                $fileExtension = end(explode('.', $image['name']));

                $result = AdminBase::uploadFile(
                    [
                        'name'     => $image['name'],
                        'tmp_name' => $image['tmp_name']
                    ],
                    [
                        'path' => $path,
                        'name' => $fileName
                    ],
                    ['jpg', 'jpeg', 'png']);

                if (is_array($result)) return ['result' => false, 'text' => $result[0]];

                $imagesList[] = '/uploads/' . $path . '/' . $fileName . '.' . $fileExtension;
            }
        }

        return ['result' => true, 'imageList' => $imagesList];
    }


    /**
     * Обновляет информацию о товаре
     *
     * @param $id
     * @param $name
     * @param $price
     * @param $categoryId
     * @param $description
     * @param $brand
     * @param $hide
     * @param $new
     * @param $images
     * @return bool
     */
    public static function edit($id, $name, $price, $categoryId, $description, $brand, $hide, $new, $images)
    {
        # Заменяем значения
        $hide = AdminBase::convertBooleanInOppositeNumber($hide);
        $new = AdminBase::convertBooleanInNumber($new);

        # Записываем информацию о измененных фото для дальнейшего подставления в запрос
        $addSQL = '';
        $addParams = [];

        foreach ($images as $key => $image) {
            $addSQL .= ',image' . $key . ' = ?';
            $addParams[] = $image;
        }

        # Формируем параметры для передачи в запрос
        $params = [$name, $price, $categoryId, $description, $brand, $hide, $new];
        $params = array_merge($params, $addParams);
        $params = array_merge($params, [$id]);

        # Отправляем запрос
        $db = Db::getConnection();
        $sql = $db->prepare("UPDATE product SET name = ?, price = ?, category_id = ?, description = ?, 
                                       brand = ?, status = ?, is_new = ? $addSQL WHERE id = ?");
        $result = $sql->execute($params);

        return $result;
    }

    /**
     * Загружает изображения продукта при редактировании.
     * При успешной загрузке вернет массив со списком изменений относительно базы данных.
     *
     * Если в базе данных, к примеру, для продукта уже указано значение image1, image3, но не указано image2, то
     * в ходе успешной загрузке функция вернет массив со следующим содержаниям:
     * ['result' => 1, '1' => '', '2' => 'linkImage', 3 => ''].
     *
     * Необходимо для дальнейшего редактирования нужного изображения.
     *
     * @param $images массив из изображениями
     * @return array
     */
    public static function editPhoto($images, $removeImages)
    {
        $editImages = [];

        for ($i = 0; $i < count($images); $i++) {

            # Загружаем и добавляем фото в список
            if ($images[$i] != '') {
                $upload = self::uploadPhoto([$images[$i]]);

                if ($upload['result']) {
                    $editImages[$i + 1] = $upload['imageList'][0];
                } else {
                    return $upload;
                }
            }

            # Удаляем фото при необходимости
            if ($removeImages[$i] == 'true') {
                $editImages[$i + 1] = '';
            }

        }

        return ['result' => true, 'imageList' => $editImages];
    }


    /**
     * Возвращает фото-обложку товара
     *
     * @param array $images
     * @return string
     */
    public static function getImageProduct($images)
    {
        # Фото по умолчанию
        $image = self::DEFAULT_IMAGE;

        # Ищем фото в полях: image1, image2, image3
        foreach ($images as $link) {
            if ($link != '') {
                $image = $link;
                break;
            }
        }

        return $image;
    }

    /**
     * Удаляет все товары в категории с указанным  id
     *
     * @param $categoryId
     * @return bool
     */
    public static function removeProductsByCategoryId($categoryId)
    {
        $categoryId = intval($categoryId);

        $db = Db::getConnection();
        $sql = $db->prepare('DELETE FROM product WHERE category_id = :id');
        $result = $sql->execute(['id' => $categoryId]);

        return $result;
    }


}