@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Profile</div>
            <div class="card-body">
                @if ($message = Session::get('error'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
                @endif
                <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            <input type="email" readonly class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                            <input type="email" readonly class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="photo" class="col-md-4 col-form-label text-md-end text-start">Current Avatar</label>
                        <div class="col-md-6">
                            @if (Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Photo" style="max-width: 150px;">
                            @endif
                            @error('photo')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="photo" class="col-md-4 col-form-label text-md-end text-start">Upload Avatar</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo') }}">
                            @if ($errors->has('photo'))
                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection