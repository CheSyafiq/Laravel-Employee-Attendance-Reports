<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Time Entries
    Route::delete('time-entries/destroy', 'TimeEntriesController@massDestroy')->name('time-entries.massDestroy');
    Route::get('time-entries/show-current', 'TimeEntriesController@showCurrent')->name('time-entries.showCurrent');
    Route::post('time-entries/update-current', 'TimeEntriesController@updateCurrent')->name('time-entries.updateCurrent');
    Route::resource('time-entries', 'TimeEntriesController');

    Route::delete('listings/destroy', 'ListingController@massDestroy')->name('listings.massDestroy');
    Route::resource('listing', 'ListingController');
});
