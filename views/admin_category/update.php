<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<!--ADMIN_CATEGORY/UPDATE-->
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li class="active">Редактирование категории</li>
                </ol>
            </div>


            <h4>Редактировать категорию "<?=$category['name']; ?>"</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Название</p>
                        <input type="text" name="name" placeholder="" value="<?=$name; ?>">

                        <p>Порядковый номер</p>
                        <input type="text" name="sort_order" placeholder="" value="<?=$sort_order; ?>">
                        
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if($status == 1) echo 'selected'; ?>>Отображается</option>
                            <option value="0" <?php if($status == 0) echo 'selected'; ?>>Скрыта</option>
                        </select>

                        <br><br>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

