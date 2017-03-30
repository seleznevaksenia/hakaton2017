<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tasker</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/template/css/animate.css" rel="stylesheet">
        <link href="/template/css/materialize.min.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">

        <script src="/template/js/jquery.js"></script>
        <script src="/template/js/materialize.min.js"></script>
        <script src="/template/js/main.js"></script>

        <link rel="stylesheet" href="/template/css/bootstrap-datetimepicker.min.css" />
    </head><!--/head-->

    <body>


            <header id="header"><!--header-->
                <div class="header_top"><!--header_top-->
                    <div class="container">

                                <div class="contactinfo">
                                    <ul class="nav nav-pills">
                                        <li><a href="#"><i class="fa fa-users"></i> TODO_Win</a></li>
                                    </ul>
                                </div>
                    </div>
                </div>

                <div class="header-middle"><!--header-middle-->
                    <div class="container">
                        <div class="row">
                                <div class="shop-menu pull-right">
                                    <ul class="nav navbar-nav">
                                        <?php if (User::isGuest()): ?>
                                            <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                            <li><a href="/user/register/"><i class="fa fa-registered"></i> Регистрация</a></li>
                                        <?php else: ?>
                                            <li><a href="/cabinet/"><i class="fa fa-user"></i> Аккаунт</a></li>
                                            <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div><!--/header-middle-->



            </header><!--/header-->
