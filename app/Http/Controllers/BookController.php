<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if($request->hasFile('photo')){
            $fullName = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $saveFile = $filename . '_' . time() . '.' . $extension;
            $path = Storage::disk('public')->putFileAs('photos',$request->file('photo'),$saveFile);
            $buku->photo = $path;
        }
        
        $buku->save();
        return redirect(route('books.index'));
    }
    public function edit(Book $book){
        return view('book.edit',compact("book"));
    }
    public function admin(){
        $books = Book::all();
        return view('book.index',compact("books"));
    }
    public function update(Request $request, Book $book)
    {
        if($request->delete_photo){
            if($book->photo){
                Storage::disk('public')->delete($book->photo);
            }
            $request->request->remove('delete_photo');
            $book->photo = null;
        }
        $book->update($request->all());
        if($request->hasFile('photo')){
            if($book->photo){
                Storage::disk('public')->delete($book->photo);
            }
            $fullName = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $saveFile = $filename . '_' . time() . '.' . $extension;
            $path = Storage::disk('public')->putFileAs('photos',$request->file('photo'),$saveFile);
            $book->photo = $path;
        }
        $book->save();        
        return redirect(route('books.index'));
    }
    public function destroy(Book $book)
    {
        if($book->photo){
            Storage::disk('public')->delete($book->photo);
        }
        $book->delete();
        return redirect(route('books.index'));
    }
}
