@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary mx-4">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>User</th>
                        <th>Stok Tanggal</th>
                        <th>Stok Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataUser = $('#table_stok').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('stok/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.barang_id = $('#barang_id').val();
                        d.user_id = $('#user_id').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()           
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "barang.barang_nama",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                }, {
                    data: "user.nama",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                }, {
                    data: "stok_tanggal",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                }, {
                    data: "stok_jumlah",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }]
            });

            $('#barang_id').on('change', function() {
                dataUser.ajax.reload();
            });

            $('#user_id').on('change', function() {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush
