<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <h3>Кабинет пользователя</h3>
                <h4>Привет, <?php echo $user['name']; ?>!</h4>
                <ul>
                    <li><a href="/cabinet/edit">Редактировать данные</a></li>

                </ul>

            </div>
        </div>

        <?php if (User::isDirector()) { ?>
            <div class="container">
                <div class="row">
                    <a href="/director/create_task" class="btn btn-default back"><i class="fa fa-plus"></i> Create task</a>
                    <a href="/director/add_from_file" class="btn btn-default back"><i class="fa fa-plus"></i> Add tasks
                        from file</a>
                </div>
            </div>
        <?php } ?>

        <div class="container">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>Task name</th>
                    <?php if ($_SESSION['role'] != 2): ?>
                        <th>Dev name</th>
                    <?php endif; ?>
                    <th>Deadline</th>
                    <th>Status</th>

<?php if ($_SESSION['role'] == 0): ?>
                    <th></th>
                    <th></th>
<?php endif; ?>
                </tr>
                </thead>
                <tbody>

                <?php if ($_SESSION['role'] == 2): ?>
                <?php if (!empty($userTasks)): ?>
                        <?php foreach ($userTasks as $task): ?>
                            <tr>
                                <th><a href="/task/index/<?php echo $task['id_task']; ?>" title="Просмотр задания"><?= $task['task_name'] ?></a></th>
                                <th><?= $task['deadline'] ?></th>
                                <th><input type="checkbox" data-id="<?php echo $task['id_task']; ?>" id="<?php echo $task['id_task']; ?>" <?php if ($task['complete'] == 1) echo ' checked="checked"'; ?>  />
                                    <label for="<?php echo $task['id_task']; ?>"></label>
                                </th>


                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <th colspan="5"><p>Заданий нет, сегодня свободен</p></th>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($_SESSION['role'] == 0): ?>
                <?php if (!empty($tasks)): ?>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <th><a href="/task/index/<?php echo $task['id_task']; ?>" title="Просмотр задания"><?= $task['task_name'] ?></a></th>
                                <th><?= $task['user_id'] ?></th>
                                <th><?= $task['deadline'] ?></th>
                                <th><input type="checkbox" data-id="<?php echo $task['id_task']; ?>" id="<?php echo $task['id_task']; ?>" <?php if ($task['complete'] == 1) echo ' checked="checked"'; ?> />
                                    <label for="<?php echo $task['id_task']; ?>"></label>
                                </th>
                                <th><a href="/task/update/<?php echo $task['id_task']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></th>
                                <th><a href="/task/delete/<?php echo $task['id_task']; ?>" title="Удалить"><i class="fa fa-times"></i></a></th>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <th colspan="6"><p>Простой рабов - не рентабельно, срочно нужны новые проекты!</p></th>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($_SESSION['role'] == 1): ?>
                    <?php if (!empty($tasks)): ?>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <th><a href="/task/index/<?php echo $task['id_task']; ?>" title="Просмотр задания"><?= $task['task_name'] ?></a></th>
                                <th><?= $task['user_id'] ?></th>
                                <th><?= $task['deadline'] ?></th>
                                <th><input type="checkbox" data-id="<?php echo $task['id_task']; ?>" id="<?php echo $task['id_task']; ?>" <?php if ($task['complete'] == 1) echo ' checked="checked"'; ?> />
                                    <label for="<?php echo $task['id_task']; ?>"></label>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <th colspan="5"><p>Работу не дают - пора мутить левачек</p></th>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>