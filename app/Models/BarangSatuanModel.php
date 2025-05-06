<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class BarangSatuanModel extends Model
{
    protected $table = 'barang_satuan';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $primaryKey = 'bsatuan_id';

    // dibawah ini untuk mengijinkan jika field2 tersebut akan diisi manual oleh kita
    // protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    protected $allowedFields = ['bsatuan_nama'];
    // protected $primaryKey = 'id';

    // settingn dibawah ngaruh ke verifikasi password bagian login nya, 
    // pas ngambil username/password di bagian if pada controller login
    // protected $returnType = "object";

}
