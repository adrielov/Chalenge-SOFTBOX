	<?php
use App\Router;

Router::add('/', 'IndexController@index');

Router::add('/report', 'ReportController@index');

Router::add('/category', 'CategoryController@index');
Router::add('/category/new', 'CategoryController@add');
Router::add('/category/edit/{id}', 'CategoryController@edit');
Router::add('/category/delete/{id}', 'CategoryController@delete');
Router::add('/category/find', 'CategoryController@find');

Router::add('/releases', 'ReleasesController@index');
Router::add('/releases/new', 'ReleasesController@add');
Router::add('/releases/view/{id}', 'ReleasesController@view');
Router::add('/releases/edit/{id}', 'ReleasesController@edit');
Router::add('/releases/delete/{id}', 'ReleasesController@delete');
Router::add('/releases/find', 'ReleasesController@find');
