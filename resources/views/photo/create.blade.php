@extends('layouts.main')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Foto</div>
                <div class="card-body">
                    <div class="row">

                        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="title" name="title" required>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end text-start">Description</label>
                                <div class="col-md-6">
                                    <textarea required class="form-control" id="description" rows="5" name="description"></textarea> @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">File
                                    input</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="picture" type="file" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
