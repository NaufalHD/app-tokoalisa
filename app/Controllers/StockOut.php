<?php

namespace App\Controllers;

// use App\Models\HutangPelangganModel;

class StockOut extends BaseController
{
    protected $StockOutModel;
    protected $validation;
    protected $StokBarangModel;
    // protected $SupplierContactModel;


    public function __construct()
    {
        $this->StockOutModel = new \App\Models\StockOutModel();
        $this->StokBarangModel = new \App\Models\StokBarangModel();
        $this->validation = \config\Services::validation();
        // $this->SupplierContactModel = new \App\Models\SupplierContactModel();
    }

    public function index()
    {
        if (session()->has('logged_in')) {
            $data = [
                'title' => 'Stock Out',
                // 'data_row' => $this->PelangganModel->get()->getResult(),
                'item_barang' => $this->StokBarangModel->get()->getResult(),
                // 'data_supplier_row' =>  $this->SupplierContactModel->select()->get()->getResult()
            ];
            return view('stock_out/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }
    }

    public function getDataStockOut()
    {
        $response = $data['data'] = array();

        //mendapatkan data pelanggan di table user model
        //inisialisasi data tabel , mengambil data dari tabel user
        $result = $this->StockOutModel->select()->orderBy('stock_out_id', 'DESC')->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // inisialisai aksi ubah data
            $ops =
                '<button 
                    id="detail_stock_out" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-detail-stock-out"

                    data-stock_out_id= "' . $value->stock_out_id . '"

                    data-stock_out_date= "' . $value->stock_out_date . '"
                    data-stock_out_barang_id= "' . $value->stock_out_barang_id . '"
                    data-stock_out_barang_barcode= "' . $value->stock_out_barang_barcode . '"
                    data-stock_out_qty= "' . $value->stock_out_qty . '"
                    data-stock_out_catatan= "' . $value->stock_out_catatan . '"
                    data-stock_out_nama_barang= "' . $value->stock_out_nama_barang . '"

                    class="btn btn-xs btn-primary">
                    <i class="fas fa-circle-info" ></i> Detail
                </button>';

            $ops .=
                '<button 
                    id="hapus_stock_out"

                    data-stock_out_id="' . $value->stock_out_id . '" 
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++, //ini buat kol nomor
                // $value->stock_in_id,
                // $value->stock_in_barang_id,
                $value->stock_out_barang_barcode,
                $value->stock_out_nama_barang,
                $value->stock_out_qty,
                $value->stock_out_catatan,
                $value->stock_out_date,
                // $value->stock_in_supp,
                // $value->stock_in_harga_masuk,

                // $value->diskon,
                // '<div id="total">' . $value->total . '</div>',
                // $value->user_id,

                $ops // buat kolom aksi
            );
        }
        return $this->response->setJSON($data);
    }

    public function save()
    {
        $response = array();

        $fields['stock_out_date'] = $this->request->getPost('stock_out_date');
        $fields['stock_out_barang_id'] = $this->request->getPost('stock_out_barang_id');
        $fields['stock_out_barang_barcode'] = $this->request->getPost('stock_out_barang_barcode');
        // $fields['stock_in_supp'] = $this->request->getPost('stock_in_supp');
        $fields['stock_out_qty'] = $this->request->getPost('stock_out_qty');
        $fields['stock_out_catatan'] = $this->request->getPost('stock_out_catatan');
        $fields['stock_out_nama_barang'] = $this->request->getPost('stock_out_nama_barang');
        // $fields['stock_in_harga_masuk'] = $this->request->getPost('stock_in_harga_masuk');

        $stock_out_qty = $this->request->getPost('stock_out_qty');
        $stock_out_barang_id = $this->request->getPost('stock_out_barang_id');

        // dibawah  ini cara jika library validationnya sudah di inisialisai di constructor (dipanggil lewat instance??? gatau deh nama e apa WKWKW belum tau)
        $this->validation->setRules([
            'stock_out_catatan' =>
            [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Catatan maksimal 255 karakter',
                ]
            ],
        ]);

        if ($this->validation->run($fields) == false) {
            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors();
        } else {
            if ($this->StockOutModel->insert($fields)) {
                // this line below is replication of previously database trigger "stock_out"
                $temp_variable = $this->StokBarangModel->getReadyStockQty($stock_out_barang_id);
                $old_stock_qty = $temp_variable['bstock_ready_stock'];

                $substracted_stock_qty = $old_stock_qty - $stock_out_qty;
                $this->StokBarangModel->where('bstock_id', $stock_out_barang_id)->set('bstock_ready_stock', $substracted_stock_qty)->update();
                // end of trigger

                $response['success'] = true;
                $response['messages'] = lang("App.insert-success");
            } else {
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
        }
        return $this->response->setJSON($response);
    }

    public function delete()
    {
        $response = array();

        $stock_out_id = $this->request->getPost('stock_out_id');

        $temp_variable_1 = $this->StockOutModel->getStockOutQty($stock_out_id);
        $temp_variable_2 = $this->StockOutModel->getStockOutBarangId($stock_out_id);
        $stock_out_qty = $temp_variable_1['stock_out_qty'];
        $stock_out_barang_id = $temp_variable_2['stock_out_barang_id'];


        if ($this->StockOutModel->where('stock_out_id', $stock_out_id)->delete()) {
            // session()->setFlashdata('pesan', 'Data Pelanggan Berhasil Dihapus');
            // return redirect()->to('pelanggan');

            // this line below is replication of previously database trigger "stock_out_deletion"
            $temp_variable_3 = $this->StokBarangModel->getReadyStockQty($stock_out_barang_id);
            $old_stock_qty = $temp_variable_3['bstock_ready_stock'];

            $added_stock_qty = $old_stock_qty + $stock_out_qty;
            $this->StokBarangModel->where('bstock_id', $stock_out_barang_id)->set('bstock_ready_stock', $added_stock_qty)->update();
            // end of trigger

            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
        return $this->response->setJSON($response);
    }
}
