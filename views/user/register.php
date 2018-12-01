<?php include ROOT.'/views/layouts/header.php'; ?>
	
	<section>
            <div class="container">
		<div class="row">
                    <div class="col-sm-4 col-sm-offset-4 padding-right">
                        <?php if(isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                            <li><?=$error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                        <?php if($result): ?>
			<h3>Вы зарегистрированы!</h3>
                        <?php else: ?>
                        <div class="signup-form"><!--signup form-->
                            <h2>Регистрация на сайте</h2>
                            <form action="#" method="post">
				<input type="text" name="name" placeholder="Имя" value=""/>
                                <input type="email" name="email" placeholder="E-mail" value=""/>
                                <input type="password" name="password" placeholder="Пароль" value=""/>
                                <input type="submit" name="submit" class="btn btn-default" value="Регистрация">
                            </form>
                        </div><!--/signup form-->
                        <?php endif; ?>
			<br/>
                        <br/>
                    </div>
		</div>
            </div>
	</section><!--/form-->
	
<?php include ROOT.'/views/layouts/footer.php'; ?>