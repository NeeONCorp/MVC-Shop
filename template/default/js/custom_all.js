// Добавление товара в корзину
window.onload = function () {
    $('.add_to_cart_button a').on('click', function () {

        $productId = $(this).parent().attr('data-value-product-id');

        if ($('*').is('[data-value-product-count]')) {
            $count = $('span#quantity_value').text();
        } else {
            $count = 1;
        }

        $.post("/cart/add/" + $productId + "/" + $count, {}, onAjaxSuccess);

        function onAjaxSuccess(data) {
            $('span.checkout_items').html(data);
            showNoty('<i class="fa fa-shopping-cart animated tada"></i>Товар добавлен в корзину', 3000);
        }

        return false;
    });
}

// Отображает сообщение на странице
function showNotice(message, type_notice, additional_selector) {
    $selector = 'div#notice-js' + additional_selector;
    $message = '<div class="alert alert-' + type_notice + '"> <button class="close" data-dismiss="alert">×</button> ' +
        message + '</div>';

    if ($($selector).length) {
        $($selector).html($message);

        return true;
    }

    return false;
}

// Задачи для страницы "Кабинет - Редактировать данные"
if ($('.cabinet-edit').length) {

    // Обновление данных профиля
    $('input[name=change_data]').on('click', function () {
        $name = $('input[name=edit_name]').val();
        $phoneNumber = $('input[name=edit_phone_number]').val();

        $.post('/cabinet/ajax/edit_profile', {
            name: $name,
            phone_number: $phoneNumber
        }, onAjaxSuccess);

        function onAjaxSuccess(data) {
            if (data == 'success') {
                showNotice('<strong>Отлично!</strong> Данные профиля обновлены.', 'success', '-data');
            } else {
                showNotice('<strong>Ошибка!</strong> ' + data, 'danger', '-data');
            }
        }
    });

    // Обновление пароля
    $('input[name=change_password]').on('click', function () {
        $passwordOld = $('input[name=edit_password_old]').val();
        $password1 = $('input[name=edit_password1]').val();
        $password2 = $('input[name=edit_password2]').val();

        $.post('/cabinet/ajax/edit_password', {
            password_old: $passwordOld,
            password1: $password1,
            password2: $password2
        }, onAjaxSuccess);

        function onAjaxSuccess(data) {
            if (data == 'success') {
                showNotice('<strong>Отлично!</strong> Пароль изменен.', 'success', '-password');

                // Очищаем поля
                $('input[name=edit_password_old]').val('');
                $('input[name=edit_password1]').val('');
                $('input[name=edit_password2]').val('');
            } else {
                showNotice('<strong>Ошибка!</strong> ' + data, 'danger', '-password');
            }
        }
    });

}

function showNoty($text, $timeout) {
    $noty = new Noty({
        text: $text,
        theme: 'metroui',
        layout: 'bottomRight',
        timeout: $timeout,
        maxVisible: 1,
        animation: {
            open: function (promise) {
                var n = this;
                new Bounce()
                    .translate({
                        from: {x: 450, y: 0}, to: {x: 0, y: 0},
                        easing: "bounce",
                        duration: 1000,
                        bounces: 4,
                        stiffness: 3
                    })
                    .scale({
                        from: {x: 1.2, y: 1}, to: {x: 1, y: 1},
                        easing: "bounce",
                        duration: 1000,
                        delay: 100,
                        bounces: 4,
                        stiffness: 1
                    })
                    .scale({
                        from: {x: 1, y: 1.2}, to: {x: 1, y: 1},
                        easing: "bounce",
                        duration: 1000,
                        delay: 100,
                        bounces: 6,
                        stiffness: 1
                    })
                    .applyTo(n.barDom, {
                        onComplete: function () {
                            promise(function (resolve) {
                                resolve();
                            })
                        }
                    });
            },
            close: function (promise) {
                var n = this;
                new Bounce()
                    .translate({
                        from: {x: 0, y: 0}, to: {x: 450, y: 0},
                        easing: "bounce",
                        duration: 500,
                        bounces: 4,
                        stiffness: 1
                    })
                    .applyTo(n.barDom, {
                        onComplete: function () {
                            promise(function (resolve) {
                                resolve();
                            })
                        }
                    });
            }
        }
    });

    $noty.show();
}
