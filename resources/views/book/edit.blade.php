@extends('layout.main')
@section('container')
    <h4 class="text-center mt-12">Ubah Data Buku</h4>
    <form action="{{route('books.update',$book->id)}}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input value="{{$book->title}}" name="title" type="text" class="form-control" placeholder="Judul Buku" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input value="{{$book->author}}" name="author" type="text" class="form-control" placeholder="Penulis" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input value="{{$book->price}}" name="price" type="number" class="form-control" placeholder="Harga" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Terbit</label>
            <input value="{{$book->published}}" name="published" type="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="submit" class="form-control btn btn-primary">
        </div>
        <a href="{{route('books.index')}}" class="form-control btn btn-danger">Batal</a>
    </form>
@endsection