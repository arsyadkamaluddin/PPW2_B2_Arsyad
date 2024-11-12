@extends('layouts.main')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ubah data buku</div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Judul Buku</label>
                                <input value="{{ $book->title }}" name="title" type="text" class="form-control" placeholder="Judul Buku"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penulis</label>
                                <input value="{{ $book->author }}" name="author" type="text" class="form-control" placeholder="Penulis"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input value="{{ $book->price }}" name="price" type="number" class="form-control" placeholder="Harga"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Terbit</label>
                                <input value="{{ $book->published }}" name="published" type="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input name="photo" type="file" class="form-control">
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="delete_photo" value="true" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Hapus foto?
                                </label>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="form-control btn btn-primary">
                            </div>
                            <a href="{{ route('books.index') }}" class="form-control btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
