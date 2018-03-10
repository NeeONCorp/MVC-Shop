<?php include(ROOT . '/views/layouts/default/header.php'); ?>

    <div class="container category-page product_section_container" id="page_category">
        <div class="row">
            <div class="col product_section clearfix">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li>
                            <a href="/categories">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                Каталог
                            </a>
                        </li>
                        <li class="active">
                            <a href="/category/<?php echo $category['id'] ?>">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <?php echo $category['title'] ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Sidebar -->

                <div class="sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">
                            <h5>Категории</h5>
                        </div>
                        <ul class="sidebar_categories">
                            <?php foreach ($categories as $_category) { ?>
                                <li class="<?php if ($categoryId == $_category['id']) echo 'active' ?>">
                                    <a href="/category/<?php echo $_category['id'] ?>">

                                        <?php if ($categoryId == $_category['id']) { ?>
                                            <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                                        <?php } ?>

                                        <?php echo $_category['title'] ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>


                </div>

                <!-- Main Content -->

                <div class="main_content">

                    <!-- Products -->

                    <div class="products_iso">
                        <div class="row">
                            <div class="col">

                                <h3><?php echo $category['title'] ?></h3>

                                <!-- Product Grid -->

                                <div class="product-grid">
                                    <?php if ($сountProduct > 0) { ?>

                                        <?php foreach ($products as $product) { ?>

                                            <div class="product-item women">
                                                <div class="product product_filter">
                                                    <a href="/product/<?php echo $product ['id'] ?>">
                                                        <div class="product_image">
                                                            <img src="<?php echo $product ['image'] ?>" alt="">
                                                        </div>
                                                    </a>

                                                    <?php if ($product['is_new']) { ?>
                                                        <div class="product_bubble product_bubble_left
                                                        product_bubble_green d-flex flex-column align-items-center">
                                                            <span>new</span></div>
                                                    <?php } ?>

                                                    <div class="product_info">
                                                        <h6 class="product_name"><a
                                                                    href="/product/<?php echo $product ['id'] ?>"><?php echo $product ['name'] ?></a>
                                                        </h6>
                                                        <div class="product_price"><?php echo $product ['price'] ?>
                                                            грн.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="red_button add_to_cart_button"
                                                     data-value-product-id="<?php echo $product['id'] ?>">
                                                    <a href="#">В корзину</a>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    <?php } else { ?>
                                        <p>Товары в данной категории отсутствуют</p>
                                    <?php } ?>


                                </div>

                                <!-- Product Sorting -->

                                <div class="product_sorting_container product_sorting_container_bottom clearfix">

                                    <div class="pages d-flex flex-row align-items-center">
                                        <?php echo $pagenation ?>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include(ROOT . '/views/layouts/default/footer.php'); ?>