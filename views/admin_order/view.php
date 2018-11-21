<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<!--ADMIN_ORDER *VIEW*-->
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Просмотр заказа</li>
                </ol>
            </div>

            <h4>Просмотр заказа #</h4>
            <br/>

            <h5>Информация о заказе:</h5>
            <table class="table-admin-small table-bordered table-striped table">
                <tr>
                    <td>Номер заказа</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Имя клиента</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Телефон клиента</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Комментарий клиента</td>
                    <td></td>
                </tr>
                <tr>
                    <td>ID клиента</td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Статус заказа</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Дата заказа</b></td>
                    <td></td>
                </tr>
            </table>
            <br><br>
            <h5>Товары в заказе:</h5>

            <table class="table-admin-medium table-bordered table-striped table ">
                <tr>
                    <th>ID товара</th>
                    <th>Артикул товара</th>
                    <th>Название</th>
                    <th>Цена за единицу</th>
                    <th>Количество</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Общая стоимость:</b></td>
                    <td><b>$</b></td>
                    <td></td>
                </tr>
            </table>

            <a href="/admin/order/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>


</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
