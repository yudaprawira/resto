<?php
$info = readModulInfo(__DIR__.'/../module.json');

//BACKEND
Route::group(['middleware' => 'web', 'prefix' => config('app.backend').'/'.$info['alias'], 'namespace' => 'Modules\Restoran\Http\Controllers'], function()
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
Route::group(['middleware'=>'cached', 'prefix' => 'kuliner', 'namespace' => 'Modules\Restoran\Http\Controllers'], function()
{
    Route::get('/', 'FeController@index');
    Route::get('/{url}', 'FeController@detail')->where('url', '[a-z0-9\-\_\+]+');
    Route::get('/{url}/about', 'FeController@about')->where('url', '[a-z0-9\-\_\+]+');
});