<?php include ROOT . '/views/layouts/header.php'; ?>
<!--CART-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categoryList as $category): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="/category/<?=$category['id']; ?>"><?=$category['name']; ?></a></h4>
                                    </div>
                                </div>
                              <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <?php if ($productsInCart): ?>
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>
                    <p>Вы выбрали такие товары:</p>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Код товара</th>
                                <th>Название</th>
                                <th>Стомость, грн</th>
                                <th>Количество, шт</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?=$product['code']; ?></td>
                                <td><a href="/product/<?=$product['id']; ?>"><?=$product['name']; ?></a></td>
                                <td><?=$product['price']; ?></td>
                                <td><?=$productsInCart[$product['id']]; ?></td>
                                <td>
                                    <a class="btn btn-default checkout" href="/cart/delete/<?=$product['id']; ?>">
                                            <i class="fa fa-times"></i>
                                    </a>
                                </td>                        
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                    <td colspan="3">Общая стоимость, грн:</td>
                                    <td><b><?=$totalPrice; ?></b></td>
                                    <td></td>
                                </tr>
                            
                        </table>
                        
                        
                        <a class="btn btn-default checkout" href="/cart/checkout"><i class="fa fa-shopping-cart"></i> Оформить заказ</a>
                        <?php else: ?>
                        <p>Корзина пуста</p>
                                                
                        <a class="btn btn-default checkout" href="/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
                </div>
                <?php endif; ?>

                
                
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>