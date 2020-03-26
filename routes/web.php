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





// Route::get('/', function () {
//     return view('welcome');
// });




// Route::get('/index', function(){
//    echo '<form action="indexdo" method="post"><input name="name" type="text">'.csrf_field().'<button>提交</button></form>';

// });

// Route::post('/indexdo', function(){
//     echo request()->name;
// });


Route::view('/index','form');

//Route::match(['get','post'],'/add','IndexController@adddo');

// 正则
// Route::get('/new/{id?}/{name?}',function($id=null,$goods_name=null){
//     echo $id."===".$goods_name;
// })->where(['id'=>'\d+','name'=>'[a-zA-Z]+']);

// 可选参数
// Route::get('/new/{id}/{name?}',function($id,$goods_name=null){
//     echo $id."==".$goods_name;
// });

Route::prefix('brand')->middleware('islogin')->group(function(){
        Route::get('create','BrandController@create');
        Route::post('store','BrandController@store');
        Route::get('index','BrandController@index');
        Route::get('destroy/{id}','BrandController@destroy');
        Route::get('edit/{id}','BrandController@edit');
        Route::post('update/{id}','BrandController@update');
        Route::get('flagobj','BrandController@flagobj');

});

Route::get('login','LoginController@login');
Route::post('dologin','LoginController@dologin');





Route::prefix('student')->group(function(){
        Route::get('create','StudentController@create');
        Route::post('store','StudentController@store');
        Route::get('index','StudentController@index');

});






// 商品分类
Route::prefix('category')->middleware('islogin')->group(function(){
    Route::get('create','CategoryController@create');
    Route::post('store','CategoryController@store');
    Route::get('index','CategoryController@index');
    Route::get('destroy/{id}','CategoryController@destroy');
    Route::get('edit/{id}','CategoryController@edit');
    Route::post('update/{id}','CategoryController@update');
    Route::get('flagobj','CategoryController@flagobj');
});



// 
Route::prefix('plot')->group(function(){
    Route::get('create','PlotController@create');
    Route::post('store','PlotController@store');
    Route::get('index','PlotController@index');
});


Route::prefix('goods')->middleware('islogin')->group(function(){
    Route::get('create','GoodsController@create');
    Route::post('store','GoodsController@store')->name('goodsstore');
    Route::get('index','GoodsController@index');
    Route::get('destroy/{id}','GoodsController@destroy');
    Route::get('edit/{id}','GoodsController@edit');
    Route::post('update/{id}','GoodsController@update')->name('goodsupdate');
    Route::get('flagobj','GoodsController@flagobj');

});



Route::prefix('admin')->group(function(){
    Route::get('create','AdminController@create');
    Route::post('store','AdminController@store');
    Route::get('index','AdminController@index');
    Route::get('destroy/{id}','AdminController@destroy');
    Route::get('edit/{id}','AdminController@edit');
    Route::post('update/{id}','AdminController@update');
    Route::get('flagobj','AdminController@flagobj');

});

Route::prefix('index')->group(function(){
    Route::get('index','IndexController@index');
});

Route::prefix('article')->group(function(){
    Route::get('create','ArticleController@create');
    Route::post('store','ArticleController@store');
    Route::get('index','ArticleController@index');
    Route::get('destroy/{id}','ArticleController@destroy');


});
Route::get('/','Index\IndexController@index');
Route::get('/log','Index\LoginController@log');
Route::get('/reg','Index\LoginController@reg');
Route::get('/reg/sendSMS','Index\LoginController@sendSMS');
Route::post('/doreg','Index\LoginController@doreg');
Route::post('/dolog','Index\LoginController@dolog');

Route::get('/reg/sendEmail','Index\LoginController@sendEmail');



Route::get('/pronav/{id}','Index\IndexController@pronav');
Route::get('/prolist','Index\IndexController@prolist');
Route::get('/car/carlist','Index\IndexController@carlist')->name('cart');
Route::post('/addcar','Index\IndexController@addcar');
Route::get('/pay','Index\IndexController@pay');
Route::get('/user','Index\IndexController@user');
Route::get('/success/{id}','Index\IndexController@success');

Route::get('/pays/{orderid}','Index\PayController@pays');
Route::get('/return_url','Index\PayController@return_url');
Route::post('/notify_url','Index\PayController@notify_url');

Route::prefix('news')->group(function(){
    Route::get('create','NewsController@create');
    Route::post('store','NewsController@store');
    Route::get('index','NewsController@index');
});

















Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
