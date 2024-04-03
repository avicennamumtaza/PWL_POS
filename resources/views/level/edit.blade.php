@extends('adminlte::page')
@section('title', 'General Form')
@section('content_header')
    <h1>Form Edit Level</h1>
@stop
@section('content')
    <!-- general form elements disabled -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data M_Level</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{url ('level/update',$data->level_id)}}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="level_id">Level ID</label>
                            <input type="text" class="form-control" id="level_id" name="level_id" 
                                value="{{ $data->level_id}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="kodeLevel">Kode Level</label>
                            <input type="text" class="form-control" id="kodeLevel" name="kodeLevel" 
                                value="{{ $data->level_kode}}">  
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
                            <input type="text" class="form-control" id="namaLevel" name="namaLevel" 
                                value="{{ $data->level_nama}}">
                        </div>
                    </div>
                </div>

                <a href="{{url('/level')}}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
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