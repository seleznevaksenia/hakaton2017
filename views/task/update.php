<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>


            <h4>Редактировать Задание #<?php echo $id; ?></h4>

            <br/>

            <div class="col-sm-8 col-sm-offset-2">
                <div class="login-form">
                    <form action="#" method="post">
                        <div class="input-field">
                            <input type="text" class="form-control" id="task_name" name="task_name"
                                   value="<?= $task['task_name'] ?>">
                            <label for="task_name">Название</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="form-control" id="description" name="description"
                                   value="<?= $task['description'] ?>">
                            <label for="description">Описание</label>
                        </div>
                        <label for="deadline">Дедлайн</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" name="deadline" id="deadline"
                                   value="<?= $task['deadline'] ?>"/>
                            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
                        </div>
                        <div class="input-field">
                           <!-- <input type="text" class="form-control" id="user_id" name="user_id"-->
                            <select id="user_id" >
                                <option value="null">Выберети число</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                                  <!-- value="<?/*= $task['user_id'] */?>"">-->
                            <label for="user_id">Разработчик</label>
                        </div>
                        <div class="input-field col s12">
                            <select name="complete">
                                <option value="1" <?php if ($task['complete'] == 1) echo ' selected="selected"'; ?> >Да
                                </option>
                                <option value="0" <?php if ($task['complete'] == 0) echo ' selected="selected"'; ?> >Нет</option>
                            </select>
                            <label>Статус</label>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-xs-10">
                                <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

