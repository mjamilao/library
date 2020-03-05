<?php

use Illuminate\Support\Facades\Route;

Route::post('books', 'BooksController@store');
Route::patch('books/{book}', 'BooksController@update');
Route::delete('books/{book}', 'BooksController@destroy');

/*  if you want to have a slug
 * Route::patch('books/{book}-{slug}', 'BooksController@update');
Route::delete('books/{book}-{slug}', 'BooksController@destroy');*/

Route::post('author', 'AuthorsController@store');
