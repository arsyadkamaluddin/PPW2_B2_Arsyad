<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('book.index',compact("books"));
    }
    public function create()
    {
        return view('book.create');
    }
    public function store(Request $request)
    {
        $buku = new Book();
        $buku->title = $request->title;
        $buku->author = $request->author;
        $buku->price = $request->price;
        $buku->published = $request->published;
        $buku->save();
        return redirect(route('books.index'));
    }
    public function edit(Book $book){
        return view('book.edit',compact("book"));
    }
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        $book->save();        
        return redirect(route('books.index'));
    }
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect(route('books.index'));
    }
}
