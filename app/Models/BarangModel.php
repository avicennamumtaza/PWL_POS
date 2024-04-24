<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';

    // protected $guarded = ['password', 'role']; Kolom Password dan Role akan diabaikan dalam operasi database sebagai bentuk proteksi terhadap tindakan-tindakan orang tak bertanggung jawab
    protected $fillable = ['barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id']; // Keempat kolom disamping wajib diberikan value ketika melakukan operasi dalam database
    // protected $fillable = ['level_id', 'username', 'nama'];

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
}
