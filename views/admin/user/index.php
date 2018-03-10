<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

    <div class="page-users">

        <div class="span9" id="content">
            <!-- morris stacked chart -->
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Список пользователей</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">

                            <div id="notise-js"></div>

                            <table id="new_orders" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Дата регистрации</th>
                                    <th>Количество заказов</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($users as $user) { ?>

                                    <tr class="category-<?php echo $user['id'] ?>">
                                        <td data-value="id"><?php echo $user['id'] ?></td>
                                        <td>
                                            <?php echo $user['name'] ?>
                                            </a>
                                        </td>
                                        <td><?php echo $user['register_data'] ?></td>
                                        <td><?php echo $user['count_orders'] ?></td>

                                        <td class="right">
                                            <a href="/admin/user/<?php echo $user['id'] ?>">Открыть</a>
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