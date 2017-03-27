<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="main">
    <div class="container">
        <div class="row">

            <div class="col-sm-5 col-sm-offset-4 padding-right">
                
                <?php if ($result): ?>
                    <p>Вы зарегистрированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul class="errorlist">
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Регистрация</h2>
                        <form method="post" action="#">
                            <div class="input-field">
                                <input type="text" class="form-control" id="firstName" name="name" value="<?php echo $name; ?>">
                                <label for="firstName">Имя</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo $password; ?>">
                                <label for="inputPassword" >Пароль</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="form-control" id="confirmPassword" name="passwordRepeat">
                                <label for="confirmPassword">Подтвердите пароль</label>
                            </div>



                            <div class="form-group ">
                                <p>
                                    <input class="with-gap" type="radio" name="role" id="radio1" value="0">
                                    <label for="radio1">начальник</label>
                                </p>
                                <p>
                                    <input class="with-gap" type="radio" name="role" id="radio2" value="1">
                                    <label for="radio2">тимлид</label>
                                </p>
                                <p>
                                    <input class="with-gap" type="radio" name="role" id="radio3" value="2" checked>
                                    <label for="radio3">работник</label>
                                </p>
                                </div>
                            </div>

                            <br />
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-5">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Регистрация">
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