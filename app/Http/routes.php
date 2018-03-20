<?php
use Illuminate\Session\TokenMismatchException;

/*
  |--------------------------------------------------------------------------
  | Public side (no auth required)
  |--------------------------------------------------------------------------
  |
*/

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
        Route::post('/searchRecords', [
            "as"   => "search.records",
            "uses" => 'LaravelAcl\Http\Controllers\HomeController@searchRecords'
        ]);
        Route::post('/validateDelivery/', [
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
        Route::post('/exportHistory', [ 
            "as"   => "delivery.export",
            "uses" => 'LaravelAcl\Http\Controllers\DeliveryController@exportHistory'
        ]);
    });

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
     * User signup
     */
    Route::post('/user/signup', [
            'uses' => 'LaravelAcl\Authentication\Controllers\UserController@postSignup',
            "as"   => "user.signup.process"
    ]);
    Route::get('/user/signup', [
            'uses' => 'LaravelAcl\Authentication\Controllers\UserController@signup',
            "as"   => "user.signup"
    ]);
    Route::post('captcha-ajax', [
            "before" => "captcha-ajax",
            'uses'   => 'LaravelAcl\Authentication\Controllers\UserController@refreshCaptcha',
            "as"     => "user.captcha-ajax.process"
    ]);
    Route::get('/user/email-confirmation', [
            'uses' => 'LaravelAcl\Authentication\Controllers\UserController@emailConfirmation',
            "as"   => "user.email-confirmation"
    ]);
    Route::get('/user/signup-success', [
            "uses" => 'LaravelAcl\Authentication\Controllers\UserController@signupSuccess',
            "as"   => "user.signup-success"
    ]);

    /*
      |--------------------------------------------------------------------------
      | Admin side (auth required)
      |--------------------------------------------------------------------------
      |
      */
    Route::group(['middleware' => ['admin_logged', 'can_see']], function ()
    {
        /**
         * dashboard
         */
        Route::get('/admin/users/dashboard', [
                'as'   => 'dashboard.default',
                'uses' => 'LaravelAcl\Authentication\Controllers\DashboardController@base'
        ]);

        /**
         * user
         */
        Route::get('/admin/users/list', [
                'as'   => 'users.list',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@getList'
        ]);
        Route::get('/admin/users/edit', [
                'as'   => 'users.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@editUser'
        ]);
        Route::post('/admin/users/edit', [
                'as'   => 'users.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@postEditUser'
        ]);
        Route::get('/admin/users/delete', [
                'as'   => 'users.delete',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@deleteUser'
        ]);
        Route::post('/admin/users/groups/add', [
                'as'   => 'users.groups.add',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@addGroup'
        ]);
        Route::post('/admin/users/groups/delete', [
                'as'   => 'users.groups.delete',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@deleteGroup'
        ]);
        Route::post('/admin/users/editpermission', [
                'as'   => 'users.edit.permission',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@editPermission'
        ]);
        Route::get('/admin/users/profile/edit', [
                'as'   => 'users.profile.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@editProfile'
        ]);
        Route::post('/admin/users/profile/edit', [
                'as'   => 'users.profile.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@postEditProfile'
        ]);
        Route::post('/admin/users/profile/addField', [
                'as'   => 'users.profile.addfield',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@addCustomFieldType'
        ]);
        Route::post('/admin/users/profile/deleteField', [
                'as'   => 'users.profile.deletefield',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@deleteCustomFieldType'
        ]);
        Route::post('/admin/users/profile/avatar', [
                'as'   => 'users.profile.changeavatar',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@changeAvatar'
        ]);
        Route::get('/admin/users/profile/self', [
                'as'   => 'users.selfprofile.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\UserController@editOwnProfile'
        ]);

        /**
         * groups
         */
        Route::get('/admin/groups/list', [
                'as'   => 'groups.list',
                'uses' => 'LaravelAcl\Authentication\Controllers\GroupController@getList'
        ]);
        Route::get('/admin/groups/edit', [
                'as'   => 'groups.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\GroupController@editGroup'
        ]);
        Route::post('/admin/groups/edit', [
                'as'   => 'groups.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\GroupController@postEditGroup'
        ]);
        Route::get('/admin/groups/delete', [
                'as'   => 'groups.delete',
                'uses' => 'LaravelAcl\Authentication\Controllers\GroupController@deleteGroup'
        ]);
        Route::post('/admin/groups/editpermission', [
                'as'   => 'groups.edit.permission',
                'uses' => 'LaravelAcl\Authentication\Controllers\GroupController@editPermission'
        ]);

        /**
         * permissions
         */
        Route::get('/admin/permissions/list', [
                'as'   => 'permission.list',
                'uses' => 'LaravelAcl\Authentication\Controllers\PermissionController@getList'
        ]);
        Route::get('/admin/permissions/edit', [
                'as'   => 'permission.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\PermissionController@editPermission'
        ]);
        Route::post('/admin/permissions/edit', [
                'as'   => 'permission.edit',
                'uses' => 'LaravelAcl\Authentication\Controllers\PermissionController@postEditPermission'
        ]);
        Route::get('/admin/permissions/delete', [
                'as'   => 'permission.delete',
                'uses' => 'LaravelAcl\Authentication\Controllers\PermissionController@deletePermission'
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