<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('task.index');
});

Route::get('/tasks', function () {
    // $tasks = App\Models\Task::all();
    // $tasks = App\Models\Task::latest()->where('completed', true)->get();

    $tasks = App\Models\Task::latest()->get();

    return view('index', [
        'tasks' => $tasks
    ]);
})->name('task.index');

Route::get('/tasks/{id}', function ($id) {
    // $task = \App\Models\Task::find($id);
    $task = \App\Models\Task::findOrFail($id);

    return view('show', ['task' => $task]);
})->name('task.show');

// Route::get('/hello', function () {
//     return 'Hello';
// })->name('hello');

// Route::get('/hallo', function () {
//     // return redirect('/hello');
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

Route::fallback(function () {
    return 'Still got somewhere!';
});

// GET
// POST , store new data to send form
// PUT , modify an existing thing
// DELETE 