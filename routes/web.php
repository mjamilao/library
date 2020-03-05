<?php

use Illuminate\Support\Facades\Route;

Route::post('books', 'BooksController@store');
Route::patch('books/{book}', 'BooksController@update');
Route::delete('books/{book}', 'BooksController@destroy');

/*  if you want to have a slug
 * Route::patch('books/{book}-{slug}', 'BooksController@update');
Route::delete('books/{book}-{slug}', 'BooksController@destroy');*/

Route::post('authors', 'AuthorsController@store');

Route::post('checkout/{book}', 'CheckoutBookController@store');
Route::post('checkin/{book}', 'CheckinBookController@store');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
