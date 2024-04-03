@extends('adminlte::page')
@section('title', 'Form User')
@section('content_header')
    <h1>Form User</h1>
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
            <h3 class="card-title">Tambah Data User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{url ('/user')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col">
                        <!-- select -->
                        <div class="form-group">
                            <label>Level ID</label>
                            <select class="form-control" name="level_id">
                                <option value=1>Administrator</option>
                                <option value=2>Manager</option>
                                <option value=3>Staff/Kasir</option>
                                <option value=4>Customer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="@error('username') is-invalid @enderror form-control" placeholder="Masukkan Username" name="username" id="username">
                            
                            @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama" id="nama">
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col">
                      <!-- textarea -->
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" placeholder="Masukkan Password" name="password" id="password">
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