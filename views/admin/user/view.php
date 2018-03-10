<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

    <div class="page-user">

        <div class="span9" id="content">
            <!-- morris stacked chart -->
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Пользователь: <?php echo $user['name'] ?></div>
                    </div>
                    <div class="block-content collapse in">

                        <div class="span12">
                            <div id="notise-js"></div>

                            <legend>Информация</legend>
                            <p>Имя: <?php echo $user['name'] ?></p>
                            <p>Email: <?php echo $user['email'] ?></p>

                            <?php if ($user['phone_number'] != '') { ?>
                                <p>Номер телефона: <?php echo $user['phone_number'] ?></p>
                            <?php } ?>
                            <p>Дата регистрации: <?php echo date('d.m.Y, H:i', $user['register_data']) ?></p>

                            <legend>Список заказов:</legend>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Стоимость заказа</th>
                                    <th>Дата заказа</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($orders as $order) { ?>
                                    <tr>
                                        <td><?php echo $order['id'] ?></td>
                                        <td><?php echo $order['total_price'] ?> грн.</td>
                                        <td><?php echo date('d.m.Y, H:i', $order['date']) ?></td>
                                        <td>
                                            <span class="badge badge-<?php echo Order::getClassOrderByStatusId($order['status']) ?>">
                                                <?php echo $order['status_name'] ?>
                                            </span>
                                        </td>
                                        <td class="right"><a href="/admin/order/<?php echo $order['id'] ?>">Открыть</a></td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>


                            <div class="form-actions">
                                <a href="/admin/users">
                                    <button type="button" class="btn">Назад</button>
                                </a>
                            </div>

                        </div>


                    </div>

                </div>
                <!-- /block -->
            </div>


        </div>
    </div>


<?php include_once(ROOT . '/views/layouts/admin/footer.php'); ?>