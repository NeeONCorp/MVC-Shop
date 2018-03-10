<?php include(ROOT . '/views/layouts/default/header.php'); ?>


    <div class="container contact_container page_default">
        <div class="row">
            <div class="col">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li class="active">
                            <a href="/login"><i class="fa fa-angle-right" aria-hidden="true"></i>Вход - Регистрация</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- Contact Us -->

        <div class="row">
            <div class="col-lg-6 get_in_touch_col">
                <div class="get_in_touch_contents">
                    <div class="card">
                        <h3 class="card-header">Авторизация</h3>
                        <div class="card-block">

                            <?php if (is_array($resultLogin)) { ?>
                                <div class="alert alert-danger">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <strong>Ошибка!</strong> <?php echo $resultLogin[0] ?>
                                </div>
                            <?php } ?>

                            <p class="card-text">Уже есть аккаунт? Вы можете войти прямо сейчас.</p>
                            <p class="card-text">
                            <form method="post" action="#">
                                <div>
                                    <input id="input_email" class="form_input input_email input_ph" type="email"
                                           name="login_email" placeholder="Эл. почта"
                                           value="<?php echo $login['email'] ?>">
                                    <input id="input_name" class="form_input input_name input_ph" type="password"
                                           name="login_password" placeholder="Пароль">
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary" value="Войти" name="login">
                                </div>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 get_in_touch_col">
                <div class="get_in_touch_contents">
                    <div class="card">
                        <h3 class="card-header">Регистрация</h3>
                        <div class="card-block">
                            <?php if ($resultRegister === true) { ?>
                                <div class="alert alert-success">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <strong>Отлично!</strong> Ваш профиль был создан и теперь Вы можете выполнить вход.
                                </div>
                            <? } else {
                                if (is_array($resultRegister)) { ?>
                                    <div class="alert alert-danger">
                                        <button class="close" data-dismiss="alert">×</button>
                                        <strong>Ошибка!</strong> <?php echo $resultRegister[0] ?>
                                    </div>
                                <?php } ?>

                                <p class="card-text">Создайте аккаунт прямо сейчас, если вы еще не успели этого сделать.</p>
                                <p class="card-text">
                                <form method="post" action="#">
                                        <input id="input_name" class="form_input input_email input_ph" type="text"
                                               name="register_name" placeholder="Имя"
                                               value="<?php echo $register['name'] ?>">
                                        <input id="input_email" class="form_input input_name input_ph" type="email"
                                               name="register_email" placeholder="Эл. почта"
                                               value="<?php echo $register['email'] ?>">
                                        <input id="input_name" class="form_input input_name input_ph" type="password"
                                               name="register_password1" placeholder="Пароль"
                                               value="<?php echo $register['password1'] ?>">
                                        <input id="input_name" class="form_input input_name input_ph" type="password"
                                               name="register_password2" placeholder="Повторите пароль"
                                               value="<?php echo $register[''] ?>">
                                        <input type="submit" class="btn btn-primary"
                                               value="Зарегистрироваться" name="register">
                                </form>
                            <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


<?php include(ROOT . '/views/layouts/default/footer.php'); ?>