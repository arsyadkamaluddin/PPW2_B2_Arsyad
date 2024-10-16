<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect("/books");
});
// Route::get('/books', [BookController::class, 'index'])->name("books.index");
// Route::get('/books/create', [BookController::class, 'create'])->name("books.create");
// Route::post('/books/create', [BookController::class, 'store'])->name("books.store");
// Route::delete('/books/{id}', [BookController::class, 'destroy'])->name("books.destroy");
// Route::get('/books/update/{id}', [BookController::class, 'edit'])->name("books.edit");
// Route::post('/books/update/{id}', [BookController::class, 'update'])->name("books.update");
Route::resource('books',BookController::class)->except('show');
