<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rs';

    protected $table = 'tb_rs';

    protected $fillable = ['nama_rs','latlng_rs','tipe_rs','gambar_rs','alamat_rs'];

    public $timestamps = false;


}