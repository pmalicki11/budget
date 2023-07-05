<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReceiversController;
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
/*
 * GET     - Request a resource
 * POST    - Create a new resource
 * PUT     - Update a resource
 * PATCH   - Modify a resource
 * DELETE  - Delete a resource
 * OPTIONS - Ask the server which verbs are allowed
 */

Route::get('/', HomeController::class)->name('home.index');
Route::prefix('/expenses')->group(function () {
    Route::get('/', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/{id}', [ExpensesController::class, 'show'])->name('expenses.show')->where('id', '[0-9]+');
    Route::get('/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('/', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/edit/{id}', [ExpensesController::class, 'edit'])->name('expenses.edit')->where('id', '[0-9]+');
    Route::patch('/{id}', [ExpensesController::class, 'update'])->name('expenses.update')->where('id', '[0-9]+');
    Route::delete('/{id}', [ExpensesController::class, 'destroy'])->name('expenses.destroy')->where('id', '[0-9]+');
    Route::get('/report', [ExpensesController::class, 'report'])->name('expenses.report');
});

Route::prefix('/receivers')->group(function () {
    Route::get('/', [ReceiversController::class, 'index'])->name('receivers.index');
    Route::get('/{id}', [ReceiversController::class, 'show'])->name('receivers.show')->where('id', '[0-9]+');
    Route::get('/create', [ReceiversController::class, 'create'])->name('receivers.create');
    Route::post('/', [ReceiversController::class, 'store'])->name('receivers.store');
    Route::get('/edit/{id}', [ReceiversController::class, 'edit'])->name('receivers.edit')->where('id', '[0-9]+');
    Route::patch('/{id}', [ReceiversController::class, 'update'])->name('receivers.update')->where('id', '[0-9]+');
    Route::delete('/{id}', [ReceiversController::class, 'destroy'])->name('receivers.destroy')->where('id', '[0-9]+');
    Route::get('/report', [ReceiversController::class, 'report'])->name('receivers.report');
});

Route::get('/incomes', function () {
    return view('incomes.index');
})->name('incomes.index');

