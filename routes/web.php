<?php

Route::get('/password/setup/{token}', 'LukaPeharda\LaravelPasswordSetup\Controllers\PasswordSetupController@showPasswordForm')->name('password.setup')->middleware('web');
Route::post('/password/save', 'LukaPeharda\LaravelPasswordSetup\Controllers\PasswordSetupController@savePassword')->name('password.save')->middleware('web');