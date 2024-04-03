@extends('adminlte::page')
@section('title', 'General Form')
@section('content_header')
    <h1>Form level</h1>
@stop
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- general form elements disabled -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Level</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{url ('/level')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="kodeLevel">Kode Level</label>
                            <input type="text" class="@error('Kode Level') is-invalid" @enderror form-control" id="kodeLevel" name="kodeLevel" 
                                placeholder="Untuk Administrator, Contoh: ADM">
                                
                                @error('kodeLevel')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- textarea -->
                        <div class="form-group">
                            <label for="namaLevel">Nama Level</label>
                            <input type="text" class="form-control" id="namaLevel" name="namaLevel" placeholder="Masukkan Nama Level">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- general form elements disabled -->
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop