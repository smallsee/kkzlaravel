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
        $api->post('user/info/thumb','UserController@thumb');
        $api->patch('user/info/update','UserController@update');

        $api->post('image/','ImageController@upload');
        $api->post('image/delete','ImageController@delete');
        $api->post('crop/upload','ImageController@crop');

        $api->get('commit','CommitController@index');
        $api->post('commit','CommitController@store');
        $api->get('user/commit','CommitController@userCommit');




        $api->get('user/user/{id}','UserController@userInfo');

        $api->get('fav','FavController@index');
        $api->get('hasfav','FavController@hasFav');
        $api->post('fav','FavController@store');
        $api->get('user/fav','FavController@userFav');

        $api->post('fan','FanController@fan');
        $api->get('hasfan','FanController@hasFan');
        $api->get('user/fan','FanController@userFan');


        $api->get('topic','TopicController@index');
        $api->get('tag','TagController@index');
        $api->get('akira','AkiraController@index');
        $api->get('week','WeekController@index');
        $api->get('video','VideoController@homeIndex');
        $api->get('search','SearchController@search');
        $api->get('video/hot','VideoController@hot');
        $api->get('video/recommend','VideoController@homeRecommend');

        $api->resource('admin/video','VideoController');
        $api->resource('admin/category','CategoryController');
        $api->resource('admin/art','ArtController');
        $api->resource('admin/article','ArticleController');
        $api->resource('admin/shop','ShopController');
        $api->get('art/hot','ArtController@hot');
        $api->get('article/hot','ArticleController@hot');


        $api->group(['middleware' => 'jwt.auth'], function ($api){
            $api->get('user/me','AuthController@AuthenticatedUser');
            $api->get('user','UserController@index');
            $api->get('user/{id}','UserController@show');
        });
    });
});
