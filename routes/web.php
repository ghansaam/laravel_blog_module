<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::post('content-categories/parse-csv-import', 'ContentCategoryController@parseCsvImport')->name('content-categories.parseCsvImport');
    Route::post('content-categories/process-csv-import', 'ContentCategoryController@processCsvImport')->name('content-categories.processCsvImport');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::post('content-tags/parse-csv-import', 'ContentTagController@parseCsvImport')->name('content-tags.parseCsvImport');
    Route::post('content-tags/process-csv-import', 'ContentTagController@processCsvImport')->name('content-tags.processCsvImport');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::post('content-pages/parse-csv-import', 'ContentPageController@parseCsvImport')->name('content-pages.parseCsvImport');
    Route::post('content-pages/process-csv-import', 'ContentPageController@processCsvImport')->name('content-pages.processCsvImport');
    Route::resource('content-pages', 'ContentPageController');

    // // Category
    // Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    // Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
    // Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
    // Route::post('categories/parse-csv-import', 'CategoryController@parseCsvImport')->name('categories.parseCsvImport');
    // Route::post('categories/process-csv-import', 'CategoryController@processCsvImport')->name('categories.processCsvImport');
    // Route::resource('categories', 'CategoryController');

    // // Sub Category
    // Route::delete('sub-categories/destroy', 'SubCategoryController@massDestroy')->name('sub-categories.massDestroy');
    // Route::post('sub-categories/media', 'SubCategoryController@storeMedia')->name('sub-categories.storeMedia');
    // Route::post('sub-categories/ckmedia', 'SubCategoryController@storeCKEditorImages')->name('sub-categories.storeCKEditorImages');
    // Route::post('sub-categories/parse-csv-import', 'SubCategoryController@parseCsvImport')->name('sub-categories.parseCsvImport');
    // Route::post('sub-categories/process-csv-import', 'SubCategoryController@processCsvImport')->name('sub-categories.processCsvImport');
    // Route::resource('sub-categories', 'SubCategoryController');

    // // App Update
    // Route::delete('app-updates/destroy', 'AppUpdateController@massDestroy')->name('app-updates.massDestroy');
    // Route::post('app-updates/media', 'AppUpdateController@storeMedia')->name('app-updates.storeMedia');
    // Route::post('app-updates/ckmedia', 'AppUpdateController@storeCKEditorImages')->name('app-updates.storeCKEditorImages');
    // Route::post('app-updates/parse-csv-import', 'AppUpdateController@parseCsvImport')->name('app-updates.parseCsvImport');
    // Route::post('app-updates/process-csv-import', 'AppUpdateController@processCsvImport')->name('app-updates.processCsvImport');
    // Route::resource('app-updates', 'AppUpdateController');

    // // App Info
    // Route::delete('app-infos/destroy', 'AppInfoController@massDestroy')->name('app-infos.massDestroy');
    // Route::post('app-infos/media', 'AppInfoController@storeMedia')->name('app-infos.storeMedia');
    // Route::post('app-infos/ckmedia', 'AppInfoController@storeCKEditorImages')->name('app-infos.storeCKEditorImages');
    // Route::post('app-infos/parse-csv-import', 'AppInfoController@parseCsvImport')->name('app-infos.parseCsvImport');
    // Route::post('app-infos/process-csv-import', 'AppInfoController@processCsvImport')->name('app-infos.processCsvImport');
    // Route::resource('app-infos', 'AppInfoController');

    // // Api Urls
    // Route::delete('api-urls/destroy', 'ApiUrlsController@massDestroy')->name('api-urls.massDestroy');
    // Route::post('api-urls/parse-csv-import', 'ApiUrlsController@parseCsvImport')->name('api-urls.parseCsvImport');
    // Route::post('api-urls/process-csv-import', 'ApiUrlsController@processCsvImport')->name('api-urls.processCsvImport');
    // Route::resource('api-urls', 'ApiUrlsController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
