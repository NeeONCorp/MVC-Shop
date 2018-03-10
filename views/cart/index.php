<?php include(ROOT . '/views/layouts/default/header.php'); ?>

    <div class="container contact_container page_default">
        <div class="row">
            <div class="col">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li class="active"><a href="/cart"><i class="fa fa-angle-right" aria-hidden="true"></i>Корзина</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 get_in_touch_col">
                <div class="get_in_touch_contents">
                    <h1 class="margin_bottom35">Корзина (<?php echo $countItems ?>)</h1>
                </div>
            </div>

            <div class="col-lg-12 get_in_touch_col">
                <div class="get_in_touch_contents">

                    <?php if ($countItems > 0) { ?>

                        <div class="table-responsive">
                            <table class="table cart_table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Продукт</th>
                                    <th>Количество</th>
                                    <th>Цена</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($products as $product) { ?>

                                    <tr>
                                        <td>
                                            <a href="/product/<?php echo $product['id'] ?>">
                                                <div class="cart_image" style="background: url(<?php echo $product['image'] ?>)"></div>
                                            </a>
                                        </td>
                                        <td><?php echo $product['id'] ?></td>
                                        <td>
                                            <p>
                                                <a href="/product/<?php echo $product['id'] ?>">
                                                    <?php echo $product['name'] ?>
                                                </a>
                                            </p>
                                        </td>
                                        <td>
                                            <form action="#" method="post">
                                                <input type="submit" value="-" name="edit_count" class="button_edit_product">
                                                <input type="text" name="edit_count_action" value="decrement" hidden>
                                                <input type="text" name="edit_count_id" value="<?php echo $product['id'] ?>" hidden>
                                            </form>

                                            <?php echo $product['count'] ?> шт.

                                            <form action="#" method="post">
                                                <input type="submit" value="+" name="edit_count" class="button_edit_product">
                                                <input type="text" name="edit_count_action" value="increment" hidden>
                                                <input type="text" name="edit_count_id" value="<?php echo $product['id'] ?>" hidden>
                                            </form>
                                        </td>
                                        <td><?php echo $product['total_price'] ?> грн.</td>
                                        <td>
                                            <form action="#" method="post">
                                                <button type="submit" value="trash" name="remove_product" class="button_edit_product">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <input type="text" name="product_id" value="<?php echo $product['id'] ?>" hidden>
                                            </form>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th colspan="4">Общая стоимость:</th>
                                    <th class="total_price"><?php echo $totalPrice ?> грн.</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <a class="btn btn-primary" href="/cart/checkout">Оформить заказ</a>

                    <?php } else { ?>
                        <p>Вы еще ничего не добавили в корзину! Исправьте это немедленно :)</p>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

<?php include(ROOT . '/views/layouts/default/footer.php'); ?>