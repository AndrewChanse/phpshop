<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<!--ADMIN_ORDER *INDEX*-->
<section>
    <div class="container">
        <div class="row">

            <br/>
                        
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление заказами</li>
                </ol>
            </div>

            <h4>Список заказов</h4>

            <br/>

            
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Имя покупателя</th>
                    <th>Телефон покупателя</th>
                    <th>Дата оформления</th>
                    <th>Статус</th>
                    <th>Просмотр</th>
                    <th>Редактирование</th>
                    <th>Удалить заказ</th>
                </tr>
                <tr>
                    <td><a href="/admin/order/view/"></a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="/admin/order/view/" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                    <td><a href="/admin/order/update/" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td><a href="/admin/order/delete/" title="Удалить"><i class="fa fa-times"></i></a></td>
                </tr>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

