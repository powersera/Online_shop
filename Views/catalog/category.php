
<?php
include_once ROOT.'/Views/layout/header.php';
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">

                        <?php foreach ($categories as $categoryItem):?>
                            <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?= $categoryItem['id']?>"
                                        class = "<?php if($categoryId == $categoryItem['id']) echo 'active';?>"
                                        >

                                            <?= $categoryItem['name']?>
                                        </a></h4>

                                </div>
                            </div>

                        <?php endforeach;?>

                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>

                    <?php foreach($categoryProducts as $product):?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="../../templates/images/home/product1.jpg" alt="" />
                                        <h2>$<?= $product['price']?></h2>
                                        <p>
                                            <a href="/product/<?=$product['id']?>">
                                              ID:<?=$product['id']?>  <?= $product['name']?></a>
                                        </p>

                                        <a href="/cart/add/<?= $product['id'];?>" data-id="<?= $product['id']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>

                    <!--Pagination -->
                    <?= $pagination->get()?>
</section>
</body>
<?php include_once ROOT.'/Views/layout/footer.php';