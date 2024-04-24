@extends('layouts.template')

@section('content')
    <div class="invoice-container mx-4">
        <div class="penjualan-header">
            <hr>
            <h3>Penjualan {{ $penjualan->penjualan_kode }}</h3>
            <hr>
            <p>
                <h4><b>Waktu</b></h4> 
                {{ $penjualan->penjualan_tanggal }}
            </p>
        </div>

        <div class="penjualan-actor">
            <div class="">
                <p>
                    <h4><b>Customer</b></h4> 
                    {{ $penjualan->pembeli }}
                </p>
                <p>
                    <h4><b>Cashier</b></h4> 
                    {{ $penjualan->user->nama }}
                </p>
            </div>
        </div>

        @empty($penjualan)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                <p>Data penjualan tidak ditemukan.</p>
            </div>
        @else
        <hr>
            <div class="penjualan-detail">
                <h4><b>Detail</b></h4>
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $idx = 1; $tot = 0; ?>
                        @foreach ($penjualan_detail as $dt)
                        <tr>
                          <td>{{ $idx++ }}</td>
                          <td>{{ $dt->barang->barang_nama }}</td>
                          <td>{{ $dt->harga }}</td>
                          <td>{{ $dt->jumlah }}</td>
                          <td>{{ $dt->jumlah * $dt->harga }}</td>
                          <?php $tot += $dt->jumlah * $dt->harga; ?>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <h4 style="text-align: right"><b>Total : {{ $tot }}</b></h4>
            </div>
        @endempty

        <div class="invoice-actions">
            <a href="{{ url('penjualan') }}" class="btn btn-primary">Kembali</a>
        </div>
        <br>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
