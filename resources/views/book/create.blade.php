
@extends('layouts.main')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah buku</div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{route('books.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Buku</label>
                                <input name="title" type="text" class="form-control" placeholder="Judul Buku" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penulis</label>
                                <input name="author" type="text" class="form-control" placeholder="Penulis" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input name="price" type="number" class="form-control" placeholder="Harga" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Terbit</label>
                                <input name="published" type="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input name="photo" type="file" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="form-control btn btn-primary">
                            </div>
                            <a href="{{route('books.index')}}" class="form-control btn btn-danger">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
