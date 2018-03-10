<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

    <div class="page-orders">

        <div class="span9" id="content">
            <!-- morris stacked chart -->
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Список заказов</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">

                            <div id="notise-js"></div>

                            <p><b>Новые заказы: <span class="badge badge-success pull-right">
                                        <?php echo $countNewOrders ?>
                                    </span></b></p>
                            <table id="new_orders" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Дата заказа</th>
                                    <th>Стоимость заказа</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($newOrders as $order) { ?>

                                    <tr class="category-<?php echo $order['id'] ?>">
                                        <td data-value="id"><?php echo $order['id'] ?></td>
                                        <td>
                                            <?php echo $order['user_name'] ?>
                                            </a>
                                        </td>
                                        <td><?php echo $order['date'] ?></td>
                                        <td><?php echo $order['price'] ?> грн.</td>

                                        <td class="right">
                                            <a href="/admin/order/<?php echo $order['id'] ?>">Открыть</a>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>

                            <br><br>
                            <p><b>Обработанные заказы: <span class="badge badge-info pull-right">
                                        <?php echo $countProcessedOrders ?>
                                    </span></b></p>
                            <table id="processed_orders" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Дата заказа</th>
                                    <th>Стоимость заказа</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($processedOrders as $order) { ?>

                                    <tr class="category-<?php echo $order['id'] ?>">
                                        <td data-value="id"><?php echo $order['id'] ?></td>
                                        <td>
                                            <?php echo $order['user_name'] ?>
                                            </a>
                                        </td>
                                        <td><?php echo $order['date'] ?></td>
                                        <td><?php echo $order['price'] ?> грн.</td>

                                        <td class="icon_control">
                                            <span class="badge badge-<?php echo Order::getClassOrderByStatusId($order['status_id']) ?>">
                                               <?php echo $order['status_name'] ?>
                                            </span>
                                        </td>
                                        <td class="right">
                                            <a href="/admin/order/<?php echo $order['id'] ?>">Открыть</a>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /block -->
            </div>


        </div>
    </div>

<?php include_once(ROOT . '/views/layouts/admin/footer.php'); ?>