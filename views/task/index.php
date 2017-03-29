<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">

                            <div class="product-information"><!--/product-information-->

                                <h2><?php echo $task['task_name']; ?></h2>
                                <p><b>Task Id:</b> <?php echo $task['id_task']; ?></p>
                                <p><b>Dedaline: </b><?php echo $task['deadline']; ?></p>
                                <p><b>Status: </b><?php echo $task['complete']; ?></p>

                            </div><!--/product-information-->

                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <br/>
                            <h5>Описание Задания</h5>
                            <?php echo $task['description']; ?>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>