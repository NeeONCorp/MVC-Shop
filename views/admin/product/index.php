<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

<div class="page-product">

    <div class="span9" id="content">
        <!-- morris stacked chart -->
        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Список товаров</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">

                        <div id="notise-js"></div>

                        <div class="table-toolbar">
                            <div class="btn-group">
                                <a href="/admin/product/add"><button class="btn btn-success">Добавить товар <i class="icon-plus icon-white"></i></button></a>
                            </div>
                        </div>

                        <table id="products-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Товар</th>
                                <th>Категория</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($products as $product) { ?>
                                <tr class="product-<?php echo $product['id'] ?>">
                                    <td><?php echo $product['id'] ?></td>
                                    <td data-name="product">
                                        <a
                                                data-link="<?php echo $product['id'] ?>"
                                                href="/product/<?php echo $product['id'] ?>">
                                            <?php echo $product['name'] ?>
                                        </a>
                                    </td>
                                    <td><?php echo $product['category_name'] ?></td>
                                    <td class="icon_control">
                                        <a href="#" data-action="remove"><i class="icon-trash"></i></a>
                                        <a href="/admin/product/edit/<?php echo $product['id'] ?>">
                                            <i class="icon-wrench"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>


    </div>


    <!-- Удаление товара -->
    <div id="modal-remove" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Удаление товара</h4>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить товар «<a href="#" target="_blank" data-value="name"></a>»?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-click-action="remove">Удалить</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include_once(ROOT . '/views/layouts/admin/footer.php'); ?>