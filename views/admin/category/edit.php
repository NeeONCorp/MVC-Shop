<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

<div class="page-add-category page-edit-category">

    <div class="span9" id="content">
        <!-- morris stacked chart -->
        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Редактировать категорию: <?php echo $category['title'] ?></div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">

                        <div id="notise-js"></div>

                        <form class="form-horizontal" id="form-main">
                            <fieldset>

                                <!-- Name product -->
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">Название категории
                                        <span class="required">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" class="span6" name="name"
                                               value="<?php echo $category['title'] ?>">
                                    </div>
                                </div>

                                <!-- Sort -->
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">Сортировка
                                        <span class="required">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="number" class="span6" name="sort" min="0" max="9999"
                                               value="<?php echo $category['sort'] ?>">
                                    </div>
                                </div>

                                <!-- Hide  -->
                                <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">Скрыть</label>
                                    <div class="controls">
                                        <label class="uniform">
                                            <input class="uniform_on" type="checkbox" id="optionsCheckbox"
                                                   name="hide"
                                                   <?php if($category['status'] == 0) { ?>checked=""<?php } ?>
                                            >
                                        </label>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary"
                                            data-action="edit"
                                            data-id-category="<?php echo $category['id'] ?>"
                                    >Редактировать категорию
                                    </button>
                                    <button type="reset" class="btn">Отмена</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>


    </div>

</div>

<?php include_once (ROOT . '/views/layouts/admin/footer.php'); ?>