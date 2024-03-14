<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\password;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    // protected $guarded = ['password', 'role']; Kolom Password dan Role akan diabaikan dalam operasi database sebagai bentuk proteksi terhadap tindakan-tindakan orang tak bertanggung jawab
    protected $fillable = ['username', 'nama', 'password', 'level_id']; // Keempat kolom disamping wajib diberikan value ketika melakukan operasi dalam database
    // protected $fillable = ['level_id', 'username', 'nama'];
}
