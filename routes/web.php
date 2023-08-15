<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use \App\Models\Task;

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

    $tasks = Task::latest()->get();

    return view('index', [
        'tasks' => $tasks
    ]);
})->name('task.index');

// Create is the name
Route::view('/tasks/create', 'create');

Route::get('/tasks/{id}', function ($id) {
    // $task = \App\Models\Task::find($id);
    $task = Task::findOrFail($id);

    return view('show', ['task' => $task]);
})->name('task.show');

Route::post('/task', function (Request $request) {
    // dd($request->all());

    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('task.show', ['id' => $task->id])->with('success', 'Task created successfully!');
})->name('task.store');

Route::fallback(function () {
    return 'Still got somewhere!';
});

// GET
// POST , store new data to send form
// PUT , modify an existing thing
// DELETE 