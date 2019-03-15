<?php

Route::apiResource('/question', 'QuestionController');

Route::apiResource('/category', 'CategoryController');

Route::apiResource('/question/{question}/reply', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@likeIt');
Route::delete('/like/{reply}', 'LikeController@unLikeIt');

Route::get('/notification', 'NotificationController@index');
Route::post('/notification/readIt', 'NotificationController@readIt');


Route::group([
                 'middleware' => 'api',
                 'prefix' => 'auth',
             ], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payLoad');
    Route::post('signup', 'AuthController@signup');
});