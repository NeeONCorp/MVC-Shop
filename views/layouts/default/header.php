<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page['title'] ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">

    <link rel="shortcut icon" href="/template/default/images/favico.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="/template/default/styles/bootstrap4/bootstrap.min.css">
    <link href="/template/default/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/template/default/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/template/default/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="/template/default/plugins/OwlCarousel2-2.2.1/animate.css">

    <link rel="stylesheet" type="text/css" href="/template/default/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/template/default/plugins/noty/noty.css">
    <link rel="stylesheet" type="text/css" href="/template/default/plugins/noty/metroui.css">
    <link rel="stylesheet" type="text/css" href="/template/default/styles/custom_all.css">

    <?php if (isset($additionalCss)) { ?>
        <?php echo $additionalCss ?>
    <?php } else { ?>
        <link rel="stylesheet" href="/template/default/styles/contact_styles.css">
        <link rel="stylesheet" href="/template/default/styles/contact_responsive.css">
    <?php } ?>
</head>
<body>

<div class="super_container">

    <!-- Header -->

    <header class="header trans_300">

        <!-- Top Navigation -->

        <div class="top_nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="top_nav_left">Example web shop</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="top_nav_right">
                            <ul class="top_nav_menu">
                                <?php if (User::isGuest()) { ?>
                                    <li class="account">
                                        <a href="/login">Вход</a>
                                    </li>
                                    <li class="account">
                                        <a href="/login">Регистрация</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="account">
                                        <a href="/cabinet/history_order">
                                            Профиль
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="account_selection">
                                            <li><a href="/cabinet/logout"><i class="fa fa-sign-in"
                                                                             aria-hidden="true"></i>Выход</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->

        <div class="main_nav_container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <div class="logo_container">
                            <a href="/">colo<span>shop</span></a>
                        </div>
                        <nav class="navbar">
                            <ul class="navbar_menu">
                                <li><a href="/">Главная</a></li>
                                <li><a href="/categories">Каталог</a></li>
                                <li><a href="/contact">Контакты</a></li>
                            </ul>
                            <ul class="navbar_user">
                                <?php if (!User::isGuest()) { ?>
                                    <li><a href="/cabinet/history_order"><i class="fa fa-user"
                                                                            aria-hidden="true"></i></a></li>
                                <?php } ?>
                                <li class="checkout">
                                    <a href="/cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="checkout_items"
                                              class="checkout_items"><?php echo Cart::getCountItems() ?></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="hamburger_container">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <div class="fs_menu_overlay"></div>

    <!-- Hamburger Menu -->

    <div class="hamburger_menu">
        <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="hamburger_menu_content text-right">
            <ul class="menu_top_nav">
                <li class="menu_item"><a href="/">Главная</a></li>

                <?php if (User::isGuest()) { ?>
                    <li class="menu_item"><a href="/login">Вход - Регистрация</a></li>
                <?php } else { ?>
                    <li class="menu_item"><a href="/login">Профиль</a></li>
                <?php } ?>

                <li class="menu_item"><a href="/categories">Каталог</a></li>
                <li class="menu_item"><a href="/contact">Контакты</a></li>
            </ul>
        </div>
    </div>