<?php


Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'Admin'],function() {
        Route::get('', 'MusicController@index')->name('home.index');
//        Route::get('', 'HomeController@index')->name('home.ready');


        Route::group(['prefix' => 'music'], function () {
            Route::get('', 'MusicController@index')->name('music.index');
            Route::get('create', 'MusicController@create')->name('music.create');
            Route::get('{id}/edit', 'MusicController@edit')->name('music.edit');
            Route::get('{id}/listen', 'MusicController@listen')->name('music.listen');
            Route::post('', 'MusicController@store')->name('music.store');
            Route::post('{id}/update', 'MusicController@update')->name('music.update');
//        Route::post('delete', 'KpiController@delete')->name('kpi.delete');


        });

    });

});

