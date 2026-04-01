<?php
use App\Http\Controllers\StudentController;

Route::get('/', function() {
    return redirect()->route('students.index');
});

Route::resource('students', StudentController::class);

Route::get('students-trash', [StudentController::class, 'trash'])->name('students.trash');
Route::post('students-restore/{id}', [StudentController::class, 'restore'])->name('students.restore');
Route::delete('students-delete/{id}', [StudentController::class, 'forceDelete'])->name('students.delete');