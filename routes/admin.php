<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

//admin login route---
Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'AdminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin','middleware' => 'is_admin','prefix'=>'admin'], function(){
    //Admin Profile Route-----
   Route::get('/home','AdminController@admin')->name('admin.home');
   Route::get('/logout','AdminController@Logout')->name('admin.logout');
   Route::get('/password/change','AdminController@PasswordChange')->name('password.change');
   Route::post('/password/update','AdminController@Update')->name('password.update');
   
   //Category route here--------
    Route::group(['prefix' => 'category'], function() {
       Route::get('/', 'CategoryController@index')->name('category');
       Route::post('/store', 'CategoryController@store')->name('store.category');
       Route::get('/edit/{id}', 'CategoryController@edit');
       Route::post('/update', 'CategoryController@update')->name('update.category');
       Route::delete('/delete/{id}', 'CategoryController@destroy')->name('category.delete');
   });
   //Subcategory route here--------
   Route::group(['prefix' => 'subcategory'], function() {
       Route::get('/', 'SubcategoryController@index')->name('subcategory');
       Route::post('/store', 'SubcategoryController@store')->name('store.subcategory');
       Route::get('/edit/{id}', 'SubcategoryController@edit');
       Route::post('/update', 'SubcategoryController@update')->name('update.subcategory');
       Route::delete('/delete/{id}', 'SubcategoryController@destroy')->name('subcategory.delete');
   });
   //Beverage route here--------
   Route::group(['prefix' => 'beverage'], function() {
      Route::get('/', 'CategoryController@b_index')->name('beverage');
      Route::post('/store', 'CategoryController@b_store')->name('store.beverage');
      Route::get('/edit/{id}', 'CategoryController@b_edit');
      Route::post('/update', 'CategoryController@b_update')->name('update.beverage');
      Route::delete('/delete/{id}', 'CategoryController@b_destroy')->name('beverage.delete');
   });
   //Coupon route here------
   Route::group(['prefix' => 'coupons'], function() {
      Route::get('/', 'CouponController@index')->name('coupon');
      Route::post('/store', 'CouponController@store')->name('coupon.store');
      Route::get('/edit/{id}', 'CouponController@edit');
      Route::post('/update', 'CouponController@update')->name('coupon.update');
      Route::delete('/delete/{id}', 'CouponController@destroy')->name('coupon.delete');
   });
   //Food route here--------
   Route::group(['prefix' => 'food'], function() {
      Route::get('/', 'FoodController@index')->name('food');
      Route::post('/store', 'FoodController@store')->name('store.food');
      Route::get('/edit/{id}', 'FoodController@edit');
      Route::post('/update','FoodController@update')->name('update.food');
      Route::delete('/delete/{id}','FoodController@destroy')->name('food.delete');
   });
   //Expensetype route here--------
   Route::group(['prefix' => 'expensetype'], function() {
      Route::get('/', 'ExpensetypeController@index')->name('expensetype');
      Route::post('/store', 'ExpensetypeController@store')->name('store.expensetype');
      Route::get('/edit/{id}', 'ExpensetypeController@edit');
      Route::post('/update','ExpensetypeController@update')->name('update.expensetype');
      Route::delete('/delete/{id}','ExpensetypeController@destroy')->name('expensetype.delete');
   });
    //Expense route here--------
   Route::group(['prefix' => 'expense'], function() {
      Route::get('/', 'ExpenseController@index')->name('expense');
      Route::post('/store', 'ExpenseController@store')->name('store.expense');
      Route::get('/edit/{id}', 'ExpenseController@edit');
      Route::post('/update','ExpenseController@update')->name('update.expense');
      Route::delete('/delete/{id}','ExpenseController@destroy')->name('expense.delete');
   });
   //Reservation route here--------
   Route::group(['prefix' => 'reservation'], function() {
      Route::get('/', 'ReservationController@index')->name('reservation');
      Route::get('/pending', 'ReservationController@PendingReservation')->name('pending.reservation');
      Route::post('/store', 'ReservationController@store')->name('store.reservation');
      Route::get('/edit/{id}', 'ReservationController@edit');
      Route::post('/update','ReservationController@update')->name('update.reservation');
      Route::delete('/delete/{id}','ReservationController@destroy')->name('reservation.delete');
   });
   //Blogcategory route here--------
   Route::group(['prefix' => 'blog-category'], function() {
      Route::get('/', 'BlogcategoryController@index')->name('blog.category');
      Route::post('/store', 'BlogcategoryController@store')->name('store.blogcategory');
      Route::get('/edit/{id}', 'BlogcategoryController@edit');
      Route::post('/update', 'BlogcategoryController@update')->name('update.blogcategory');
      Route::delete('/delete/{id}', 'BlogcategoryController@destroy')->name('blogcategory.delete');
   });
   //Blog route here--------
   Route::group(['prefix' => 'blog'], function() {
      Route::get('/', 'BlogController@index')->name('blog');
      Route::post('/store', 'BlogController@store')->name('store.blog');
      Route::get('/edit/{id}', 'BlogController@edit');
      Route::post('/update', 'BlogController@update')->name('update.blog');
      Route::delete('/delete/{id}', 'BlogController@destroy')->name('blog.delete');
   });
   //Client say route here--------
   Route::group(['prefix' => 'pending-review'], function() {
      Route::get('/', 'ClientController@index')->name('pending.review');
      Route::get('/edit/{id}', 'ClientController@edit');
      Route::post('/update', 'ClientController@update')->name('update.review');
   });
   //Floor route here--------
   Route::group(['prefix' => 'setup-floor'], function() {
      Route::get('/', 'FloorController@index')->name('floor');
      Route::post('/store', 'FloorController@store')->name('store.floor');
      Route::get('/edit/{id}', 'FloorController@edit');
      Route::post('/update', 'FloorController@update')->name('update.floor');
      Route::delete('/delete/{id}', 'FloorController@destroy')->name('floor.delete');
   });
   //Table route here--------
   Route::group(['prefix' => 'setup-table'], function() {
      Route::get('/', 'TableController@index')->name('table');
      Route::post('/store', 'TableController@store')->name('store.table');
      Route::get('/edit/{id}', 'TableController@edit');
      Route::post('/update', 'TableController@update')->name('update.table');
      Route::delete('/delete/{id}', 'TableController@destroy')->name('table.delete');
   });
   //Customer route here--------
   Route::group(['prefix' => 'customer'], function() {
      Route::get('/', 'CustomerController@index')->name('customer');
      Route::post('/store', 'CustomerController@store')->name('store.customer');
      Route::get('/edit/{id}', 'CustomerController@edit');
      Route::post('/update', 'CustomerController@update')->name('update.customer');
      Route::delete('/delete/{id}', 'CustomerController@destroy')->name('customer.delete');
      Route::get('/active/{id}', 'CustomerController@Active');
   });

   //HRM ALL Route start
     //designation route-----
   Route::group(['prefix' => 'designation'], function() {
      Route::get('/', 'Hrm\DesignationController@index')->name('designation');
      Route::post('/store', 'Hrm\DesignationController@store')->name('store.designation');
      Route::get('/edit/{id}', 'Hrm\DesignationController@edit');
      Route::post('/update', 'Hrm\DesignationController@update')->name('update.designation');
      Route::delete('/delete/{id}', 'Hrm\DesignationController@destroy')->name('designation.delete');
   });
   //department route-----
   Route::group(['prefix' => 'department'], function() {
      Route::get('/department', 'Hrm\DesignationController@indexDepartment')->name('department');
      Route::post('/store', 'Hrm\DesignationController@storeDepartment')->name('department.store');
      Route::get('/edit/{id}', 'Hrm\DesignationController@editDepartment');
      Route::post('/update', 'Hrm\DesignationController@updateDepartment')->name('department.update');
      Route::delete('/delete/{id}', 'Hrm\DesignationController@destroyDepartment')->name('delete.department');
   });
   //employee route-----
   Route::group(['prefix' => 'employee'], function() {
      Route::get('/', 'Hrm\EmployeeController@index')->name('employee');
      Route::post('/store', 'Hrm\EmployeeController@store')->name('store.employee');
      Route::get('/edit/{id}', 'Hrm\EmployeeController@edit');
      Route::post('/update', 'Hrm\EmployeeController@update')->name('update.employee');
      Route::delete('/delete/{id}', 'Hrm\EmployeeController@destroy')->name('employee.delete');
   });
    //employee award route-----
   Route::group(['prefix' => 'award'], function() {
      Route::get('/', 'Hrm\AwardController@index')->name('award');
      Route::post('/store', 'Hrm\AwardController@store')->name('store.award');
      Route::get('/edit/{id}', 'Hrm\AwardController@edit');
      Route::post('/update', 'Hrm\AwardController@update')->name('update.award');
      Route::delete('/delete/{id}', 'Hrm\AwardController@destroy')->name('award.delete');
   });
   //holiday route-----
   Route::group(['prefix' => 'holiday'], function() {
      Route::get('/', 'Hrm\HolidayController@index')->name('holiday');
      Route::post('/store', 'Hrm\HolidayController@store')->name('store.holiday');
      Route::get('/edit/{id}', 'Hrm\HolidayController@edit');
      Route::post('/update', 'Hrm\HolidayController@update')->name('update.holiday');
      Route::delete('/delete/{id}', 'Hrm\HolidayController@destroy')->name('holiday.delete');
   });
   //leavetype route-----
   Route::group(['prefix' => 'leave-type'], function() {
      Route::get('/', 'Hrm\LeaveController@index')->name('leavetype');
      Route::post('/store', 'Hrm\LeaveController@store')->name('store.leavetype');
      Route::get('/edit/{id}', 'Hrm\LeaveController@edit');
      Route::post('/update', 'Hrm\LeaveController@update')->name('update.leavetype');
      Route::delete('/delete/{id}', 'Hrm\LeaveController@destroy')->name('leavetype.delete');
   });
   //leave route-----
   Route::group(['prefix' => 'leave'], function() {
      Route::get('/', 'Hrm\LeaveController@leaveIndex')->name('leave');
      Route::post('/store', 'Hrm\LeaveController@leaveStore')->name('store.leave');
      Route::get('/edit/{id}', 'Hrm\LeaveController@leaveEdit');
      Route::post('/update', 'Hrm\LeaveController@LeaveUpdate')->name('update.leave');
      Route::delete('/delete/{id}', 'Hrm\LeaveController@leaveDestroy')->name('leave.delete');
   });
    //single attendance route-----
   Route::group(['prefix' => 'attendance'], function() {
      Route::get('/', 'Hrm\AttendanceController@Index')->name('single.attendance');
      Route::get('create/person/wise/row/{user_id}', 'Hrm\AttendanceController@CreateRow');
      Route::post('/store', 'Hrm\AttendanceController@personwise')->name('personwise.attendance.store');
      //all attendance route
      Route::get('/all', 'Hrm\AttendanceController@allAttendance')->name('all.attendance');
      Route::post('/missing/store', 'Hrm\AttendanceController@missingStore')->name('missing.attendance.store');
      Route::get('/edit/{id}', 'Hrm\AttendanceController@AttendanceEdit');
      Route::post('/update', 'Hrm\AttendanceController@AttendanceUpdate')->name('update.attendance');
      Route::delete('/delete/{id}', 'Hrm\AttendanceController@AttendanceDestroy')->name('attendance.delete');
      //attendance adjustment
      Route::get('/adjustment', 'Hrm\AttendanceController@Adjustment')->name('attendance.adjustment');
      Route::get('/adjustment/page', 'Hrm\AttendanceController@AdjustmentForm')->name('adjustment.form');
      Route::get('/clockin_change/{id}/{date}/{clock_in}', 'Hrm\AttendanceController@clockInChange');
      Route::get('/clockout_change/{id}/{date}/{clock_out}', 'Hrm\AttendanceController@clockOutChange');
   });
   //setting route here-----
   Route::group(['prefix' => 'setting'], function() {
      Route::get('/seo', 'SettingController@seoSetting')->name('setting.seo');
      Route::post('/seo/update/{id}', 'SettingController@SeoUpdate')->name('seo.setting.update');
      Route::get('/wedsite','SettingController@Setting')->name('setting');
      Route::post('/update/{id}', 'SettingController@SettingUpdate')->name('website.setting.update');
      Route::get('/smtp','SettingController@smtpSetting')->name('smtp.setting');
      Route::post('/smtp/update/{id}', 'SettingController@SmtpUpdate')->name('smtp.setting.update');
   });
   //payment gateway route here-----
   Route::group(['prefix' => 'payment-gateway'], function() {
      Route::get('/', 'SettingController@paymentGateway')->name('payment.gateway');
      Route::post('/update-aamarpay', 'SettingController@AamarpayUpdate')->name('aamarpay.update');
      Route::post('/update-surjopay', 'SettingController@SurjopayUpdate')->name('surjopay.update');
      Route::post('/update-ssl', 'SettingController@SSLUpdate')->name('ssl.update');
   });
});