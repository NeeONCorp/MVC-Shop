<?php include(ROOT . '/views/layouts/default/header.php'); ?>

    <div class="container contact_container page_default">

        <div class="row">
            <div class="col">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li class="active">
                            <a href="/contact"><i class="fa fa-angle-right" aria-hidden="true"></i>Связь с нами</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">

            <div class="col-lg-6 contact_col">
                <div class="contact_contents">
                    <h1>Свяжитесь с нами</h1>
                    <p>There are many ways to contact us. You may drop us a line, give us a call or send an email,
                        choose
                        what suits you the most.</p>
                    <div>
                        <p>(800) 686-6688</p>
                        <p>info.deercreative@gmail.com</p>
                    </div>
                    <div>
                        <p>Open hours: 8.00-18.00 Mon-Fri</p>
                        <p>Sunday: Closed</p>
                    </div>
                </div>

                <!-- Follow Us -->

                <div class="follow_us_contents">
                    <h1>Follow Us</h1>
                    <ul class="social d-flex flex-row">
                        <li><a href="#" style="background-color: #3a61c9"><i class="fa fa-facebook"
                                                                             aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" style="background-color: #41a1f6"><i class="fa fa-twitter"
                                                                             aria-hidden="true"></i></a></li>
                        <li><a href="#" style="background-color: #fb4343"><i class="fa fa-google-plus"
                                                                             aria-hidden="true"></i></a></li>
                        <li><a href="#" style="background-color: #8f6247"><i class="fa fa-instagram"
                                                                             aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="col-lg-6 get_in_touch_col">
                <div class="get_in_touch_contents">
                    <h1>Обратная связь</h1>
                    <p>Есть вопросы? Напишите нам.</p>

                    <?php if ($resultSend === true) { ?>
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Отлично!</strong> Ваше сообщение было доставлено.
                        </div>
                    <?php } else { ?>

                        <?php if (is_array($resultSend)) { ?>
                            <div class="alert alert-danger">
                                <button class="close" data-dismiss="alert">×</button>
                                <strong>Ошибка!</strong> <?php echo $resultSend[0] ?>
                            </div>
                        <?php } ?>

                        <form method="post" action="#">
                            <div>
                                <input id="input_name" class="form_input input_name input_ph" type="text"
                                       placeholder="Имя" name="contact_name" value="<?php echo $send['name'] ?>">
                                <input id="input_email" class="form_input input_email input_ph" type="email"
                                       placeholder="Эл. почта" name="contact_email"
                                       value="<?php echo $send['email'] ?>">
                                <textarea id="input_message" class="input_ph input_message" placeholder="Сообщение"
                                          name="contact_message"><?php echo $send['message'] ?></textarea>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary" value="Отправить" name="send">
                            </div>
                        </form>

                    <?php } ?>

                </div>
            </div>

        </div>
    </div>
    </div>

<?php include(ROOT . '/views/layouts/default/footer.php'); ?>