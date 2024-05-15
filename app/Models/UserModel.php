<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

use function Laravel\Prompts\password;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    // protected $guarded = ['password', 'role']; Kolom Password dan Role akan diabaikan dalam operasi database sebagai bentuk proteksi terhadap tindakan-tindakan orang tak bertanggung jawab
    protected $fillable = ['username', 'nama', 'password', 'level_id']; // Keempat kolom disamping wajib diberikan value ketika melakukan operasi dalam database
    // protected $fillable = ['level_id', 'username', 'nama'];

    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
