<?php
    Route::group(['prefix' => '/admin', 'namespace' => 'Admin'], function () {
        Route::post('/uploads', 'FilesController@fileUpload');
        Route::get('/', "UsersController@index");
        Route::get('/home', "UsersController@index");
        Route::resource('/users', 'UsersController', ['except' => ['show']]);
        Route::resource('/players', 'PlayersController', ['except' => ['show']]);
        Route::resource('/players/order', 'PlayersController@postSort');
        Route::resource('/banners', 'BannersController', ['except' => ['show']]);
        Route::resource('/banners/order', 'BannersController@postSort');
        Route::resource('/floaters', 'FloatersController', ['except' => ['show']]);
        Route::resource('/floaters/order', 'FloatersController@postSort');
        Route::resource('/pages', 'PagesController', ['except' => ['show']]);
        Route::resource('/pages/order', 'PagesController@postSort');
        Route::resource('pages.subpages', 'SubpagesController', ['except' => 'show']);
        Route::resource('/receivers', 'ReceiversController', ['except' => ['show']]);
        Route::resource('/contacts', 'ContactsController', ['except' => ['show']]);
        Route::resource('/sections', 'SectionsController', ['except' => ['show']]);
        
        Route::resource('/biddings', 'BiddingsController', ['except' => ['show']]);
        Route::resource('/attachments', 'AttachmentsController', ['except' => ['show']]);
        Route::resource('biddings.attachments', 'AttachmentsController', ['except' => ['show']]);
        Route::resource('biddings.notifications', 'NotificationsController', ['except' => ['show']]);
        Route::resource('biddings.newsletters', 'BiddingNewslettersController', ['except' => ['show']]);
        Route::resource('/biddings/{parent_id}/attachments/order', 'AttachmentsController@postSort');
        
        Route::resource('/b_trimestrals', 'B_trimestralsController', ['except' => ['show']]);
        Route::resource('/attachments', 'A_trimestralsController', ['except' => ['show']]);
        Route::resource('b_trimestrals.attachments', 'A_trimestralsController', ['except' => ['show']]);
        Route::resource('b_trimestrals.notifications', 'NotificationsController', ['except' => ['show']]);
        Route::resource('b_trimestrals.newsletters', 'BiddingNewslettersController', ['except' => ['show']]);
        Route::resource('/b_trimestrals/{parent_id}/attachments/order', 'A_trimestralsController@postSort');
        
        Route::resource('/file_uploads', 'UploadsController', ['only' => ['index', 'create', 'store', 'show', 'destroy']]);
        Route::resource('/categories', 'CategoriesController', ['except' => ['show']]);
        Route::resource('/categories/order', 'CategoriesController@postSort');
        Route::resource('/bidding_categories', 'BiddingCategoriesController', ['except' => ['show']]);
        Route::resource('/bidding_categories/order', 'BiddingCategoriesController@postSort');
        Route::resource('/posts', 'PostsController', ['except' => ['show']]);
        Route::resource('/notices', 'NoticesController', ['except' => ['show']]);
        Route::resource('/newsletters', 'NewslettersController', ['except' => ['show']]);
        Route::resource('/posts/order', 'PostsController@postSort');
        Route::resource('/diaries', 'DiariesController', ['except' => ['show']]);
    });

    Route::group(['prefix' => '/api', 'namespace' => 'Api'], function () {
        Route::resource('/pages', 'PagesController', ['only' => ['index', 'show']]);
        Route::resource('/posts', 'PostsController', ['only' => ['index', 'show', 'update']]);
        Route::resource('/notices', 'NoticesController', ['only' => ['index']]);
        Route::resource('/players', 'PlayersController', ['only' => ['index']]);
        Route::resource('/banners', 'BannersController', ['only' => ['index']]);
        Route::resource('/floaters', 'FloatersController', ['only' => ['index']]);
        Route::resource('/biddings', 'BiddingsController', ['only' => ['index']]);
        Route::resource('/sections', 'SectionsController', ['only' => ['index']]);
        Route::resource('/newsletters', 'NewslettersController', ['only' => ['store']]);
        Route::resource('/contacts', 'ContactsController', ['only' => ['store']]);
        Route::resource('/uploads', 'UploadsController', ['only' => ['show']]);
        Route::resource('/search', 'SearchController', ['only' => ['index']]);
        Route::resource('/diaries', 'DiariesController', ['only' => ['index']]);
    });

    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

    Route::get('/meta/p/{id}', 'MetaTagsController@pagina');
    Route::get('/meta/noticia/{id}', 'MetaTagsController@noticia');
    Route::get('/meta/{any?}', 'MetaTagsController@any')->where('any', '.*');

    Route::get('/dynamic_images', 'DynamicImagesController@index');

    Route::any('{all}', 'HomeController@index')->where('all', '.*');