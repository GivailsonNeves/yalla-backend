<?php

// Categories Management
Route::group(['namespace' => 'Categories'], function () {
    Route::resource('categories', 'CategoriesController', ['except' => ['show']]);

    //For DataTables
    Route::post('categories/get', 'CategoriesTableController')->name('categories.get');
});
