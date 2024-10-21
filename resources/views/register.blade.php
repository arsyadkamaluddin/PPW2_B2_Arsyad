@extends('layout.main')
@section('container')
<section class="vh-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="{{ route('store') }}" method="POST">    
            @csrf
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" name="email" class="form-control form-control-lg"
                placeholder="Email" />
            </div>
            <div data-mdb-input-init class="form-outline mb-3">
              <input type="password" name="password" class="form-control form-control-lg"
                placeholder="Password" />
            </div>
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Daftar</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya akun? <a href="{{ route('login') }}"
                  class="link-danger">Masuk</a></p>
            </div>
  
          </form>
        </div>
      </div>
  </section>
@endsection