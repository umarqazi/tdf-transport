<?php
use Illuminate\Session\TokenMismatchException;

/*
|--------------------------------------------------------------------------
| Public side (no auth required)
|--------------------------------------------------------------------------
|
*/
/**
* Password recovery
*/
Route::get('/user/change-password', [
  "as"   => "user.change-password",
  "uses" => 'LaravelAcl\Authentication\Controllers\AuthController@getChangePassword'
]);
Route::get('/user/recovery-password', [
  "as"   => "user.recovery-password",
  "uses" => 'LaravelAcl\Authentication\Controllers\AuthController@getReminder'
]);
Route::post('/user/change-password/', [
  'uses' => 'LaravelAcl\Authentication\Controllers\AuthController@postChangePassword',
  "as"   => "user.reminder.process"
]);

Route::get('/user/change-password-success', [
  "uses" => function ()
  {
    return view('laravel-authentication-acl::client.auth.change-password-success');
  },
  "as"   => "user.change-password-success"
]
);
Route::post('/user/reminder', [
  'uses' => 'LaravelAcl\Authentication\Controllers\AuthController@postReminder',
  "as"   => "user.reminder"
]);
Route::get('/user/reminder-success', [
  "uses" => function ()
  {
    return view('laravel-authentication-acl::client.auth.reminder-success');
  },
  "as"   => "user.reminder-success"
]);
/**
* User login and logout
*/
Route::group(['middleware' => ['web']], function ()
{
  Route::get('/', [
    "as"   => "user.login",
    "uses" => 'LaravelAcl\Http\Controllers\AuthController@getClientLogin'
  ]);
  Route::post('/', [
    "uses" => 'LaravelAcl\Http\Controllers\AuthController@postClientLogin',
    "as"   => "user.login"
  ]);

  Route::get('/admin/login', [
    "as"   => "user.admin.login",
    "uses" => 'LaravelAcl\Authentication\Controllers\AuthController@getAdminLogin'
  ]);
  Route::get('/admin/logout', [
    "as"   => "user.logout",
    "uses" => 'LaravelAcl\Authentication\Controllers\AuthController@getLogout'
  ]);
  Route::post('/user/login', [
    "uses" => 'LaravelAcl\Authentication\Controllers\AuthController@postAdminLogin',
    "as"   => "user.login.process"
  ]);
  Route::get('/logout', [
    "as"   => "client.logout",
    "uses" => 'LaravelAcl\Http\Controllers\AuthController@getClientLogout'
  ]);
  Route::get('/forgetPassword', [
    "as"   => "forgetPassword",
    "uses" => 'LaravelAcl\Http\Controllers\HomeController@forgetPassword'
  ]);
  Route::post('/forgetPassword', [
    "as"   => "post.forgetPassword",
    "uses" => 'LaravelAcl\Http\Controllers\HomeController@pForgetPassword'
  ]);
  Route::get('/changePassword/{token}', [
    "as"   => "change.Password",
    "uses" => 'LaravelAcl\Http\Controllers\HomeController@changePassword'
  ]);
  Route::post('/changePassword/', [
    "as"   => "post.change.password",
    "uses" => 'LaravelAcl\Http\Controllers\HomeController@pChangePassword'
  ]);

  Route::group(['middleware' => ['user_logged', 'can_see']], function ()
  {
    Route::get('/dashboard', [
      "as"   => "user.dashboard",
      "uses" => 'LaravelAcl\Http\Controllers\HomeController@dashboard'
    ]);
    Route::get('/dashboard/{date}', [
      "as"   => "user.date.dashboard",
      "uses" => 'LaravelAcl\Http\Controllers\HomeController@dashboard'
    ]);
    Route::get('/monthlyRecords', [
      "as"   => "records",
      "uses" => 'LaravelAcl\Http\Controllers\HomeController@monthView'
    ]);
    Route::get('/delivery', [
      "as"   => "create.delivery",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@index'
    ]);
    Route::get('/delivery/{date}/{period}', [
      "as"   => "create.delivery.period",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@index'
    ]);
    Route::get('/delivery/{id}', [
      "as"   => "edit.delivery",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@index'
    ]);
    Route::post('/delivery', [
      "as"   => "delivery.edit",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@create'
    ]);
    Route::get('/viewDelivery/{id}', [
      "as"   => "view.delivery",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@viewDeliver'
    ]);
    Route::post('/uploadPdf', [
      "as"   => "upload.pdf",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@uploadPdf'
    ]);
    Route::post('/delivery/uploadPdf', [
      "as"   => "delivery.upload.pdf",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@uploadPdf'
    ]);
    Route::get('/deleteDelivery/{id}', [
      "as"   => "delete.delivery",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@destroy'
    ]);

    Route::post('/validateDelivery', [
      "as"   => "validate.delivery",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@deliveryValidate'
    ]);
    Route::get('/history', [
      "as"   => "delivery.history",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@history'
    ]);
    Route::post('/history', [
      "as"   => "post.delivery.history",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@history'
    ]);
    });
    Route::post('/searchRecords', [
      "as"   => "search.records",
      "uses" => 'LaravelAcl\Http\Controllers\HomeController@searchRecords'
    ]);
    Route::post('/exportHistory', [
      "as"   => "delivery.export",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@exportHistory'
    ]);
    Route::get('/getDeliveryPrice', [
      "as"   => "price",
      "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@getDeliveryPrice'
    ]);
    Route::group(['middleware' => ['tdf_manager', 'can_see']], function ()
    {
      Route::get('/planDriverTour', [
        "as"   => "plan.tour",
        "uses" => 'LaravelAcl\Http\Controllers\HomeController@tourPlan'
      ]);
      Route::get('/planDriverTour/{id}', [
        "as"   => "tour.plan",
        "uses" => 'LaravelAcl\Http\Controllers\HomeController@tourPlan'
      ]);
      Route::post('/planDriverTour', [
        "as"   => "tour.plan",
        "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@pTourPlan'
      ]);
      Route::get('/allDeliveryHistory', [
        "as"   => "history.deliveries",
        "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@allManagerDeliveries'
      ]);
      Route::post('/allDeliveryHistory', [
        "as"   => "post.manager.history",
        "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@allManagerDeliveries'
      ]);
      Route::get('/deleteTour/{id}', [
        "as"   => "delete.tour",
        "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@deleteTour'
      ]);
      Route::get('/sendDriverEmail/{id}', [
        "as"   => "send.driver.email",
        "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@sendDriverEmail'
      ]);
    });
    Route::get('/driverTours', [
      "as"   => "driver.tours",
      "uses" => 'LaravelAcl\Http\Controllers\VehicleController@toursList'
    ]);
    Route::get('/tourDeliveryDetail/{id}', [
      "as"   => "driver.tours.detail",
      "uses" => 'LaravelAcl\Http\Controllers\VehicleController@deliveryDetail'
    ]);
    Route::post('/tourDeliveryDetail', [
      "as"   => "update.delivery.status",
      "uses" => 'LaravelAcl\Http\Controllers\VehicleController@updateDeliveryStatus'
    ]);


  /*
  |--------------------------------------------------------------------------
  | Admin side (auth required)
  |--------------------------------------------------------------------------
  |
  */
  Route::group(['middleware' => ['admin_logged', 'can_see']], function ()
  {
    Route::get('/admin/users/dashboard', [
      'as'   => 'dashboard.default',
      'uses' => 'LaravelAcl\Http\Controllers\DashboardController@base'
    ]);
    Route::get('/admin/users/list', [
      'as'   => 'users.list',
      'uses' => 'LaravelAcl\Http\Controllers\UserController@getList'
    ]);
    Route::get('/admin/users/edit', [
      'as'   => 'users.edit',
      'uses' => 'LaravelAcl\Authentication\Controllers\UserController@editUser'
    ]);
    Route::post('/admin/users/edit', [
      'as'   => 'users.edit',
      'uses' => 'LaravelAcl\Http\Controllers\UserController@postEditUser'
    ]);
    Route::get('/admin/users/delete', [
      'as'   => 'users.delete',
      'uses' => 'LaravelAcl\Http\Controllers\UserController@deleteUser'
    ]);
    Route::post('/admin/vehicle/edit', [
      'as'   => 'vehicle.edit',
      'uses' => 'LaravelAcl\Http\Controllers\DashboardController@pEditVehicle'
    ]);


    /****TDF Routes***/
    Route::prefix('admin')->group(function () {
      Route::get('/store/list/{companyId}', [
        'as'   => 'store.list',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@index'
      ]);
      Route::get('/store/edit/{companyId}', [
        'as'   => 'store.edit',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@edit'
      ]);
      Route::get('/store/update/{id}', [
        'as'   => 'store.update',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@edit'
      ]);
      Route::get('/company/delete/{id}', [
        'as'   => 'company.delete',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@destroyCompany'
      ]);
      Route::post('/store/edit', [
        'as'   => 'post.store.edit',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@store'
      ]);

      Route::get('/store/delete/{id}', [
        'as'   => 'store.delete',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@destroy'
      ]);
      Route::get('/store/employee/list/{storeId}', [
        'as'   => 'employees',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@storeEmployees'
      ]);
      Route::get('/store/add/employee/{storeId}', [
        'as'   => 'add.employee',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@addEmployee'
      ]);
      Route::get('/store/edit/employee/{id}', [
        'as'   => 'edit.employee',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@addEmployee'
      ]);
      Route::post('/store/add/employee/', [
        'as'   => 'save.employee',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@pAddEmployee'
      ]);
      Route::get('/store/delete/employee/{id}', [
        'as'   => 'employee.delete',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@deleteEmployee'
      ]);
      Route::get('/store/delete/employee/{id}', [
        'as'   => 'employee.delete',
        'uses' => 'LaravelAcl\Http\Controllers\StoreController@deleteEmployee'
      ]);
      Route::get('/company/list', [
        'as'   => 'company.list',
        'uses' => 'LaravelAcl\Http\Controllers\CompanyController@companyList'
      ]);
      Route::get('/company/edit', [
        'as'   => 'company.edit',
        'uses' => 'LaravelAcl\Http\Controllers\CompanyController@editCompany'
      ]);
      Route::post('/company/edit', [
        'as'   => 'company.edit',
        'uses' => 'LaravelAcl\Http\Controllers\CompanyController@pEditCompany'
      ]);
      /****products routes****/
      Route::get('/product/list/{companyId}', [
        'as'   => 'product.list',
        'uses' => 'LaravelAcl\Http\Controllers\ProductController@index'
      ]);
      Route::get('/product/edit', [
        'as'   => 'product.edit',
        'uses' => 'LaravelAcl\Http\Controllers\ProductController@edit'
      ]);
      Route::post('/product/edit', [
        'as'   => 'post.product.edit',
        'uses' => 'LaravelAcl\Http\Controllers\ProductController@store'
      ]);
      Route::get('/product/delete', [
        'as'   => 'product.delete',
        'uses' => 'LaravelAcl\Http\Controllers\ProductController@destroy'
      ]);
      Route::post('importExport', [
        'as'   => 'import',
        'uses'=>'LaravelAcl\Http\Controllers\ProductController@importExport']);
        /****TDF Routes***/
      });
      Route::get('getData', ['as'=>'datatables.data', 'uses'=>'LaravelAcl\Http\Controllers\DashboardController@checking']);

    });
  });
  //////////////////// Automatic error handling //////////////////////////

  if(Config::get('acl_base.handle_errors'))
  {
    App::error(function (RuntimeException $exception, $code)
    {
      switch($code)
      {
        case '404':
        return view('laravel-authentication-acl::client.exceptions.404');
        break;
        case '401':
        return view('laravel-authentication-acl::client.exceptions.401');
        break;
        case '500':
        return view('laravel-authentication-acl::client.exceptions.500');
        break;
      }
    });

    App::error(function (TokenMismatchException $exception)
    {
      return view('laravel-authentication-acl::client.exceptions.500');
    });
  }
