<?php include(ROOT . '/views/layouts/default/header.php'); ?>

    <div class="main" id="page_main">

        <!-- Slider -->

        <div class="main_slider" style="background-image:url(template/default/images/slider_1.jpg)">
            <div class="container fill_height">
                <div class="row align-items-center fill_height">
                    <div class="col">
                        <div class="main_slider_content">
                            <h6>Весна / Летняя коллекция 2017</h6>
                            <h1>Успейте получите скидку до 30%</h1>
                            <div class="red_button shop_now_button animated fadeInUp">
                                <a href="/categories">Перейти к покупкам</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Arrivals -->

        <div class="new_arrivals">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_title new_arrivals_title">
                            <h2>Новые товары</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col text-center">
                        <div class="new_arrivals_sorting">
                            <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                                <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked"
                                    data-filter="*">all
                                </li>

                                <?php foreach ($categoryLastedProducts as $category) { ?>
                                    <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center"
                                        data-filter=".category-id-<?php echo $category['id'] ?>"><?php echo $category['name'] ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="product-grid"
                             data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

                            <?php foreach ($lastedProducts as $product) { ?>
                                <div class="product-item category-id-<?php echo $product['category_id'] ?>">
                                    <div class="product product_filter">
                                        <a href="/product/<?php echo $product ['id'] ?>">
                                            <div class="product_image">
                                                <img src="<?php echo $product['image'] ?>" alt="">
                                            </div>
                                        </a>

                                        <?php if ($product['is_new']) { ?>
                                            <div class="product_bubble product_bubble_left product_bubble_green d-flex
                                        flex-column align-items-center"><span>new</span></div>
                                        <?php } ?>
                                        <div class="product_info">
                                            <h6 class="product_name"><a href="/product/<?php echo $product['id'] ?>">
                                                    <?php echo $product['name'] ?></a></h6>
                                            <div class="product_price"><?php echo $product['price'] ?> грн.</div>
                                        </div>
                                    </div>
                                    <div class="red_button add_to_cart_button"
                                         data-value-product-id="<?php echo $product['id'] ?>">
                                        <a href="#">В корзину</a>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deal of the week -->

        <div class="deal_ofthe_week">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="deal_ofthe_week_img">
                            <img src="/template/default/images/deal_ofthe_week.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 text-right deal_ofthe_week_col">
                        <div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
                            <div class="section_title">
                                <h2>До конца скидки</h2>
                            </div>
                            <ul class="timer">
                                <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                    <div id="day" class="timer_num">03</div>
                                    <div class="timer_unit">Дня</div>
                                </li>
                                <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                    <div id="hour" class="timer_num">15</div>
                                    <div class="timer_unit">Час.</div>
                                </li>
                                <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                    <div id="minute" class="timer_num">45</div>
                                    <div class="timer_unit">Мин.</div>
                                </li>
                                <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                    <div id="second" class="timer_num">23</div>
                                    <div class="timer_unit">Сек.</div>
                                </li>
                            </ul>
                            <div class="red_button deal_ofthe_week_button"><a href="/categories">shop now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

<?php include(ROOT . '/views/layouts/default/footer.php'); ?>