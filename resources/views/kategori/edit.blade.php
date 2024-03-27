@extends('layouts.app')

@section('subtitle', 'Edit Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit Kategor</div>
            <div class="card-body">
                <form action="{{ url('kategori/update', $data->kategori_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kategori_id">Kategori ID</label>
                        <input type="text" class="form-control" id="kategori_id" name="kategori_id" value="{{ $data->kategori_id }}" disabled>

                    </div>

                    <div class="form-group">
                        <label for="kategori_kode">Kategori Kode</label>
                        <input type="text" class="form-control" id="kategori_kode" name="kategori_kode" value="{{ $data->kategori_kode }}">
                    </div>

                    <div class="form-group">
                        <label for="kategori_nama">Kategori Nama</label>
                        <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" value="{{ $data->kategori_nama }}">
                    </div>

                    <a class="btn btn-danger" href={{url('/kategori') }}>Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection