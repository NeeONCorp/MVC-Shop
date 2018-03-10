<?php include(ROOT . '/views/layouts/default/header.php'); ?>

    <div class="container contact_container page_default">
        <div class="row">
            <div class="col">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/cart"><i class="fa fa-angle-right" aria-hidden="true"></i>Корзина</a>
                        <li class="active"><a href="/cart"><i class="fa fa-angle-right" aria-hidden="true"></i>
                                Оформление заказа
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 get_in_touch_col">
                <div class="get_in_touch_contents">

                    <?php if ($countProducts > 0) { ?>

                        <div class="card">
                            <h3 class="card-header">Оформление заказа</h3>
                            <div class="card-block">
                                <p class="card-text">
                                    <?php if ($result === true) { ?>
                                <div class="alert alert-success">
                                    <strong>Отлично!</strong> Заказ оформлен, скоро мы свяжемся с Вами.
                                </div>
                                <? } else { ?>

                                    <?php if (is_array($result)) { ?>
                                        <div class="alert alert-danger">
                                            <button class="close" data-dismiss="alert">×</button>
                                            <strong>Ошибка!</strong> <?php echo $result[0] ?>
                                        </div>
                                    <?php } ?>

                                    <p class="card-text">Оставьте свои данные и мы свяжемся с Вами для уточнения деталей
                                        заказа.</p>

                                    <form action="#" method="post">
                                        <?php if ($userId == null) { ?>

                                            <input id="input_name" class="form_input input_email input_ph" type="text"
                                                   name="checkout_name" placeholder="Имя"
                                                   value="<?php echo $_POST['checkout_name'] ?>">
                                            <input id="input_name" class="form_input input_name input_ph" type="text"
                                                   name="checkout_phone_number" placeholder="Номер телефона"
                                                   value="<?php echo $_POST['checkout_phone_number'] ?>">
                                            <input id="input_name" class="form_input input_name input_ph" type="text"
                                                   name="checkout_email" placeholder="Эл. почта"
                                                   value="<?php echo $_POST['checkout_email'] ?>"">

                                        <? } ?>

                                        <input class="btn btn-primary" type="submit" value="Оформить заказ"
                                               name="checkout">
                                    </form>

                                <? } ?>

                                </p>
                            </div>
                        </div>


                    <?php } else { ?>
                        <p>Товары в корзине отсутствуют.</p>
                    <?php } ?>

                </div>
            </div>

        </div>
    </div>

<?php include(ROOT . '/views/layouts/default/footer.php'); ?>