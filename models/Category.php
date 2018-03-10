<?php

class Category extends AdminBase
{
    /**
     * Возвращает массив категорий доступных пользователю
     *
     * @return array
     */
    public static function getCategoriesList()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM category WHERE status = '1'  ORDER BY sort DESC");

        $categories = [];
        $i = 0;

        while ($row = $result->fetch()) {
            $categories[$i]['title'] = $row['title'];
            $categories[$i]['id'] = $row['id'];

            $i++;
        }

        return $categories;
    }

    /**
     * Возвращает массив категорий в которых содержаться последние продукты
     *
     * @count - количество последних товаров для отображения
     * @return array
     */
    public static function getCategoryLastedProducts($count = Product::LASTED_PRODUCT_SHOW)
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT p.category_id, c.title AS category_name 
                                        FROM product p, category c 
                                        WHERE p.category_id = c.id AND p.status = 1 AND c.status = 1
                                        ORDER BY p.id DESC 
                                        LIMIT ' . $count);

        $categoryId = [];
        $categoryLastedProducts = [];

        while ($row = $result->fetch()) {
            if (!in_array($row['category_id'], $categoryId)) {
                array_push($categoryId, $row['category_id']);
                array_push($categoryLastedProducts, [
                    'id'   => $row['category_id'],
                    'name' => $row['category_name']
                ]);
            }
        }

        return $categoryLastedProducts;
    }


    /**
     * Возвращает количество товаров в категории
     *
     * @param $categoryId
     * @return int
     */
    public static function getTotalCountProductsInCategory($categoryId)
    {
        $db = Db::getConnection();
        $sql = $db->prepare("SELECT COUNT(*) AS count FROM product WHERE category_id = ? AND status = 1");
        $sql->execute([$categoryId]);

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $result = $result['count'];

        return $result;
    }

    /**
     * Проверяет существует ли категория с заданым Id
     *
     * @param $id
     * @return bool
     */
    public static function existCategoryById($id)
    {
        $db = Db::getConnection();
        $sql = $db->prepare("SELECT COUNT(*) AS count FROM category WHERE id = :category_id");
        $sql->execute(['category_id' => $id]);

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $result = $result['count'];

        if ($result > 0) return true;

        return false;
    }

    /**
     * Возвращает массив всех категорию
     *
     * @return array
     */
    public static function getCategoriesListAdmin()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT 
                                        c.title,
                                        c.id,
                                        c.status,
                                        c.sort,
                                       (SELECT COUNT(*) FROM product WHERE category_id = c.id) AS count_product
                                       
                                        FROM 
                                        category c
                                        ORDER BY c.sort DESC, c.title ASC");

        $categories = $result->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }


    /**
     * Удаляет категорию с заданым id
     *
     * @param $id
     * @return bool
     */
    public static function removeCategoryById($id)
    {
        $id = intval($id);

        $db = Db::getConnection();
        $sql = $db->prepare('DELETE FROM category WHERE id = :category_id');
        $result = $sql->execute(['category_id' => $id]);

        return $result;
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
     *  Проверка значения 'Сортировка'. Правила:
     * - целое число
     * - больше ноля
     * - меньше 10 000
     *
     * @param $sort
     * @return bool
     */
    public static function checkSort($sort)
    {
        if (preg_match('~^[0-9]+$~', $sort)) {
            $sort = intval($sort);

            if ($sort > 0 && $sort < 10000) {
                return true;
            }
        }

        return false;
    }

    /**
     * Проверка данных при добавлении категории
     *
     * @param $name
     * @param $sort
     * @return array|bool
     */
    public static function checkDataAdd($name, $sort)
    {
        $errors = null;

        if (!self::checkName($name)) $errors[] = 'Некорректное имя категории: должно содержать более 3х символов.';
        if (!self::checkSort($sort)) $errors[] = 'Значение сортировки должно быть целым числом, а так же больше 0 и меньше 10 000.';

        if (!is_array($errors)) {
            return true;
        }

        return $errors;
    }


    /**
     * Добавляет категорию
     *
     * @param $name
     * @param $sort
     * @param $hide
     * @return bool
     */
    public static function add($name, $sort, $hide)
    {
        # Если нужно скрыть категорию, то устанавливаем status '0', и наоборот
        $status = self::convertBooleanInOppositeNumber($hide);

        $db = Db::getConnection();
        $sql = $db->prepare('INSERT INTO category (title, sort, status) VALUES (:name, :sort, :status)');
        $result = $sql->execute([
            'name'   => $name,
            'sort'   => $sort,
            'status' => $status
        ]);

        return $result;
    }

    /**
     * Редактирует категорию с заданым id
     *
     * @param int $id
     * @param array $params - содержит отредактированные данные о товаре
     * @return bool
     */
    public static function editCategoryById($id, $params)
    {
        # Если нужно скрыть категорию, то устанавливаем status '0', и наоборот
        $params['status'] = self::convertBooleanInOppositeNumber($params['hide']);

        $db = Db::getConnection();
        $sql = $db->prepare('UPDATE category 
                                       SET title = :title, sort = :sort, status = :status 
                                       WHERE id = :id');
        $result = $sql->execute([
            'id'     => $id,
            'title'  => $params['name'],
            'sort'   => $params['sort'],
            'status' => $params['status']
        ]);

        return $result;
    }

    /**
     * Возвращает массив с информацией о категории с заданным id
     *
     * @param $id
     * @return array
     */
    public static function getCategoryById($id)
    {
        $db = Db::getConnection();
        $sql = $db->prepare('SELECT * FROM category WHERE id = :categoryId');
        $sql->execute(['categoryId' => $id]);

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Проверяет является ли категория скрытой
     *
     * @param int $id
     * @return boolean
     */
    public static function isHideCategory($id) {
        $category = self::getCategoryById($id);

        if(!$category['status']) return true;

        return false;
    }

}