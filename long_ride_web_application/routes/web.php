<?php

use App\Http\Controllers\PassengerController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DailyRoutesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\test;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketInspectorController;
use App\Http\Controllers\TimeTableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('sample');
// });

Route::get('/report', function () {
    return view('reports.index');
});

Route::get('/',[test::class, 'index'])->name('test');

//Ticket Inspector Routes
Route::get('/ticketInspector/create_view',[TicketInspectorController::class, 'create'])->name('createTicketInspector_view');

Route::post('/ticketInspector/create',[TicketInspectorController::class, 'store'])->name('createTicketInspector');

Route::get('/ticketInspector/index',[TicketInspectorController::class, 'index'])->name('ticketInspector_index');

Route::post('/ticketInspector/delete/{id}',[TicketInspectorController::class, 'destroy'])->name('timetableInspector_delete');

Route::get('/ticketInspector/edit/{id?}',[TicketInspectorController::class, 'edit'])->name('ticketInspector_edit_view');

Route::post('/ticketInspector/update/{id?}',[TicketInspectorController::class, 'update'])->name('ticketInspector_update');

Route::get('/report/inspector',[TicketInspectorController::class, 'loadModal'])->name('inspector_load');

Route::post('/report/inspector/print',[TicketInspectorController::class, 'generateInspectorReport'])->name('inspector_print');

//Timetable Routes
Route::get('/timetable/index/{id?}',[TimeTableController::class, 'index'])->name('timetable_index');

Route::get('/timetable/create/{id?}',[TimeTableController::class, 'create'])->name('create_timeTable_view');

Route::post('/timetable/create',[TimeTableController::class, 'store'])->name('create_timetable');

Route::post('/timetable/delete/{id}',[TimeTableController::class, 'destroy'])->name('timeTable_delete');

Route::get('/timetable/edit/{id?}',[TimeTableController::class, 'edit'])->name('time_table_edit_view');

Route::post('/timetable/update/{id?}',[TimeTableController::class, 'update'])->name('timetable_update');

Route::get('/timetable/view/{id?}',[TimeTableController::class, 'show'])->name('timetable_view');

Route::get('/timetable/report/print/{id?}',[TimeTableController::class, 'printReport'])->name('timetable_report_print');

Route::get('/report/timetable',[TimeTableController::class, 'loadModal'])->name('timetable_load');

Route::post('/report/timetable/print',[TimeTableController::class, 'generateTimetableReport'])->name('timetable_print');

//Passenger Routes
Route::get('passenger/index/{type?}',[PassengerController::class, 'index'])->name('passenger_index');

Route::post('/passenger/create/{action}/{id?}',[PassengerController::class, 'create'])->name('passenger_create');

Route::get('/passenger/view/{action}/{id?}',[PassengerController::class, 'view'])->name('passenger_view');

Route::post('/passenger/changePassengerStatus',[PassengerController::class, 'changePassengerStatus'])->name('changePassengerStatus');

//Passenger Report Routes
Route::get('/report/passenger',[PassengerController::class, 'loadModal'])->name('passenger_load');

Route::post('/report/passenger/print',[PassengerController::class, 'generatePassengerReport'])->name('passenger_print');

//Daily-Routes Routes
Route::get('/route/index/{action?}',[DailyRoutesController::class, 'index'])->name('route_index');

Route::get('/route/view/{action?}/{id?}',[DailyRoutesController::class, 'view'])->name('route_view');

Route::post('/route/create/{action?}/{id?}',[DailyRoutesController::class, 'create'])->name('route_create');

Route::get('/report/route',[DailyRoutesController::class, 'loadModal'])->name('route_load');

Route::post('/report/route/print',[DailyRoutesController::class, 'generateRouteReport'])->name('route_print');

Route::post('/route/changeRouteStatus',[DailyRoutesController::class, 'changeRouteStatus'])->name('changeRouteStatus');

//Card Routes
Route::get('/card/index',[CardController::class, 'index'])->name('card_index');

Route::get('/card/view/{action?}/{id?}',[CardController::class, 'view'])->name('card_view');

Route::post('/card/create/{action?}/{id?}',[CardController::class, 'create'])->name('card_create');

Route::post('/card/changeAvailabilityStatus',[CardController::class, 'changeAvailabilityStatus'])->name('changeAvailabilityStatus');

//Vehicle Routes
Route::get('/report/vehicle',[VehicleController::class, 'loadModal'])->name('vehicle_load');

Route::post('/report/vehicle/print',[VehicleController::class, 'generateVehicleReport'])->name('vehicle_print');

Route::post('/login',[LoginController::class, 'index'])->name('login_index');

Route::get('/', function(){
    return view('auth.login');
});
