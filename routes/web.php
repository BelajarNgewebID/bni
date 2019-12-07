<?php

Route::get('/', 'UserController@indexPage')->name('user.index');

Route::get('/login', 'UserController@loginPage')->name('user.loginPage');
Route::get('/logout', 'UserController@logout')->name('user.logout');
Route::get('/register', 'UserController@registerPage')->name('user.registerPage');
Route::post('/login', 'UserController@login')->name('user.login');
Route::post('/register', 'UserController@register')->name('user.register');
Route::get('/sukses-register', 'UserController@registerSuccess')->name('user.registerSuccess');

Route::get('/dashboard', 'UserController@dashboardPage')->name('user.dashboard')->middleware('User');
Route::get('/kelas-saya', 'UserController@listKelas')->name('user.listKelas')->middleware('User');
Route::get('/cari', 'UserController@cariKelas')->name('user.cariKelas');
Route::get('/settings', 'UserController@settingsPage')->name('user.settings')->middleware('User');

Route::group(['prefix' => 'settings'], function() {
    Route::post('personal', 'UserController@settingsPersonal')->name('user.settings.personal');
    Route::post('security', 'UserController@settingsSecurity')->name('user.settings.security');
});

Route::group(['prefix' => 'pengajar'], function() {
    Route::get('/dasbor', 'UserController@dashboard')->name('pengajar.dashboard')->middleware('User');
    
    Route::get('/kelas', 'UserController@kelas')->name('pengajar.kelas')->middleware('User');
    Route::get('/kelas/buat', 'UserController@createClass')->name('pengajar.createClass')->middleware('User');
    Route::post('/kelas/buat', 'ClassController@store')->name('kelas.create')->middleware('User');
    Route::patch('/kelas/{id}/update', 'ClassController@update')->name('kelas.update')->middleware('User');
    Route::get('/kelas/{id}/materi', 'UserController@manageMaterial')->name('kelas.material')->middleware('User');
    Route::get('/kelas/{id}/settings', 'UserController@classSettings')->name('kelas.settings')->middleware('User');
    Route::get('/kelas/{id}/peserta', 'UserController@classParticipant')->name('kelas.peserta')->middleware('User');

    Route::get('/kelas/{id}/tambah-materi', 'UserController@uploadMaterialPage')->name('material.upload')->middleware('User');
    Route::post('/kelas/{id}/store-materi', 'MaterialController@store')->name('material.store')->middleware('User');
    Route::get('/kelas/{id}/delete-materi', 'MaterialController@delete')->name('material.delete')->middleware('User');
    
    Route::get('/pendapatan', 'UserController@earning')->name('pengajar.earning')->middleware('User');
});

Route::group(['prefix' => 'kelas'], function() {
    Route::get('{id}', 'ClassController@detail')->name('kelas.detail');
    Route::post('{id}/join', 'ClassController@join')->name('kelas.join');
    Route::delete('{id}/delete', 'ClassController@delete')->name('kelas.delete');

    Route::post('featuring', 'ClassController@featuring')->name('kelas.featuring');
    Route::get('{id}/remove-featuring', 'ClassController@removeFeaturing')->name('kelas.removeFeaturing');
});

Route::group(['prefix' => 'payout'], function() {
    Route::get('{id}/claim', 'PayoutController@claim')->name('payout.claim');
});

Route::group(['prefix' => 'invoice'], function() {
    Route::get('/', 'InvoiceController@mine')->name('invoice')->middleware('User');
    Route::get('/selesai-bayar', 'InvoiceController@done')->name('invoice.done')->middleware('User');
    // Route::get('/{id}/bayar', 'InvoiceController@payPage')->name('invoice.bayar')->middleware('User');
    // Route::get('bayar', 'InvoiceController@payPage')->name('invoice.bayar')->middleware('User');
    Route::post('bayar', 'InvoiceController@pay')->name('invoice.bayar')->middleware('User');
    Route::post('/{id}/bayar', 'InvoiceController@pay')->name('invoice.bayar.action')->middleware('User');
});

Route::group(['prefix' => 'belajar'], function() {
    Route::get('{classId}/{materialId?}', 'LearnController@index')->name('learn.start')->middleware('User');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('login', 'AdminController@loginPage')->name('admin.loginPage');
    Route::post('login', 'AdminController@login')->name('admin.login');
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard')->middleware('Admin');
    Route::get('invoice', 'AdminController@invoice')->name('admin.invoice')->middleware('Admin');
    Route::get('kelas', 'AdminController@kelas')->name('admin.kelas')->middleware('Admin');
    Route::get('featured-kelas', 'AdminController@featuredKelas')->name('admin.featuredKelas')->middleware('Admin');

    Route::get('mentor', 'AdminController@mentor')->name('admin.mentor')->middleware('Admin');
    Route::post('mentor/add', 'UserController@addAsMentor')->name('admin.mentorAdd')->middleware('Admin');
    Route::get('mentor/{id}/remove', 'UserController@removeMentor')->name('admin.removeMentor')->middleware('Admin');

    Route::get('invoice/{id}/accept', 'InvoiceController@accept')->name('admin.invoice.accept')->middleware('Admin');
    Route::get('invoice/{id}/decline', 'InvoiceController@decline')->name('admin.invoice.decline')->middleware('Admin');
});

Route::get('/stream/{classId}/{videoPath}', 'LearnController@stream')->name('stream.video');

Route::get('/test', function() {
    $myArr = [1,2,2,5,6,6];
    dd(array_count_values($myArr));
    // $i = 0;
    // foreach($myArr as $key => $value) {
    //     if($myArr[$key] == $myArr[$key + 1]) {
    //         echo $value;
    //     }
    //     $i = $i + 1;
    // }
});