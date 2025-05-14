<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class StockInModel extends Model
{
    protected $table = 'stock_in';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $primaryKey = 'stock_in_id';

    // dibawah ini untuk mengijinkan jika field2 tersebut akan diisi manual oleh kita
    // protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    protected $allowedFields = [
        'stock_in_date',
        'stock_in_barang_id',
        'stock_in_barang_barcode',
        'stock_in_supp',
        'stock_in_catatan',
        'stock_in_qty',
        'stock_in_nama_barang',
        'stock_in_harga_masuk',
    ];
    // protected $primaryKey = 'id';

    public function getStockInBarangId($stock_in_id = false)
    {
        if ($stock_in_id == false) {
            return null;
        } else {
            return $this->select('stock_in_barang_id')->where(['stock_in_id' => $stock_in_id])->first();
        }
    }

    public function getStockInQty($stock_in_id = false)
    {
        if ($stock_in_id == false) {
            return null;
        } else {
            return $this->select('stock_in_qty')->where(['stock_in_id' => $stock_in_id])->first();
        }
    }
}
