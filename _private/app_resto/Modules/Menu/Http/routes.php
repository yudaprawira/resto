<?php
$info = readModulInfo(__DIR__.'/../module.json');

//BACKEND
Route::group(['middleware' => 'web', 'prefix' => config('app.backend').'/'.$info['alias'], 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
    Route::match(['GET', 'POST'], '/', 'BeController@index');
    Route::match(['GET', 'POST'], '/trash', 'BeController@trash');
    Route::get('/add', 'BeController@form');
    Route::get('/edit/{id}', 'BeController@form')->where('id', '[0-9]+');
    Route::get('/delete/{id}', 'BeController@delete')->where('id', '[0-9]+');
    Route::get('/restore/{id}', 'BeController@restore')->where('id', '[0-9]+');
    Route::post('/save', 'BeController@save');  
});


//FRONT END
Route::group(['middleware'=>'web', 'prefix' => 'kuliner', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
    Route::get('/{resto}/menu', 'FeController@index')->where('resto', '[a-z0-9\-\_\+]+');
    Route::get('/{resto}/menu/{url}.html', 'FeController@detail')->where('resto', '[a-z0-9\-\_\+]+')->where('url', '[a-z0-9\-\_\+]+');
});
