<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

    <div class="page-order">

        <div class="span9" id="content">
            <!-- morris stacked chart -->
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Заказ №<?php echo $order['id'] ?></div>
                    </div>

                    <div class="block-content collapse in">
                            <div id="notise-js"></div>
                    </div>
                    <div class="block-content collapse in">

                        <div class="span12">

                            <div class="span6">
                                <legend>Покупатель</legend>
                                <p>Имя: <?php echo $order['user_name'] ?>

                                    <?php if ($order['user_id']) { ?>

                                        <i>(Пользователь сайта, ID:

                                            <?php echo $order['user_id'] ?>
                                            )</i>

                                    <?php } ?>
                                </p>

                                <p>Email: <?php echo $order['user_email'] ?></p>

                                <?php if ($order['user_phone'] != '') { ?>
                                    <p>Номер телефона: <?php echo $order['user_phone'] ?></p>
                                <?php } ?>

                            </div>

                            <div class="span6">
                                <legend>Данные заказа</legend>
                                <p>Статус заказа:</p>
                                <form action="#">
                                    <select name="status" class="chzn-select">
                                        <?php foreach ($statusesOrder as $status) { ?>

                                            <option value="<?php echo $status['id'] ?>"

                                                <?php if ($status['id'] == $order['status_id']) { ?>
                                                    selected
                                                <?php } ?>

                                            ><?php echo $status['name'] ?></option>

                                        <?php } ?>
                                    </select>
                                </form>
                                <p>Дата заказа: <?php echo $order['date'] ?></p>
                                <p>Стоимость заказа: <?php echo $order['price'] ?> грн.</p>
                            </div>

                            <div class="clear"></div>

                            <table id="products" class="table table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Товар</th>
                                    <th>Колличество</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($order['products'] as $id => $product) { ?>

                                    <tr class="<?php if (!$product['exist']) { ?>error<?php } ?>">
                                        <td>
                                            <a href="/product/<?php echo $id ?>" target="_blank">
                                                <div class="product_image"
                                                     style="background: url(<?php echo $product['image'] ?>)"></div>
                                            </a>
                                        </td>
                                        <td><?php echo $id ?></td>
                                        <td><a href="/product/<?php echo $id ?>" target="_blank">
                                                <?php echo $product['name'] ?>
                                            </a></td>
                                        <td><?php echo $product['count'] ?></td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>

                            <div class="form-actions">
                                <button type="submit"
                                        class="btn btn-primary"
                                        data-action="save"
                                        data-id-order="<?php echo $order['id'] ?>"
                                        style="display:none;">Сохранить</button>
                                <a href="/admin/orders">
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