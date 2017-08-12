<?php

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['AdminAuth']], function () {
        //    Routes for Teacher Crud
        Route::get('/teachers', ['uses' => 'TeacherController@getIndex', 'as' => 'teachers-list']);
        Route::post('/teachers/add', ['uses' => 'TeacherController@add', 'as' => 'teachers-add']);
        Route::post('/teachers/update', ['uses' => 'TeacherController@update', 'as' => 'teachers-update']);
        Route::get('/teachers/remove/{id}', ['uses' => 'TeacherController@delete', 'as' => 'teachers-delete']);
    });

});