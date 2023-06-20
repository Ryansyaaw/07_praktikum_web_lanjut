<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table="mahasiswas";
    public $timestamps= false;
    protected $primaryKey = 'Nim' ;

    /**
    * The attributes that are mass assignable.* *
    @var array
    */
    protected $fillable = [
        'Nim',
        'Nama',
        'Kelas',
        'Jurusan',
        'No_Handphone',
        'Email',
        'Alamat',
        'kelas_id',
        ];
    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
