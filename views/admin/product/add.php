<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

<div class="page-add-product">

    <div class="span9" id="content">
        <!-- morris stacked chart -->
        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Добавить товар</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">

                        <div id="notise-js"></div>

                        <form class="form-horizontal" id="form-main">
                            <fieldset>

                                <!-- Name product -->
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">Название товара
                                        <span class="required">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" class="span6" name="name">
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="control-group">
                                    <label class="control-label">Цена
                                        <span class="required">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" class="span6 m-wrap" name="price">
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="control-group">
                                    <label class="control-label" for="select01">Категория
                                        <span class="required">*</span>
                                    </label>
                                    <div class="controls">
                                        <select id="select01" class="chzn-select" name="category">
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category['id'] ?>">
                                                    <?php echo $category['title'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Photo -->
                                <div class="control-group">
                                    <label class="control-label" for="fileInput">Фотография</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="fileInput" type="file"
                                               name="image1">
                                    </div>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="fileInput" type="file"
                                               name="image2">
                                    </div>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="fileInput" type="file"
                                               name="image3">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="control-group">
                                    <label class="control-label" for="textarea2">Textarea WYSIWYG</label>
                                    <div class="controls">
                                            <textarea class="input-xlarge textarea"
                                                      placeholder="Enter text ..."
                                                      id="ckeditor_standard"
                                                      name="description"></textarea>
                                    </div>
                                </div>

                                <!-- Brand -->
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">Название бренда</label>
                                    <div class="controls">
                                        <input type="text" class="span6" name="brand">
                                    </div>
                                </div>

                                <!-- Hide product -->
                                <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">Скрыть товар</label>
                                    <div class="controls">
                                        <label class="uniform">
                                            <input class="uniform_on" type="checkbox" id="optionsCheckbox"
                                                   name="hide">
                                        </label>
                                    </div>
                                </div>

                                <!-- New -->
                                <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">Отображать как 'New'</label>
                                    <div class="controls">
                                        <label class="uniform">
                                            <input class="uniform_on" type="checkbox" id="optionsCheckbox"
                                                   name="new" checked="">
                                        </label>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary"
                                            data-action="add">Добавить товар
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