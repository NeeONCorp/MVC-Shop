<?php include(ROOT . '/views/layouts/default/header.php'); ?>

    <div class="container contact_container page_history_order page_default">
        <div class="row">
            <div class="col">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="#">Кабинет
                                пользователя</a></li>
                        <li class="active"><a href="/cabinet/history_order"><i class="fa fa-angle-right"
                                                                               aria-hidden="true"></i>
                                История заказов
                            </a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-9 get_in_touch_col">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="get_in_touch_contents">
                            <h1 class="margin_bottom35">История заказов</h1>

                            <div id="accordion">

                                <?php if (count($orders) > 0) { ?>

                                    <? for ($i = 0; $i < count($orders); $i++) { ?>

                                        <div class="card">
                                            <div class="card-header" role="tab" id="heading<?php echo $i ?>">
                                                <h5 class="mb-0">
                                                    <!-- Title -->
                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                       href="#collapse<?php echo $i ?>"
                                                       aria-expanded="<?php if (!$i) { ?>true
                                                       <?php } else { ?>
                                                       false
                                                       <?php } ?>"
                                                       aria-controls="collapse<?php echo $i ?>">
                                                        Заказ Id-<?php echo $orders[$i]['id'] ?>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapse<?php echo $i ?>"
                                                 class="collapse <?php if (!$i) { ?>show<?php } ?>"
                                                 role="tabpanel" aria-labelledby="heading<?php echo $i ?>">
                                                <div class="card-block">
                                                    <!-- Content -->
                                                    <div class="data_order">
                                                        <p>Статус: <span
                                                                    class="badge badge-pill badge-<?php echo Order::getClassOrderByStatusId($orders[$i]['status']) ?>"><?php echo $orders[$i]['status_name'] ?></span>
                                                        <p>Дата
                                                            заказа: <?php echo date('d.m.Y, H:i', $orders[$i]['date']) ?></p>
                                                    </div>

                                                    <table class="table history_table">
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Продукт</th>
                                                            <th>Количество</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php foreach ($orders[$i]['products'] as $product) { ?>

                                                            <tr>
                                                                <td>
                                                                    <a href="/product/<?php echo $product['id'] ?>">
                                                                        <div class="cart_image" style="background: url(
                                                                        <?php echo $product['image'] ?>
                                                                                )"></div>
                                                                    </a>
                                                                </td>

                                                                <td>
                                                                    <p>
                                                                        <a href="/product/<?php echo $product['id'] ?>">
                                                                            <?php echo $product['name'] ?>
                                                                        </a>
                                                                    </p>
                                                                </td>
                                                                <td><?php echo $product['count'] ?> шт.</td>
                                                            </tr>

                                                        <?php } ?>

                                                        </tbody>

                                                        <tfoot>
                                                        <tr>
                                                            <th colspan="2">Cумма заказа:</th>
                                                            <th class="total_price"><?php echo $orders[$i]['total_price'] ?>
                                                                грн.
                                                            </th>
                                                            <th></th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    <? } ?>

                                <? } else { ?>

                                    <p><?php echo $user['name'] ?>, Ваша история заказов пока что пуста.</p>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 account_menu">
                <?php echo $navigation ?>
            </div>
        </div>
    </div>

<?php include(ROOT . '/views/layouts/default/footer.php'); ?>