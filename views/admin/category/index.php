<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

    <div class="page-categories">

        <div class="span9" id="content">
            <!-- morris stacked chart -->
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Список категорий</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">

                            <div id="notise-js"></div>

                            <div class="table-toolbar">
                                <div class="btn-group">
                                    <a href="/admin/category/add">
                                        <button class="btn btn-success">Добавить категорию
                                            <i class="icon-plus icon-white"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <table id="categories-table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Категория</th>
                                    <th>Количество продуктов</th>
                                    <th>Отображение</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($categories as $category) { ?>
                                    <tr class="category-<?php echo $category['id'] ?>">
                                        <td data-value="id"><?php echo $category['id'] ?></td>
                                        <td>
                                            <a href="/category/<?php echo $category['id'] ?>"
                                               target="_blank"
                                               data-value="name"
                                            >
                                                <?php echo $category['title'] ?>
                                            </a>
                                        </td>
                                        <td><?php echo $category['count_product'] ?></td>
                                        <td>

                                            <?php if ($category['status']) { ?>

                                                <i class="icon-eye-open"></i>

                                            <?php } else { ?>

                                                <i class="icon-eye-close"></i>

                                            <?php } ?>

                                        </td>
                                        <td class="icon_control">
                                            <a href="#" data-action="remove"><i class="icon-trash"></i></a>
                                            <a href="/admin/category/edit/<?php echo $category['id'] ?>">
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


        <!-- Удаление категории  -->
        <div id="modal-remove" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Удаление категории</h4>
                    </div>
                    <div class="modal-body">
                        <p>Вы действительно хотите удалить категорию «<a href="#" target="_blank" data-value="name"></a>»?
                        </p>
                        <p>Все товары в категории будут так же удалены.
                        </p>
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