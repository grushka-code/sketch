<?php

Route::view('/','stats::index');

Route::get('/peoples', 'PeoplesController@index')
    ->name('.peoples');
Route::get('/peoples/charts', 'PeoplesController@charts')
    ->name('.peoples.charts');
Route::get('/peoples/regenerate', 'PeoplesController@reGenerate')
    ->name('.peoples.regenerate')
    ->middleware('can:can_generate_peoples');

Route::get('/prices', 'PricesController@index')
    ->name('.prices');
Route::get('/prices/charts', 'PricesController@charts')
    ->name('.prices.charts');
Route::get('/prices/regenerate', 'PricesController@reGenerate')
    ->middleware('can:can_generate_prices')
    ->name('.prices.regenerate');
