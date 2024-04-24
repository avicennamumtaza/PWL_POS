@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary mx-4">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah Transaksi</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Pembeli</th>
                        <th>Kode Penjualan</th>
                        <th>Tanggal</th>
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
            var dataPenjualan = $('#table_penjualan').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('penjualan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.penjualan_id = $('#penjualan_id').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()           
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "user.nama",
                    className: "text-center",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "pembeli",
                    className: "text-center",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "penjualan_kode",
                    className: "text-center",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "penjualan_tanggal",
                    className: "text-center",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                }, {
                    data: "aksi",
                    className: "text-center",
                    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan 
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                }]
            });

            $('#user_id').on('change', function() {
                dataPenjualan.ajax.reload();
            });

            $('#penjualan_id').on('change', function() {
                dataPenjualan.ajax.reload();
            });

        });
    </script>
@endpush
