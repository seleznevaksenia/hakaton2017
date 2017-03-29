<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">

    <h4><?= $result ?></h4>

    <form method="post" action="" enctype="multipart/form-data">
        <div class="input-field col-sm-6">
            <input class="form-control" name="userfile" type="file" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
    </form>

    <br>

    <p>Требования к содержимому файла: </p>
        <ol>
            <li>Предпочтительный формат файла - txt</li>
            <li>Каждая часть задания отмечается соответствующей меткой и занимает только одну строку</li>
            <li>Обязательно к заполнению только название</li>
            <li>Описание и дедлайн можно пропустить</li>
            <li>Задания разделяются пустой строкой (несколькими)</li>
            <li>Между пунктами одного задания не могут находиться пустые строки</li>
            <li>Формат дедлайна строгий: year-month-day HH:mm</li>
        </ol>
        <p>Пример оформления задания: </p>
        <pre>
Task: загрузить задания из файла
Description: заданий в файле несколько
Deadline: 2017-03-30 12:00

Task: посмотреть результат
        </pre>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>