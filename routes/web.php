<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::get('/admin', 'AdminController@dashboard');
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@dashboard');

    Route::get('/employee/lists', 'AdminController@listEmployee')->name('admin-emplyoee');
    Route::post('/employee/create', 'AdminController@createEmployee')->name('admin-create-emplyoee');
    Route::get('/employee/{id?}', 'AdminController@employee')->name('admin-emplyoee-createform');
    Route::put('/employee/update/{id}', 'AdminController@updateEmployee')->name('admin-emplyoee-update');
    Route::get('/employee/delete/{id}', 'AdminController@deleteEmployee')->name('admin-emplyoee-delete');

    Route::get('/account', 'AdminController@account')->name('admin-account');
    Route::post('/account/create', 'AdminController@createAccount')->name('admin-create-account');
    Route::get('/account/lists', 'AdminController@listAccount')->name('admin-lists-account');
    Route::get('/account/edit/{id}', 'AdminController@editAccount')->name('admin-edit-account');
    Route::put('/account/update/{id}', 'AdminController@updateAccount')->name('admin-update-account');
    Route::get('/account/delete/{id}', 'AdminController@deleteAccount')->name('admin-delete-account');

    Route::get('/company', 'AdminController@company')->name('admin-company');
    Route::post('/company', 'AdminController@createCompany')->name('admin-create-company');
    Route::put('/company/update/{id}', 'AdminController@updateCompany')->name('admin-update-company');
    Route::get('/company/delete/{id}', 'AdminController@deleteCompany')->name('admin-delete-company');

    Route::get('/department', 'AdminController@department')->name('admin-department');
    Route::post('/department', 'AdminController@createDepartment')->name('admin-create-department');
    Route::put('/department/update/{id}', 'AdminController@updateDepartment')->name('admin-update-department');
    Route::get('/department/delete/{id}', 'AdminController@deleteDepartment')->name('admin-delete-department');
});

Route::get('/', 'ShowController@companies');
Route::get('/employees', 'ShowController@employees');
Route::get('/employee/export', 'ShowController@employeeExport');
Auth::routes();
