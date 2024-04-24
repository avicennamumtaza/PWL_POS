@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('penjualan/') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">User</label>
                    <div class="col-11">
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="">- Pilih User -</option>
                            @foreach ($user as $item)
                                <option value="{{ $item->user_id }}"
                                    {{ old('user_id') == $item->user_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kode Penjulan</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                            value="{{ $penjualan_kode }}" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Pembeli</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="pembeli" name="pembeli"
                            value="{{ old('pembeli') }}" required placeholder="Masukkan Nama Pembeli">
                        @error('pembeli')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div id="formBarangContainer">
                    <div id="formBarang" class="form-barang">
                        <div class="card-header">
                            <h3 class="card-title">Detail Transaksi Barang</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-danger px-2 btn-sm hapusBarang"><b>x</b></button>
                            </div>
                        </div>
                        <br>

                        <div class="form-group row">
                            <label class="col-1 control-label col-form-label">Barang</label>
                            <div class="col-11">
                                <select class="form-control" id="barang_id" name="barang_id[]" required>
                                    <option value="">- Pilih Barang -</option>
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->barang_id }}" data-harga_jual="{{ $item->harga_jual }}">
                                            {{ $item->barang_nama }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-1 control-label col-form-label">Harga</label>
                            <div class="col-11">
                                <input type="number" class="form-control" id="harga" name="harga[]" required readonly>
                                @error('harga.*')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-1 control-label col-form-label">Jumlah</label>
                            <div class="col-11">
                                <input type="number" class="form-control" id="jumlah" name="jumlah[]" required>
                                @error('jumlah.*')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success mt-3" id="tambahBarang"><b>+</b></button>
                <br><br><br>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Menambahkan form barang baru saat tombol "Tambah Barang" ditekan
            $('#tambahBarang').click(function() {
                var formBarang = $('#formBarang').clone();
                formBarang.find('input').val('');

                var timestamp = new Date().getTime(); // Membuat ID unik
                formBarang.find('select').attr('id', 'barang_id_' + timestamp);
                formBarang.find('input[name="harga[]"]').attr('id', 'harga_' + timestamp);
                formBarang.find('input[name="harga[]"]').attr('name','harga[]'); // Menghapus pengaturan name
                formBarang.find('input[name="jumlah[]"]').attr('id', 'jumlah_' + timestamp);
                formBarang.find('input[name="jumlah[]"]').attr('name','jumlah[]'); // Menghapus pengaturan name

                $('#formBarangContainer').append(formBarang);

                // Menambahkan tombol "Hapus" untuk menghapus formulir barang yang baru ditambahkan
                formBarang.find('.hapusBarang').click(function() {
                    $(this).closest('.form-barang').remove();
                });

                // Menambahkan penanganan perubahan harga untuk elemen formulir barang yang baru ditambahkan
                $('#barang_id_' + timestamp).change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var harga_jual = selectedOption.data('harga_jual');
                    $(this).closest('.form-barang').find('input[name="harga[]"]').val(harga_jual);
                });
            });

            // Menambahkan penanganan perubahan harga untuk elemen formulir barang yang asli
            $('#barang_id').change(function() {
                var selectedOption = $(this).find('option:selected');
                var harga_jual = selectedOption.data('harga_jual');
                $('#harga').val(harga_jual);
            });
        });
    </script>
@endpush