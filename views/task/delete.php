<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br/>



            <h4>Удалить Задание #<?php echo $id; ?></h4>


            <p>Вы действительно хотите удалить этот задание?</p>

            <form method="post">
                <input type="submit" name="submit" value="Удалить" />
            </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

