<?php

class AdminOrderController extends AdminBase
{
    /**
     * Страница "Список заказов"
     */
    public function actionIndex()
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Новые заказы
        $newOrders = Order::getOrders('new');
        $countNewOrders = count($newOrders);

        # Обработаные заказы
        $processedOrders = Order::getOrders('processed');
        $countProcessedOrders = count($processedOrders);

        # Заголовок страницы
        $page = ['title' => 'Список заказов'];

        include_once(ROOT . '/views/admin/order/index.php');
    }

    /**
     * Страница "Просмотр заказа"
     *
     * @param $id
     */
    public function actionView($id)
    {
        # Проверка прав администратора
        self::checkAdmin();

        # Проверить существование заказа
        $existOrder = Order::existOrderById($id);

        # Получить список статусов заказа
        $statusesOrder = Order::getStatuses();


        if ($existOrder) {
            # Получаем данные о заказе
            $order = Order::getOrderById($id);
        } else App::locationPageNotFound();

        # Заголовок страницы
        $page = ['title' => 'Заказ №' . $order['id']];

        include_once(ROOT . '/views/admin/order/view.php');
    }

    /**
     * Изменяет статус заказа
     *
     * @param $orderId
     * @param $statusId
     */
    public function actionEditStatus($orderId, $statusId)
    {
        # Проверка прав администратора
        self::checkAdmin();

        $errors = false;
        $statusId = preg_replace('~[^0-9]~', '', $statusId);

        # Проверить существование заказа
        if (!Order::existOrderById($orderId)) $errors = true;

        # Проверить существование статуса заказа
        if (!Order::existStatusOrderById($statusId)) $errors = true;

        # Изменить статус
        if (!$errors) Order::editStatusOrder($orderId, $statusId);

        # Ответ
        if (!$errors) echo 'success';
    }
}