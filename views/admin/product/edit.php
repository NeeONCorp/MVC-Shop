<?php include_once(ROOT . '/views/layouts/admin/header.php'); ?>

    <div class="page-add-product page-edit-product">

        <div class="span9" id="content">
            <!-- morris stacked chart -->
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Редактировать товар: <?php echo $product['name'] ?></div>
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
                                            <input type="text" class="span6" name="name"
                                                   value="<?php echo $product['name'] ?>">
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="control-group">
                                        <label class="control-label">Цена
                                            <span class="required">*</span>
                                        </label>
                                        <div class="controls">
                                            <input type="text" class="span6 m-wrap" name="price"
                                                   value="<?php echo $product['price'] ?>">
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

                                                    <option value="<?php echo $category['id'] ?>"

                                                            <?php if ($category['id'] == $product['category_id']) { ?>selected=""<?php } ?>>

                                                        <?php echo $category['title'] ?>

                                                    </option>

                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>

                                    <!-- Photo -->
                                    <div class="control-group">
                                        <label class="control-label" for="fileInput">Фотография</label>

                                        <!-- List uploaded photo -->
                                        <div class="list-uploaded-photo">

                                            <?php foreach ($images as $key => $image) { ?>

                                                <div class="controls box-picture"
                                                     data-id-image="<?php echo $key ?>">
                                                    <div class="picture"
                                                         style="background: url(<?php echo $image ?>)">
                                                        <button class="remove"
                                                                data-action="remove-photo">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                        </div>


                                        <!-- Input for upload photo -->
                                        <div class="list-input-upload">

                                            <?php foreach ($emptyImages as $name => $value) { ?>

                                                <div class="controls" data-name="<?php echo $name ?>">
                                                    <div class="uploader" id="uniform-fileInput">
                                                        <input
                                                                class="input-file uniform_on"
                                                                id="fileInput"
                                                                type="file"
                                                                name="image<?php echo $name ?>">
                                                        <span class="filename" style="user-select: none;">
                                                        No file selected
                                                    </span>
                                                        <span class="action" style="user-select: none;">
                                                            Choose File
                                                        </span>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="control-group">
                                        <label class="control-label" for="textarea2">Textarea WYSIWYG</label>
                                        <div class="controls">
                                            <textarea class="input-xlarge textarea"
                                                      placeholder="Enter text ..."
                                                      id="ckeditor_standard"
                                                      name="description"><?php echo $product['description'] ?></textarea>
                                        </div>
                                    </div>

                                    <!-- Brand -->
                                    <div class="control-group">
                                        <label class="control-label" for="typeahead">Название бренда</label>
                                        <div class="controls">
                                            <input type="text" class="span6" name="brand"
                                                   value="<?php echo $product['brand'] ?>">
                                        </div>
                                    </div>

                                    <!-- Hide product -->
                                    <div class="control-group">
                                        <label class="control-label" for="optionsCheckbox">Скрыть товар</label>
                                        <div class="controls">
                                            <label class="uniform">
                                                <input class="uniform_on" type="checkbox"
                                                       name="hide" <?php if (!$product['status']) { ?> checked="" <?php } ?>>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- New -->
                                    <div class="control-group">
                                        <label class="control-label" for="optionsCheckbox">Отображать как 'New'</label>
                                        <div class="controls">
                                            <label class="uniform">
                                                <input class="uniform_on" type="checkbox"
                                                       name="new" <?php if ($product['is_new']) { ?> checked="" <?php } ?>>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="control-photo" style="display: none">
                                        <label class="uniform">
                                            <input class="uniform_on" type="checkbox"
                                                   name="remove_photo1">
                                            Remove photo 1
                                        </label>

                                        <label class="uniform">
                                            <input class="uniform_on" type="checkbox"
                                                   name="remove_photo2">
                                            Remove photo 2
                                        </label>

                                        <label class="uniform">
                                            <input class="uniform_on" type="checkbox"
                                                   name="remove_photo3">
                                            Remove photo 3
                                        </label>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"
                                                data-action="edit"
                                                data-id-product="<?php echo $product['id'] ?>"
                                        >Сохранить изменения
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

<?php include_once(ROOT . '/views/layouts/admin/footer.php'); ?>