@extends('layouts.app')

{{--Customixe Layout Sections--}}

@section('subtitle', 'Level')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Level')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Level</div>
            <div class="card-body"> {{ $dataTable->table() }}
            <a class="btn btn-primary" href={{url("/level/create")}}>Tambah Kategori</a>
        </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush