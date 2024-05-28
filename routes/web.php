<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;


Route::get('/', function () {
    return view('welcome');
});


// Calendar routes
Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');

//normal:noreccurence
Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');

//daily
Route::post('calendar2', [CalendarController::class, 'store2'])->name('calendar.store2');
Route::post('calendar3', [CalendarController::class, 'store3'])->name('calendar.store3');


//weekly
Route::post('calendar4', [CalendarController::class, 'store4'])->name('calendar.store4');
Route::post('calendar5', [CalendarController::class, 'store5'])->name('calendar.store5');

//month
Route::post('storemontlyendbydate', [CalendarController::class, 'storemontlyendbydate'])->name('calendar.storemontlyendbydate');
Route::post('storemontlyendbyoccurence', [CalendarController::class, 'storemontlyendbyoccurence'])->name('calendar.storemontlyendbyoccurence');


Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');

Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
Route::delete('calendarfutureevent/destroy/{Numreccurence}', [CalendarController::class, 'destroyallfutureevents'])->name('calendar.destroyallfutureevents');