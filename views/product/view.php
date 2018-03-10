<?php include(ROOT . '/views/layouts/default/header.php'); ?>

    <div class="container single_product_container" id="page_product" data-name-page="product">
        <div class="row">
            <div class="col">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/categories/">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                Каталог
                            </a>
                        </li>
                        <li>
                            <a href="/category/<?php echo $product['category_id'] ?>">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <?php echo $product['categoryName'] ?>
                            </a>
                        </li>
                        <li class="active">
                            <a href="/product/<?php echo $product['id'] ?>">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <?php echo $product['name'] ?>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="single_product_pics">
                    <div class="row">
                        <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                            <div class="single_product_thumbnails">
                                <ul>
                                    <?php for ($i = 0; $i < count($product['images']); $i++) { ?>

                                        <li class="<?php if (!$i) echo 'active'; ?>">
                                            <img src="<?php echo $product['images'][$i] ?>" alt=""
                                                 data-image="<?php echo $product['images'][$i] ?>">

                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-9 image_col order-lg-2 order-1">
                            <div class="single_product_image">
                                <div class="single_product_image_background"
                                     style="background-image:url(<?php echo $product['images'][0] ?>)"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="product_details">
                    <div class="product_details_title">
                        <h2><?php echo $product['name'] ?></h2>
                        <p><?php echo $product['description'] ?></p>
                    </div>

                    <?php if ($product['brand'] != '') { ?>
                        <div class="product_brand">
                            <p>
                                <span class="badge badge-pill badge-primary">Бренд:</span>
                                <?php echo $product['brand'] ?>
                            </p>
                        </div>
                    <?php } ?>

                    <div class="product_price"><?php echo $product['price'] ?> грн.</div>


                    <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                        <span>Количество:</span>
                        <div class="quantity_selector">
                            <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            <span id="quantity_value" data-value-product-count="">1</span>
                            <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        </div>

                        <div class="red_button add_to_cart_button" data-value-product-id="<?php echo $product['id'] ?>">
                            <a href="#">В корзину</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php include(ROOT . '/views/layouts/default/footer.php'); ?>