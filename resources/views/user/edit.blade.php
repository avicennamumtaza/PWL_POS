@extends('adminlte::page')
@section('title', 'General Form')
@section('content_header')
    <h1>Form Edit User</h1>
@stop
@section('content')
    <!-- general form elements disabled -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{url ('user/update',$data->user_id)}}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="level_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" 
                                value="{{ $data->user_id}}"disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <!-- select input -->
                        <div class="form-group">
                            <label for="level_id">Level ID</label>
                            <select class="form-control" name="level_id">
                                <option value=1 {{ $data->level_id == 1 ? 'selected' : '' }}>Administrator</option>
                                <option value=2 {{ $data->level_id == 2 ? 'selected' : '' }}>Manager</option>
                                <option value=3 {{ $data->level_id == 3 ? 'selected' : '' }}>Staff/Kasir</option>
                                <option value=4 {{ $data->level_id == 4 ? 'selected' : '' }}>Customer</option>
                            </select>
                        </div>
                    </div>
                </div>                

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="kodeLevel">Username</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                value="{{ $data->username}}">  
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <!-- textarea -->
                        <div class="form-group">
                            <label for="namaLevel">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                value="{{ $data->nama}}">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <!-- textarea -->
                        <div class="form-group">
                            <label for="namaLevel">Password</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                value="{{ $data->password}}">
                        </div>
                    </div>
                </div>

                <a href="{{url('/user')}}" class="btn btn-danger">Kembali</a>
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