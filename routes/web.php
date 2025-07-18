<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get("/login",[UserController::class, 'loginView'])->name('loginView');
Route::get("/register",[UserController::class, 'registerView'])->name('registerView');

Route::post("/login", [UserController::class, 'loginPost'])->name('loginPost');
Route::post("/register", [UserController::class, 'registerPost'])->name('registerPost');

Route::get('/pagina_principal', [UserController::class, 'pg_principal'])->name('pg_principal');

Route::get('/Task', [TaskController::class, 'TaskView'])->name('TaskView');
Route::post('/Task', [TaskController::class, 'TaskPost'])->name('TaskPost');

Route::get('/api/Task', [TaskController::class, 'index'])->name('index');

Route::get('/delete/task', [TaskController::class, 'deletePOST'])->name('deletePOST');

Route::post('/logout/{id}', [UserController::class, 'logout'])->name('logout');

Route::post('/editTask', [TaskController::class, 'editTask'])->name('editTask');

Route::get('/logs', [LogController::class, 'logs'])->name('logs');

Route::get('/api/users', function (Request $request) {
    $search = $request->q;

    return User::where('name', 'like', "%{$search}%")
        ->select('id', 'name')
        ->limit(10)
        ->get();
});

