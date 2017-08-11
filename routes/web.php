<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/video/mysql','VideoController@mysql');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('user/login','AuthController@authenticate');
        $api->post('user/register','AuthController@register');

        $api->post('image/','ImageController@upload');
        $api->post('image/delete','ImageController@delete');


        $api->get('tag','TagController@index');
        $api->get('akira','AkiraController@index');
        $api->get('week','WeekController@index');
        $api->get('video','VideoController@homeIndex');
        $api->get('video/recommend','VideoController@homeRecommend');

        $api->resource('admin/video','VideoController');


        $api->group(['middleware' => 'jwt.auth'], function ($api){
            $api->get('user/me','AuthController@AuthenticatedUser');
            $api->get('user','UserController@index');
            $api->get('user/{id}','UserController@show');
        });
    });
});
