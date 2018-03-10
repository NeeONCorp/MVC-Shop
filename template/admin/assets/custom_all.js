// Резшрешает пользователю добавлять товары, категории т.д.
$allow_action = true;

// Удаляет заданый символ с начала и конца строки
function trim(str, value) {
    while (str.charAt(str.length - 1) == value) {
        str = str.slice(0, str.length - 1)
    }
    while (str.charAt(0) == value) {
        str = str.slice(1, str.length)
    }
    return str
}

// Отображает сообщение на странице
function showNotice(message, type_notice) {
    $selector = 'div#notise-js';
    $message = '<div class="alert alert-' + type_notice + '"> <button class="close" data-dismiss="alert">×</button> ' +
        message + '</div>';

    if ($($selector).length) {
        $($selector).html($message);

        return true;
    }

    return false;
}

// Задачи для страницы "Список товаров"
if ($('div.page-product').length) {
    $productsTable = $('#products-table').DataTable({
        "order": [[0, "desc"]],
        "columnDefs": [{
            "targets": 3,
            "orderable": false
        }]
    });

    // Вызывает модальное окно для подтверждение удаление товара
    $('.page-product [data-action=remove]').on('click', function () {

        $parent = $(this).parents('tr');
        $parent = $parent.find('[data-name=product] a');

        $productName = $parent.html().replace(/\s+/g, " ");
        $productName = trim($productName, ' ');
        $productId = $parent.attr('data-link');

        $("#modal-remove [data-value=name]").html($productName);
        $("#modal-remove [data-value=name]").attr('href', '/product/' + $productId);
        $("#modal-remove [data-value=name]").attr('data-product-id', $productId);
        $("#modal-remove").modal('show');

    });

    // Удаляет товар
    $('.page-product #modal-remove [data-click-action=remove]').on('click', function () {
        $parent = $(this).parents('.modal-content');
        $parent = $parent.find('[data-value=name]');

        $productId = $parent.attr('data-product-id');

        $.post('/admin/ajax/product/remove/' + $productId, {}, onAjaxSuccess);

        function onAjaxSuccess(data) {
            if (data == 'success') {
                $("#modal-remove").modal('hide');

                $row = $('tr.product-' + $productId);
                $productsTable.rows($('table#products-table tr.product-' + $productId)).remove().draw();
                showNotice('<strong>Отлично!</strong> Товар удален.', 'success');
            }
        }
    });
}

// Задачи для страницы "Добавить товар"
if ($('div.page-add-product').length) {
    $('textarea#ckeditor_standard').ckeditor({
        width: '98%', height: '150px', toolbar: [
            {name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']},
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
            {name: 'basicstyles', items: ['Bold', 'Italic']}
        ]
    });
    $('textarea#ckeditor_full').ckeditor({width: '98%', height: '150px'});
    $(".chzn-select").chosen();
    $(".uniform_on").uniform();


    // Добавляет товар
    $('div.page-add-product [data-action=add]').on('click', function (e) {
        e.preventDefault();

        if ($allow_action) {

            // Запрещаем выполнения подобного действия до получения ответа
            $allow_action = false;

            // Стилизация
            $(this).css('opacity', 0.5);

            $data = new FormData();

            // Собираем данные с форм
            $('div.page-add-product form#form-main input,' +
                'div.page-add-product form#form-main textarea,' +
                'div.page-add-product form#form-main select').each(function () {
                if (!$(this).parent().hasClass('chzn-search')) {
                    $key = $(this).attr('name');

                    if ($(this).attr('type') == 'file') {
                        $value = this.files[0];
                    }

                    if ($(this).attr('type') == 'text' || $(this)[0].tagName == 'TEXTAREA' ||
                        $(this)[0].tagName == 'SELECT') {
                        $value = $(this).val();
                    }

                    if ($(this).attr('type') == 'checkbox') {
                        $value = $(this).prop("checked");
                    }

                    $data.append($key, $value);
                }
            });


            $.ajax({
                url: "/admin/ajax/product/add",
                type: "POST",
                contentType: false,
                processData: false,
                data: $data,

                success: function (data) {
                    if (data == 'success') {
                        showNotice('<strong>Отлично!</strong> Товар добавлен.', 'success');

                        // Перенаправляем на страницу с продуктами
                        setTimeout(function () {
                            window.location.href = '/admin/products';
                        }, 2000);
                    } else {
                        showNotice('<strong>Ошибка!</strong> ' + data, 'error');

                        // Делаем кнопку кликабильной
                        $allow_action = true;
                        $('.form-actions .btn-primary').css('opacity', 1);
                    }

                    $('body,html').animate({scrollTop: 0}, 800);
                }
            });
        }

        return false;
    });
}

// Задачи для страницы "Редактировать товар"
if ($('div.page-edit-product').length) {

    // Обработка формы
    $('form#form-main button').on('click', function (e) {
        e.preventDefault();

        $action = $(this).attr('data-action');

        // Удаляем фото
        if ($action == 'remove-photo') {
            $box = $(this).parents('.box-picture');
            $imageId = $box.attr('data-id-image');
            $imageId = $imageId.replace(/[^0-9]+/, '');

            $box.fadeOut('fast', function () {
                $box.remove();
            });

            // Добавляем поле для выбора фото
            $('.list-input-upload').append('<div class="controls" data-name="' + $imageId + '"><div class="uploader" id="uniform-fileInput"> ' +
                '<input class="input-file uniform_on" id="fileInput" type="file" name="image' + $imageId + '">' +
                '<span class="filename" style="user-select: none;">No file selected</span><span class="action" ' +
                'style="user-select: none;"> Choose File </span> </div> </div>');

            // Сортируем формы для выбора файлов
            $elems = $('.list-input-upload .controls');
            $elems.sort(function (a, b) {
                return a.getAttribute('data-name') > b.getAttribute('data-name')
            }).appendTo($elems.parent());

            $(".uniform_on").uniform();

            // Отмечаем, что фото нужно удалить
            $('.control-photo input').eq($imageId - 1).click();
        }

        // Обновляет информацию
        if ($action == 'edit') {
            $productId = $(this).attr('data-id-product');

            $data = new FormData();

            // Собираем данные с форм
            $('div.page-add-product form#form-main input,' +
                'div.page-add-product form#form-main textarea,' +
                'div.page-add-product form#form-main select').each(function () {
                if (!$(this).parent().hasClass('chzn-search')) {
                    $key = $(this).attr('name');

                    if ($(this).attr('type') == 'file') {
                        $value = this.files[0];
                    }

                    if ($(this).attr('type') == 'text' || $(this)[0].tagName == 'TEXTAREA' ||
                        $(this)[0].tagName == 'SELECT') {
                        $value = $(this).val();
                    }

                    if ($(this).attr('type') == 'checkbox') {
                        $value = $(this).prop("checked");
                    }

                    $data.append($key, $value);
                }
            });


            $.ajax({
                url: "/admin/ajax/product/edit/" + $productId,
                type: "POST",
                contentType: false,
                processData: false,
                data: $data,

                success: function (data) {
                    if (data == 'success') {
                        window.location.href = '/admin/product/edit/' + $productId + '/?success';
                    } else {
                        showNotice('<strong>Ошибка!</strong> ' + data, 'error');
                    }

                    $('body,html').animate({scrollTop: 0}, 800);
                }
            });
        }

        // Действие при выборе фото
        $('.list-input-upload input').on('change', function () {
            $nameFile = $(this).val();

            if ($nameFile != '') {
                $imageId = $(this).attr('name');
                $imageId = $imageId.replace(/[^0-9]+/, '');

                // Отмечаем, что фото не нужно удалять
                $('.control-photo input').eq($imageId - 1).removeAttr('checked');
            } else {
                // Говорим, что фото нужно удалить
                $('.control-photo input').eq($imageId - 1).prop('checked', true);
            }
        });

        return false;
    })

    // Отлавливаем GET параметры
    $strGET = window.location.search.replace('?', '');
    if ($strGET == 'success') {
        showNotice('<strong>Отлично!</strong> Изменения сохранены.', 'success')
    }
}

// Задачи для страницы "Список категорий"
if ($('div.page-categories').length) {
    $categoriesTable = $('#categories-table').DataTable({
        "columnDefs": [{
            "targets": [3, 4],
            "orderable": false
        }],
    });

    // Показать окно для подтверждения удаления
    $('[data-action=remove]').on('click', function () {
        $parent = $(this).parents('tr');

        $categoryName = $parent.find('[data-value=name]').html();
        $categoryName = $categoryName.replace(/\s+/g, " ");
        $categoryName = trim($categoryName, ' ');

        $categoryId = $parent.find('[data-value=id]').html();

        $('#modal-remove a[data-value=name]').html($categoryName);
        $('#modal-remove a[data-value=name]').attr('href', '/category/' + $categoryId);

        $('#modal-remove').modal('show');
    });

    // Удаляем категорию
    $('[data-click-action=remove]').on('click', function () {
        $.post('/admin/ajax/category/remove/' + $categoryId, {}, onAjaxSuccess);

        function onAjaxSuccess(data) {
            if (data == 'success') {
                showNotice('<strong>Отлично!</strong> Категория удалена.', 'success');
                $('#modal-remove').modal('hide');
                $categoriesTable.rows($('table tr.category-' + $categoryId)).remove().draw();
            }
        }
    });
}

// Задачи для страницы "Добавить категорию"
if ($('div.page-add-category').length) {
    $(".uniform_on").uniform();

    // Добавление категорию
    $('[data-action=add]').on('click', function (e) {
        e.preventDefault();

        // Стилизация
        $(this).css('opacity', 0.5);

        $categoryName = $('input[name=name]').val();
        $categorySort = $('input[name=sort]').val();
        $categoryHide = $('input[name=hide]').prop('checked');

        if ($allow_action) {

            // Запрещаем выполнения подобного действия до получения ответа
            $allow_action = false;

            $.post('/admin/ajax/category/add', {
                name: $categoryName,
                sort: $categorySort,
                hide: $categoryHide
            }, onAjaxSuccess);

            function onAjaxSuccess(data) {
                if (data == 'success') {
                    showNotice('<strong>Отлично!</strong> Категория добавлена.', 'success');

                    // Перенаправляем на страницу с продуктами
                    setTimeout(function () {
                        window.location.href = '/admin/categories';
                    }, 2000);
                } else {
                    showNotice('<strong>Ошибка!</strong> ' + data, 'error');

                    $allow_action = true;

                    // Делаем кнопку кликабильной
                    $('.form-actions .btn-primary').css('opacity', 1);
                }
            }
        }

        return false;
    });

    // Редактирование категории
    $('[data-action=edit]').on('click', function (e) {
        e.preventDefault();

        $categoryId = $(this).attr('data-id-category');
        $categoryName = $('input[name=name]').val();
        $categorySort = $('input[name=sort]').val();
        $categoryHide = $('input[name=hide]').prop('checked');

        $.post('/admin/ajax/category/edit/' + $categoryId,
            {
                name: $categoryName,
                sort: $categorySort,
                hide: $categoryHide
            }, onAjaxSuccess);

        function onAjaxSuccess(data) {
            if (data == 'success') {
                showNotice('<strong>Отлично!</strong> Данные о категории обновлены.', 'success');
            } else {
                showNotice('<strong>Ошибка!</strong> ' + data, 'error');
            }
        }

        return false;
    });


}

// Задачи для страницы "Список заказов"
if ($('div.page-orders').length) {
    $('#new_orders').DataTable({
        "columnDefs": [{
            "targets": [4],
            "orderable": false
        }],
        "order": [[0, "desc"]]
    });

    $('#processed_orders').DataTable({
        "columnDefs": [{
            "targets": [5],
            "orderable": false
        }],
        "order": [[0, "desc"]]
    });
}

// Задачи для страницы "Просмотр заказа"
if ($('div.page-order').length) {
    $(".chzn-select").chosen();
    $('table').DataTable({
        "order": [[1, "desc"]]
    });

    // Показываем кнопку для обработки заказа
    $('select[name=status]').on('change', function () {
        $('[data-action=save]').fadeIn('fast');
    });

    // Обработка заказа
    $('[data-action=save]').on('click', function () {
        $orderId = $(this).attr('data-id-order');
        $statusId = $('select[name=status]').val();

        $.post('/admin/ajax/order/edit/' + $orderId + '/status=' + $statusId, {}, onAjaxSuccess);

        function onAjaxSuccess(data) {
            if (data == 'success') {
                showNotice('<strong>Отлично!</strong> Статус заказа изменен.', 'success');
                $('body,html').animate({scrollTop: 0}, 800);
            }
        }
    });
}

// Здачи для страницы "Список пользователей"
if ($('div.page-users').length) {
    $('table').DataTable({
        "columnDefs": [{
            "targets": [4],
            "orderable": false
        }],
        "order": [[0, "desc"]]
    });
}

// Здачи для страницы "Просмотр информации о пользователе"
if ($('div.page-user').length) {
    $('table').DataTable({
        "columnDefs": [{
            "targets": [4],
            "orderable": false
        }],
        "order": [[0, "desc"]]
    });
}