<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Вход на сайт</h2>
                        <form  class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label col-xs-2">Логин</label>
                                    <div class="col-xs-10">
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Введите имя"  name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="control-label col-xs-2">Пароль</label>
                                    <div class="col-xs-10">
                                        <input type="password" class="form-control" id="inputPassword" placeholder="Пароль"  name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-2 col-xs-10">
                                        <div class="checkbox">
                                            <label><input type="checkbox"> Запомнить</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-2 col-xs-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Войти</button>
                                    </div>
                                </div>
                        </form>
                    </div><!--/sign up form-->
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>