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
                    <!-- text input -->
                    <div class="form-group">
                    <label>Level Kode</label>
                    <input type="text" class="form-control" placeholder="Masukkan Kode Level">
                    </div>
                </div>
                </div>

                <div class="row">
                <div class="col">
                    <!-- text input -->
                    <div class="form-group">
                    <label>Level Nama</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Level">
                    </div>
                </div>
                </div>

            <button type = "submit" class ="btn btn-info">Tambah</button> 
        </div>
    </div>
@stop