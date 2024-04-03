@extends('layouts.app')

{{--Customixe Layout Sections--}}

@section('subtitle', 'User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'User')

@section('content')
    <div class="card">
            <div class="card-header">Manage User</div>
            <div class="card-body"> 
                <a class="btn btn-primary mb-3" href={{url("/user/create")}}>Tambah Kategori</a>
                {{ $dataTable->table() }}
            </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush