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
                    <th>Description</th>
                    <?php if ($_SESSION['role'] != 2): ?>
                        <th>Dev name</th>
                    <?php endif; ?>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>хз зачем</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($userTasks)): ?>
                    <?php if ($_SESSION['role'] == 2): ?>
                        <?php foreach ($userTasks as $task): ?>
                            <tr>
                                <th><?= $task['task_name'] ?></th>
                                <th><?= $task['description'] ?></th>
                                <th><?= $task['deadline'] ?></th>
                                <th><?= $task['complete'] ?></th>
                                <th><?= $task['id_task'] ?></th>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php else: ?>
                    <tr>
                        <th colspan="5"><p>Заданий нет, сегодня свободен</p></th>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($tasks)): ?>
                    <?php if ($_SESSION['role'] != 2): ?>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <th><?= $task['task_name'] ?></th>
                                <th><?= $task['description'] ?></th>
                                <th><?= $task['user_id'] ?></th>
                                <th><?= $task['deadline'] ?></th>
                                <th><?= $task['complete'] ?></th>
                                <th><?= $task['id_task'] ?></th>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <tr>
                        <th colspan="6"><p>Простой рабов не рентабельно, срочно нужны новые проекты!</p></th>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>