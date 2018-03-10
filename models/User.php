<?php

class User
{
    /**
     * Проверка данных при регистрации.
     */
    public static function checkDataRegister($name, $email, $password1, $password2)
    {
        $errors = null;

        if (!self::checkName($name)) $errors[] = 'Некорректное имя: необходимо от 2 до 35 символов.';
        if (!self::checkEmailCorrect($email)) $errors[] = 'Некорректный email.';
        if (!self::checkEmailExist($email)) $errors[] = 'Данный эл. адрес уже зарегистрирован в системе.';
        if (!self::checkPassword($password1)) $errors[] = 'Некорректный пароль: необходимо от 6 символов.';
        if (!self::comparePasswords($password1, $password2)) $errors[] = 'Пароли не совпадают.';

        if (!isset($errors)) {
            return true;
        } else {
            return $errors;
        }
    }

    /**
     * Проверка имени: неменьше 2х, не больше 35 символов
     */
    public static function checkName($name)
    {
        if (mb_strlen($name) < 2 || mb_strlen($name) > 35) {
            return false;
        } else return true;
    }

    /**
     * Проверка email на валидность
     */
    public static function checkEmailCorrect($email)
    {
        if (filter_var(($email), FILTER_VALIDATE_EMAIL)) {
            return true;
        } else return false;
    }

    /**
     * Проверка email на уникальность
     */
    public static function checkEmailExist($email)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('SELECT id FROM user WHERE email = :email');
        $sql->execute(['email' => $email]);

        if (count($sql->fetchAll()) > 0) {
            return false;
        } else return true;
    }

    /**
     * Проверка пароль: неменьше 6и символов
     */
    public static function checkPassword($password)
    {
        if (mb_strlen($password) < 6) {
            return false;
        } else return true;
    }

    /**
     * Проверка паролей на идентичность
     */
    public static function comparePasswords($password1, $password2)
    {
        if ($password1 != $password2) {
            return false;
        } else return true;
    }

    /**
     * Регистрация пользователя
     *
     * @param $name
     * @param $email
     * @param $password
     * @return bool
     */
    public static function register($name, $email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = Db::getConnection();
        $sql = $db->prepare('INSERT INTO user (name, email, password, register_data) VALUES (:name, :email, :password, :time)');
        $result = $sql->execute([
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
            'time'     => time()
        ]);

        return $result;
    }

    /**
     * Проверка данных при авторизации.
     *
     * Возвращает ID пользователя если данные корректны
     * и FALSE в противном случае.
     */
    public static function checkDataLogin($email, $password)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('SELECT id, password FROM user WHERE email = :email');
        $sql->execute(['email' => $email]);
        $result = $sql->fetchAll();

        $errors = null;

        if (count($result) > 0) {
            if (password_verify($password, $result[0]['password'])) {
                return $result[0]['id'];
            } else $errors[] = 'Пароль неверный.';
        } else $errors[] = 'Email не найден в системе.';


        return $errors;
    }

    /**
     * Авторизируем пользователя
     */
    public static function auth($userId)
    {
        $_SESSION['user']['id'] = $userId;
        header('Location: /cabinet/history_order');
    }

    /**
     * Проверяет авторизирован ли пользователь.
     * Вернет ID пользователя или перенаправит
     * на страницу входа
     */
    public static function checkLogged()
    {
        $userId = $_SESSION['user']['id'];

        if ($userId > 0) {
            return $userId;
        } else {
            header('Location: /login');
        }
    }

    /**
     * Проверяет является ли пользователь гостем
     */
    public static function isGuest()
    {
        if ($_SESSION['user']['id'] > 0) {
            return false;
        } else return true;
    }

    /**
     * Выходим с профиля пользователя
     */
    public static function logout()
    {
        unset($_SESSION['user']);
        header('Location: /login');
    }

    /**
     * Вернет массив с информацией о пользователе
     */
    public static function getUserById($userId)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('SELECT * FROM user WHERE id = :id');
        $sql->execute(['id' => $userId]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Проверка номера телефона
     */
    public static function checkPhoneNumber($phoneNumber)
    {
        if (preg_match('/^[+]380[0-9]{9}+$/', $phoneNumber)) {
            return true;
        } else return false;
    }

    /**
     * Проверяем корректность данных для формы
     * "Личные данные"
     */
    public static function checkEditData($name, $phoneNumber)
    {
        $errors = null;

        if (!self::checkName($name)) $errors[] = 'Некорректное имя: необходимо от 2 до 35 символов.';
        if (!self::checkPhoneNumber($phoneNumber)) $errors[] = 'Некорректный номер телефона. Необходимый формат: +380xxxxxxx.';

        if (!is_array($errors)) {
            return true;
        }

        return $errors;
    }

    /**
     * Редактируем "Личные данные" пользователя
     */
    public static function editData($name, $phoneNumber, $idUser)
    {
        $name = App::clearStr($name);

        $db = Db::getConnection();
        $sql = $db->prepare('UPDATE user SET name=:name, phone_number=:phone_number WHERE id=:id');
        $result = $sql->execute(['name' => $name, 'phone_number' => $phoneNumber, 'id' => $idUser]);

        return $result;
    }

    /**
     * Проверяем коректность данных для формы
     * "Безопасность"
     */
    public static function checkEditPassword($passwordOld, $password1, $password2, $idUser)
    {
        $errors = null;

        if (!self::checkPasswordOld($passwordOld, $idUser)) $errors[] = 'Старый пароль введен неверно.';
        if (!self::checkPassword($password1)) $errors[] = 'Некорректный пароль: необходимо от 6 символов.';
        if (!self::comparePasswords($password1, $password2)) $errors[] = 'Пароли не совпадают.';

        if (!is_array($errors)) {
            return true;
        }

        return $errors;
    }

    /**
     * Проверяет правильно ли введен старый пароль от профиля
     *
     * @param $password
     * @param $idUser
     * @return bool
     */
    public static function checkPasswordOld($password, $idUser)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('SELECT password FROM user WHERE id = :id');
        $sql->execute(['id' => $idUser]);

        $result = $sql->fetch();


        if (password_verify($password, $result['password'])) {
            return true;
        }

        return false;
    }

    /**
     * Изменяет пароль пользователя
     */
    public static function editPassword($password, $idUser)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = Db::getConnection();
        $sql = $db->prepare('UPDATE user SET password = :password WHERE id = :id');
        $result = $sql->execute(['password' => $password, 'id' => $idUser]);

        return $result;
    }

    /**
     * Возвращает массив с заказами пользователя
     *
     * @param $id
     * @return array
     */
    public static function getOrdersByUserId($id)
    {
        $db = Db::getConnection();

        $sql = $db->prepare('
          SELECT 
          ol.id, ol.price, ol.status, ol.date, ol.products,
          os.name AS status_name
          FROM 
          order_list ol,
          order_status os
          WHERE 
          ol.id_user = :id AND 
          ol.status = os.id
          ORDER BY ol.id DESC
          ');
        $sql->execute(['id' => $id]);

        $orders = [];
        $i = 0;

        while ($row = $sql->fetch()) {
            $j = 0;

            $products = $row['products'];
            $products = json_decode($products, true);

            $orders[$i]['id'] = $row['id'];
            $orders[$i]['total_price'] = $row['price'];
            $orders[$i]['status_name'] = $row['status_name'];
            $orders[$i]['status'] = $row['status'];
            $orders[$i]['date'] = $row['date'];

            # Получает данные о товаре
            foreach ($products as $product => $count) {
                $queryProduct = $db->prepare('SELECT name, image1, image2, image3 FROM product WHERE id = :id');
                $queryProduct->execute(['id' => $product]);
                $productData = $queryProduct->fetch();

                # Получает изоображение товара
                $imagesArr = [$productData['image1'], $productData['image2'], $productData['image3']];
                $image = Product::getImageProduct($imagesArr);

                $orders[$i]['products'][$j]['id'] = $product;
                $orders[$i]['products'][$j]['count'] = $count;
                $orders[$i]['products'][$j]['name'] = $productData['name'];
                $orders[$i]['products'][$j]['image'] = $image;

                $j++;
            }

            $i++;
        }

        return $orders;
    }

    /**
     * Проверяет является ли пользователь администратором
     *
     * @param $id
     * @return bool
     */
    public static function isAdmin($id)
    {
        $db = Db::getConnection();
        $query = $db->prepare('SELECT id FROM admin WHERE user_id = :user_id');
        $query->execute(['user_id' => $id]);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return true;
        }

        return false;

    }

    /**
     * Возвращает  массив с данными о всех пользователях
     *
     * @return array
     */
    public static function getUsers()
    {
        $db = Db::getConnection();
        $sql = $db->query("SELECT 
                                     DISTINCT user.*,
                                    (SELECT COUNT(*) FROM order_list WHERE order_list.id_user = user.id) AS count_orders
                                     FROM user");

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        # Приводим данные к нужному виду
        foreach ($result as $index => $user) {
            $result[$index]['register_data'] = date('d.m.Y, H:i', $user['register_data']);
        }

        return $result;
    }

    /**
     * Проверяет существование пользователя с заданным Id
     *
     * @param $id
     * @return boolean
     */
    public static function existUserById ($id) {
        $db = Db::getConnection();
        $sql = $db->prepare("SELECT COUNT(*) AS count FROM user WHERE id = :userId");
        $sql->execute(['userId' => $id]);

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        if($result['count'] > 0) return true;

        return false;
    }
}