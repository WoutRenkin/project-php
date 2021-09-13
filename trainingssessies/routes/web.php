<?php

use App\StudentAcademyYear;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('logout','Auth\LoginController@logout');
Route::redirect('home', '/');
Route::resource('/', 'HomeController');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::view('help', 'admin/help');
    Route::resource('home', 'admin\HomeController');
    Route::put('students/{student}/deactivate', 'admin\UserController@deactivate');
    Route::put('students/{student}/activate', 'admin\UserController@activate');
    Route::get('students/{student}/addToYear', 'admin\UserController@addToYear');
    Route::get('students/{studentAcademyYear}/download', 'admin\UserController@download');
    Route::post('students/excel', 'admin\UserController@excel');
    Route::resource('students', 'admin\UserController');
    Route::get('admins', 'admin\UserController@admin');


    //Beheer organisaties

    Route::put('organisations/{organisation}/updateActive', 'admin\OrganisationController@updateActive');
    Route::resource('organisations', 'admin\OrganisationController');

    //Beheer teams
    Route::get('teams/checkStudents', 'admin\TeamController@checkStudents');

    Route::resource('teams', 'admin\TeamController');
    Route::put('teams/{team}/deactivate', 'admin\TeamController@deactivate');
    Route::put('teams/{team}/activate', 'admin\TeamController@activate');


    Route::put('coordinators/{coordinator}/deactivate', 'admin\CoordinatorController@deactivate');
    Route::resource('coordinators', 'admin\CoordinatorController');


    //Sessions beheren
    Route::resource('sessions', 'admin\SessionController');
    Route::get('sessions/{session}/download', 'admin\SessionController@download');

    //beheer voorstel
    Route::resource('voorstel', 'admin\SuggestionController');

    //beheer academiejaar
    Route::resource('academiejaar', 'admin\AcademyYearController');
    Route::put('academiejaar/{id}/activate', 'admin\AcademyYearController@activate');

    //Calendar
    Route::resource('calendar', 'admin\CalendarController');
    //Documents
    Route::put('documents/{file}/updateActive', 'admin\DocumentController@updateActive');
    Route::resource('documents', 'admin\DocumentController');
    Route::get('documents/{file}/download', 'admin\DocumentController@download');

    //Notification selfevaluation
    Route::post('notifications/selfevaluation/markAsRead', 'admin\NotificationSelfevaluationController@markAsRead');
    Route::get('notifications/selfevaluation/{studentAcademyYear}/download', 'admin\NotificationSelfevaluationController@download');
    Route::get('notifications/selfevaluation/getReadNotifications','admin\NotificationSelfevaluationController@getReadNotifications');
    Route::resource('notifications/selfevaluation','admin\NotificationSelfevaluationController');

    //Notification session
    Route::post('notifications/session/markAsRead', 'admin\NotificationsessionController@markAsRead');
    Route::get('notifications/session/getReadNotifications','admin\NotificationsessionController@getReadNotifications');
    Route::resource('notifications/session','admin\NotificationsessionController');

    //docenten
    Route::get('docents', 'admin\DocentController@index');
    Route::get('docents/reset', 'admin\DocentController@reset');

});

Route::middleware(['auth', 'student'])->prefix('student')->group(function () {
    Route::resource('teams', 'student\TeamController');
    Route::resource('calendar', 'student\CalendarController');
    Route::resource('voorstel', 'student\SuggestionController');
    Route::get('voorstel/{session}/download', 'student\SuggestionController@download');
    Route::resource('information', 'student\InfoController');

    //Documents
    Route::get('documents/{file}/download', 'student\DocumentController@download');
    Route::resource('documents', 'student\DocumentController');

    Route::get('selfevaluation/{studentAcademyYear}/download', 'student\SelfevaluationController@download');
    Route::resource('selfevaluation', 'student\SelfevaluationController');
    Route::view('help', 'student/help');
});

Route::resource('profile', 'student\InfoController');

//docent routes
Route::get('docent/{token}', 'docent\SessionController@calendar');
Route::get('docent/{token}/{show}', 'docent\SessionController@show');
Route::post('docent/store/{token}/{id}', 'docent\SessionController@store');
