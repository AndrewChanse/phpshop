<?php include ROOT.'/views/layouts/header.php'; ?>
	
<section>
    <div class="container">
	<div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if($result): ?>
                <h3>Данные отредактированы!</h3>
                <?php endif; ?>
                <div class="signup-form"><!--signup form-->
                    <h2>Редактирование данных пользователя</h2>
                    <form action="#" method="post">
                        <p>Имя:</p>
                        <input type="text" name="name" placeholder="Имя" value="<?=$name; ?>"/>
                        <p>Пароль: (текущее значение: <?=$password; ?>)</p>       
                        <input type="password" name="password" placeholder="Пароль" value="<?=$password; ?>"/>
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