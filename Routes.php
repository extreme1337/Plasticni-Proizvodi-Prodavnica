<?php
    return [
        \App\Core\Route::get('|^user/register/?$|',                  'Main',                    'getRegister'),
        \App\Core\Route::post('|^user/register/?$|',                 'Main',                    'postRegister'),
        \App\Core\Route::get('|^user/login/?$|',                     'Main',                    'getLogin'),
        \App\Core\Route::post('|^user/login/?$|',                    'Main',                    'postLogin'),
        \App\Core\Route::get('|^user/logout/?$|',                    'Main',                    'getLogout'),
        
        \App\core\Route::get('|^category/([0-9]+)/?$|',             'Category',                'show'),
        \App\core\Route::get('|^category/([0-9]+)/delete/?$|',      'Category',                'delete'),
        \App\Core\Route::get('|^cart/?$|',                          'Cart' ,                    'show' ),
        
        \App\core\Route::get('|^product/([0-9]+)/?$|',              'Product',                 'show'),
        \App\core\Route::post('|^search/?$|',                       'Product',                 'postSearch'),
        
        #Api rute:
        \App\Core\Route::get('|^api/product/([0-9]+)/?$|',          'ApiProduct' ,             'show' ),
        \App\Core\Route::get('|^api/cart/?$|',                      'ApiBookmark' ,            'show' ),
        \App\core\Route::get('|^api/bookmarks/?$|',                 'ApiBookmark',            'getBookmarks'),
        \App\core\Route::get('|^api/bookmarks/add/([0-9]+)/?$|',    'ApiBookmark',            'addBookmark'),
        \App\core\Route::get('|^api/bookmarks/clear/?$|',           'ApiBookmark',            'clear'),
       

        \App\Core\Route::get('|^user/profile/?$|',                    'UserDashboard',            'index'),
        
        \App\Core\Route::get('|^user/categories/?$|',                 'UserCategoryManagement',   'categories'),
        \App\Core\Route::get('|^user/categories/edit/([0-9]+)/?$|',   'UserCategoryManagement',   'getEdit'),
        \App\Core\Route::post('|^user/categories/edit/([0-9]+)/?$|',  'UserCategoryManagement',   'postEdit'),
        \App\Core\Route::get('|^user/categories/add/?$|',               'UserCategoryManagement',   'getAdd'),
        \App\Core\Route::post('|^user/categories/add/?$|',              'UserCategoryManagement',   'postAdd'),

        \App\Core\Route::get('|^user/products/?$|',                 'UserProductManagement',   'products'),
        \App\Core\Route::get('|^user/products/edit/([0-9]+)/?$|',   'UserProductManagement',   'getEdit'),
        \App\Core\Route::post('|^user/products/edit/([0-9]+)/?$|',  'UserProductManagement',   'postEdit'),
        \App\Core\Route::get('|^user/products/add/?$|',               'UserProductManagement',   'getAdd'),
        \App\Core\Route::post('|^user/products/add/?$|',              'UserProductManagement',   'postAdd'),

        \App\Core\Route::get('|^user/manufacturers/?$|',                 'UserManufacturerManagement',   'manufacturers'),
        \App\Core\Route::get('|^user/manufacturers/edit/([0-9]+)/?$|',   'UserManufacturerManagement',   'getEdit'),
        \App\Core\Route::post('|^user/manufacturers/edit/([0-9]+)/?$|',  'UserManufacturerManagement',   'postEdit'),
        \App\Core\Route::get('|^user/manufacturers/add/?$|',             'UserManufacturerManagement',   'getAdd'),
        \App\Core\Route::post('|^user/manufacturers/add/?$|',            'UserManufacturerManagement',   'postAdd'),
        \App\Core\Route::get('|^user/manufacturers/delete/?$|',          'UserManufacturerManagement',   'deleteById'),
        \App\Core\Route::post('|^user/manufacturers/delete/?$|',         'UserManufacturerManagement',   'postDeleteById'),

        \App\Core\Route::get('|^user/prices/?$|',                 'UserProductPriceManagement',   'prices'),
        \App\Core\Route::get('|^user/prices/edit/([0-9]+)/?$|',   'UserProductPriceManagement',   'getEdit'),
        \App\Core\Route::post('|^user/prices/edit/([0-9]+)/?$|',  'UserProductPriceManagement',   'postEdit'),
        \App\Core\Route::get('|^user/prices/add/?$|',               'UserProductPriceManagement',   'getAdd'),
        \App\Core\Route::post('|^user/prices/add/?$|',              'UserProductPriceManagement',   'postAdd'),

        \App\Core\Route::get('|^user/producategories/?$|',                 'UserProductCategoryManagement',   'producategories'),
        \App\Core\Route::get('|^user/producategories/edit/([0-9]+)/?$|',   'UserProductCategoryManagement',   'getEdit'),
        \App\Core\Route::post('|^user/producategories/edit/([0-9]+)/?$|',  'UserProductCategoryManagement',   'postEdit'),
        \App\Core\Route::get('|^user/producategories/add/?$|',               'UserProductCategoryManagement',   'getAdd'),
        \App\Core\Route::post('|^user/producategories/add/?$|',              'UserProductCategoryManagement',   'postAdd'),


        \App\core\Route::get('|^categories/?$|',                    'Category',                'listAll'),
        

        /*
        UserCategoryManagement
        \App\core\Route::get('|^profile/([0-9]+)/?$|',           'Profile',                 'show'),
        \App\core\Route::get('|^profile/model/([0-9]+)/?$|',     'Model',                   'show'),
        \App\core\Route::get('|^cart/?$|',                       'Cart',                    'show'),
        */
        \App\core\Route::any('|^.*$|',                              'Main',                    'home')
    ];