<!DOCTYPE html>
<html>

<head>
    <title><?php echo $page['title'] ?></title>

    <meta name="http-equiv" content="Content-type: text/html; charset=UTF-8">
    <meta charset="UTF-8">

    <link rel="shortcut icon" href="/template/default/images/favico.ico" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="/template/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/template/admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="/template/admin/assets/styles.css" rel="stylesheet" media="screen">
    <link href="/template/admin/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="/template/admin/assets/custom_all.css">

    <!--[if lte IE 8]>
    <script language="javascript" type="text/javascript" src="/template/admin/vendors/flot/excanvas.min.js"></script>
    <![endif]-->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="/template/admin/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Admin Panel</a>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3" id="sidebar">
            <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse main-menu">
                <li>
                    <a href="/admin/products"><i class="icon-chevron-right"></i> Товары</a>
                </li>
                <li>
                    <a href="/admin/categories"><i class="icon-chevron-right"></i> Категории</a>
                </li>
                <li>
                    <a href="/admin/orders"><i class="icon-chevron-right"></i> Заказы
                        <?php if (Order::getCountNewOrders() > 0) { ?>
                            <span class="badge badge-success pull-right"><?php echo Order::getCountNewOrders() ?></span>
                        <?php } ?>
                    </a>
                </li>
                <li>
                    <a href="/admin/users"><i class="icon-chevron-right"></i> Зарегистрированные пользователи</a>
                </li>
                <li>
                    <a href="/cabinet/logout"><i class="icon-chevron-right"></i> Выход</a>
                </li>
            </ul>
        </div>
        <!--/span-->