<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

<div class="page-add-category">

    <div class="span9" id="content">
        <!-- morris stacked chart -->
        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Добавить категорию</div>
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
                                        <input type="text" class="span6" name="name">
                                    </div>
                                </div>

                                <!-- Sort -->
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">Сортировка
                                        <span class="required">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="number" class="span6" name="sort" value="1">
                                    </div>
                                </div>

                                <!-- Hide  -->
                                <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">Скрыть</label>
                                    <div class="controls">
                                        <label class="uniform">
                                            <input class="uniform_on" type="checkbox" id="optionsCheckbox"
                                                   name="hide">
                                        </label>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary"
                                            data-action="add">Добавить категорию
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