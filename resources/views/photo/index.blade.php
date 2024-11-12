@extends('layouts.main')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Foto</div>
                <div class="card-body">
                    <a class="mt-2 btn btn-primary" href="{{ route('photos.create') }}">Tambah Foto</a>
                    <div class="row mt-3">
                        @if (count($photos) > 0)
                        @foreach ($photos as $item)
                        <div class="col-sm-2">
                            <div class="flex">
                                <a class="btn" href="{{ route('photos.edit',$item->id) }}">Edit</a>
                                <form action="{{ route('photos.destroy',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn d-inline" type="submit">Hapus</button>
                                </form>

                            </div>
                            <div>
                                <a class="example-image-link"
                                href="{{ Storage::url("$item->picture") }}" data-lightbox="roadtrip"
                                data-title="{{ $item->description }}">
                                <img class="example-image img-fluid mb-2"
                                src='{{ Storage::url("$item->picture") }}' alt="image-1" />
                            </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>Tidak ada data.</h3>
                        @endif
                        <div class="d-flex">
                            {{ $photos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
