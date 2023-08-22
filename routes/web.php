<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\ChangePasswordController; // Dodajte ovu liniju

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.systemCalendar')->with('status', session('status'));
    }

    return redirect()->route('admin.systemCalendar');
});


Route::get('/cancel/appointment/{id}' , 'Admin\TerminiController@cancelAppointment')->name('terminus.cancelAppointment');

Auth::routes(['register' => false]);

// Pravila privatnosti i uvjeti koristenja
Route::get('/pravila-privatnosti', [PagesController::class, 'pravilaPrivatnosti'])->name('pravila_privatnosti');
Route::get('/uvjeti-koristenja', [PagesController::class, 'uvjetiKoristenja'])->name('uvjeti_koristenja');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Zaposlenici
    Route::delete('zaposlenicis/destroy', 'ZaposleniciController@massDestroy')->name('zaposlenicis.massDestroy');
    Route::resource('zaposlenicis', 'ZaposleniciController');

    // Pacjenti
    Route::delete('pacjentis/destroy', 'PacjentiController@massDestroy')->name('pacjentis.massDestroy');
    Route::resource('pacjentis', 'PacjentiController');
    
    Route::get('/admin/termins/create', 'Admin\TerminController@create')->name('admin.termins.create');


    // Termini
    Route::delete('terminus/destroy', 'TerminiController@massDestroy')->name('terminus.massDestroy');
    Route::resource('terminus', 'TerminiController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

    Route::get('plans', [PlanController::class, 'index'])->name('plans');
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name("plans.show");

    Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");
    Route::post('subscription/cancel', [PlanController::class, 'cancel'])->name("subscription.cancel");

});

Route::any('stripe/success', function() {
    $status = 'success';
    $message = 'Subscription purchase successfully!';
    return view("subscription_success", compact('status', 'message'));
});

Route::any('stripe/fail', function() {
    $status = 'error';
    $message = 'Something went wrong!';
    return view("subscription_success", compact('status', 'message'));
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
    Route::post('password/confirm', [ChangePasswordController::class, 'confirm'])->name('password.confirm');
});