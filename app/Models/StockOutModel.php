<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class StockOutModel extends Model
{
    protected $table = 'stock_out';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $primaryKey = 'stock_out_id';

    // dibawah ini untuk mengijinkan jika field2 tersebut akan diisi manual oleh kita
    // protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    protected $allowedFields = [
        'stock_out_date',
        'stock_out_barang_id',
        'stock_out_barang_barcode',
        'stock_out_nama_barang',
        'stock_out_qty',
        'stock_out_catatan',
    ];
    // protected $primaryKey = 'id';

    public function getStockOutBarangId($stock_out_id = false)
    {
        if ($stock_out_id == false) {
            return null;
        } else {
            return $this->select('stock_out_barang_id')->where(['stock_out_id' => $stock_out_id])->first();
        }
    }

    public function getStockOutQty($stock_out_id = false)
    {
        if ($stock_out_id == false) {
            return null;
        } else {
            return $this->select('stock_out_qty')->where(['stock_out_id' => $stock_out_id])->first();
        }
    }
}
