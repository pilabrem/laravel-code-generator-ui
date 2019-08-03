<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Pilabrem\CodeGeneratorUI\Http\Controllers',
    'prefix' => 'code-generator-ui/table',
    'middleware' => 'web',
], function () {
    Route::get('/', 'GeneratorTablesController@index')
         ->name('generator_tables.generator_table.index');
    Route::get('/create','GeneratorTablesController@create')
         ->name('generator_tables.generator_table.create');
    Route::get('/show/{generatorTable}','GeneratorTablesController@show')
         ->name('generator_tables.generator_table.show');
    Route::get('/{generatorTable}/edit','GeneratorTablesController@edit')
         ->name('generator_tables.generator_table.edit');
    Route::post('/', 'GeneratorTablesController@store')
         ->name('generator_tables.generator_table.store');
    Route::put('generator_table/{generatorTable}', 'GeneratorTablesController@update')
         ->name('generator_tables.generator_table.update');
    Route::delete('/generator_table/{generatorTable}','GeneratorTablesController@destroy')
         ->name('generator_tables.generator_table.destroy');
});

Route::group([
    'namespace' => 'Pilabrem\CodeGeneratorUI\Http\Controllers',
    'prefix' => 'code-generator-ui/field',
    'middleware' => 'web',
], function () {
    Route::get('/', 'GeneratorTableFieldsController@index')
         ->name('generator_table_fields.generator_table_field.index');
    Route::get('/create','GeneratorTableFieldsController@create')
         ->name('generator_table_fields.generator_table_field.create');
    Route::get('/show/{generatorTableField}','GeneratorTableFieldsController@show')
         ->name('generator_table_fields.generator_table_field.show')->where('id', '[0-9]+');
    Route::get('/{generatorTableField}/edit','GeneratorTableFieldsController@edit')
         ->name('generator_table_fields.generator_table_field.edit')->where('id', '[0-9]+');
    Route::post('/', 'GeneratorTableFieldsController@store')
         ->name('generator_table_fields.generator_table_field.store');
    Route::put('generator_table_field/{generatorTableField}', 'GeneratorTableFieldsController@update')
         ->name('generator_table_fields.generator_table_field.update')->where('id', '[0-9]+');
    Route::delete('/generator_table_field/{generatorTableField}','GeneratorTableFieldsController@destroy')
         ->name('generator_table_fields.generator_table_field.destroy')->where('id', '[0-9]+');
});

// Generate
Route::group([
    'namespace' => 'Pilabrem\CodeGeneratorUI\Http\Controllers',
    'prefix' => 'code-generator-ui/generate',
    'middleware' => 'web',
], function () {
    Route::get('/config/{table}', 'GeneratorTableFieldsController@generateConfig')
         ->name('generator_table_fields.generator_table_field.config');
    Route::get('/resources/{table}','GeneratorTableFieldsController@generateResources')
         ->name('generator_table_fields.generator_table_field.resources');

    Route::get('/config', 'GeneratorTablesController@generateConfig')
        ->name('generator_tables.generator_table.config');
    Route::get('/resources','GeneratorTablesController@generateResources')
        ->name('generator_tables.generator_table.resources');
});

