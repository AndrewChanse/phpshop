<?php include ROOT.'/views/layouts/header.php'; ?>
	
<section>
    <div class="container">
	<div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <h3>Данные отредактированы!</h3>
                <div class="signup-form"><!--signup form-->
                    <h2>Редактирование данных пользователя</h2>
                    <form action="#" method="post">
                        <p>Имя:</p>
                        <input type="text" name="name" placeholder="Имя" value=""/>
                        <p>Пароль: (текущее значение: )</p>       
                        <input type="password" name="password" placeholder="Пароль" value=""/>
                        </br>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить"/>
                    </form>
		</div><!--/signup form-->
				<br/>
                                <br/>
            </div>
	</div>
    </div>
</section><!--/form-->
	
<?php include ROOT.'/views/layouts/footer.php'; ?>