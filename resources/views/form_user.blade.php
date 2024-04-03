@extends('adminlte::page') 
 
@section('title', 'Dashboard') 
 
@section('content_header') 
    <h1>General Form</h1> 
@stop 
 
@section('content') 
    <!-- general form elements disabled -->
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Form m_level</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label>Select Level</label>
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Masukkan Username">
                    </div>
                </div>
                </div>

                <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama User">
                    </div>
                </div>
                </div>

                <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Masukkan Password">
                    </div>
                </div>
                </div>

            <button type = "submit" class ="btn btn-info">Tambah</button> 
        </div>
    </div>
@stop