<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<!--ADMIN_PRODUCT/UPDATE-->
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li class="active">Редактировать товар</li>
                </ol>
            </div>


            <h4>Редактирование товара # <?=$id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название товара</p>
                        <input type="text" name="name" placeholder="" value="<?=$options['name']; ?>">

                        <p>Артикул</p>
                        <input type="text" name="code" placeholder="" value="<?=$options['code']; ?>">

                        <p>Стоимость, $</p>
                        <input type="text" name="price" placeholder="" value="<?=$options['price']; ?>">

                        <p>Категория</p>
                        <select name="category_id">
                            <?php foreach ($categorySelect as $category): ?>
                            <option value="<?=$category['id']; ?>" <?php if($category['id'] == $product['category_id']) echo 'selected'; ?>><?=$category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                        <br/><br/>

                        <p>Производитель</p>
                        <input type="text" name="brand" placeholder="" value="<?=$options['brand']; ?>">

                        <p>Изображение товара</p>
                        <img src="<?=Product::getImage($id); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="">

                        <p>Детальное описание</p>
                        <textarea name="description"><?=$options['description']; ?></textarea>
                        
                        <br/><br/>

                        <p>Наличие на складе</p>
                        <select name="availability">
                            <option value="1" <?php if($options['availability'] == 1) echo 'selected'; ?>>Да</option>
                            <option value="0" <?php if($options['availability'] == 0) echo 'selected'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>
                        
                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" <?php if($options['is_new'] == 1) echo 'selected'; ?>>Да</option>
                            <option value="0" <?php if($options['is_new'] == 0) echo 'selected'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>Рекомендуемые</p>
                        <select name="is_recommended">
                            <option value="1" <?php if($options['is_recommended'] == 1) echo 'selected'; ?>>Да</option>
                            <option value="0" <?php if($options['is_recommended'] == 0) echo 'selected'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if($options['status'] == 1) echo 'selected'; ?>>Отображается</option>
                            <option value="0" <?php if($options['status'] == 0) echo 'selected'; ?>>Скрыт</option>
                        </select>
                        
                        <br/><br/>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        
                        <br/><br/>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

