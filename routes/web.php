<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\GoalStatusController;
use App\Http\Controllers\GratitudeController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TodoController;
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

Route::get('/', [AuthController::class,'login']);

Route::get('/login', [AuthController::class,'login'])->name('login');
Route::get('/signup', [AuthController::class,'signup']);
Route::get('/forgot-password', [AuthController::class,'forgotPassword']);
Route::get('/password-reset', [AuthController::class,'passwordReset']);
Route::get('/business-plans', [PlansController::class,'businessPlans']);
Route::get('/write-business-plan', [PlansController::class,'writeBusinessPlans']);
Route::get('/view-business-plan', [PlansController::class,'viewBusinessPlan']);

Route::get('/goals', [GoalsController::class,'goals']);
Route::get('/set-goal', [GoalsController::class,'setGoal']);
Route::get('/vision-board', [GoalsController::class,'visionBoard']);
Route::get('/plans', [PlansController::class,'plans']);
Route::get('/weekly-plans', [PlansController::class,'weeklyPlans']);
Route::get('/weekly-plan', [PlansController::class,'weeklyPlan']);
Route::get('/goal-plans', [PlansController::class,'goalPlans']);
Route::get('/calendar/{action?}', [PlansController::class,'calendarAction']);

Route::get('/notes', [ActionsController::class,'notes']);
Route::get('/todos', [ActionsController::class,'todos']);
Route::get('/add-tolearn', [ActionsController::class,'addtoLearn']);
Route::get('/add-task', [ActionsController::class,'addTask']);
Route::get('/add-note', [ActionsController::class,'addNote']);
Route::get('/view-note', [ActionsController::class,'viewNote']);
Route::get('/view-todo', [ActionsController::class,'viewTodo']);
Route::get('/tolearn', [ActionsController::class,'tolearn']);
Route::get('/gratitude', [GratitudeController::class,'gratitude']);
Route::get('/projects', [ProjectController::class,'projects']);
Route::get('/create-project', [ProjectController::class,'createProject']);
Route::get('/view-project', [ProjectController::class,'viewProject']);

Route::post('/save-event', [PlansController::class,'eventPost']);
Route::post('/user-post', [ProfileController::class,'userPost']);


