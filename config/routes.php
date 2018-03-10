<?php
return [
    #
    ''                                              => 'app/index',
    '404'                                           => 'app/pageNotFound',
    'product/([a-z0-9-_]+)'                         => 'product/view/$1',
    'categories(/page-([0-9])+)?'                   => 'category/index/$1',
    'category/([a-z0-9-_]+)(/page-[0-9]+)?'         => 'category/view/$1/$2',
    'contact'                                       => 'contact/index',
    'cart'                                          => 'cart/index',
    'cart/add/([0-9]+)(/[0-9]+)?'                   => 'cart/addProduct/$1/$2',
    'cart/checkout'                                 => 'cart/checkout',
    'login'                                         => 'user/loginRegister',

    # Пользователь
    'cabinet/edit'                                  => 'cabinet/editPage',
    'cabinet/ajax/edit_profile'                     => 'cabinet/editProfile',
    'cabinet/ajax/edit_password'                    => 'cabinet/editPassword',
    'cabinet/history_order'                         => 'cabinet/historyOrder',
    'cabinet/logout'                                => 'cabinet/logout',

    # Администратор
    'admin'                                         => 'adminProduct/index',
    'admin/products'                                => 'adminProduct/index',
    'admin/ajax/product/remove/([0-9]+)'            => 'adminProduct/remove/$1',
    'admin/product/add'                             => 'adminProduct/addPage',
    'admin/ajax/product/add'                        => 'adminProduct/add',
    'admin/product/edit/([0-9]+)(/.+)?'             => 'adminProduct/editPage/$1',
    'admin/ajax/product/edit/([0-9]+)'              => 'adminProduct/edit/$1',
    'admin/categories'                              => 'adminCategory/index',
    'admin/ajax/category/remove/([0-9]+)'           => 'adminCategory/remove/$1',
    'admin/category/add'                            => 'adminCategory/addPage',
    'admin/ajax/category/add'                       => 'adminCategory/add',
    'admin/category/edit/([0-9]+)'                  => 'adminCategory/editPage/$1',
    'admin/ajax/category/edit/([0-9]+)'             => 'adminCategory/edit/$1',
    'admin/orders'                                  => 'adminOrder/index',
    'admin/order/([0-9]+)'                          => 'adminOrder/view/$1',
    'admin/ajax/order/edit/([0-9]+)/(status=[0-9])' => 'adminOrder/editStatus/$1/$2',
    'admin/users'                                   => 'adminUser/index',
    'admin/user/([0-9]+)'                           => 'adminUser/view/$1'
];