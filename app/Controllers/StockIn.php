<?php

namespace App\Controllers;

// use App\Models\HutangPelangganModel;

class StockIn extends BaseController
{
    protected $StockInModel;
    protected $validation;
    protected $StokBarangModel;
    protected $SupplierContactModel;
    protected $TblpenjualandetailModel;


    public function __construct()
    {
        $this->StockInModel = new \App\Models\StockInModel();
        $this->StokBarangModel = new \App\Models\StokBarangModel();
        $this->validation = \config\Services::validation();
        $this->SupplierContactModel = new \App\Models\SupplierContactModel();
        $this->TblpenjualandetailModel = new \App\Models\TblpenjualandetailModel();
    }

    public function index()
    {
        if (session()->has('logged_in')) {
            $data = [
                'title' => 'Stock In',
                // 'data_row' => $this->PelangganModel->get()->getResult(),
                'item_barang' => $this->StokBarangModel->get()->getResult(),
                'data_supplier_row' =>  $this->SupplierContactModel->select()->get()->getResult()
            ];

            return view('stock_in/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }
    }

    public function getDataStockIn()
    {
        $response = $data['data'] = array();

        //mendapatkan data pelanggan di table user model
        //inisialisasi data tabel , mengambil data dari tabel user
        $result = $this->StockInModel->select()->orderBy('stock_in_id', 'DESC')->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // inisialisai aksi ubah data
            $ops =
                '<button 
                    id="detail_stock_in" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-detail-stock-in"

                    data-stock_in_id= "' . $value->stock_in_id . '"

                    data-stock_in_date= "' . $value->stock_in_date . '"
                    data-stock_in_barang_id= "' . $value->stock_in_barang_id . '"
                    data-stock_in_barang_barcode= "' . $value->stock_in_barang_barcode . '"
                    data-stock_in_supp= "' . $value->stock_in_supp . '"
                    data-stock_in_qty= "' . $value->stock_in_qty . '"
                    data-stock_in_catatan= "' . $value->stock_in_catatan . '"
                    data-stock_in_nama_barang= "' . $value->stock_in_nama_barang . '"
                    data-stock_in_harga_masuk= "' . $value->stock_in_harga_masuk . '"

                    class="btn btn-xs btn-primary">
                    <i class="fas fa-circle-info" ></i> Detail
                </button>';

            $ops .=
                '<button 
                    id="hapus_stock_in"

                    data-stock_in_id="' . $value->stock_in_id . '" 
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++, //ini buat kol nomor
                // $value->stock_in_id,
                // $value->stock_in_barang_id,
                $value->stock_in_barang_barcode,
                $value->stock_in_nama_barang,
                $value->stock_in_qty,
                $value->stock_in_catatan,
                $value->stock_in_date,
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

        $fields['stock_in_date'] = $this->request->getPost('stock_in_date');
        $fields['stock_in_barang_id'] = $this->request->getPost('stock_in_barang_id');
        $fields['stock_in_barang_barcode'] = $this->request->getPost('stock_in_barang_barcode');
        $fields['stock_in_supp'] = $this->request->getPost('stock_in_supp');
        $fields['stock_in_qty'] = $this->request->getPost('stock_in_qty');
        $fields['stock_in_catatan'] = $this->request->getPost('stock_in_catatan');
        $fields['stock_in_nama_barang'] = $this->request->getPost('stock_in_nama_barang');
        $fields['stock_in_harga_masuk'] = $this->request->getPost('stock_in_harga_masuk');

        // 
        $stock_in_qty = $this->request->getPost('stock_in_qty');
        $stock_in_barang_id = $this->request->getPost('stock_in_barang_id');

        // dibawah  ini cara jika library validationnya sudah di inisialisai di constructor (dipanggil lewat instance??? gatau deh nama e apa WKWKW belum tau)
        $this->validation->setRules([
            'stock_in_catatan' =>
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
            if ($this->StockInModel->insert($fields)) {

                // this line below is replication of previously database trigger "stock_in"
                $temp_variable = $this->StokBarangModel->getReadyStockQty($stock_in_barang_id);
                // $response['tempA'] = $query;
                // $response['tempA'] = $query['bstock_ready_stock'];
                $old_stock_qty = $temp_variable['bstock_ready_stock'];

                $added_stock_qty = $old_stock_qty + $stock_in_qty;
                $this->StokBarangModel->where('bstock_id', $stock_in_barang_id)->set('bstock_ready_stock', $added_stock_qty)->update();

                // below is working
                // $this->StokBarangModel->where('bstock_id', $stock_in_barang_id)->set('bstock_ready_stock', $stock_in_qty)->update();

                // this line below is only using "update" without "set" statement. 
                // $this->StokBarangModel->where('bstock_id', 12)->update(['bstock_ready_stock' => 77]);

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

        $stock_in_id = $this->request->getPost('stock_in_id');

        $temp_variable_1 = $this->StockInModel->getStockInQty($stock_in_id);
        $temp_variable_2 = $this->StockInModel->getStockInBarangId($stock_in_id);
        $stock_in_qty = $temp_variable_1['stock_in_qty'];
        $stock_in_barang_id = $temp_variable_2['stock_in_barang_id'];

        if ($this->StockInModel->where('stock_in_id', $stock_in_id)->delete()) {
            // session()->setFlashdata('pesan', 'Data Pelanggan Berhasil Dihapus');
            // return redirect()->to('pelanggan');

            // this line below is replication of previously database trigger "stock_in_deletion"
            $temp_variable_3 = $this->StokBarangModel->getReadyStockQty($stock_in_barang_id);
            $old_stock_qty = $temp_variable_3['bstock_ready_stock'];

            $substracted_stock_qty = $old_stock_qty - $stock_in_qty;
            $this->StokBarangModel->where('bstock_id', $stock_in_barang_id)->set('bstock_ready_stock', $substracted_stock_qty)->update();
            // end of trigger

            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
        return $this->response->setJSON($response);
    }

    // coba2
    // public function save()
    // {
    //     $response = array();


    //     $query = $this->TblpenjualandetailModel->getBstockQty(1173);

    //     $response['success'] = false;
    //     // $response['messages'] = lang("App.insert-error");
    //     // $response['messages'] = $query[1]->bstock_id;
    //     // $response['messages'] = $query[0]->qty;
    //     // $response['messages'] = (int)$query[1]->qty;
    //     // $response['messages'] = "lesgo";


    //     $alpha = 0;
    //     foreach ($query as $row) {
    //         // $bstock_id = $row['bstock_id'];
    //         // $qty = $row['qty'];
    //         $bstock_id = $row->bstock_id;
    //         $qty = $row->qty;
    //         // $alpha += $qty;
    //         // Use $bstock_id and $qty as needed

    //         $old_stock_qty = $this->StokBarangModel->select('bstock_ready_stock')->where('bstock_id', $bstock_id)->first();
    //         // $new_stock_qty = (int)$old_stock_qty + (int)$qty;
    //         // $alpha += (int)$old_stock_qty + (int)$qty;
    //         // $alpha +=  (int)$qty;
    //         // $alpha +=  (int)$old_stock_qty;
    //         $alpha +=  (int)$old_stock_qty;
    //         // $this->StokBarangModel->where('bstock_id', $bstock_id)->set('bstock_ready_stock', $new_stock_qty)->update();
    //     }
    //     $bstock_id = 2;
    //     $alpha = $this->StokBarangModel->select('bstock_ready_stock')->where('bstock_id', $bstock_id)->first();
    //     $beta = (int)$alpha["bstock_ready_stock"];


    //     $k = $query[0]->qty;
    //     $f = $query[1]->qty;
    //     // $response['messages'] = (int)$k + (int)$f;
    //     // $response['messages'] = (int)$k;
    //     // $response['messages'] = $f;
    //     // $response['messages'] = $alpha;
    //     $response['messages'] = $beta;


    //     return $this->response->setJSON($response);
    // }
}
