<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<!--ADMIN_ORDER *UPDATE*-->
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Редактирование заказа</li>
                </ol>
            </div>


            <h4>Редактировать заказ #</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Имя клиента</p>
                        <input type="text" name="userName" placeholder="" value="">

                        <p>Телефон клиента</p>
                        <input type="text" name="userPhone" placeholder="" value="">

                        <p>Комментарий клиента</p>
                        <input type="text" name="userComment" placeholder="" value="">

                        <p>Дата оформления заказа</p>
                        <input type="text" name="date" placeholder="" value="">

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected>Новый заказ</option>
                            <option value="2">В обработке</option>
                            <option value="3">Доставляется</option>
                            <option value="4">Закрыт</option>
                            
                        </select>
                        <br>
                        <br>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>