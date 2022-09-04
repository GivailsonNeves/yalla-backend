<?php

// Features Management
Route::group(['namespace' => 'Features'], function () {
    Route::resource('features', 'FeaturesController', ['except' => ['show']]);

    //For DataTables
    Route::post('features/get', 'FeaturesTableController')->name('features.get');
});
