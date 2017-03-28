<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">

<h4><?= $result ?></h4>

<form method="post" action="">
        <div class="input-field">
            <input type="text" class="form-control" id="task_name" name="task_name" required>
            <label for="task_name">Название</label>
        </div>
        <div class="input-field">
            <input type="text" class="form-control" id="description" name="description">
            <label for="description">Описание</label>
        </div>
        <label for="deadline">Дедлайн</label>
        <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" name="deadline" id="deadline"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-10">
                <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
</form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>