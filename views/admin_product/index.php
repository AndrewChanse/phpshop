<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<!--PRODUCT/INDEX-->
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление товарами</li>
                </ol>
            </div>

            <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить товар</a>
            
            <h4>Список товаров</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID товара</th>
                    <th>Артикул</th>
                    <th>Название товара</th>
                    <th>Цена</th>
                    <th>Редактирование</th>
                    <th>Удаление</th>
                </tr>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?=$product['id']; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="/admin/product/update/" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td><a href="/admin/product/delete/" title="Удалить"><i class="fa fa-times"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

