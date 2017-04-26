<?php
// home
Route::get('/', 'HomeController@index');
Route::get('/comit', function() {
    return 'commit';
});
// login
Route::get('login', function(){return redirect('/');});
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('register', function(){return redirect('/');});
Route::post('register', 'Auth\RegisterController@register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@customReset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@customSendResetLinkEmail')->name('password.email');
// socialite route
Route::get('login/{socialProvider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{socialProvider}/callback', 'Auth\LoginController@handleProviderCallback');
// cart
Route::get('/cart', 'CartController@index');
Route::post('/cart/shipping/update', 'CartController@updateShipping');
Route::post('/cart/{id}/remove', 'CartController@removeItem');
// checkout
Route::post('/checkout/validation', 'CheckoutController@validation');
Route::post('/checkout', 'CheckoutController@checkout');
Route::get('/checkout/done', 'CheckoutController@getDone');
//customize
Route::get('/customize', 'CustomizeController@index');
Route::get('/customize/{id}', 'CustomizeController@edit');
Route::post('/cart/add', 'CustomizeController@addCart');
Route::post('/cart/{id}/update', 'CustomizeController@updateCart');
Route::post('/product/save', 'CustomizeController@saveProduct');
Route::post('/product/{id}/update', 'CustomizeController@updateProduct');
// account
Route::get('/account', 'AccountController@index');
Route::post('/account/email', 'AccountController@updateEmail');
Route::post('/account/password', 'AccountController@updatePassword');

// Image route
Route::post('image/upload', 'ImageController@uploadImage');
Route::post('image/delete', 'ImageController@deleteImage');
Route::get('image/{id}/src', 'ImageController@imageSrc');

Route::group(['prefix' => 'admin'], function () {
  // customization
  Route::get('customize', 'CustomizeController@index');
  Route::get('customize/type/{id}/edit', 'CustomizeController@editType');
  Route::get('customize/component/{id}/edit', 'CustomizeController@editComponent');
  Route::get('customize/{id}', 'CustomizeController@show');
  Route::post('customize', 'CustomizeController@store');

  Route::get('cms/slider', 'CmsController@slider');
  Route::get('cms/product', 'CmsController@product');
  Route::get('cms/menu', 'CmsController@menu');
  Route::get('cms/page', 'CmsController@page');
});

// Route::get('/contact', function(){return view('contact');});
//cms
Route::get('/{slug}', 'CmsController@page');
