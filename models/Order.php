<?php

class Order
{
    /**
     * Создает заказ.
     * Если $userData хранит ключ `id` - значит заказ был сделан авторизованным пользователем.
     * В противном случае массив хранит ключи: `name`, `phone_number`, `email` (гостя).
     *
     * @param $userData
     * @return boolean
     */
    public static function create($userData)
    {
        $db = Db::getConnection();

        $products = Cart::getProducts();
        $products = json_encode($products);
        $totalPrice = Cart::getTotalPrice();
        $date = time();

        if (array_key_exists('id', $userData)) {
            $sql = $db->prepare('
                INSERT INTO 
                order_list
                (id_user, products, price, date)
                VALUES 
                (:id_user, :products, :price, :date)
            ');

            $sql->execute([
                'id_user'  => $userData['id'],
                'products' => $products,
                'price'    => $totalPrice,
                'date'     => $date
            ]);
        } else {
            $sql = $db->prepare('
                INSERT INTO 
                order_list
                (name, number_phone, email, products, price, date)
                VALUES 
                (:name, :number_phone, :email, :products, :price, :date)
            ');

            $sql->execute([
                'name'         => $userData['name'],
                'number_phone' => $userData['phone_number'],
                'email'        => $userData['email'],
                'products'     => $products,
                'price'        => $totalPrice,
                'date'         => $date
            ]);
        }

        return true;
    }

    /**
     * Возвращает .class для блока статуса заказа
     *
     * @param $id
     * @return string
     */
    public static function getClassOrderByStatusId($id)
    {
        $class = null;

        switch ($id) {
            case '1':
                $class = 'warning';
                break;
            case '2':
                $class = 'warning';
                break;
            case '3':
                $class = 'success';
                break;
            default:
                $class = 'primary';
                break;
        }

        return $class;

    }

    /**
     * Возвращает массив с данными о заказах (новых, всех)
     *
     * @param string $type - тип отображаемых заказов (новые/все)
     * @return array
     */
    public static function getOrders($type = 'new')
    {
        # Указываем необходимый тип заказов
        $addSQL = '';
        if ($type == 'new') {
            $addSQL = 'WHERE ol.status = 0';
        } else {
            $addSQL = 'WHERE ol.status != 0';
        }


        $db = Db::getConnection();
        $sql = $db->query("SELECT
                                    ol.id,
                                    ol.date,
                                    ol.price,
                                    ol.id_user AS user_id,
                                    ol.status AS status_id,
                                    os.name AS status_name,
                                    
                                    # Имя пользователя
                                    IF(u.id IS NULL, 
                                    ol.name, 
                                    u.name) as user_name,
                                    
                                    # Номер телефона
                                    IF(u.id IS NULL, 
                                    ol.number_phone, 
                                    u.phone_number) as user_phone,
                                    
                                    # Email
                                    IF(u.id IS NULL, 
                                    ol.email, 
                                    u.email) as user_email
                                    
                                    
                                    FROM
                                    order_list ol
                                    LEFT JOIN user u
                                    ON ol.id_user = u.id
                                    INNER JOIN order_status os 
                                    ON os.id = ol.status
                                    $addSQL
                                    ");

        $orders = [];
        $i = 0;

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $orders[$i]['id'] = $row['id'];
            $orders[$i]['user_name'] = $row['user_name'];
            $orders[$i]['user_phone'] = $row['user_phone'];
            $orders[$i]['user_email'] = $row['user_email'];
            $orders[$i]['price'] = $row['price'];
            $orders[$i]['status_id'] = $row['status_id'];
            $orders[$i]['status_name'] = $row['status_name'];
            $orders[$i]['date'] = date('d.m.Y, H:i', $row['date']);

            $i++;
        }

        return $orders;

    }

    /**
     * Возвращает массив с данными о заказе с заданным Id
     *
     * @param $id
     * @return array
     */
    public static function getOrderById($id)
    {
        # Получаем информацию о заказе
        $db = Db::getConnection();
        $sql = $db->prepare("SELECT
                                    ol.id,
                                    ol.date,
                                    ol.price,
                                    ol.id_user AS user_id,
                                    ol.status AS status_id,
                                    ol.products,
                                    os.name AS status_name,
                                    
                                    # Имя пользователя
                                    IF(u.id IS NULL, 
                                    ol.name, 
                                    u.name) AS user_name,
                                    
                                    # Номер телефона
                                    IF(u.id IS NULL, 
                                    ol.number_phone, 
                                    u.phone_number) AS user_phone,
                                    
                                    # Email
                                    IF(u.id IS NULL, 
                                    ol.email, 
                                    u.email) AS user_email
                                    
                                    
                                    FROM
                                    order_list ol
                                    LEFT JOIN user u
                                    ON ol.id_user = u.id
                                    INNER JOIN order_status os 
                                    ON os.id = ol.status
                                    WHERE ol.id = :order_id
                                    ");
        $sql->execute(['order_id' => $id]);

        $order = $sql->fetch(PDO::FETCH_ASSOC);

        # Приводим данные к нужному виду
        $order['date'] = date('d.m.Y, H:i', $order['date']);
        $order['products'] = json_decode($order['products'], true);

        # Список товаров
        $products = '';
        foreach ($order['products'] as $product => $count) $products .= $product . ',';
        $products = preg_replace('~,$~', '', $products);

        # Получаем информацию о товарах
        $sql = $db->query("SELECT * FROM product WHERE id IN ($products)");
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);

        # Записываем информацию о найденных товарах
        foreach ($products as $product) {
            $productId = $product['id'];

            $image = Product::getImageProduct([$product['image1'], $product['image2'], $product['image3']]);
            $count = $order['products'][$productId];

            $order['products'][$productId] = [
                'name'  => $product['name'],
                'image' => $image,
                'count' => $count,
                'exist' => true
            ];
        }


        # Записываем информацию о ненайденных товарах (если такие есть)
        foreach ($order['products'] as $id => $value) {
            if (!is_array($value)) {
                $image = Product::getImageProduct([]);

                $order['products'][$id] = [
                    'name'  => 'Продукт не найден',
                    'image' => $image,
                    'count' => $value,
                    'exist' => false
                ];
            }
        }

        return $order;

    }

    /**
     * Проверяет существует ли заказ с заданным  Id
     *
     * @param $id
     * @return bool
     */
    public static function existOrderById($id)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('SELECT COUNT(*) AS count FROM order_list WHERE id = :order_id');
        $sql->execute(['order_id' => $id]);

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            return true;
        }

        return false;
    }

    /**
     * Возращает массив со списком существующих статусов заказа
     *
     * @return array
     */
    public static function getStatuses()
    {
        $db = Db::getConnection();
        $sql = $db->query('SELECT * FROM order_status');
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Проверяет существование статуса заказа с указанным Id
     *
     * @param $statusId
     * @return boolean
     */
    public static function existStatusOrderById($statusId)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('SELECT COUNT(*) AS count FROM order_status WHERE id = :status_id');
        $sql->execute(['status_id' => $statusId]);

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) return true;

        return false;
    }

    /**
     * Изменяет статус заказа
     *
     * @param $orderId
     * @param $status
     * @return bool
     */
    public static function editStatusOrder($orderId, $status)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('UPDATE order_list SET status = :status WHERE id = :order_id');
        $result = $sql->execute(['status' => $status, 'order_id' => $orderId]);

        return $result;
    }

    /**
     * Возвращает количество новых заказов
     *
     * @return int
     */
    public static function getCountNewOrders()
    {
        $db = Db::getConnection();
        $sql = $db->query("SELECT COUNT(*) AS count FROM order_list WHERE status = 0");
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $result = $result['count'];

        return $result;
    }

}