<?php


use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    // $router->resource('users', UserController::class);
    $router->resource('application/users', UserController::class);
    $router->resource('equipment-models', EquipmentController::class);
    $router->resource('equipment-status-models', EquipmentStatusController::class);
    $router->resource('equipment-type-models', EquipmentTypeController::class);
    $router->resource('equipment-images-models', EquipmentImageController::class);
    $router->resource('user-statuses', UserStatusController::class);
    $router->resource('equipment-transfer-models', EquipmentTransferController::class);


});
