<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <?php if ($result): ?>
                    <p>Вы зарегистрированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Регистрация</h2>
                        <form class="form-horizontal" method="post" action="#">
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="firstName">Имя:</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" id="firstName" placeholder="Введите имя" name="name" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="inputPassword" >Пароль:</label>
                                <div class="col-xs-9">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Введите пароль" name="password" value="<?php echo $password; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="confirmPassword">Подтвердите пароль:</label>
                                <div class="col-xs-9">
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Введите пароль ещё раз" name="passwordRepeat">
                                </div>
                            </div>
                            <div class="form-group ">
                            <label class="radio-inline control-label col-xs-3">
                                <input type="radio" name="role" id="radio1" value="0"> начальник
                            </label>
                            <label class="radio-inline control-label col-xs-3">
                                <input type="radio" name="role" id="radio2" value="1"> тимлид
                            </label>
                            <label class="radio-inline control-label col-xs-3">
                                <input type="radio" name="role" id="radio3" value="2" checked> работник
                            </label>
                            </div>

                            <br />
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-xs-9">
                                    <input type="submit" name="submit"class="btn btn-primary" value="Регистрация">
                                    <input type="reset" class="btn btn-primary" value="Очистить форму">
                                </div>
                            </div>
                        </form>
                    </div><!--/sign up form-->
                
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>