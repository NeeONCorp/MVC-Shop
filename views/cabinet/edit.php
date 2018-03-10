<?php include(ROOT . '/views/layouts/default/header.php'); ?>

    <div class="container contact_container cabinet-edit page_default">
        <div class="row">
            <div class="col">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="#">Кабинет пользователя</a></li>
                        <li class="active">
                            <a href="/cabinet/edit">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                Редактировать данные</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-9 get_in_touch_col">
                <div class="get_in_touch_contents">
                    <h1 class="margin_bottom35">Редактировать данные</h1>

                    <div class="row">
                        <div class="col-lg-11 get_in_touch_col">
                            <div class="get_in_touch_contents">
                                <div class="card">
                                    <h3 class="card-header">Личные данные</h3>
                                    <div class="card-block">
                                        <p class="card-text">

                                        <div id="notice-js-data"></div>

                                        <div>
                                            <input id="input_email" class="form_input input_email input_ph" type="type"
                                                   name="edit_name" placeholder="Имя" value="<?php echo $user['name'] ?>">
                                            <input id="input_name" class="form_input input_name input_ph" type="text"
                                                   name="edit_phone_number" placeholder="Номер телефона"
                                                   value="<?php echo $user['phone_number'] ?>">
                                        </div>
                                        <div>
                                            <input type="submit" class="btn btn-primary" value="Сохранить изменения"
                                                   name="change_data">
                                        </div>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-11 get_in_touch_col margin_top35">
                            <div class="get_in_touch_contents">
                                <div class="card">
                                    <h3 class="card-header">Безопасность</h3>
                                    <div class="card-block">
                                        <p class="card-text">

                                        <div id="notice-js-password"></div>

                                        <div>
                                            <input id="input_email" class="form_input input_email input_ph" type="password"
                                                   name="edit_password_old" placeholder="Предыдущий пароль">
                                            <input id="input_email" class="form_input input_email input_ph" type="password"
                                                   name="edit_password1" placeholder="Пароль" value="">
                                            <input id="input_name" class="form_input input_name input_ph" type="password"
                                                   name="edit_password2" placeholder="Повторите пароль">
                                        </div>
                                        <div>
                                            <input type="submit" class="btn btn-primary" value="Изменить пароль"
                                                   name="change_password">
                                        </div>

                                        </p>
                                    </div>
                                </div>
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