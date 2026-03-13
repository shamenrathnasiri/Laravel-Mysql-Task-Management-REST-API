<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $stats = [];
    if (auth()->check()) {
        $userId = auth()->id();
        $stats = [
            'total'       => \App\Models\Task::where('user_id', $userId)->count(),
            'pending'     => \App\Models\Task::where('user_id', $userId)->where('status', 'pending')->count(),
            'in_progress' => \App\Models\Task::where('user_id', $userId)->where('status', 'in_progress')->count(),
            'completed'   => \App\Models\Task::where('user_id', $userId)->where('status', 'completed')->count(),
        ];
    }
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tasks', TaskController::class);
    Route::get('trashed-tasks', [TaskController::class, 'trashed'])->name('tasks.trashed');
    Route::delete('trashed-tasks/{id}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.forceDelete');
});

require __DIR__.'/auth.php';
